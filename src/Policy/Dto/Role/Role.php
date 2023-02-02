<?php

namespace Slps970093\Live100ms\Policy\Dto\Role;

use Slps970093\Live100ms\Policy\Dto\Role\Subscribe\Params as SubscribeParams;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Role
{
    #[SerializedName('publishParams')]
    public PublishParams $publishParams;

    #[SerializedName('subscribeParams')]
    public SubscribeParams $subscribeParams;

    #[SerializedName('permissions')]
    public Permission $permissions;

    #[SerializedName('priority')]
    public int $priority = 1;

    #[SerializedName('maxPeerCount')]
    public int $maxPeerCount = 0;
}
