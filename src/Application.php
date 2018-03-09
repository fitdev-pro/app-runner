<?php

namespace FitdevPro\FitAppRunner;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class Application
 * @package FitdevPro\FitAppRunner
 */
class Application
{
    /** @var  ContainerInterface */
    protected $di;

    /** @var  ServerRequestInterface */
    protected $request;

    /** @var  ResponseInterface */
    protected $response;

    /** @var  MiddlewareInterface */
    protected $middleware;

    /** @var  RequestHandlerInterface */
    protected $requestHandler;

    /** @var  ResponseEmitterInterface */
    protected $emitter;

    /**
     * Application constructor.
     * @param ContainerInterface $di
     * @throws \Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $di)
    {
        $this->di = $di;

        $this->request = $this->di->get('request');

        $this->middleware = $this->di->get('httpMiddleware');
        $this->requestHandler = $this->di->get('requestHundler');

        $this->emitter = $this->di->get('responseEmitter');

        $this->checkDependencies();
    }

    /**
     * @throws \Exception
     */
    private function checkDependencies(){
        if( !$this->request instanceof ResponseInterface ){
            throw new \Exception('Service "request" passed to FitdevPro\FitAppRunner\Application must implement interface Psr\Http\Message\ResponseInterface, instance of '.get_class($this->request).' given.');
        }

        if( !$this->emitter instanceof ResponseEmitterInterface ){
            throw new \Exception('Service "responseEmitter" passed to FitdevPro\FitAppRunner\Application must implement interface FitdevPro\FitAppRunner\IResponseEmitter, instance of '.get_class($this->response).' given.');
        }

        if( !$this->middleware instanceof MiddlewareInterface ){
            throw new \Exception('Service "middleware" passed to FitdevPro\FitAppRunner\Application must implement interface Psr\Http\Server\MiddlewareInterface, instance of '.get_class($this->response).' given.');
        }

        if( !$this->requestHandler instanceof RequestHandlerInterface ){
            throw new \Exception('Service "middleware" passed to FitdevPro\FitAppRunner\Application must implement interface Psr\Http\Server\RequestHandlerInterface, instance of '.get_class($this->response).' given.');
        }
    }

    public function handle()
    {
        $this->response = $this->middleware->process($this->request, $this->requestHandler);

        return $this;
    }

    public function dispatch()
    {
        $this->emitter->emit($this->response);
    }
}
