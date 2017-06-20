<?php
namespace SftpConnector;

use phpseclib\Crypt\RSA;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;

final class SftpOptions extends EncapsulatedOptions
{
    private $host;

    private $port = 22;

    /**
     * @var string|RSA
     */
    private $authenticationSecurity;

    private $timeout = 10;

    private $username = '';

    /**
     * @param string $host
     */
    public function __construct($host) {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string|RSA $authenticationSecurity
     */
    public function setAuthenticationSecurity($authenticationSecurity)
    {
        $this->authenticationSecurity = $authenticationSecurity;
    }

    public function getAuthenticationSecurity()
    {
        return $this->authenticationSecurity;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}
