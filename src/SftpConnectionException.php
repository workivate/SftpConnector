<?php
namespace SftpConnector;

use ScriptFUSION\Porter\Connector\RecoverableConnectorException;

/**
 * The exception that is thrown when an SFTP connection error occurs.
 */
class SftpConnectionException extends RecoverableConnectorException
{
    // Intentionally empty.
}
