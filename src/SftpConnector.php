<?php
namespace SftpConnector;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;
use SftpConnector\Libssh2\NotConnectedException;
use SftpConnector\Phpseclib\PhpseclibAdapter;

/**
 * Fetches data form an SFTP server via a library specific adapter (libssh2 by default).
 *
 * @see https://github.com/phpseclib/phpseclib
 */
class SftpConnector implements Connector
{
    protected $adapter;

    public function __construct(SftpAdapter $adapter = null)
    {
        $this->adapter = $adapter ?: new PhpseclibAdapter;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $source Path to the file.
     * @param SftpOptions $options Mandatory options to connect to the FTP.
     *
     * @return string Response.
     *
     * @throws NotConnectedException The connection must be established before executing an action.
     * @throws \InvalidArgumentException Options is not an instance of SftpOptions.
     * @throws SftpConnectionException Couldn't connect to the server.
     */
    public function fetch($source, EncapsulatedOptions $options = null)
    {
        if (!$options || !$options instanceof SftpOptions) {
            throw new \InvalidArgumentException('Options must be an instance of SftpOptions.');
        }

        $this->adapter->connect($options->getHost(), $options->getPort());
        $this->adapter->authenticate($options);
        $resource = $this->adapter->fetch($source);
        $this->adapter->disconnect();

        return $resource;
    }
}
