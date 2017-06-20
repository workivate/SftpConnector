<?php
namespace SftpConnectorTest\Unit;

use ScriptFUSION\Porter\Connector\RecoverableConnectorException;
use SftpConnector\SftpLoginException;

final class SftpLoginExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testRecoverable()
    {
        self::assertInstanceOf(RecoverableConnectorException::class, new SftpLoginException);
    }
}
