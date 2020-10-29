<?php

namespace Tests\Controllers;

use \Cursos\Controllers\HomeController;
use Slim\Factory\AppFactory;


final class HomeControllerTest extends \PHPUnit\Framework\TestCase {

    public function testHomeCanRenderTheHTML() {
        $container = \Cursos\ContainerFactory::create();

        $controller = $container->get("Cursos\Controllers\HomeController");

        $app = AppFactory::create();
        $fac = $app->getResponseFactory();
        $response = $fac->createResponse();

        $responseResult = $controller->index($response);

        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Bienvenidos a cursos", $body);

    }
}