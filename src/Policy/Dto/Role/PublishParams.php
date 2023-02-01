<?php

namespace Slps970093\Live100ms\Policy\Dto\Role;

use Slps970093\Live100ms\Policy\Dto\Role\Media\Audio;
use Slps970093\Live100ms\Policy\Dto\Role\Media\Screen;
use Slps970093\Live100ms\Policy\Dto\Role\Media\Video;
use Symfony\Component\Serializer\Annotation\SerializedName;

class PublishParams
{
    public function __construct()
    {
        $this->screenSimulcastLayers = (object) [];
        $this->videoSimulcastLayers = (object) [];
    }

    #[SerializedName('allowed')]
    public array $allowed = ["audio", "video", "screen"];

    #[SerializedName('audio')]
    public Audio $audio;

    #[SerializedName('video')]
    public Video $video;

    #[SerializedName('screen')]
    public Screen $screen;

    #[SerializedName('videoSimulcastLayers')]
    public \stdClass $videoSimulcastLayers;

    #[SerializedName('screenSimulcastLayers')]
    public \stdClass $screenSimulcastLayers;
}
