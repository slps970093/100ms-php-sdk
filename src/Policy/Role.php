<?php

namespace Slps970093\Live100ms\Policy;

use Illuminate\Support\Facades\Http;
use Slps970093\Live100ms\AbstractManagerApi;
use Slps970093\Live100ms\Policy\Dto\Role\Role as DtoRole;
use Slps970093\Live100ms\Policy\Dto\RoleItem;
use Slps970093\Live100ms\SerializerFactory;

class Role extends AbstractManagerApi
{
    /**
     *
     * @see https://www.100ms.live/docs/server-side/v2/policy/create-update-role
     * @param string $templateId
     * @param string $roleName
     * @param DtoRole $dtoRole
     * @return RoleItem
     */
    public function createOrEditRole(string $templateId, string $roleName, DtoRole $dtoRole): RoleItem
    {
        $json = SerializerFactory::create()->serialize($dtoRole, 'json');

        $apiResult = Http::withBody($json, 'application/json')
            ->withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->post("https://api.100ms.live/v{$this->apiVersion}/templates/{$templateId}/roles/{$roleName}", []);

        return SerializerFactory::create()
            ->deserialize($apiResult->body(), RoleItem::class, 'json');
    }

    /**
     * delete role
     * @see https://www.100ms.live/docs/server-side/v2/policy/delete-a-role
     *
     * @param string $templateId
     * @param string $roleName
     * @return bool
     */
    public function deleteRole(string $templateId, string $roleName): bool
    {
        $apiResult = Http::withHeaders([
                "Authorization" => "Bearer {$this->managerToken}"
            ])
            ->delete("https://api.100ms.live/v{$this->apiVersion}/templates/{$templateId}/roles/{$roleName}", []);

        return $apiResult->status() == 204;
    }
}
