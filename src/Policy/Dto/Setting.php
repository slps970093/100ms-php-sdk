<?php

namespace Slps970093\Live100ms\Policy\Dto;

use Slps970093\Live100ms\Destinations\Dto\Record\RecordingInfoRequest;
use Slps970093\Live100ms\Policy\Dto\Setting\RoomState;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Setting
{
    public function __construct()
    {
        $this->roomState = new RoomState();
        $this->recording = new RecordingInfoRequest();
    }

    #[SerializedName('region')]
    public string $region = "in";
    #[SerializedName('subscribeDegradation')]
    public \stdClass $subscribeDegradation;
    #[SerializedName('screenSimulcastLayers')]
    public \stdClass $screenSimulcastLayers;
    #[SerializedName('videoSimulcastLayers')]
    public \stdClass $videoSimulcastLayers;
    #[SerializedName('recording')]
    public RecordingInfoRequest $recording;
    #[SerializedName('roomState')]
    public RoomState $roomState;
}
