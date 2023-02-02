<?php

namespace Slps970093\Live100ms\Tests\Policy;

use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\Auth\ManagementToken;
use Slps970093\Live100ms\Policy\Dto\RoleItem;
use Slps970093\Live100ms\Policy\Role;
use Slps970093\Live100ms\SerializerFactory;
use Slps970093\Live100ms\Tests\AbstractPkgTestCase;
use Slps970093\Live100ms\Policy\Dto\Role\Role as DtoRole;

class RoleTest extends AbstractPkgTestCase
{
    public function test_createOrUpdateRole()
    {
        $templateId  = 'tpl-2022';
        $roleName    = 'monkey';
        $requestJson = <<<JSON
{
    "publishParams": {
        "allowed": [
            "audio",
            "video",
            "screen"
        ],
        "audio": {
            "bitRate": 32,
            "codec": "opus"
        },
        "video": {
            "bitRate": 310,
            "codec": "vp8",
            "frameRate": 30,
            "width": 480,
            "height": 360
        },
        "screen": {
            "codec": "vp8",
            "frameRate": 10,
            "width": 1920,
            "height": 1080
        },
        "videoSimulcastLayers": {},
        "screenSimulcastLayers": {}
    },
    "subscribeParams": {
        "subscribeToRoles": [
            "guest",
            "host"
        ],
        "maxSubsBitRate": 3200,
        "subscribeDegradation": {
            "packetLossThreshold": 25,
            "degradeGracePeriodSeconds": 1,
            "recoverGracePeriodSeconds": 4
        }
    },
    "permissions": {
        "endRoom": true,
        "removeOthers": true,
        "mute": true,
        "unmute": true,
        "changeRole": true,
        "sendRoomState": false
    },
    "priority": 1,
    "maxPeerCount": 0
}
JSON;
        $expectedJson = <<<JSON
{
    "name": "{$roleName}",
    "publishParams": {
        "allowed": [
            "audio",
            "video",
            "screen"
        ],
        "audio": {
            "bitRate": 32,
            "codec": "opus"
        },
        "video": {
            "bitRate": 310,
            "codec": "vp8",
            "frameRate": 30,
            "width": 480,
            "height": 360
        },
        "screen": {
            "codec": "vp8",
            "frameRate": 10,
            "width": 1920,
            "height": 1080
        },
        "videoSimulcastLayers": {},
        "screenSimulcastLayers": {}
    },
    "subscribeParams": {
        "subscribeToRoles": [
            "guest",
            "host"
        ],
        "maxSubsBitRate": 3200,
        "subscribeDegradation": {
            "packetLossThreshold": 25,
            "degradeGracePeriodSeconds": 1,
            "recoverGracePeriodSeconds": 4
        }
    },
    "permissions": {
        "endRoom": true,
        "removeOthers": true,
        "mute": true,
        "unmute": true,
        "changeRole": true,
        "sendRoomState": false
    },
    "priority": 1,
    "maxPeerCount": 0
}
JSON;

        /** @var ManagementToken $mgrToken */
        $mgrToken = $this->app->make(ManagementToken::class);

        $jwtToken = $mgrToken->createToken(Carbon::now(), Carbon::now()->addHours(1));

        Http::fake([
            "https://api.100ms.live/v2/templates/{$templateId}/roles/{$roleName}" => Http::response(
                $expectedJson,
                200,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ]);

        $dtoRole = SerializerFactory::create()->deserialize($requestJson, DtoRole::class, 'json');

        $role = new Role($jwtToken, 2);
        $roleDetail = $role->createOrEditRole($templateId, $roleName, $dtoRole);

        Http::assertSent(function (Request $request) use ($jwtToken) {
            return $request->hasHeader('Authorization', "Bearer {$jwtToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);

        $expectedDto = SerializerFactory::create()->deserialize($expectedJson, RoleItem::class, 'json');
        $this->assertEquals($expectedDto, $roleDetail);
    }

    public function test_deleteRole()
    {
        $templateId  = 'tpl-2022';
        $roleName    = 'monkey';
        /** @var ManagementToken $mgrToken */
        $mgrToken = $this->app->make(ManagementToken::class);

        $jwtToken = $mgrToken->createToken(Carbon::now(), Carbon::now()->addHours(1));

        Http::fake([
            "https://api.100ms.live/v2/templates/{$templateId}/roles/{$roleName}" => Http::response(
                "",
                204,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ]);

        $role = new Role($jwtToken, 2);

        $this->assertTrue($role->deleteRole($templateId, $roleName));

        Http::assertSent(function (Request $request) use ($jwtToken) {
            return $request->hasHeader('Authorization', "Bearer {$jwtToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);
    }
}
