<?php

namespace Slps970093\Live100ms\Tests\Auth;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Orchestra\Testbench\TestCase;
use Slps970093\Live100ms\Auth\ManagementToken;
use Slps970093\Live100ms\Live100msServiceProvider;

class ManagementTokenTest extends TestCase
{
    public function test_create_token()
    {
        /** @var ManagementToken $mgrToken */
        $mgrToken = $this->app->make(ManagementToken::class);

        $issuedAt = Carbon::now();
        $expireAt = Carbon::now()->addHours(1);
        $jwtToken = $mgrToken->createToken($issuedAt, $expireAt);

        $decoded = JWT::decode($jwtToken, new Key($mgrToken->getAppSecret(), "HS256"));

        $expected = [
            'access_key' => $mgrToken->getAppKey(),
            'type' => 'management',
            'version' => $mgrToken->getApiVersion(),
            'jti' =>  $mgrToken->getJti(),
            'iat'  => $issuedAt->getTimestamp(),
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expireAt->getTimestamp(),
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
