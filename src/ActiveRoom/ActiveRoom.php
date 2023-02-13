<?php

namespace Slps970093\Live100ms\ActiveRoom;

use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\AbstractManagerApi;
use Slps970093\Live100ms\ActiveRoom\Dto\EndRoomRequest;
use Slps970093\Live100ms\ActiveRoom\Dto\MessageResponse;
use Slps970093\Live100ms\ActiveRoom\Dto\RemovePeerRequest;
use Slps970093\Live100ms\SerializerFactory;

class ActiveRoom extends AbstractManagerApi
{
    public function removePeer($roomId, RemovePeerRequest $request): MessageResponse
    {
        $serializer = SerializerFactory::create();
        $apiResult = Http::withBody($serializer->serialize($request, 'json'), 'application/json')
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/active-rooms/{$roomId}/remove-peers");

        return $serializer->deserialize($apiResult->body(), MessageResponse::class, 'json');
    }
    public function endActiveRoom($roomId, EndRoomRequest $request): MessageResponse
    {
        $serializer = SerializerFactory::create();
        $apiResult = Http::withBody($serializer->serialize($request, 'json'), 'application/json')
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/active-rooms/{$roomId}/end-room");

        return $serializer->deserialize($apiResult->body(), MessageResponse::class, 'json');
    }
}
