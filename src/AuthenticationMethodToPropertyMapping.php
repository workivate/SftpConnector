<?php
namespace SftpConnector;

class AuthenticationMethodToPropertyMapping
{
    const MAPPING = [
        AuthenticationMethod::BASIC => 'password',
        AuthenticationMethod::RSA => 'rsaKey',
    ];

    public static function getMapping(AuthenticationMethod $authenticationMethod)
    {
        return self::MAPPING[$authenticationMethod->value()];
    }
}
