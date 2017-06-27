<?php
namespace SftpConnector\Libssh2;

/**
 * The exception that is thrown if an action is executed while not being connected.
 */
class NotConnectedException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('You must be connected to the server in order to execute an action.');
    }
}
