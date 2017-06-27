<?php
namespace SftpConnector\Ssh2;

use SftpConnector\AuthenticationMethod;
use SftpConnector\SftpOptions;
use SftpConnector\Ssh2LibraryAdapter;

class Ssh2Adapter implements Ssh2LibraryAdapter
{
    private $session;

    /**
     * @return resource
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param string $host
     * @param int $port
     *
     * @return $this
     *
     * @throws Ssh2ConnectionException Couldn't connect to the server.
     */
    public function connect($host, $port = 22)
    {
        if (!$this->session = @ssh2_connect($host, $port)) {
            throw new Ssh2ConnectionException();
        }

        return $this;
    }

    /**
     * @param SftpOptions $options
     *
     * @return $this
     *
     * @throws \InvalidArgumentException The authentication method specified is incorrect.
     *
     * @see AuthenticationMethod
     */
    public function authenticate(SftpOptions $options)
    {
        switch ($options->getAuthenticationMethod()) {
            case AuthenticationMethod::NONE():
                $this->noAuthentication($options->getUsername());
                break;

            case AuthenticationMethod::PUBLIC_KEY():
                $this->publicKeyAuthentication(
                    $options->getUsername(),
                    $options->getPublicKey(),
                    $options->getPrivateKey(),
                    $options->getPassword()
                );
                break;

            case AuthenticationMethod::PASSWORD():
                $this->passwordAuthentication($options->getUsername(), $options->getPassword());
                break;

            default:
                throw new \InvalidArgumentException('An invalid authentication method has been provided.');
        }

        return $this;
    }

    public function fetch($source)
    {
        $this->convertSsh2ResourceToSftpResource();

        return fopen("ssh2.sftp://{$this->getSession()}/$source", 'r');
    }

    /**
     * @param string $username
     */
    private function noAuthentication($username)
    {
        ssh2_auth_none($this->session, $username);
    }

    /**
     * @param string $username
     * @param string $publicKey
     * @param string $privateKey
     * @param string $passphrase
     */
    private function publicKeyAuthentication($username, $publicKey, $privateKey, $passphrase)
    {
        ssh2_auth_pubkey_file(
            $this->session,
            $username,
            $publicKey,
            $privateKey,
            $passphrase
        );
    }

    /**
     * @param string $username
     * @param string $password
     */
    private function passwordAuthentication($username, $password)
    {
        ssh2_auth_password($this->session, $username, $password);
    }

    private function convertSsh2ResourceToSftpResource()
    {
        $this->session = ssh2_sftp($this->session);
    }
}
