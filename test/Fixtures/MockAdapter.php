<?php
namespace SftpConnectorTest\Fixtures;

use SftpConnector\SftpOptions;
use SftpConnector\SftpAdapter;

class MockAdapter implements SftpAdapter
{
    public function connect($host, $post = 22)
    {
        return $this;
    }

    public function authenticate(SftpOptions $options)
    {
        return $this;
    }

    public function fetch($source)
    {
        return fopen(__DIR__ . '/fixture.json', 'r');
    }

    public function disconnect()
    {
        return $this;
    }
}
