SftpConnector
=============

[![Latest version][Version image]][Releases]
[![Total downloads][Downloads image]][Downloads]
[![Build status][Build image]][Build]
[![Test coverage][Coverage image]][Coverage]
[![Code style][Style image]][Style]

Provides an SFTP connector for [Porter][Porter] that fetches data from an SFTP server via [phpseclib][phpseclib] or [Libssh2][libssh2].

**Be careful if you use Libssh2**

When trying to use STFP commands once logged in the server, a segmentation fault can happen if you're not using the good version on PHP/Ssh2.
There is a supposedly working hack to avoid that (casting the resource to an int when using the SSH2 wrapper but it never worked for me).

/!\ _Use it at your own risk_ /!\


  [Releases]: https://github.com/Porter-connectors/SftpConnector/releases
  [Version image]: https://poser.pugx.org/connectors/sftp/version "Latest version"
  [Downloads]: https://packagist.org/packages/connectors/sftp
  [Downloads image]: https://poser.pugx.org/connectors/sftp/downloads "Total downloads"
  [Build]: https://travis-ci.org/Porter-connectors/SftpConnector
  [Build image]: https://travis-ci.org/Porter-connectors/SftpConnector.svg?branch=master "Build status"
  [Coverage]: https://coveralls.io/github/Porter-connectors/SftpConnector
  [Coverage image]: https://coveralls.io/repos/Porter-connectors/SftpConnector/badge.svg "Test coverage"
  [Style]: https://styleci.io/repos/96418297
  [Style image]: https://styleci.io/repos/96418297/shield?style=flat "Code style"
  
  [Porter]: https://github.com/ScriptFUSION/Porter
  [phpseclib]: https://github.com/phpseclib/phpseclib
  [libssh2]: https://libssh2.org/
