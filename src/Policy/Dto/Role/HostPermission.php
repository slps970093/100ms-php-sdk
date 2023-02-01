<?php

namespace Slps970093\Live100ms\Policy\Dto\Role;

use Symfony\Component\Serializer\Annotation\SerializedName;

class HostPermission
{
    #[SerializedName('endRoom')]
    public bool $endRoom = true;
    #[SerializedName('removeOthers')]
    public bool $removeOthers = true;

    #[SerializedName('mute')]
    public bool $mute = true;

    #[SerializedName('unmute')]
    public bool $unmute = true;

    #[SerializedName('changeRole')]
    public bool $changeRole = true;

    #[SerializedName('sendRoomState')]
    public bool $sendRoomState = false;
}
