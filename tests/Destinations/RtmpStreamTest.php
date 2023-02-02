<?php

namespace Slps970093\Live100ms\Tests\Destinations;

use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\Auth\ManagementToken;
use Slps970093\Live100ms\Destinations\Dto\RtmpStream\BasicStreamAction;
use Slps970093\Live100ms\Destinations\Dto\RtmpStream\StartStream;
use Slps970093\Live100ms\Destinations\RtmpStream;
use Slps970093\Live100ms\SerializerFactory;
use Slps970093\Live100ms\Tests\AbstractPkgTestCase;

class RtmpStreamTest extends AbstractPkgTestCase
{
    public function test_createStream()
    {
        $requestJson = <<<JSON
{
    "operation": "start",
    "room_id": "",
    "meeting_url": "<meeting_url>",
    "rtmp_urls": [
      "<rtmp_url_1>", "<rtmp_url_2>"
    ],
    "record": true,
    "resolution" : {"width": 1280, "height": 720}
}
JSON;
        /** @var StartStream $dtoStartRtmpStream */
        $dtoStartRtmpStream = SerializerFactory::create()->deserialize($requestJson, StartStream::class,'json');

        /** @var ManagementToken $managerToken */
        $managerToken = $this->app->make(ManagementToken::class);
        $issuedAt = Carbon::now();
        $expireAt = Carbon::now()->addHours(1);
        $jwtToken = $managerToken->createToken($issuedAt, $expireAt);

        Http::fake([
            "https://api.100ms.live/v2/beam" => Http::response('Beam has started successfully',200)
        ]);

        $rtmpStream = new RtmpStream($jwtToken,2);
        $this->assertTrue($rtmpStream->startStream($dtoStartRtmpStream));

        Http::assertSent(function (Request $request) use ($jwtToken) {
            return $request->hasHeader('Authorization', "Bearer {$jwtToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);
    }

    public function test_stopStream()
    {
        $requestJson = <<<JSON
{
    "operation": "stop",
    "room_id": "123456"
}
JSON;
        $dtoBasicStreamAction = SerializerFactory::create()->deserialize($requestJson,BasicStreamAction::class,'json');

        /** @var ManagementToken $managerToken */
        $managerToken = $this->app->make(ManagementToken::class);
        $issuedAt = Carbon::now();
        $expireAt = Carbon::now()->addHours(1);
        $jwtToken = $managerToken->createToken($issuedAt, $expireAt);

        Http::fake([
            "https://api.100ms.live/v2/beam" => Http::response('Beam has stopped successfully',200)
        ]);

        $rtmpStream = new RtmpStream($jwtToken,2);
        $this->assertTrue($rtmpStream->stopStream($dtoBasicStreamAction));

        Http::assertSent(function (Request $request) use ($jwtToken) {
            return $request->hasHeader('Authorization', "Bearer {$jwtToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);
    }
}