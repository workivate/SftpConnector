<?php
namespace SftpConnector;

interface SftpAdapter
{
    /**
     * @param string $host
     * @param int $post
     *
     * @return $this
     */
    public function connect($host, $post = 22);

    /**
     * @param SftpOptions $options
     *
     * @return $this
     */
    public function authenticate(SftpOptions $options);

    /**
     * @param string $source
     *
     * @return resource
     */
    public function fetch($source);

    /**
     * @return $this
     */
    public function disconnect();
}
