<?php

namespace Slps970093\Live100ms\Policy\Dto;

use Symfony\Component\Serializer\Annotation\SerializedName;

class TemplateItem extends Template
{
    #[SerializedName('id')]
    public string $id;
    #[SerializedName('created_at')]
    public string $createdAt;
    #[SerializedName('updated_at')]
    public string $updatedAt;
    #[SerializedName('_id')]
    public string $_id;
    #[SerializedName('customer')]
    public string $customer;
}