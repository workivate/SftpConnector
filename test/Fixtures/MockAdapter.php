<?php
namespace SftpConnectorTest\Fixtures;

use SftpConnector\Libssh2\NotConnectedException;
use SftpConnector\SftpAdapter;
use SftpConnector\SftpConnectionException;
use SftpConnector\SftpOptions;

class MockAdapter implements SftpAdapter
{
    const VALID_HOST = 'foo';
    const VALID_SESSION = 'baz';

    private $session;

    public function connect($host, $port = 22)
    {
        if ($host !== self::VALID_HOST) {
            throw new SftpConnectionException;
        }

        $this->session = self::VALID_SESSION;

        return $this;
    }

    public function authenticate(SftpOptions $options)
    {
        if (!$this->session) {
            throw new NotConnectedException;
        }

        return $this;
    }

    public function fetch($source)
    {
        if (!$this->session) {
            throw new NotConnectedException;
        }

        return fopen($source, 'r');
    }

    public function disconnect()
    {
        $this->session = null;

        return $this;
    }
}
