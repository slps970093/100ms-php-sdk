<?php

namespace Slps970093\Live100ms\Policy\Dto\Role;

use Symfony\Component\Serializer\Annotation\SerializedName;

class GuestPermission
{
    #[SerializedName('sendRoomState')]
    public bool $sendRoomState  = false;
}
