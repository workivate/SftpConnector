<?php
namespace SftpConnectorTest\Unit;

use ScriptFUSION\Porter\Options\EncapsulatedOptions;
use SftpConnector\SftpConnector;
use SftpConnector\SftpLoginException;
use SftpConnector\SftpOptions;

class SftpConnectorTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidOptionsType()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new SftpConnector)->fetch('foo', \Mockery::mock(EncapsulatedOptions::class));
    }

    public function testFailedSsh2Connection()
    {
        $this->expectException(SftpLoginException::class);

        (new SftpConnector)->fetch('foo', new SftpOptions('bar'));
    }
}
