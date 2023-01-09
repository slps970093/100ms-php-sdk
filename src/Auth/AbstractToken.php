<?php

namespace Slps970093\Live100ms\Auth;

use Carbon\Carbon;
use Firebase\JWT\JWT;

abstract class AbstractToken
{
    protected string $appKey = "";

    protected string $appSecret = "";

    protected int $apiVersion = 2;

    protected string $jti = "";

    public function __construct(string $appKey, string $appSecret, int $apiVersion)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     */
    public function setAppKey(string $appKey): void
    {
        $this->appKey = $appKey;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     */
    public function setAppSecret(string $appSecret): void
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return int
     */
    public function getApiVersion(): int
    {
        return $this->apiVersion;
    }

    /**
     * @param int $apiVersion
     */
    public function setApiVersion(int $apiVersion): void
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return string
     */
    public function getJti(): string
    {
        return $this->jti;
    }

    /**
     * @param string $jti
     */
    public function setJti(string $jti): void
    {
        $this->jti = $jti;
    }

    abstract protected function getPayload(Carbon $issuedAt, Carbon $expireAt): array;

    public function createToken(Carbon $issuedAt, Carbon $expireAt): string
    {
        $payload = $this->getPayload($issuedAt, $expireAt);

        return JWT::encode($payload, $this->appSecret, "HS256");
    }
}
