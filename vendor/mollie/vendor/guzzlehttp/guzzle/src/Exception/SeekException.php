<?php

namespace _PhpScoper7fb942e22fb5\GuzzleHttp\Exception;

use _PhpScoper7fb942e22fb5\Psr\Http\Message\StreamInterface;
/**
 * Exception thrown when a seek fails on a stream.
 */
class SeekException extends \RuntimeException implements \_PhpScoper7fb942e22fb5\GuzzleHttp\Exception\GuzzleException
{
    private $stream;
    public function __construct(\_PhpScoper7fb942e22fb5\Psr\Http\Message\StreamInterface $stream, $pos = 0, $msg = '')
    {
        $this->stream = $stream;
        $msg = $msg ?: 'Could not seek the stream to position ' . $pos;
        parent::__construct($msg);
    }
    /**
     * @return StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }
}
