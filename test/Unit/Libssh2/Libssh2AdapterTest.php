<?php
namespace SftpConnectorTest\Unit\Libssh2;

use SftpConnector\Libssh2\Libssh2Adapter;
use SftpConnector\Libssh2\NotConnectedException;
use SftpConnector\SftpConnectionException;
use SftpConnector\SftpOptions;

/**
 * @requires extension ssh2
 */
final class Libssh2AdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testFailedSsh2Connection()
    {
        $this->setExpectedException(SftpConnectionException::class);

        (new Libssh2Adapter)->connect('foo');
    }

    public function testNotConnectedAuthentication()
    {
        $this->setExpectedException(NotConnectedException::class);

        $adapter = new Libssh2Adapter;
        $adapter->disconnect()->authenticate(new SftpOptions('foo', 'bar'));
    }

    public function testNotConnectedFetch()
    {
        $this->setExpectedException(NotConnectedException::class);

        $adapter = new Libssh2Adapter;
        $adapter->disconnect()->fetch('foo');
    }
}
