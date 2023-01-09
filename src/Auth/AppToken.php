<?php

namespace Slps970093\Live100ms\Auth;

use Carbon\Carbon;

class AppToken extends AbstractToken
{
    private string $role = "";

    private string $roomId = "";

    private string $userId = "";

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getRoomId(): string
    {
        return $this->roomId;
    }

    /**
     * @param string $roomId
     */
    public function setRoomId(string $roomId): void
    {
        $this->roomId = $roomId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    protected function getPayload(Carbon $issuedAt, Carbon $expireAt): array
    {
        return [
            "iat"           => $issuedAt->getTimestamp(),
            "nbf"           => $issuedAt->getTimestamp(),
            "exp"           => $expireAt->getTimestamp(),
            "access_key"    => $this->appKey,
            "type"          => "app",
            "jti"           => $this->jti,
            "version"       => $this->apiVersion,
            "role"          => $this->role,
            "room_id"       => $this->roomId,
            "user_id"       => $this->userId
        ];
    }
}
