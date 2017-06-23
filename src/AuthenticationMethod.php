<?php
namespace SftpConnector;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static NONE()
 * @method static PASSWORD()
 * @method static PUBLIC_KEY()
 */
class AuthenticationMethod extends AbstractEnumeration
{
    const NONE = 'NONE';
    const PASSWORD = 'PASSWORD';
    const PUBLIC_KEY = 'PUBLIC_KEY';
}
