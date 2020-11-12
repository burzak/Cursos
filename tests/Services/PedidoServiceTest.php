<?php

namespace Tests\Services;

use Cursos\Models\Pedido;

final class PedidoServiceTest extends \PHPUnit\Framework\TestCase {

    private $db;
    /**
     * @var \Cursos\Services\PedidoService
     */
    private $pedidoService;

    protected function setUp(): void {
        $this->db = new \Cursos\DB\MemoryStorage();
        $this->pedidoService = new \Cursos\Services\PedidoService($this->db);
    }

    public function testexisteClasePedido(){
        $this->assertTrue(class_exists("\Cursos\Services\PedidoService"));
    }

    public function testRegistarUnPedido(){
       
        $registro=$this->pedidoService->registrar('rober@edu', 'estoEsUnTexto');
        $this->assertInstanceOf(Pedido::class,$registro);
        $this->assertEquals('rober@edu',$registro->getEmail());
        $this->assertEquals('estoEsUnTexto',$registro->getTexto());
        $this->assertEquals('1', $registro->getStatus());

    }


    public function testRegistarVariosPedidos(){
       
        $registro=$this->pedidoService->registrar('rober@edu', 'estoEsUnTexto');
        $registro1=$this->pedidoService->registrar('asd@edu', 'estoEsUnTexto1');
        $this->assertInstanceOf(Pedido::class,$registro);

        $this->assertEquals('rober@edu',$registro->getEmail());
        $this->assertEquals('estoEsUnTexto',$registro->getTexto());

        $this->assertEquals('asd@edu',$registro1->getEmail());
        $this->assertEquals('estoEsUnTexto1',$registro1->getTexto());
    }

    public function testRegistarVariosPedidosDeUnaMismaPersona(){
        $registro=$this->pedidoService->registrar('rober@edu', 'estoEsUnTexto');
        $registro1=$this->pedidoService->registrar('rober@edu', 'estoEsUnTexto1');
        $registro2=$this->pedidoService->registrar('rober@edu', 'estoEsUnTexto2');
        $this->assertInstanceOf(Pedido::class,$registro);
        $this->assertEquals('rober@edu',$registro->getEmail());
        $this->assertEquals('rober@edu',$registro1->getEmail());
        $this->assertEquals('rober@edu',$registro2->getEmail());
    }

    public function testFindAll(){
        $registro=$this->pedidoService->registrar('rober@edu42', 'estoEsUnTexto');
        $registro1=$this->pedidoService->registrar('rober@edu', 'estoEsUnTexto');
        $todos=$this->pedidoService->findAll();
        $this->assertCount(2,$todos);
        $this->assertEquals('rober@edu42',$todos[0]->getEmail());
    }

    public function testFindAllArrayVacio(){
        $todos=$this->pedidoService->findAll();
        $this->assertEquals(array(),$todos);
    }

    public function testBorrar(){
        $registro1=$this->pedidoService->registrar('rober@edu', 'estoEsUnTexto');
        $registro2=$this->pedidoService->registrar('asdasd@edu', 'estoEsUnTexto1');
        $borro=$this->pedidoService->borrar($registro2);
        $todos=$this->pedidoService->findAll();
        $this->assertTrue($borro);
        $this->assertCount(1,$todos);  
        $this->assertEquals('rober@edu',$todos[0]->getEmail());
        $this->assertEquals('estoEsUnTexto',$todos[0]->getTexto());
    }

    public function testBorrarUnUsuarioFake(){
        $registroFake= new Pedido("22","userFake@asd.com","text","1");
        $borroFake=$this->pedidoService->borrar($registroFake);
        $this->assertFalse($borroFake);
        $todos=$this->pedidoService->findAll();
        $this->assertCount(0,$todos);
    }
}

/* - PedidosService
    - register(email, texto) : Pedido
    - borrar(Pedido) : Boolean
    - findAll() : Pedido[] */
