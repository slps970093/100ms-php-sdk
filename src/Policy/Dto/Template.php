<?php

namespace Slps970093\Live100ms\Policy\Dto;

use Slps970093\Live100ms\Policy\Dto\Role\Role;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Template
{
    public function __construct()
    {
        $this->settings = new Setting();
    }

    #[SerializedName('name')]
    public string $name;

    #[SerializedName('default')]
    public bool $default;

    #[SerializedName('roles')]
    public \stdClass $roles;

    #[SerializedName('settings')]
    public Setting $settings;
}
