<?php

namespace Slps970093\Live100ms\Policy\Dto;

use Slps970093\Live100ms\Policy\Dto\Role\Role;
use Symfony\Component\Serializer\Annotation\SerializedName;

class RoleItem extends Role
{
    #[SerializedName('name')]
    public string $name;
}
