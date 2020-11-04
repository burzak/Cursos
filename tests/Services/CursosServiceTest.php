<?php

namespace Tests\Services;

use Cursos\Services\CursosService;
use Cursos\Models\Curso;
final class CursosServiceTest extends \PHPUnit\Framework\TestCase {

    protected $cursosService;
    protected function setUp () : void {
        $storage = new \Cursos\DB\MemoryStorage();

        $this->cursosService = new CursosService($storage);
    } 

    public function testResgisterReturn()
    {
        $curso = $this->cursosService->register("lala", "lele", "lili");
        $this->assertTrue($curso instanceof Curso);
    }

    public function testRegisterSomething()
    {
        $curso = $this->cursosService->register("nombre", "descripcion","duracion");

        $this->assertEquals("nombre", $curso->getNombre());
        $this->assertEquals("descripcion", $curso->getDescripcion());
        $this->assertEquals("duracion", $curso->getDuracion());
   
        $curso = $this->cursosService->register("vegeta777", "minecraft para bommers","20 seg");

        $this->assertEquals("vegeta777", $curso->getNombre());
        $this->assertEquals("minecraft para bommers", $curso->getDescripcion());
        $this->assertEquals("20 seg", $curso->getDuracion());

    }

    public function testFindOneNull()
    {
        $this->assertNull($this->cursosService->findOne("pepeventilete"));
    }

    public function testFindOneAndAssert()
    {
        $registro = $this->cursosService->register("nombre", "descripcion","duracion");
        
        $curso = $this->cursosService->findOne($registro->getId());
        
        $this->assertTrue($curso instanceof Curso);

        $this->assertEquals("nombre" , $curso->getNombre());
        $this->assertEquals("descripcion" , $curso->getDescripcion());
        $this->assertEquals("duracion" , $curso->getDuracion());
    }

    public function testFindSeveralCourses()
    {
        $macrame = $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
        $amongUs = $this->cursosService->register("among us", "aprendiendo a jugar","2 hs");
        $pimba = $this->cursosService->register("pimba", "pumba","2 hs");
        
        $curso1 = $this->cursosService->findOne($macrame->getId());
        $curso2 = $this->cursosService->findOne($amongUs->getId());
        $curso3 = $this->cursosService->findOne($pimba->getId());
        
        $this->assertEquals("macrame" , $curso1->getNombre());
        $this->assertEquals("macrame intesivo" , $curso1->getDescripcion());
        $this->assertEquals("2 ajños" , $curso1->getDuracion());
    
        $this->assertEquals("among us" , $curso2->getNombre());
        $this->assertEquals("aprendiendo a jugar" , $curso2->getDescripcion());
        $this->assertEquals("2 hs" , $curso2->getDuracion());

        $this->assertEquals("pimba" , $curso3->getNombre());
        $this->assertEquals("pumba" , $curso3->getDescripcion());
        $this->assertEquals("2 hs" , $curso3->getDuracion());
    }

    public function testRegisterAndUpdate()
    {
        $macrame = $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
    
        $curso = $this->cursosService->update($macrame);

        $this->assertTrue($curso instanceof Curso);

    }

    public function testRegisterUpdateAndAssert()
    {
        $macrame = $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
    
        $macraUpdated = new Curso("LOL", "macrame en el LOL", "4 ajños", $macrame->getId());

        $curso = $this->cursosService->update($macraUpdated);

        $this->assertEquals("LOL" , $curso->getNombre());
        $this->assertEquals("macrame en el LOL" , $curso->getDescripcion());
        $this->assertEquals("4 ajños" , $curso->getDuracion());

    }

    public function testUpdateNull()
    {
        $macraUpdated = new Curso("LOL", "macrame en el LOL", "4 ajños", "macrameID");

        $curso = $this->cursosService->update($macraUpdated);

        $this->assertNull($curso);
    }

    public function testFindAllEmpty()
    {
        $this->assertEmpty($this->cursosService->findAll());
    }

    public function testFindAllRellenito()
    {
        $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
        $this->assertEquals(1 , count($this->cursosService->findAll()));
    
        $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
        $this->assertEquals(2 , count($this->cursosService->findAll()));
        
        $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
        $this->assertEquals(3 , count($this->cursosService->findAll()));
        
        $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
        $this->assertEquals(4 , count($this->cursosService->findAll()));
       
        $this->cursosService->register("macrame", "macrame intesivo","2 ajños");
        $this->assertEquals(5 , count($this->cursosService->findAll()));

    }
}