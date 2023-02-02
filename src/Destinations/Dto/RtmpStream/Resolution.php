<?php

namespace Slps970093\Live100ms\Destinations\Dto\RtmpStream;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Resolution
{
    #[SerializedName('width')]
    public int $width;

    #[SerializedName('height')]
    public int $height;
    public function __construct()
    {
        $this->height = 720;
        $this->width = 1280;
    }
}