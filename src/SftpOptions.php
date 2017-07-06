<?php
namespace SftpConnector;

use ScriptFUSION\Porter\Options\EncapsulatedOptions;

final class SftpOptions extends EncapsulatedOptions
{
    const DEFAULT_PORT = 22;
    const DEFAULT_TIMEOUT = 10;
    const DEFAULT_PASSWORD = '';

    /**
     * @param string $host
     * @param string $username
     */
    public function __construct($host, $username)
    {
        $this->set('host', $host);
        $this->set('username', $username);

        $this->setDefaults([
            'port' => self::DEFAULT_PORT,
            'timeout' => self::DEFAULT_TIMEOUT,
            'password' => self::DEFAULT_PASSWORD,
            'authenticationMethod' => AuthenticationMethod::NONE(),
        ]);
    }

    public function getHost()
    {
        return $this->get('host');
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->get('username');
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
     * @param string $publicKey
     *
     * @return $this
     */
    public function setPublicKey($publicKey)
    {
        return $this->set('publicKey', $publicKey);
    }

    /**
     * @return string
     */
    public function getPublicKey()
    {
        return $this->get('publicKey');
    }

    /**
     * @param string $privateKey
     *
     * @return $this
     */
    public function setPrivateKey($privateKey)
    {
        return $this->set('privateKey', $privateKey);
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->get('privateKey');
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
}
