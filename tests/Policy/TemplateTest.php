<?php

namespace Slps970093\Live100ms\Tests\Policy;

use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\Auth\ManagementToken;
use Slps970093\Live100ms\Policy\Dto\Template as DtoTemplate;
use Slps970093\Live100ms\Policy\Dto\TemplateItem as DtoTemplateItem;
use Slps970093\Live100ms\Policy\Template;
use Slps970093\Live100ms\SerializerFactory;
use Slps970093\Live100ms\Tests\AbstractPkgTestCase;

class TemplateTest extends AbstractPkgTestCase
{

    public function test_create()
    {
        $originJsonRequest = <<<JSON
{
    "name": "new-template-haha",
    "default": false,
    "roles": {
        "guest": {
            "name": "guest",
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
                    "bitRate": 300,
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
                    "host",
                    "guest"
                ],
                "maxSubsBitRate": 3200,
                "subscribeDegradation": {
                    "packetLossThreshold": 25,
                    "degradeGracePeriodSeconds": 1,
                    "recoverGracePeriodSeconds": 4
                }
            },
            "permissions": {
                "sendRoomState": false
            },
            "priority": 1,
            "maxPeerCount": 0
        },
        "host": {
            "name": "host",
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
                    "bitRate": 300,
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
    },
    "settings": {
        "region": "in",
        "subscribeDegradation": {},
        "recording": {
            "enabled": false,
            "upload": {
                "type": "<upload type: supported are s3, gs, oss>",
                "location": "<Name of the storage bucket>",
                "prefix": "<Upload prefix path>",
                "options": {
                    "region": "<region of the storage bucket>"
                },
                "credentials": {
                    "key": "<access key ID for accessing the storage bucket>",
                    "secretKey": "<secret access key for accessing the storage bucket>"
                }
            }
        },
        "screenSimulcastLayers": {},
        "videoSimulcastLayers": {},
        "roomState": {
            "messageInterval": 5,
            "sendPeerList": false,
            "stopRoomStateOnJoin": true,
            "enabled": false
        }
    },
    "destinations": {
        "browserRecordings": {},
        "rtmpDestinations": {},
        "hlsDestinations": {}
    }
}
JSON;
        $expectedJsonResponse = <<<JSON
{
    "id": "6324661c4da877930beaecaa",
    "name": "new-template-haha",
    "default": false,
    "roles": {
        "guest": {
            "name": "guest",
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
                    "bitRate": 300,
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
                    "host",
                    "guest"
                ],
                "maxSubsBitRate": 3200,
                "subscribeDegradation": {
                    "packetLossThreshold": 25,
                    "degradeGracePeriodSeconds": 1,
                    "recoverGracePeriodSeconds": 4
                }
            },
            "permissions": {
                "sendRoomState": false
            },
            "priority": 1,
            "maxPeerCount": 0
        },
        "host": {
            "name": "host",
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
                    "bitRate": 300,
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
    },
    "settings": {
        "region": "in",
        "subscribeDegradation": {},
        "recording": {
            "enabled": false,
            "upload": {
                "type": "<upload type: supported are s3, gs, oss>",
                "location": "<Name of the storage bucket>",
                "prefix": "<Upload prefix path>",
                "options": {
                    "region": "<region of the storage bucket>"
                },
                "credentials": {
                    "key": "<access key ID for accessing the storage bucket>",
                    "secretKey": "<secret access key for accessing the storage bucket>"
                }
            }
        },
        "screenSimulcastLayers": {},
        "videoSimulcastLayers": {},
        "roomState": {
            "messageInterval": 5,
            "sendPeerList": false,
            "stopRoomStateOnJoin": true,
            "enabled": false
        }
    },
    "destinations": {
        "browserRecordings": {},
        "rtmpDestinations": {},
        "hlsDestinations": {}
    },
    "createdAt": "2022-09-16T12:03:40.068Z",
    "updatedAt": "2022-09-16T12:03:40.068Z",
    "_id": "6324661c4da877930beaecaa",
    "customer": "627cda54ff688c037a39291b"
}
JSON;
        Http::fake([
            "https://api.100ms.live/v2/templates" => Http::response(
                $expectedJsonResponse,
                200,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ]);

        $serializer = SerializerFactory::create();

        /** @var DtoTemplate $requestDto */
        $requestDto = $serializer->deserialize($originJsonRequest,DtoTemplate::class,'json');

        /** @var ManagementToken $mgrToken */
        $mgrToken = $this->app->make(ManagementToken::class);

        $mgrApiToken = $mgrToken->createToken(Carbon::now(),Carbon::now()->addHours(1));

        $template = new Template($mgrApiToken,2);

        $response = $template->create($requestDto);

        Http::assertSent(function (Request $request) use ($mgrApiToken) {
            return $request->hasHeader('Authorization', "Bearer {$mgrApiToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);

        $this->assertEquals(
            $serializer->deserialize($expectedJsonResponse,DtoTemplateItem::class,'json'),
            $response
        );
    }

    public function test_update()
    {
        $expectedJsonResponse = <<<JSON
{
    "id": "6324661c4da877930beaecaa",
    "name": "new-template-newTpl-1",
    "default": false,
    "roles": {
        "guest": {
            "name": "guest",
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
                    "bitRate": 300,
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
                    "host",
                    "guest"
                ],
                "maxSubsBitRate": 3200,
                "subscribeDegradation": {
                    "packetLossThreshold": 25,
                    "degradeGracePeriodSeconds": 1,
                    "recoverGracePeriodSeconds": 4
                }
            },
            "permissions": {
                "sendRoomState": false
            },
            "priority": 1,
            "maxPeerCount": 0
        },
        "host": {
            "name": "host",
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
                    "bitRate": 300,
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
    },
    "settings": {
        "region": "in",
        "subscribeDegradation": {},
        "recording": {
            "enabled": false,
            "upload": {
                "type": "<upload type: supported are s3, gs, oss>",
                "location": "<Name of the storage bucket>",
                "prefix": "<Upload prefix path>",
                "options": {
                    "region": "<region of the storage bucket>"
                },
                "credentials": {
                    "key": "<access key ID for accessing the storage bucket>",
                    "secretKey": "<secret access key for accessing the storage bucket>"
                }
            }
        },
        "screenSimulcastLayers": {},
        "videoSimulcastLayers": {},
        "roomState": {
            "messageInterval": 5,
            "sendPeerList": false,
            "stopRoomStateOnJoin": true,
            "enabled": false
        }
    },
    "destinations": {
        "browserRecordings": {},
        "rtmpDestinations": {},
        "hlsDestinations": {}
    },
    "createdAt": "2022-09-16T12:03:40.068Z",
    "updatedAt": "2022-09-16T12:03:40.068Z",
    "_id": "6324661c4da877930beaecaa",
    "customer": "627cda54ff688c037a39291b"
}
JSON;
        Http::fake([
            "https://api.100ms.live/v2/templates/6324661c4da877930beaecaa" => Http::response(
                $expectedJsonResponse,
                200,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ]);

        $serializer = SerializerFactory::create();

        $dtoTemplate = $serializer->deserialize($expectedJsonResponse,DtoTemplate::class,'json');

        /** @var ManagementToken $mgrToken */
        $mgrToken = $this->app->make(ManagementToken::class);

        $mgrApiToken = $mgrToken->createToken(Carbon::now(),Carbon::now()->addHours(1));

        $template = new Template($mgrApiToken,2);

        $response = $template->update('6324661c4da877930beaecaa', $dtoTemplate);

        Http::assertSent(function (Request $request) use ($mgrApiToken) {
            return $request->hasHeader('Authorization', "Bearer {$mgrApiToken}");
        });

        # 確認請求 至少送過一次
        Http::assertSentCount(1);

        $this->assertEquals(
            $serializer->deserialize($expectedJsonResponse,DtoTemplateItem::class,'json'),
            $response
        );
    }
}