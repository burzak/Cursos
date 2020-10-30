<?php

namespace Tests\Controllers;

use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\RequestFactory;

final class CursosControllerTest extends \PHPUnit\Framework\TestCase {
    protected function setUp() : void {
        $container = \Cursos\ContainerFactory::create();
        $this->controller = $container->get("Cursos\Controllers\CursosController");
        $this->cursoService = $container->get("Cursos\Services\CursoService");
        $app = AppFactory::create();
        $fac = $app->getResponseFactory();
        $this->response = $fac->createResponse();
        $this->requestFactory =  new RequestFactory();
    }

    public function testCursosCanRenderTheHTML() {
        $curso1 = $this->cursoService->register("Curso1", "desc1");
        $curso2 = $this->cursoService->register("Curso2", "desc2");
        $curso3 = $this->cursoService->register("Curso3", "desc3");

        $responseResult = $this->controller->view($this->response);

        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Listado de cursos", $body);
        $this->assertStringContainsString($curso1->getIdCurso(), $body);
        $this->assertStringContainsString($curso1->getName(), $body);
        $this->assertStringContainsString($curso1->getDescription(), $body);
        $this->assertStringContainsString($curso2->getIdCurso(), $body);
        $this->assertStringContainsString($curso2->getName(), $body);
        $this->assertStringContainsString($curso2->getDescription(), $body);
        $this->assertStringContainsString($curso3->getIdCurso(), $body);
        $this->assertStringContainsString($curso3->getName(), $body);
        $this->assertStringContainsString($curso3->getDescription(), $body);
    }

    public function testCursosCanRenderTheForm() {
        $responseResult = $this->controller->form($this->response);

        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Formulario de curso", $body);
        $this->assertStringContainsString('name="idCurso"', $body);
        $this->assertStringContainsString('name="name"', $body);
        $this->assertStringContainsString('name="description"', $body);
        $this->assertStringContainsString('name="submit"', $body);
    }

    public function testCursosCanCreate() {
        $request = $this->requestFactory->createRequest('POST', '/')->withParsedBody([
            'name' => 'curso1',
            'description' => 'desc1',
        ]);

        $responseResult = $this->controller->formSubmit($this->response, $request);
        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Todo joya", $body);
        $this->assertStringContainsString('curso1', $body);
        $this->assertStringContainsString('desc1', $body);
    }
    

    public function testCursosCantCreate() {
        $request = $this->requestFactory->createRequest('POST', '/')->withParsedBody([]);

        $responseResult = $this->controller->formSubmit($this->response, $request);
        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Todo mal", $body);
    }

    public function testCursosCantCreateBeacauseRequestGET() {
        $request = $this->requestFactory->createRequest('GET', '/');

        $responseResult = $this->controller->formSubmit($this->response, $request);
        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Qué hace señor", $body);
    }

    public function testCursosCanViewEditForm() {
        $curso = $this->cursoService->register("Curso4", "desc4");

        $responseResult = $this->controller->edit($this->response, $curso->getIdCurso());
        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString('name="idCurso" value="' . $curso->getIdCurso() . '"', $body);
        $this->assertStringContainsString('name="name" value="' . $curso->getName() . '"', $body);
        $this->assertStringContainsString('name="description" value="' . $curso->getDescription() . '"', $body);
    }

    public function testCursosCantViewEditFormIdNotExist() {
        $idCurso = 'cualquiercosa!';

        $responseResult = $this->controller->edit($this->response, $idCurso);
        
        $this->assertEquals(302, $responseResult->getStatusCode());
    }

    public function testCursosCanEdit() {
        $curso = $this->cursoService->register("Curso5", "desc5");
        $request = $this->requestFactory->createRequest('POST', '/')->withParsedBody([
            'idCurso' => $curso->getIdCurso(),
            'name' => 'curso6',
            'description' => 'desc6',
        ]);

        $responseResult = $this->controller->formSubmit($this->response, $request);
        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Todo joya", $body);
        $this->assertStringContainsString("curso6", $body);
        $this->assertStringContainsString("desc6", $body);
    }

    public function testCursosCantEdit() {
        $request = $this->requestFactory->createRequest('POST', '/')->withParsedBody([
            'idCurso' => 'cualquiercosa!',
            'name' => 'curso7',
            'description' => 'desc7',
        ]);

        $responseResult = $this->controller->formSubmit($this->response, $request);
        $body = (string) $responseResult->getBody();
        
        $this->assertStringContainsString("Todo mal", $body);
    }
}