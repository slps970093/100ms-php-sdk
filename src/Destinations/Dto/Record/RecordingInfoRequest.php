<?php

namespace Slps970093\Live100ms\Destinations\Dto\Record;

use Slps970093\Live100ms\Destinations\Dto\Record\RecordingInfo;
use Slps970093\Live100ms\Destinations\Dto\Record\UploadInfoRequest;
use Symfony\Component\Serializer\Annotation\SerializedName;

class RecordingInfoRequest extends RecordingInfo
{
    public function __construct()
    {
        $this->uploadInfo = new UploadInfoRequest();
    }

    #[SerializedName('upload_info')]
    public UploadInfoRequest $uploadInfo;
}
