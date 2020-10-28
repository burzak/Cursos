<?php

namespace Tests\Services;

final class CursoServiceTest extends \PHPUnit\Framework\TestCase {
    /**
     * @var \Cursos\DB\MemoryStorage
     */
    private $db;

    /**
     * @var \Cursos\Services\CursoService
     */
    private $service;


    protected function setUp() : void {
        $this->db = new \Cursos\DB\MemoryStorage();
        $this->service = new \Cursos\Services\CursoService($this->db);
    }

    public function testExists() {
        $this->assertTrue(class_exists("Cursos\Services\CursoService"));
    }

    public function testCanRegisterARequest() {
        $curso = $this->service->register("Curso1", "desc1");

        $this->assertEquals("Curso1", $curso->getName());
        $this->assertEquals("desc1", $curso->getDescription());
    }

    public function testCanRegisterAnotherRequest() {
        $curso = $this->service->register("Curso2", "desc2");

        $this->assertEquals("Curso2", $curso->getName());
        $this->assertEquals("desc2", $curso->getDescription());
    }

    public function testCanRegisterAndIsFound() {
        $curso = $this->service->register("Curso3", "desc3");
        
        $cursos = $this->service->findAll();

        $this->assertCount(1, $cursos);
    }

    public function testCanRegister2RequestsAndAreFound() {
        $curso1 = $this->service->register("Curso4", "desc4");
        $curso2 = $this->service->register("Curso5", "desc5");
        
        $cursos = $this->service->findAll();

        $this->assertCount(2, $cursos);

        foreach ($cursos as $curso) {
            $this->assertTrue($curso instanceof \Cursos\Models\Curso);
        }
    }

    public function testCanUpdate() {
        $curso1 = $this->service->register("Curso6", "desc6");

        $cursoUpdate = $this->service->update($curso1->getIdCurso(), "Curso7", "desc7");

        $this->assertEquals("Curso7", $cursoUpdate->getName());
        $this->assertEquals("desc7", $cursoUpdate->getDescription());
    }

    public function testCanFoundOne() {
        $curso1 = $this->service->register("Curso8", "desc8");

        $cursoFound = $this->service->findOne($curso1->getIdCurso());

        $this->assertEquals("Curso8", $cursoFound->getName());
        $this->assertEquals("desc8", $cursoFound->getDescription());
    }

    public function testCantFoundOne() {
        $curso1 = $this->service->register("Curso9", "desc9");

        $cursoFound = $this->service->findOne('cualquiercosa!');

        $this->assertNull($cursoFound);
    }

    public function testUpdateAndFoundOne() {
        $curso1 = $this->service->register("Curso10", "desc10");
        $cursoUpdate = $this->service->update($curso1->getIdCurso(), "Curso11", "desc11");

        $cursoFound = $this->service->findOne($curso1->getIdCurso());

        $this->assertEquals("Curso11", $cursoFound->getName());
        $this->assertEquals("desc11", $cursoFound->getDescription());
    }

    public function testUpdateNotExistingId() {
        $curso1 = $this->service->register("Curso12", "desc12");
        $cursoUpdate = $this->service->update('cualquiercosa!', "Curso13", "desc13");

        $this->assertNull($cursoUpdate);
    }
}
