<?php

namespace Slps970093\Live100ms\Room\Dto\Record;

use Slps970093\Live100ms\Room\Dto\Record\RecordingInfo;
use Slps970093\Live100ms\Room\Dto\Record\UploadInfoRequest;
use Symfony\Component\Serializer\Annotation\SerializedName;

class RecordingInfoRequest extends RecordingInfo
{
    #[SerializedName('upload_info')]
    public UploadInfoRequest $uploadInfo;
}
