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
     */
    public function __construct(IDependencyContainer $di)
    {
        $this->di = $di;

        $this->request = $this->di->get('request');
        $this->response = $this->di->get('response');

        $this->middleware = $this->di->get('middleware');
        $this->emitter = $this->di->get('requestEmitter');
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
