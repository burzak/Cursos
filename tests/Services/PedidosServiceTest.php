<?php

namespace Tests\Services;

use \Cursos\Services\PedidosService;

final class PedidosServiceTest extends \PHPUnit\Framework\TestCase {

private $service;



protected function setUp () : void {
    $storage = new \Cursos\DB\MemoryStorage();
    $this->service = new PedidosService($storage);
} 

public function testClassExist () {
    $this->assertTrue(class_exists('Cursos\Services\PedidosService'));
}

public function testPuedeRegistrar () {

    $pedido = $this->service->register('uno@uno.com','curso de macrame');
    
    $this->assertTrue($pedido instanceof \Cursos\Models\Pedido);
}

public function testPuedeRegistrarOtro () {
    
    $pedido = $this->service->register('uno@uno.com','curso de macrame');

    $this->assertEquals('uno@uno.com', $pedido->getEmail());
    $this->assertEquals('curso de macrame', $pedido->getTexto());
}

public function testPuedeRegistrarOtrosDatos () {

    $pedido = $this->service->register('dos@dos.com','curso de macrame, la leyenda continua');

    $this->assertEquals('dos@dos.com', $pedido->getEmail());
    $this->assertEquals('curso de macrame, la leyenda continua', $pedido->getTexto());
}

public function testFindOne () {
    
    $pedido = $this->service->register('dos@dos.com','curso de macrame, la leyenda continua');

    $found = $this->service->findOne($pedido->getId());

    $this->assertTrue($found instanceof \Cursos\Models\Pedido);
}

public function testFindOneOtherRegister () {
    
    $pedido1 = $this->service->register('uno@uno.com','curso de macrame');
    $pedido2 = $this->service->register('dos@dos.com','curso de macrame, la leyenda continua');

    $found1 = $this->service->findOne($pedido1->getId());
    $found2 = $this->service->findOne($pedido2->getId());

    $this->assertEquals('uno@uno.com', $found1->getEmail());
    $this->assertEquals('dos@dos.com', $found2->getEmail());
    $this->assertEquals('curso de macrame', $found1->getTexto());
    $this->assertEquals('curso de macrame, la leyenda continua', $found2->getTexto());
}

public function testFindAll () {
    
    $pedido1 = $this->service->register('uno@uno.com','curso de macrame');
    $pedido2 = $this->service->register('dos@dos.com','curso de macrame, la leyenda continua');

    $found = $this->service->findAll();

    $this->assertEquals(2, count($found));
    $this->assertTrue(in_array($pedido1,$found));
    $this->assertTrue(in_array($pedido2,$found));
}



}