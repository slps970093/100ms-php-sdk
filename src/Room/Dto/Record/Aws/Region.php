<?php

namespace Slps970093\Live100ms\Room\Dto\Record\Aws;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Region
{
    #[SerializedName('region')]
    public string $region;
}
