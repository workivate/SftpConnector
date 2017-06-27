<?php
namespace SftpConnectorTest\Fixtures;

use SftpConnector\Libssh2\NotConnectedException;
use SftpConnector\SftpOptions;
use SftpConnector\SftpAdapter;
use SftpConnector\Ssh2ConnectionException;

class MockAdapter implements SftpAdapter
{
    const VALID_HOST = 'foo';
    const VALID_SESSION = 'baz';

    private $session;

    public function connect($host, $post = 22)
    {
        if ($host !== self::VALID_HOST) {
            throw new Ssh2ConnectionException;
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
