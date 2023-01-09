<?php

namespace Slps970093\Live100ms\Room\JsonEntities\Record;

use Slps970093\Live100ms\Room\JsonEntities\Record\Aws\Credentials;
use Slps970093\Live100ms\Room\JsonEntities\Record\Aws\Region;
use Symfony\Component\Serializer\Annotation\SerializedName;

class UploadInfoRequest
{
    #[SerializedName('type')]
    public string $type;

    #[SerializedName('location')]
    public string $location;

    #[SerializedName('prefix')]
    public string $prefix;

    #[SerializedName('options')]
    public Region $options;

    #[SerializedName('credentials')]
    public Credentials $credentials;
}