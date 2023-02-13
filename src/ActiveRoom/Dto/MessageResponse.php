<?php

namespace Slps970093\Live100ms\ActiveRoom\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class MessageResponse
{
    #[SerializedName('message')]
    public string $message;
}