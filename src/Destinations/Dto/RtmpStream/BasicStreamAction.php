<?php

namespace Slps970093\Live100ms\Destinations\Dto\RtmpStream;

use Symfony\Component\Serializer\Annotation\SerializedName;

class BasicStreamAction
{
    #[SerializedName('operation')]
    public string $operation;
    #[SerializedName('room_id')]
    public string $roomId;
}
