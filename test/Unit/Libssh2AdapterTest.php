<?php
namespace SftpConnectorTest\Unit;

use SftpConnector\Ssh2\Libssh2Adapter;
use SftpConnector\Ssh2\Ssh2ConnectionException;

final class Libssh2AdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testFailedSsh2Connection()
    {
        $this->expectException(Ssh2ConnectionException::class);

        (new Libssh2Adapter)->connect('foo');
    }
}
