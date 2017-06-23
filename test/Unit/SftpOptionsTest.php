<?php
namespace SftpConnectorTest\Unit;

use SftpConnector\AuthenticationMethod;
use SftpConnector\SftpOptions;

final class SftpOptionsTest extends \PHPUnit_Framework_TestCase
{
    const HOST = 'foo';
    const USERNAME = 'bar';

    public function testOptionsDefaults()
    {
        $options = new SftpOptions(self::HOST, self::USERNAME);

        self::assertSame(self::HOST, $options->getHost());
        self::assertSame(self::USERNAME, $options->getUsername());
        self::assertSame(SftpOptions::DEFAULT_PORT, $options->getPort());
        self::assertSame(SftpOptions::DEFAULT_TIMEOUT, $options->getTimeout());
        self::assertSame(AuthenticationMethod::NONE(), $options->getAuthenticationMethod());
    }

    public function testHost()
    {
        self::assertSame(
            self::HOST,
            (new SftpOptions(self::HOST, self::USERNAME))->getHost()
        );
    }

    public function testUsername()
    {
        self::assertSame(
            self::USERNAME,
            (new SftpOptions(self::HOST, self::USERNAME))->getUsername()
        );
    }

    public function testPort()
    {
        self::assertSame(
            $port = 23,
            (new SftpOptions(self::HOST, self::USERNAME))->setPort($port)->getPort()
        );
    }

    public function testTimeout()
    {
        self::assertSame(
            $timeout = 12,
            (new SftpOptions(self::HOST, self::USERNAME))->setTimeout($timeout)->getTimeout()
        );
    }

    public function testAuthenticationMethod()
    {
        self::assertSame(
            $authenticationMethod = AuthenticationMethod::PASSWORD(),
            (new SftpOptions(self::HOST, self::USERNAME))
                ->setAuthenticationMethod($authenticationMethod)
                ->getAuthenticationMethod()
        );
    }

    public function testPublicKey()
    {
        self::assertSame(
            $publicKey = 'foo',
            (new SftpOptions(self::HOST, self::USERNAME))->setPublicKey($publicKey)->getPublicKey()
        );
    }

    public function testPrivateKey()
    {
        self::assertSame(
            $privateKey = 'foo',
            (new SftpOptions(self::HOST, self::USERNAME))->setPrivateKey($privateKey)->getPrivateKey()
        );
    }

    public function testPassword()
    {
        self::assertSame(
            $password = 'foo',
            (new SftpOptions(self::HOST, self::USERNAME))->setPassword($password)->getPassword()
        );
    }
}
