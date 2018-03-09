<?php

namespace FitdevPro\FitAppRunner;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface IResponseEmitter
 * @package FitdevPro\FitAppRunner
 */
interface ResponseEmitterInterface
{
    public function emit(ResponseInterface $response);
}
