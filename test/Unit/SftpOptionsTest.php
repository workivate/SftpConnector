<?php
namespace SftpConnectorTest\Unit;

use SftpConnector\AuthenticationMethod;
use SftpConnector\SftpOptions;

final class SftpOptionsTest extends \PHPUnit_Framework_TestCase
{
    const HOST = 'foo';

    public function testOptionsDefaults()
    {
        $options = new SftpOptions(self::HOST);

        self::assertSame(self::HOST, $options->getHost());
        self::assertSame(SftpOptions::DEFAULT_PORT, $options->getPort());
        self::assertSame(SftpOptions::DEFAULT_TIMEOUT, $options->getTimeout());
        self::assertSame(SftpOptions::DEFAULT_USERNAME, $options->getUsername());
        self::assertSame(AuthenticationMethod::NONE(), $options->getAuthenticationMethod());
    }

    public function testHost()
    {
        self::assertSame(self::HOST, (new SftpOptions(self::HOST))->getHost());
    }

    public function testPort()
    {
        self::assertSame($port = 23, (new SftpOptions(self::HOST))->setPort($port)->getPort());
    }

    public function testPassword()
    {
        self::assertSame($password = 'bar', (new SftpOptions(self::HOST))->setPassword($password)->getPassword());
    }

    public function testTimeout()
    {
        self::assertSame($timeout = 12, (new SftpOptions(self::HOST))->setTimeout($timeout)->getTimeout());
    }

    public function testUsername()
    {
        self::assertSame($username = 'bar', (new SftpOptions(self::HOST))->setUsername($username)->getUsername());
    }
}
