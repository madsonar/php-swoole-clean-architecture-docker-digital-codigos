#!/usr/bin/env php
<?php

declare(strict_types=1);

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

require 'serverHandle.php';

$http = new Server("0.0.0.0", 80);

$http->on(
    "start",
    function (Server $http) {
        echo "Swoole HTTP server is started.\n";
    }
);

$http->on(
    "request",
    function (Request $request, Response $response) {
        $returnedResponse = handleRequest($request, $response);
        $response->end($returnedResponse);
}
);

$http->start();