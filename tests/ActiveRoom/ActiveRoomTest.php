<?php

namespace Slps970093\Live100ms\Tests\ActiveRoom;

use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\ActiveRoom\ActiveRoom;
use Slps970093\Live100ms\ActiveRoom\Dto\EndRoomRequest;
use Slps970093\Live100ms\ActiveRoom\Dto\RemovePeerRequest;
use Slps970093\Live100ms\Auth\ManagementToken;
use Slps970093\Live100ms\Tests\AbstractPkgTestCase;

class ActiveRoomTest extends AbstractPkgTestCase
{
    public function test_removePeer()
    {
        $roomId = "aries12345";

        $expectedJsonResponse = <<<JSON
{
    "message": "peer remove request submitted"
}
JSON;

        Http::fake([
            "https://api.100ms.live/v2/active-rooms/{$roomId}/remove-peers" => Http::response(
                $expectedJsonResponse,
                200,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ]);

        /** @var ManagementToken $mgrToken */
        $mgrToken = $this->app->make(ManagementToken::class);
        $jwtToken = $mgrToken->createToken(Carbon::now(), Carbon::now()->addHours(1));
        $activeRoom = new ActiveRoom($jwtToken, 2);

        $dtoRequest = new RemovePeerRequest();
        $response = $activeRoom->removePeer($roomId, $dtoRequest);

        Http::assertSent(function (Request $request) use ($jwtToken) {
            return $request->hasHeader('Authorization', "Bearer {$jwtToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);

        $this->assertEquals('peer remove request submitted', $response->message);
    }
    public function test_endRoom()
    {
        $roomId = "aries12345";

        $expectedJsonResponse = <<<JSON
{
    "message": "session is ending"
}
JSON;

        Http::fake([
            "https://api.100ms.live/v2/active-rooms/{$roomId}/end-room" => Http::response(
                $expectedJsonResponse,
                200,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ]);

        /** @var ManagementToken $mgrToken */
        $mgrToken = $this->app->make(ManagementToken::class);
        $jwtToken = $mgrToken->createToken(Carbon::now(), Carbon::now()->addHours(1));
        $activeRoom = new ActiveRoom($jwtToken, 2);

        $dtoRequest = new EndRoomRequest();
        $dtoRequest->lock = false;
        $response = $activeRoom->endActiveRoom($roomId, $dtoRequest);

        Http::assertSent(function (Request $request) use ($jwtToken) {
            return $request->hasHeader('Authorization', "Bearer {$jwtToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);

        $this->assertEquals('session is ending', $response->message);
    }
}
