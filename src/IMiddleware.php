<?php

namespace FitdevPro\FitAppRunner;

/**
 * Interface IMiddleware
 * @package FitdevPro\FitAppRunner
 */
interface IMiddleware
{
    public function handle(IServerRequest $request, IResponse $response);
}
