<?php

namespace Slps970093\Live100ms\Room\JsonEntities\Record\Aws;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Credentials
{
    #[SerializedName('key')]
    public string $key;

    #[SerializedName('secret')]
    public string $secret;
}
