<?php
namespace SftpConnectorTest\Unit\Libssh2;

use SftpConnector\Libssh2\Libssh2Adapter;
use SftpConnector\Ssh2ConnectionException;

final class Libssh2AdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testFailedSsh2Connection()
    {
        $this->expectException(Ssh2ConnectionException::class);

        (new Libssh2Adapter)->connect('foo');
    }
}
