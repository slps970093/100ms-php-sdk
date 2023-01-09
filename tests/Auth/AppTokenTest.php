<?php

namespace Slps970093\Live100ms\Tests\Auth;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slps970093\Live100ms\Auth\AppToken;
use Slps970093\Live100ms\Live100msServiceProvider;

class AppTokenTest extends \Orchestra\Testbench\TestCase
{
    public function test_create_token()
    {
        /** @var AppToken $appToken */
        $appToken = $this->app->make(AppToken::class);

        $issuedAt = Carbon::now();
        $expireAt = Carbon::now()->addHours(1);
        $jwtToken = $appToken->createToken($issuedAt, $expireAt);

        $decoded = JWT::decode($jwtToken, new Key($appToken->getAppSecret(), "HS256"));

        $expected = [
            "iat"           => $issuedAt->getTimestamp(),
            "nbf"           => $issuedAt->getTimestamp(),
            "exp"           => $expireAt->getTimestamp(),
            "access_key"    => $appToken->getAppKey(),
            "type"          => "app",
            "jti"           => $appToken->getJti(),
            "version"       => $appToken->getApiVersion(),
            "role"          => $appToken->getRole(),
            "room_id"       => $appToken->getRoomId(),
            "user_id"       => $appToken->getUserId()
        ];

        $this->assertEquals($expected, (array) $decoded);
    }

    protected function getPackageProviders($app): array
    {
        return [
            Live100msServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('100ms.access_token', 'app-access-token');
        $app['config']->set('100ms.secret', 'app-secret');
        $app['config']->set('100ms.api-version', 2);
    }
}
