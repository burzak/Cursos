<?php

namespace Tests\Controllers;

use Slim\Factory\AppFactory;
use \Cursos\Services\PedidoService;
use Slim\Psr7\Factory\RequestFactory;


class PedidoControllerTest extends \PHPUnit\Framework\TestCase{

     
    protected function setUp ():void{
        $container = \Cursos\ContainerFactory::create();
        $container->set('Cursos\DB\StorageInterface',
                        \DI\autowire('Cursos\DB\MemoryStorage'));

        $this->controller = $container->get("Cursos\Controllers\PedidoController");
        $this->pedidoService = $container->get("Cursos\Services\PedidoService");

        $app = AppFactory::create();
        $this->fac = $app->getResponseFactory();
        $this->response = $this->fac->createResponse();
        $this->requestFactory = new RequestFactory();
    }

    public function testPedidoCanRenderTheHTML() {

        $responseResult = $this->controller->index($this->response);

        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Bienvenidos a pedidos", $body);
    }

    public function testPedidoRenderHtmlWithData(){

        $data = $this->pedidoService->registrar("uno@uno.com","tdd");
        $responseResult = $this->controller->index($this->response);
        $body = (string) $responseResult->getBody();
        $this->assertStringContainsString($data->getEmail(),$body);
    }

    public function testPedidosRenderHtmlWithDataAndDeleteDataOk(){
        $data = $this->pedidoService->registrar("uno@uno.com","tdd");
        $data1 = $this->pedidoService->registrar("cuatro|@cuatro.com","cuatro");
        $responseResult = $this->controller->index($this->response);
        $body = (string) $responseResult->getBody();
        $this->assertStringContainsString($data->getEmail(),$body);
        $this->assertStringContainsString($data1->getEmail(),$body);
        $this->pedidoService->borrar($data1);
        $nuevoRes = $this->fac->createResponse();
        $responseResult1= $this->controller->index($nuevoRes);
        $body1 = (string) $responseResult1->getBody();
        $this->assertStringNotContainsString("cuatro|@cuatro.com",$body1);

    }

    public function testFormularioRequestWithNoInformacion(){
        $responseResult = $this->controller->form($this->response);
        $body = (string) $responseResult->getBody();

        $this->assertStringContainsString("formulario de pedidos",$body);
        $this->assertStringContainsString('name="email"',$body);
        $this->assertStringContainsString('name="texto"',$body);
    }

    public function testCreateAtravesDeForm(){
        $request = $this->requestFactory->createRequest('POST', '/')->withParsedBody([
            'email' => 'nico@nico.com',
            'texto' => 'tdd',
        ]);
        
        $responseResult = $this->controller->formSubmit($this->response,$request);
        $body = (string) $responseResult->getBody();

     }
}