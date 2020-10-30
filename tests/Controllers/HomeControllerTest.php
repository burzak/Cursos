<?php

namespace Tests\Controllers;

use \Cursos\Controllers\HomeController;
use Slim\Factory\AppFactory;


final class HomeControllerTest extends \PHPUnit\Framework\TestCase {

    public function testHomeCanRenderTheHTML() {
        $container = \Cursos\ContainerFactory::create();
        $container->set('Cursos\DB\StorageInterface',
                        \DI\autowire('Cursos\DB\FileStorage')->constructor(\DI\get('test_db_file')));

        $controller = $container->get("Cursos\Controllers\HomeController");

        $app = AppFactory::create();
        $fac = $app->getResponseFactory();
        $response = $fac->createResponse();

        $responseResult = $controller->index($response);

        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Bienvenidos a cursos", $body);

    }
}