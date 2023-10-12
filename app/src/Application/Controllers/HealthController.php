<?php
namespace App\Application\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HealthController {
    public function check() {
        return new Response('APP UP');
    }

    public function phpInfo() {
        ob_start();
        phpinfo();
        $phpInfo = ob_get_clean();
        $response = new Response($phpInfo);
        $response->headers->set('Content-Type', 'text/html');
        return $response;
    }
}