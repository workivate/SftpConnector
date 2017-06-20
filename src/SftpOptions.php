<?php
namespace SftpConnector;

use phpseclib\Crypt\RSA;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;

final class SftpOptions extends EncapsulatedOptions
{
    const DEFAULT_PORT = 22;
    const DEFAULT_TIMEOUT = 10;
    const DEFAULT_USERNAME = '';

    /**
     * @param string $host
     */
    public function __construct($host) {
        $this->set('host', $host);

        $this->setDefaults([
            'port' => self::DEFAULT_PORT,
            'timeout' => self::DEFAULT_TIMEOUT,
            'username' => self::DEFAULT_USERNAME,
            'authenticationMethod' => AuthenticationMethod::BASIC(),
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
     * @param RSA $rsaKey
     *
     * @return $this
     */
    public function setRsaKey(RSA $rsaKey)
    {
        return $this->set('rsaKey', $rsaKey);
    }

    /**
     * @return RSA
     */
    public function getRsaKey()
    {
        return $this->get('rsaKey');
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        return $this->set('password', $password);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * @param AuthenticationMethod $authenticationMethod
     *
     * @return $this
     */
    public function setAuthenticationMethod(AuthenticationMethod $authenticationMethod)
    {
        return $this->set('authenticationMethod', $authenticationMethod);
    }

    /**
     * @return AuthenticationMethod
     */
    public function getAuthenticationMethod()
    {
        return $this->get('authenticationMethod');
    }

    /**
     * @return string|RSA
     */
    public function getAuthenticationCredentials()
    {
        return $this->get(AuthenticationMethodToPropertyMapping::getMapping($this->getAuthenticationMethod()->value()));
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
