<?php

namespace Slps970093\Live100ms\Policy\Dto\Role\Subscribe;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Degradation
{
    #[SerializedName('packetLossThreshold')]
    public int $packetLossThreshold = 25;

    #[SerializedName('degradeGracePeriodSeconds')]
    public int $degradeGracePeriodSeconds = 1;

    #[SerializedName('recoverGracePeriodSeconds')]
    public int $recoverGracePeriodSeconds = 1;
}