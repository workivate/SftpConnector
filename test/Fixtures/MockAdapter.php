<?php
namespace SftpConnectorTest\Fixtures;

use SftpConnector\SftpOptions;
use SftpConnector\Ssh2LibraryAdapter;

class MockAdapter implements Ssh2LibraryAdapter
{
    public function getSession()
    {
    }

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
}
