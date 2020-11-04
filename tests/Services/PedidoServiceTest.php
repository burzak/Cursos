<?php

namespace Tests\Services;

use Cursos\Models\Pedido;
use Cursos\Services\PedidoService;


/* 
- PedidosService
    register(email, curso_texto): Pedido
    findOne(idPedido) : Pedido
    findAll(): Pedido[]
    hide(Pedido): Pedido
 */



final class PedidoServiceTest extends \PHPUnit\Framework\TestCase{
    
    protected function setUp(): void
    {
        $storage = new \Cursos\DB\MemoryStorage;
        $this->servicio = new PedidoService($storage);
    }
    
    
    
    public function testRegister(){
        $servicio = $this->servicio;
        $res = $servicio->register("uno@uno.com","lolsito");
        $this->assertInstanceOf(\Cursos\Models\Pedido::class,$res);
    }

    public function testRegisterGets(){
        $servicio = $this->servicio;
        $res = $servicio->register("dos@dos.com","lolsitoreloud");
        $this->assertEquals($res->getEmail(),"dos@dos.com");
        $this->assertEquals($res->getTexto(),"lolsitoreloud");
    }

    public function testOtroRegisterGets(){
        $servicio = $this->servicio;
        $res = $servicio->register("tres@tres.com","lolsitoreloud2");
        $this->assertEquals($res->getEmail(),"tres@tres.com");
        $this->assertEquals($res->getTexto(),"lolsitoreloud2");
    }
    public function testFindOne(){
        $servicio = $this->servicio;
        $res2 = $servicio->register("cuatro@cuatro.com","otracosa");
        $res1 = $servicio->findOne($res2->getId());
        $this->assertEquals($res1->getEmail(),"cuatro@cuatro.com");
        $this->assertEquals($res1->getTexto(),"otracosa");
    }
    public function testFindOne2(){
        $servicio = $this->servicio;
        $res2 = $servicio->register("five@five.com","otracosasecuela");
        $res1 = $servicio->findOne($res2->getId());
        $this->assertEquals($res1->getEmail(),"five@five.com");
        $this->assertEquals($res1->getTexto(),"otracosasecuela");
    }

    public function test2id(){
        $servicio = $this->servicio;
        $res2 = $servicio->register("five@five.com","otracosasecuela");
        $res3 = $servicio->register("seis@seis.com","otra2");
        $res4 = $servicio->findOne($res2->getId());
        $res5 = $servicio->findOne($res3->getId());
        $this->assertEquals($res4->getEmail(),"five@five.com");
        $this->assertEquals($res5->getEmail(),"seis@seis.com");
        $this->assertEquals($res4->getTexto(),"otracosasecuela");
        $this->assertEquals($res5->getTexto(),"otra2");
    }
}

