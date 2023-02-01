<?php

namespace Slps970093\Live100ms;

abstract class AbstractManagerApi
{
    protected string $managerToken = "";

    protected int $apiVersion = 2;

    public function __construct(string $managerToken, int $apiVersion)
    {
        $this->apiVersion   = $apiVersion;
        $this->managerToken = $managerToken;
    }
}