<?php

namespace Slps970093\Live100ms\Policy\Dto\Role\Media;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Screen
{
    #[SerializedName('bitRate')]
    public int $bitRate = 300;
    #[SerializedName('frameRate')]
    public int $frameRate = 10;

    #[SerializedName('width')]
    public int $width = 480;

    #[SerializedName('height')]
    public int $height = 360;
}