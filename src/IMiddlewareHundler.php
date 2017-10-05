<?php

namespace FitdevPro\FitAppRunner;

/**
 * Interface IMiddlewareHundler
 * @package FitdevPro\FitAppRunner
 */
interface IMiddlewareHundler
{
    public function handle(IServerRequest $request, IResponse $response) : IResponse;
    public function appendMidleware($midleware);
}
