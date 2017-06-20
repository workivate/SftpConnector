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
     * @return string Response.
     *
     * @throws \InvalidArgumentException Options is not an instance of SftpOptions.
     * @throws SftpLoginException Couldn't log in to the server.
     */
    public function fetch($source, EncapsulatedOptions $options = null)
    {
        if (!$options || !$options instanceof SftpOptions) {
            throw new \InvalidArgumentException('Options must be an instance of SftpOptions.');
        }

        $sftp = new SFTP(
            $options->getHost(),
            $options->getPort(),
            $options->getTimeout()
        );

        if (!$sftp->login($options->getUsername(), $options->getAuthenticationCredentials())) {
            throw new SftpLoginException();
        }

        return $sftp->get($source);
    }
}
