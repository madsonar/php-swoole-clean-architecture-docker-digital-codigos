<?php

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use App\Application\Routing\Routes;

function handleRequest(SwooleRequest $swooleRequest, SwooleResponse $swooleResponse): string {
    $request = Request::create(
        $swooleRequest->server['request_uri'],
        $swooleRequest->server['request_method'],
        [],
        $swooleRequest->cookie ?? [],
        $swooleRequest->files ?? [],
        $swooleRequest->server,
        $swooleRequest->rawContent()
    );

    $routes = Routes::getRoutes();

    $context = new RequestContext();
    $context->fromRequest($request);

    $matcher = new UrlMatcher($routes, $context);

    try {
        $attributes = $matcher->match($request->getPathInfo());
        $controller = $attributes['_controller'];
        unset($attributes['_controller']);
        
        if (is_callable($controller)) {
            $response = $controller();
        } else {
            list($class, $method) = $controller;
            $object = new $class();
            $response = $object->$method();
        }
    } catch (ResourceNotFoundException $e) {
        $response = new Response('Not Found', 404);
    } catch (Exception $e) {
        $response = new Response('An error occurred', 500);
    }

    $swooleResponse->status($response->getStatusCode());
    foreach ($response->headers->all() as $name => $values) {
        foreach ($values as $value) {
            $swooleResponse->header($name, $value);
        }
    }

    // Retorne o conteúdo da resposta em vez de finalizá-la diretamente
    return $response->getContent();
}
