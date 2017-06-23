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
     * @throws Ssh2ConnectionException Couldn't connect to the server.
     */
    public function fetch($source, EncapsulatedOptions $options = null)
    {
        if (!$options || !$options instanceof SftpOptions) {
            throw new \InvalidArgumentException('Options must be an instance of SftpOptions.');
        }

        if (!$session = @ssh2_connect($options->getHost(), $options->getPort())) {
            throw new Ssh2ConnectionException;
        }

        $this->ssh2Authenticate($session, $options);

        return fopen("ssh2.sftp://$session/$source", 'r');
    }

    private function ssh2Authenticate($session, SftpOptions $options)
    {
        switch ($options->getAuthenticationMethod()) {
            case AuthenticationMethod::NONE():
                ssh2_auth_none($session, $options->getUsername());
                break;

            case AuthenticationMethod::PUBLIC_KEY():
                ssh2_auth_pubkey_file(
                    $session,
                    $options->getUsername(),
                    $options->getPublicKey(),
                    $options->getPrivateKey(),
                    $options->getPassword()
                );
                break;

            case AuthenticationMethod::PASSWORD():
                ssh2_auth_password($session, $options->getUsername(), $options->getPassword());
                break;
        }
    }
}
