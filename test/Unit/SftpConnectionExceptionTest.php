<?php
namespace SftpConnectorTest\Unit;

use ScriptFUSION\Porter\Connector\RecoverableConnectorException;
use SftpConnector\SftpConnectionException;

final class SftpConnectionExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testRecoverable()
    {
        self::assertInstanceOf(RecoverableConnectorException::class, new SftpConnectionException);
    }
}
