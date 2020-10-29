<?php

namespace Tests\Services;

use Cursos\Models\Dictado;

final class DictadoServiceTest extends \PHPUnit\Framework\TestCase {
    /**
     * @var \Cursos\DB\MemoryStorage
     */
    private $db;

    /**
     * @var \Cursos\Services\CursoService
     */
    private $cursoService;
    
    /**
     * @var \Cursos\Services\DictadoService
     */
    private $dictadoService;


    protected function setUp() : void {
        $this->db = new \Cursos\DB\MemoryStorage();
        $this->cursoService = new \Cursos\Services\CursoService($this->db);
        $this->dictadoService = new \Cursos\Services\DictadoService($this->db, $this->cursoService);
    }

    public function testExists() {
        $this->assertTrue(class_exists("Cursos\Services\DictadoService"));
    }

    public function testCanRegisterARequest() {
        $curso = $this->cursoService->register("Curso1", "desc1");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);

        $this->assertEquals($curso, $dictado->getCurso());
        $this->assertEquals($fechaInicio, $dictado->getFechaInicio());
        $this->assertEquals($fechaFin, $dictado->getFechaFin());
    }

    public function testCanRegisterAnotherRequest() {
        $curso = $this->cursoService->register("Curso2", "desc2");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);

        $this->assertEquals($curso, $dictado->getCurso());
        $this->assertEquals($fechaInicio, $dictado->getFechaInicio());
        $this->assertEquals($fechaFin, $dictado->getFechaFin());
    }

    public function testCanRegisterAndIsFound() {
        $curso = $this->cursoService->register("Curso3", "desc3");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);

        $dictados = $this->dictadoService->findAll();

        $this->assertCount(1, $dictados);
    }

    public function testCanRegister2RequestsAndAreFound() {
        $curso1 = $this->cursoService->register("Curso4", "desc4");
        $curso2 = $this->cursoService->register("Curso5", "desc5");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        
        $dictado1 = $this->dictadoService->register($curso1, $fechaInicio, $fechaFin);
        $dictado2 = $this->dictadoService->register($curso2, $fechaInicio, $fechaFin);
        
        $dictados = $this->dictadoService->findAll();

        $this->assertCount(2, $dictados);

        foreach ($dictados as $dictado) {
            $this->assertTrue($dictado instanceof \Cursos\Models\Dictado);
        }
    }

    public function testCanUpdate() {
        $curso1 = $this->cursoService->register("Curso6", "desc6");
        $fechaInicio1 = time();
        $fechaFin1 = time() + 10 * 24 * 3600;

        $curso2 = $this->cursoService->register("Curso7", "desc7");
        $fechaInicio2 = $fechaFin1;
        $fechaFin2 = $fechaInicio2 + 10 * 24 * 3600;
        
        $dictado = $this->dictadoService->register($curso1, $fechaInicio1, $fechaFin1);

        $dictadoUpdate = $this->dictadoService->update($dictado->getIdDictado(), $curso2, $fechaInicio2, $fechaFin2);

        $this->assertEquals($curso2, $dictadoUpdate->getCurso());
        $this->assertEquals($fechaInicio2, $dictadoUpdate->getFechaInicio());
        $this->assertEquals($fechaFin2, $dictadoUpdate->getFechaFin());
    }

    public function testUpdateNotExistingId() {
        $curso = $this->cursoService->register("Curso8", "desc8");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);

        $dictadoUpdate = $this->dictadoService->update('cualquiercosa!', $curso, $fechaInicio, $fechaFin);

        $this->assertNull($dictadoUpdate);
    }

    public function testCanFoundOne() {
        $curso = $this->cursoService->register("Curso9", "desc9");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);

        $dictadoFound = $this->dictadoService->findOne($dictado->getIdDictado());

        $this->assertEquals($curso, $dictadoFound->getCurso());
        $this->assertEquals($fechaInicio, $dictadoFound->getFechaInicio());
        $this->assertEquals($fechaFin, $dictadoFound->getFechaFin());
    }

    public function testCantFoundOne() {
        $curso = $this->cursoService->register("Curso10", "desc10");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);

        $dictadoFound = $this->dictadoService->findOne('cualquiercosa!');

        $this->assertNull($dictadoFound);
    }

    public function testICanDeactivateARequest() {
        $curso = $this->cursoService->register("Curso11", "desc11");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);
        
        $dictadoDeactivate = $this->dictadoService->deactive($dictado);

        $this->assertEquals($curso, $dictadoDeactivate->getCurso());
        $this->assertEquals($fechaInicio, $dictadoDeactivate->getFechaInicio());
        $this->assertEquals($fechaFin, $dictadoDeactivate->getFechaFin());
        $this->assertEquals(0, $dictadoDeactivate->getActivo());
    }

    public function testICantDeactivateARequest() {
        $curso = $this->cursoService->register("Curso12", "desc12");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        $dictado = new Dictado('cualquiera',$curso,$fechaInicio,$fechaFin,1);
        
        $dictadoDeactivate = $this->dictadoService->deactive($dictado);

        $this->assertNull($dictadoDeactivate);
    }

    public function testICanActivateARequest() {
        $curso = $this->cursoService->register("Curso13", "desc13");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        $dictado = $this->dictadoService->register($curso, $fechaInicio, $fechaFin);
        
        $dictadoDeactivate = $this->dictadoService->deactive($dictado);
        $dictadoDeactivateFound = $this->dictadoService->findOne($dictadoDeactivate->getIdDictado());

        $this->assertEquals(0, $dictadoDeactivateFound->getActivo());

        $dictadoActivate = $this->dictadoService->activate($dictadoDeactivateFound);

        $this->assertEquals($curso, $dictadoActivate->getCurso());
        $this->assertEquals($fechaInicio, $dictadoActivate->getFechaInicio());
        $this->assertEquals($fechaFin, $dictadoActivate->getFechaFin());
        $this->assertEquals(1, $dictadoActivate->getActivo());
    }

    public function testICantActivateARequest() {
        $curso = $this->cursoService->register("Curso14", "desc14");
        $fechaInicio = time();
        $fechaFin = time() + 10 * 24 * 3600;
        $dictado = new Dictado('cualquiera',$curso,$fechaInicio,$fechaFin,0);
        
        $dictadoDeactivate = $this->dictadoService->activate($dictado);

        $this->assertNull($dictadoDeactivate);
    }
}
