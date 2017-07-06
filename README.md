SftpConnector
========

Provides an SFTP connector for [Porter][Porter] that fetches data from an SFTP server via [phpseclib][phpseclib] or [Libssh2][libssh2].

**Be careful if you use Libssh2**

When trying to use STFP commands once logged in the server, a segmentation fault can happen if you're not using the good version on PHP/Ssh2.
There is a supposedly working hack to avoid that (casting the resource to an int when using the SSH2 wrapper but it never worked for me).

/!\ _Use it at your own risk_ /!\


[Porter]: https://github.com/ScriptFUSION/Porter
[phpseclib]: https://github.com/phpseclib/phpseclib
[libssh2]: https://libssh2.org/
