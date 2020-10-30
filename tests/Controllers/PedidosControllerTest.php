<?php

namespace Tests\Controllers;

use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\RequestFactory;

final class PedidosControllerTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \Cursos\DB\MemoryStorage
     */
    private $db;

    /**
     * @var \Cursos\Services\PedidoService
     */
    private $service;

    private $app;
    private $container;
    private $requestFactory;

    protected function setUp(): void
    {
        $this->db = new \Cursos\DB\MemoryStorage();
        $this->app = AppFactory::create();
        $this->container = \Cursos\ContainerFactory::create();

        $this->requestFactory = new RequestFactory();

    }

    public function testExistsClass()
    {
        $this->assertTrue(class_exists("Cursos\Controllers\PedidosController"));
    }
    public function testPedidosCanRenderTheHTML()
    {

        $controller = $this->container->get("Cursos\Controllers\PedidosController");

        $fac = $this->app->getResponseFactory();
        $response = $fac->createResponse();

        $responseResult = $controller->index($response);

        $body = (string) $responseResult->getBody();

        $this->assertStringContainsString("Bienvenidos a pedidos", $body);
    }
    public function testPedidosCanRenderListHTML()
    {

        $service = $this->container->get("Cursos\Services\PedidoService");

        $controller = $this->container->get("Cursos\Controllers\PedidosController");

        $fac = $this->app->getResponseFactory();
        $response = $fac->createResponse();

        $pedido1 = $service->register("empleado1@mail.com", "curso1");
        $pedido2 = $service->register("empleado2@mail.com", "curso2");

        $responseResult = $controller->list($response);
        $body = (string) $responseResult->getBody();

        $this->assertStringContainsString("empleado1@mail.com", $body);
        $this->assertStringContainsString("curso1", $body);
        $this->assertStringContainsString("empleado2@mail.com", $body);
        $this->assertStringContainsString("curso2", $body);
    }

    public function testPedidosCanRenderRegisterRequestHTML()
    {

        $service = $this->container->get("Cursos\Services\PedidoService");

        $controller = $this->container->get("Cursos\Controllers\PedidosController");

        $fac = $this->app->getResponseFactory();
        $response = $fac->createResponse();

        

        $request = $this->requestFactory->createRequest('POST', '/')->withParsedBody(
            [
                'email' => 'email3@email.com',
                'description' => 'desc3',
            ]
        );
        $responseResult = $controller->formSubmit($response, $request);
        $body = (string) $responseResult->getBody();

        $this->assertStringContainsString('email3@email.com', $body);
        $this->assertStringContainsString('desc3', $body);

    }

    public function testPedidosCanRenderHideRequestHTML()
    {

        $service = $this->container->get("Cursos\Services\PedidoService");
        $controller = $this->container->get("Cursos\Controllers\PedidosController");

        $fac = $this->app->getResponseFactory();
        $response = $fac->createResponse();

        $pedido = $service->register("empleado1@mail.com", "curso1");

        $request = $this->requestFactory->createRequest('POST', '/')->withParsedBody(
            [
                'id' => $pedido->getId(),
                'email' => $pedido->getEmail(),
                'description' => $pedido->getDescription(),
            ]
        );
        $responseResult = $controller->formSubmit($response, $request);
        $body = (string) $responseResult->getBody();

        $this->assertStringContainsString('inactivo', $body);
        
    }
}
