<?php

namespace Slps970093\Live100ms\Policy;

use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\AbstractManagerApi;
use Slps970093\Live100ms\Policy\Dto\Template as DtoTemplate;
use Slps970093\Live100ms\Policy\Dto\TemplateItem as DtoTemplateItem;
use Slps970093\Live100ms\SerializerFactory;

class Template extends AbstractManagerApi
{
    public function create(DtoTemplate $template)
    {
        $serializer = SerializerFactory::create();
        $apiResult = Http::withBody($serializer->serialize($template,'json'),'application/json')
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/templates", []);

        return $serializer->deserialize($apiResult->body(), DtoTemplateItem::class, 'json');
    }

    public function update($id, DtoTemplate $template)
    {
        $serializer = SerializerFactory::create();
        $apiResult = Http::withBody($serializer->serialize($template,'json'),'application/json')
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/templates/{$id}", []);

        return $serializer->deserialize($apiResult->body(), DtoTemplateItem::class, 'json');
    }
}