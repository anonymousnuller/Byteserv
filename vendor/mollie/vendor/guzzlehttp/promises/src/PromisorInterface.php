<?php

namespace _PhpScoper7fb942e22fb5\GuzzleHttp\Promise;

/**
 * Interface used with classes that return a promise.
 */
interface PromisorInterface
{
    /**
     * Returns a promise.
     *
     * @return PromiseInterface
     */
    public function promise();
}
