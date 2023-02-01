<?php

namespace Slps970093\Live100ms\Policy\Dto\Role\Media;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Audio
{
    #[SerializedName('bitRate')]
    public int $bitRate = 32;

    #[SerializedName('codec')]
    public string $codec = "opus";
}