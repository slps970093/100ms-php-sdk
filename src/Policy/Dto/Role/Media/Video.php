<?php

namespace Slps970093\Live100ms\Policy\Dto\Role\Media;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Video
{
    #[SerializedName('bitRate')]
    public int $bitRate = 300;

    #[SerializedName('codec')]
    public string $codec = "vp8";
    #[SerializedName('frameRate')]
    public int $frameRate = 30;

    #[SerializedName('width')]
    public int $width = 480;

    #[SerializedName('height')]
    public int $height = 360;
}
