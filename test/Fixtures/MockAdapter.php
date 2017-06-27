<?php
namespace SftpConnectorTest\Fixtures;

use SftpConnector\Libssh2\NotConnectedException;
use SftpConnector\SftpOptions;
use SftpConnector\SftpAdapter;

class MockAdapter implements SftpAdapter
{
    private $session;

    public function connect($host, $post = 22)
    {
        $this->session = 'foo';

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

        return fopen(__DIR__ . '/fixture.json', 'r');
    }

    public function disconnect()
    {
        $this->session = null;

        return $this;
    }
}
