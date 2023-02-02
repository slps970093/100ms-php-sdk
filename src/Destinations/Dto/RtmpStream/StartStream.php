<?php

namespace Slps970093\Live100ms\Destinations\Dto\RtmpStream;

use Symfony\Component\Serializer\Annotation\SerializedName;

class StartStream extends BasicStreamAction
{
    #[SerializedName('meeting_url')]
    public string $meetingUrl;

    #[SerializedName('rtmp_urls')]
    public array $rtmpUrls;

    #[SerializedName('record')]
    public bool $record;

    #[SerializedName('resolution')]
    public Resolution $resolution;
}