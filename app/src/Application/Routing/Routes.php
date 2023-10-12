<?php
namespace App\Application\Routing;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Application\Controllers\HealthController;

class Routes {
    public static function getRoutes(): RouteCollection {
        $routes = new RouteCollection();


        $routes->add('health_check', new Route('/health-check', [
            '_controller' => [HealthController::class, 'check']
        ]));

        $routes->add('php_info', new Route('/phpinfo', [
            '_controller' => [HealthController::class, 'phpInfo']
        ]));

        return $routes;
    }
}