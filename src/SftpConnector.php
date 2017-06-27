<?php
namespace SftpConnector;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;
use SftpConnector\Ssh2\Ssh2Adapter;
use SftpConnector\Ssh2\Ssh2ConnectionException;

/**
 * Fetches data form an SFTP server via libssh2 library.
 *
 * @link https://github.com/phpseclib/phpseclib
 */
class SftpConnector implements Connector
{
    private $adapter;

    public function __construct(Ssh2LibraryAdapter $adapter = null)
    {
        $this->adapter = $adapter ?: new Ssh2Adapter;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $source Path to the file.
     * @param SftpOptions $options Mandatory options to connect to the FTP.
     *
     * @return resource Response.
     *
     * @throws \InvalidArgumentException Options is not an instance of SftpOptions.
     * @throws Ssh2ConnectionException Couldn't connect to the server.
     */
    public function fetch($source, EncapsulatedOptions $options = null)
    {
        if (!$options || !$options instanceof SftpOptions) {
            throw new \InvalidArgumentException('Options must be an instance of SftpOptions.');
        }

        $this->adapter->connect($options->getHost(), $options->getPort());
        $this->adapter->authenticate($options);

        return $this->adapter->fetch($source);
    }
}
