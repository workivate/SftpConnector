<?php
namespace SftpConnector\Phpseclib;

use phpseclib\Crypt\RSA;
use phpseclib\Net\SFTP;
use SftpConnector\AuthenticationMethod;
use SftpConnector\SftpAdapter;
use SftpConnector\SftpOptions;
use SftpConnector\Ssh2ConnectionException;

class PhpseclibAdapter implements SftpAdapter
{
    /**
     * @var SFTP
     */
    private $session;

    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * @param string $host
     * @param int $port
     *
     * @return $this
     */
    public function connect($host, $port = 22)
    {
        $this->session = new SFTP($host, $port);

        return $this;
    }

    /**
     * @param SftpOptions $options
     *
     * @return $this
     *
     * @throws \InvalidArgumentException The authentication method specified is incorrect.
     * @throws Ssh2ConnectionException Couldn't log in to the remote server.
     */
    public function authenticate(SftpOptions $options)
    {
        switch ($options->getAuthenticationMethod()) {
            case AuthenticationMethod::PUBLIC_KEY():
                $key = new RSA;
                $key->loadKey(file_get_contents($options->getPrivateKey()));
                $this->login($options->getUsername(), $key);
                break;

            case AuthenticationMethod::NONE():
                $this->login($options->getUsername());
                break;

            case AuthenticationMethod::PASSWORD():
                $this->login($options->getUsername(), $options->getPassword());
                break;

            default:
                throw new \InvalidArgumentException('An invalid authentication method has been provided.');
        }

        return $this;
    }

    /**
     * @param string $source
     *
     * @return string
     */
    public function fetch($source)
    {
        return $this->session->get($source);
    }

    public function disconnect()
    {
        if ($this->session && $this->session->isConnected()) {
            $this->session->disconnect();
            $this->session = null;
        }
    }

    /**
     * @param string $username
     * @param string|RSA|null $securityCredential
     *
     * @throws Ssh2ConnectionException Couldn't log in to the remote server.
     */
    private function login($username, $securityCredential = null) {

        if (!@$this->session->login($username, $securityCredential)) {
            throw new Ssh2ConnectionException;
        }
    }
}
