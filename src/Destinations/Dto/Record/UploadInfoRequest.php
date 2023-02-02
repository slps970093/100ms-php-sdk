<?php

namespace Slps970093\Live100ms\Destinations\Dto\Record;

use Slps970093\Live100ms\Destinations\Dto\Record\Aws\Credentials;
use Slps970093\Live100ms\Destinations\Dto\Record\Aws\Region;
use Symfony\Component\Serializer\Annotation\SerializedName;

class UploadInfoRequest
{
    public function __construct()
    {
        $this->options = new Region();
        $this->credentials = new Credentials();
    }

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
