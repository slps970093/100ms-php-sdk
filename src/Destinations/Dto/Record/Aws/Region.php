<?php

namespace Slps970093\Live100ms\Destinations\Dto\Record\Aws;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Region
{
    #[SerializedName('region')]
    public string $region;
}
