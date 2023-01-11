<?php

namespace Slps970093\Live100ms\Room;

use Doctrine\Common\Annotations\AnnotationReader;
use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\Room\JsonEntities\CreateRoomRequest;
use Slps970093\Live100ms\Room\JsonEntities\CreateRoomResponse;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Room
{
    private string $managerToken = "";

    private int $apiVersion = 2;

    public function __construct(string $managerToken, int $apiVersion)
    {
        $this->apiVersion   = $apiVersion;
        $this->managerToken = $managerToken;
    }

    public function createRoom(CreateRoomRequest $request): CreateRoomResponse
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);
        $serializer = new Serializer(
            [new ObjectNormalizer($classMetadataFactory,$metadataAwareNameConverter,null, new ReflectionExtractor()),],
            [new JsonEncoder()]
        );
        $apiResult = Http::withBody($serializer->serialize($request,'json'), "application/json")
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/rooms", []);


        return $serializer->deserialize($apiResult->body(), CreateRoomResponse::class, 'json');
    }
}
