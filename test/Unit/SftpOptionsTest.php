<?php
namespace SftpConnectorTest\Unit;

use phpseclib\Crypt\RSA;
use SftpConnector\AuthenticationMethod;
use SftpConnector\SftpOptions;

class SftpOptionsTest extends \PHPUnit_Framework_TestCase
{
    const HOST = 'foo';

    public function testOptionsDefaults()
    {
        $options = new SftpOptions(self::HOST);

        self::assertSame(self::HOST, $options->getHost());
        self::assertSame(SftpOptions::DEFAULT_PORT, $options->getPort());
        self::assertSame(SftpOptions::DEFAULT_TIMEOUT, $options->getTimeout());
        self::assertSame(SftpOptions::DEFAULT_USERNAME, $options->getUsername());
        self::assertInternalType('string', $options->getAuthenticationCredentials());
    }

    public function testHost()
    {
        self::assertSame(self::HOST, (new SftpOptions(self::HOST))->getHost());
    }

    public function testPort()
    {
        self::assertSame($port = 23, (new SftpOptions(self::HOST))->setPort($port)->getPort());
    }

    public function testRsaKey()
    {
        $rsa = new RSA;
        $options = new SftpOptions(self::HOST);

        $options->setAuthenticationMethod(AuthenticationMethod::RSA());
        $options->setRsaKey($rsa);

        self::assertSame($rsa, $options->getAuthenticationCredentials());
    }

    public function testPassword()
    {
        $options = new SftpOptions(self::HOST);

        $options->setAuthenticationMethod(AuthenticationMethod::BASIC());
        $options->setPassword('bar');

        self::assertSame('bar', $options->getAuthenticationCredentials());
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
