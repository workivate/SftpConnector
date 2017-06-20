<?php
namespace SftpConnector;

use ScriptFUSION\Porter\Connector\RecoverableConnectorException;

/**
 * The exception that is thrown when an SFTP login error occurs.
 */
class SftpLoginException extends RecoverableConnectorException
{
    // Intentionally empty.
}
