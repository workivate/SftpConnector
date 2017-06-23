<?php
namespace SftpConnector\Ssh2;

use ScriptFUSION\Porter\Connector\RecoverableConnectorException;

/**
 * The exception that is thrown when an SSH2 connection error occurs.
 */
class Ssh2ConnectionException extends RecoverableConnectorException
{
    // Intentionally empty.
}
