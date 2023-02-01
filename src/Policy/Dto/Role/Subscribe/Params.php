<?php

namespace Slps970093\Live100ms\Policy\Dto\Role\Subscribe;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Params
{
    #[SerializedName('subscribeToRoles')]
    public array $subscribeToRoles = [
        "host",
        "guest"
    ];

    #[SerializedName('maxSubsBitRate')]
    public int $maxSubsBitRate = 3200;

    #[SerializedName('subscribeDegradation')]
    public Degradation $degradation;
}