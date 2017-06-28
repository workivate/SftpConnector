<?php
namespace SftpConnectorTest\Unit\Phpseclib;

use SftpConnector\Phpseclib\PhpseclibAdapter;
use SftpConnector\SftpOptions;
use SftpConnector\Ssh2ConnectionException;

final class PhpseclibAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testFailedSsh2Connection()
    {
        $this->expectException(Ssh2ConnectionException::class);

        (new PhpseclibAdapter)->connect('foo')->authenticate(new SftpOptions('foo', 'bar'));
    }
}
