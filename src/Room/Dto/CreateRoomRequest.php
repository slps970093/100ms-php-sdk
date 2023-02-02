<?php

namespace Slps970093\Live100ms\Room\Dto;

use Slps970093\Live100ms\Destinations\Dto\Record\RecordingInfoRequest;
use Symfony\Component\Serializer\Annotation\SerializedName;

class CreateRoomRequest
{
    #[SerializedName('name')]
    public string $name;

    #[SerializedName('description')]
    public string $description;

    #[SerializedName('template_id')]
    public string $templateId;

    #[SerializedName('recording_info')]
    public RecordingInfoRequest $recordingInfo;

    #[SerializedName('region')]
    public string $region = "auto";
}
