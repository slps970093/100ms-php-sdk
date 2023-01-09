<?php

namespace Slps970093\Live100ms\Auth;

use Carbon\Carbon;

class ManagementToken extends AbstractToken
{
    protected function getPayload(Carbon $issuedAt, Carbon $expireAt): array
    {
        return [
            'access_key' => $this->appKey,
            'type' => 'management',
            'version' => $this->apiVersion,
            'jti' =>  $this->jti,
            'iat'  => $issuedAt->getTimestamp(),
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expireAt->getTimestamp(),
        ];
    }
}
