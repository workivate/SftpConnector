<?php
namespace SftpConnectorTest\Unit\Phpseclib;

use SftpConnector\Phpseclib\PhpseclibAdapter;
use SftpConnector\SftpConnectionException;
use SftpConnector\SftpOptions;

final class PhpseclibAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testFailedSsh2Connection()
    {
        $this->setExpectedException(SftpConnectionException::class);

        (new PhpseclibAdapter)->connect('foo')->authenticate(new SftpOptions('foo', 'bar'));
    }
}
