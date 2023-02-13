<?php

namespace Slps970093\Live100ms\ActiveRoom\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class EndRoomRequest
{
    #[SerializedName('reason')]
    public string $reason = "";

    #[SerializedName('lock')]
    public bool $lock = false;
}
