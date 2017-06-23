<?php
namespace SftpConnector;

use phpseclib\Net\SFTP;
use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;

/**
 * Fetches data form an SFTP server via Phpseclib library.
 *
 * @link https://github.com/phpseclib/phpseclib
 */
class SftpConnector implements Connector
{
    /**
     * {@inheritdoc}
     *
     * @param string $source Path to the file.
     * @param SftpOptions $options Mandatory options to connect to the FTP.
     *
     * @return resource Response.
     *
     * @throws \InvalidArgumentException Options is not an instance of SftpOptions.
     * @throws SftpLoginException Couldn't log in to the server.
     */
    public function fetch($source, EncapsulatedOptions $options = null)
    {
        if (!$options || !$options instanceof SftpOptions) {
            throw new \InvalidArgumentException('Options must be an instance of SftpOptions.');
        }

        if (!$session = \ssh2_connect($options->getHost(), $options->getPort())) {
            throw new SftpLoginException();
        }

        \ssh2_auth_pubkey_file($session, $options->getUsername(), '', $options->getAuthenticationCredentials());

        return fopen("ssh2.sftp://$session/$source", 'r');
    }
}
