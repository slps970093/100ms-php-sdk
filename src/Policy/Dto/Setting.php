<?php

namespace Slps970093\Live100ms\Policy\Dto;

use Slps970093\Live100ms\Policy\Dto\Setting\RoomState;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Setting
{
    #[SerializedName('region')]
    public string $region = "in";
    #[SerializedName('subscribeDegradation')]
    public \stdClass $subscribeDegradation;
    #[SerializedName('screenSimulcastLayers')]
    public \stdClass $screenSimulcastLayers;
    #[SerializedName('videoSimulcastLayers')]
    public \stdClass $videoSimulcastLayers;
    #[SerializedName('roomState')]
    public RoomState $roomState;
}