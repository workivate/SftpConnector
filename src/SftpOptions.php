<?php
namespace SftpConnector;

use phpseclib\Crypt\RSA;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;

final class SftpOptions extends EncapsulatedOptions
{
    /**
     * @param string $host
     */
    public function __construct($host) {
        $this->set('host', $host);

        $this->setDefaults([
            'port' => 22,
            'timeout' => 10,
            'username' => ''
        ]);
    }

    public function getHost()
    {
        return $this->get('host');
    }

    /**
     * @param int $port
     *
     * @return $this
     */
    public function setPort($port)
    {
        return $this->set('port', $port);
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->get('port');
    }

    /**
     * @param string|RSA $authenticationSecurity
     *
     * @return $this
     */
    public function setAuthenticationSecurity($authenticationSecurity)
    {
        return $this->set('authenticationSecurity', $authenticationSecurity);
    }

    /**
     * @return string|RSA
     */
    public function getAuthenticationSecurity()
    {
        return $this->get('authenticationSecurity');
    }

    /**
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        return $this->set('timeout', $timeout);
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->get('timeout');
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        return $this->set('username', $username);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->get('username');
    }
}
