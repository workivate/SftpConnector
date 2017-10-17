<?php
namespace SftpConnector\Libssh2;

use SftpConnector\AuthenticationMethod;
use SftpConnector\SftpAdapter;
use SftpConnector\SftpConnectionException;
use SftpConnector\SftpOptions;

class Libssh2Adapter implements SftpAdapter
{
    /**
     * @var resource
     */
    protected $session;

    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * @param string $host
     * @param int $port
     *
     * @return $this
     *
     * @throws SftpConnectionException Couldn't connect to the server.
     */
    public function connect($host, $port = 22)
    {
        if (!$this->session = @ssh2_connect($host, $port)) {
            throw new SftpConnectionException;
        }

        return $this;
    }

    /**
     * @param SftpOptions $options
     *
     * @return $this
     *
     * @throws \InvalidArgumentException The authentication method specified is incorrect.
     * @throws NotConnectedException The connection must be established before executing an action.
     *
     * @see AuthenticationMethod
     */
    public function authenticate(SftpOptions $options)
    {
        if (!$this->session) {
            throw new NotConnectedException;
        }

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

    /**
     * @param string $source
     *
     * @return resource
     *
     * @throws NotConnectedException The connection must be established before executing an action.
     */
    public function fetch($source)
    {
        if (!$this->session) {
            throw new NotConnectedException;
        }

        $sftp = ssh2_sftp($this->session);

        return fopen("ssh2.sftp://$sftp/$source", 'r');
    }

    public function disconnect()
    {
        if ($this->session) {
            ssh2_exec($this->session, 'exit');
            $this->session = null;
        }

        return $this;
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
}
