<?php

namespace Slps970093\Live100ms\Room;

use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\AbstractManagerApi;
use Slps970093\Live100ms\Room\Dto\CreateRoomRequest;
use Slps970093\Live100ms\Room\Dto\CreateRoomResponse;
use Slps970093\Live100ms\SerializerFactory;

class Room extends AbstractManagerApi
{
    public function createRoom(CreateRoomRequest $request): CreateRoomResponse
    {
        $serializer = SerializerFactory::create();
        $apiResult = Http::withBody($serializer->serialize($request, 'json'), "application/json")
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/rooms", []);


        return $serializer->deserialize($apiResult->body(), CreateRoomResponse::class, 'json');
    }
}
