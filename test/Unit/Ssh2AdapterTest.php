<?php
namespace SftpConnectorTest\Unit;

use SftpConnector\Ssh2\Ssh2Adapter;
use SftpConnector\Ssh2\Ssh2ConnectionException;

final class Ssh2AdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testFailedSsh2Connection()
    {
        $this->expectException(Ssh2ConnectionException::class);

        (new Ssh2Adapter)->connect('foo');
    }
}
