<?php
namespace SftpConnector\Ssh2;

use SftpConnector\AuthenticationMethod;
use SftpConnector\SftpOptions;
use SftpConnector\Ssh2ConnectionException;

class Ssh2Adapter
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
                ssh2_auth_none($this->session, $options->getUsername());
                break;

            case AuthenticationMethod::PUBLIC_KEY():
                ssh2_auth_pubkey_file(
                    $this->session,
                    $options->getUsername(),
                    $options->getPublicKey(),
                    $options->getPrivateKey(),
                    $options->getPassword()
                );
                break;
            case AuthenticationMethod::PASSWORD():
                ssh2_auth_password($this->session, $options->getUsername(), $options->getPassword());
                break;

            default:
                throw new \InvalidArgumentException('An invalid authentication method has been provided.');
        }

        return $this;
    }
}
