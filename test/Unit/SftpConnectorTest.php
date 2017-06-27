<?php
namespace SftpConnectorTest\Unit;

use ScriptFUSION\Porter\Options\EncapsulatedOptions;
use SftpConnector\SftpConnector;
use SftpConnectorTest\Fixtures\MockAdapter;

class SftpConnectorTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidOptionsType()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new SftpConnector(new MockAdapter))->fetch('foo', \Mockery::mock(EncapsulatedOptions::class));
    }
}
