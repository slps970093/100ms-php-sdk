<?php

namespace Slps970093\Live100ms\Room\JsonEntities;

use Slps970093\Live100ms\Room\JsonEntities\Record\RecordingInfo;
use Symfony\Component\Serializer\Annotation\SerializedName;

class CreateRoomResponse
{
    #[SerializedName('id')]
    public string $id;
    #[SerializedName('name')]
    public string $name;
    #[SerializedName('enabled')]
    public bool $enabled;
    #[SerializedName('description')]
    public string $description;
    #[SerializedName('customer')]
    public string $customer;
    #[SerializedName('recording_info')]
    public RecordingInfo $recordingInfo;
    #[SerializedName('recording_source_template')]
    public bool $recordingSourceTemplate;
    #[SerializedName('template_id')]
    public string $templateId;
    #[SerializedName('template')]
    public string $template;
    #[SerializedName('region')]
    public string $region;
    #[SerializedName('created_at')]
    public string $createdAt;
    #[SerializedName('updated_at')]
    public string $updatedAt;
}
