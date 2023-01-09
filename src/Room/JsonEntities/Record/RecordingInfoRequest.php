<?php

namespace Slps970093\Live100ms\Room\JsonEntities\Record;

use Symfony\Component\Serializer\Annotation\SerializedName;

class RecordingInfoRequest extends RecordingInfo
{
    #[SerializedName('upload_info')]
    public UploadInfoRequest $uploadInfo;
}
