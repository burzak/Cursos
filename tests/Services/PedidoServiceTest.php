<?php

namespace Tests\Services;

// - PedidosService
//     register(email, descripcion) : Pedidos
//     hide(Pedido) : Bool
//     findAll() : Pedidos[]

final class PedidoServiceTest extends \PHPUnit\Framework\TestCase {

    public function testExists() {
        $this->assertTrue(class_exists("Cursos\Services\PedidoService"));
    }

    /**
     * @var \Cursos\DB\MemoryStorage
     */
    private $db;

    /**
     * @var \Cursos\Services\PedidoService
     */
    private $service;


    protected function setUp() : void {
        $this->db = new \Cursos\DB\MemoryStorage();
        $this->service = new \Cursos\Services\PedidoService($this->db);
    }

    public function testCanRegisterARequest() {
        $pedido = $this->service->register("mail@mail.com", "desc");

        $this->assertEquals("mail@mail.com", $pedido->getEmail());
        $this->assertEquals("desc", $pedido->getDescription());
    }
    
    public function testCanRegisterAnotherRequest() {
        $pedido = $this->service->register("2@2.com", "pepe");

        $this->assertEquals("2@2.com", $pedido->getEmail());
        $this->assertEquals("pepe", $pedido->getDescription());
    }


    public function testCanRegisterAndIsFound() {
        $pedido = $this->service->register("2@2.com", "pepe");
        
        $pedidos = $this->service->findAll();

        $this->assertCount(1, $pedidos);
    }

    public function testCanRegister2RequestsAndAreFound() {
        $pedido1 = $this->service->register("1@1.com", "pepe1");
        $pedido2 = $this->service->register("2@2.com", "pepe2");
        $misPedidos = array($pedido1, $pedido2);
        
        $pedidos = $this->service->findAll();

        $this->assertCount(2, $pedidos);
        foreach ($pedidos as $pedido) {
            $this->assertTrue($pedido instanceof \Cursos\Models\Pedido);
        }
    }


    public function testICanHideARequest() {
        $pedido1 = $this->service->register("5@5.com", "desc5");
        $pedido2 = $this->service->register("6@6.com", "desc6");
        
        $r = $this->service->hide($pedido2);

        $this->assertTrue($r);
    }

    public function testICanHideARequestAndFindAllGetOnlyOneResult() {
        $pedido1 = $this->service->register("7@7.com", "desc7");
        $pedido2 = $this->service->register("8@8.com", "desc8");
        
        $r = $this->service->hide($pedido2);

        $pedidos = $this->service->findAll();

        $this->assertCount(1, $pedidos);
    }

}

