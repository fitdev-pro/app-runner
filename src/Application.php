<?php

namespace FitdevPro\FitAppRunner;

/**
 * Class Application
 * @package FitdevPro\FitAppRunner
 */
class Application
{
    /** @var  IDependencyContainer */
    protected $di;

    /** @var  IServerRequest */
    protected $request;

    /** @var  IResponse */
    protected $response;

    /** @var  IResponseEmitter */
    protected $emitter;

    /** @var  IMiddleware */
    protected $middleware;

    /**
     * Application constructor.
     * @param IDependencyContainer $di
     * @throws \Exception
     */
    public function __construct(IDependencyContainer $di)
    {
        $this->di = $di;

        $this->request = $this->di->get('request');
        $this->response = $this->di->get('response');
        $this->emitter = $this->di->get('responseEmitter');

        $this->middleware = $this->di->get('middleware');

        $this->checkDependencies();
    }

    private function checkDependencies(){
        if( !$this->request instanceof IServerRequest ){
            throw new \Exception('Service "request" passed to FitdevPro\FitAppRunner\Application must implement interface FitdevPro\FitAppRunner\IResponse, instance of '.get_class($this->request).' given.');
        }

        if( !$this->response instanceof IResponse ){
            throw new \Exception('Service "response" passed to FitdevPro\FitAppRunner\Application must implement interface FitdevPro\FitAppRunner\IServerRequest, instance of '.get_class($this->response).' given.');
        }

        if( !$this->emitter instanceof IResponseEmitter ){
            throw new \Exception('Service "responseEmitter" passed to FitdevPro\FitAppRunner\Application must implement interface FitdevPro\FitAppRunner\IResponseEmitter, instance of '.get_class($this->response).' given.');
        }

        if( !$this->middleware instanceof IMiddlewareHundler ){
            throw new \Exception('Service "middleware" passed to FitdevPro\FitAppRunner\Application must implement interface FitdevPro\FitAppRunner\IMiddlewareHundler, instance of '.get_class($this->response).' given.');
        }
    }

    public function handle()
    {
        $this->response = $this->middleware->handle($this->request, $this->response);

        return $this;
    }

    public function dispatch()
    {
        $this->emitter->emit($this->response);
    }
}
