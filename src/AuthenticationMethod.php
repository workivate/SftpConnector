<?php
namespace SftpConnector;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static RSA()
 * @method static BASIC()
 */
class AuthenticationMethod extends AbstractEnumeration
{
    const RSA = 'RSA';
    const BASIC = 'BASIC';
}
