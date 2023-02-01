<?php

namespace Slps970093\Live100ms\Policy\Dto\Setting;

use Symfony\Component\Serializer\Annotation\SerializedName;

class RoomState
{
    #[SerializedName('messageInterval')]
    public int $messageInterval = 5;

    #[SerializedName('sendPeerList')]
    public bool $sendPeerList = false;
    #[SerializedName('stopRoomStateOnJoin')]
    public bool $stopRoomStateOnJoin = true;

    #[SerializedName('enabled')]
    public bool $enabled = false;
}
