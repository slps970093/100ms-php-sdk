<?php

namespace Slps970093\Live100ms\ActiveRoom\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class RemovePeerRequest
{
    #[SerializedName('peer_id')]
    public string $peerId = "";
    #[SerializedName('role')]
    public string $role = "";
    #[SerializedName('reason')]
    public string $reason = "";
}