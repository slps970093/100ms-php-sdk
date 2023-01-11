<?php

namespace Slps970093\Live100ms\Tests\Room;

use Carbon\Carbon;
use Doctrine\Common\Annotations\AnnotationReader;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;
use Slps970093\Live100ms\Auth\ManagementToken;
use Slps970093\Live100ms\Live100msServiceProvider;
use Slps970093\Live100ms\Room\JsonEntities\CreateRoomRequest;
use Slps970093\Live100ms\Room\JsonEntities\CreateRoomResponse;
use Slps970093\Live100ms\Room\Room;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RoomTest extends TestCase
{
    public function test_createRoom()
    {
        $roomRequest = new CreateRoomRequest();
        $roomRequest->name = "測試房間";
        $roomRequest->description = 'This is sample description for room';
        $roomRequest->templateId = "xxxx-cat";

        $fakeResponse = [
            'id' => '631a05390e6ffae22efa610b',
            'name' => $roomRequest->name,
            'enabled' => true,
            'description' => $roomRequest->description,
            'customer' => '627cdddff2e4e30487862ad1',
            'recording_source_template' => false,
            'recording_info' => (object) [
                'enabled' => true,
                'upload_info' => (object) [
                    'type' => 's3',
                    'location' => 'brytecam-test-bucket-ap-south-1',
                    'prefix' => 'dev/627cdddff2e4e30487862ad1',
                ],
            ],
            'template_id' => $roomRequest->templateId,
            'template' => 'new-template-1662550293',
            'region' =>  $roomRequest->region,
            'created_at' => '2022-09-08T15:07:37.83Z',
            'updated_at' => '2022-09-08T15:07:37.83Z',
        ];

        Http::fake([
            "https://api.100ms.live/v2/rooms" => Http::response(
                $fakeResponse,
                200,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ]);

        /** @var ManagementToken $managerToken */
        $managerToken = $this->app->make(ManagementToken::class);
        $issuedAt = Carbon::now();
        $expireAt = Carbon::now()->addHours(1);
        $jwtToken = $managerToken->createToken($issuedAt, $expireAt);

        $room = new Room($jwtToken, 2);

        $response = $room->createRoom($roomRequest);

        Http::assertSent(function (Request $request) use ($jwtToken) {
            return $request->hasHeader('Authorization', "Bearer {$jwtToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);

        # 比對結構
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);
        $serializer = new Serializer([new ObjectNormalizer($classMetadataFactory,$metadataAwareNameConverter,null, new ReflectionExtractor())], [new JsonEncoder()]);
        $expected = $serializer->deserialize(json_encode($fakeResponse), CreateRoomResponse::class, 'json');
        $expected->createdAt = $response->createdAt;
        $expected->updatedAt = $response->updatedAt;
        $this->assertEquals($expected, $response);
    }

    protected function getPackageProviders($app): array
    {
        return [
            Live100msServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('100ms.access_token', 'app-access-token');
        $app['config']->set('100ms.secret', 'app-secret');
        $app['config']->set('100ms.api-version', 2);
    }
}
