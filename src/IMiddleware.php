<?php

namespace FitdevPro\FitAppRunner;

/**
 * Interface IMiddleware
 * @package FitdevPro\FitAppRunner
 */
interface IMiddleware
{
    public function __invoke(IServerRequest $request, IResponse $response, callable $next = null);
}
