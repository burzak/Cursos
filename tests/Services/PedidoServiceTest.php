<?php

namespace Tests\Services;

use Cursos\Models\Pedido;
use Cursos\Services\PedidoService;

class PedidoServiceTest extends \PHPUnit\Framework\TestCase{

    protected $pedidoService;
    protected function setUp () : void {
        $storage = new \Cursos\DB\MemoryStorage();

        $this->pedidoService = new PedidoService($storage);    
    }


    public function testRegisterRequest(){
        $result = $this->pedidoService->register("uno@uno.com","uno");
        $this->assertTrue($result instanceof Pedido);
        $this->assertEquals("uno@uno.com", $result->getEmail());
        $this->assertEquals("uno", $result->getTexto());        
    }

    public function testFindAllRequest(){
        $result = $this->pedidoService->findAll();
        $this->assertCount(0, $result);
    }

    public function testFindAllRequestWithData(){
        $this->pedidoService->register("uno@uno.com","uno");
        $result = $this->pedidoService->findAll();
        $this->assertCount(1, $result);
        $this->assertEquals("uno@uno.com",$result[0]->getEmail());
        $this->assertEquals("uno",$result[0]->getTexto());
    }
    
    public function testDeleteRequest(){
        $pedido = $this->pedidoService->register("uno@uno.com","uno");
        $result= $this->pedidoService->delete($pedido);
        $this->assertTrue($result);
    }

    public function testDeleteWithTwoRequest(){
        $pedido = $this->pedidoService->register("uno@uno.com","uno");
        $pedido2 = $this->pedidoService->register("dos@dos.com","dos");
        $result= $this->pedidoService->delete($pedido);
        $data = $this->pedidoService->findAll();
        $this->assertTrue($result);
        $this->assertCount(1,$data);
    }

    public function testDeleteFalse(){
        $pedido = new Pedido(1,"n@n.com","curson",1);
        $result= $this->pedidoService->delete($pedido);
        $this->assertFalse($result);
        

    }

}