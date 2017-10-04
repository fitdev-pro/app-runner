<?php

namespace FitdevPro\FitAppRunner;

/**
 * Interface IResponseEmitter
 * @package FitdevPro\FitAppRunner
 */
interface IResponseEmitter
{
    public function emit(IResponse $response);
}
