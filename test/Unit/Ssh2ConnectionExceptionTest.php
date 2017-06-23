<?php
namespace SftpConnectorTest\Unit;

use ScriptFUSION\Porter\Connector\RecoverableConnectorException;
use SftpConnector\Ssh2\Ssh2ConnectionException;

final class Ssh2ConnectionExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testRecoverable()
    {
        self::assertInstanceOf(RecoverableConnectorException::class, new Ssh2ConnectionException);
    }
}
