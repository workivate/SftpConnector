<?php
namespace SftpConnectorTest\Unit;

use ScriptFUSION\Porter\Options\EncapsulatedOptions;
use SftpConnector\SftpConnector;
use SftpConnector\SftpOptions;
use SftpConnectorTest\Fixtures\MockAdapter;

final class SftpConnectorTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidOptionsType()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new SftpConnector(new MockAdapter))->fetch('foo', \Mockery::mock(EncapsulatedOptions::class));
    }

    public function testFetch()
    {
        $filePath = __DIR__ . '/../Fixtures/fixture.json';
        $fileContent = json_decode(file_get_contents($filePath), true);

        $resource = (new SftpConnector(new MockAdapter))->fetch(
            $filePath,
            new SftpOptions('foo', 'bar')
        );

        self::assertInternalType('resource', $resource);

        $content = json_decode(fread($resource, filesize($filePath)), true);

        self::assertSame($fileContent, $content);
    }
}
