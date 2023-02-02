<?php

namespace Slps970093\Live100ms\Destinations;

use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\AbstractManagerApi;
use Slps970093\Live100ms\Destinations\Dto\RtmpStream\BasicStreamAction;
use Slps970093\Live100ms\Destinations\Dto\RtmpStream\StartStream;
use Slps970093\Live100ms\SerializerFactory;

class RtmpStream extends AbstractManagerApi
{
    public function startStream(StartStream $startStream): bool
    {
        $serializer = SerializerFactory::create();
        $apiResult = Http::withBody($serializer->serialize($startStream,'json'),'application/json')
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/beam", []);

        return $apiResult->status() == 200;
    }

    public function stopStream(BasicStreamAction $basicStreamAction): bool
    {
        $serializer = SerializerFactory::create();
        $apiResult = Http::withBody($serializer->serialize($basicStreamAction,'json'),'application/json')
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/beam", []);

        return $apiResult->status() == 200;
    }
}