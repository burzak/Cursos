<?php

namespace Cursos\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Cursos\Models\Curso;

final class CursosController {

    /**
     * @var \Cursos\Templates\TemplateEngineInterface
     */
    private $templateEngine;
    private $cursosService;

    // constructor receives container instance
    public function __construct(\Cursos\Templates\TemplateEngineInterface $templateEngine, \Cursos\Services\CursosService $cursosService) {
        $this->cursosService = $cursosService;
        $this->templateEngine = $templateEngine;
    }
 
    public function index(ResponseInterface $response): ResponseInterface {
        return $this->templateEngine->render($response, 'index.html', array());
    }

    public function view(ResponseInterface $response): ResponseInterface {
        $cursos = $this->cursosService->findAll();
        return $this->templateEngine->render($response, 'view.html', array("cursos"=>$cursos));
    }

    public function form(ResponseInterface $response): ResponseInterface {
        return $this->templateEngine->render($response, 'form.html', array());
    }
    
    public function edit(ResponseInterface $response, RequestInterface $request, string $idCurso): ResponseInterface {
        $curso = $this->cursosService->findOne($idCurso);
        return $this->templateEngine->render($response, 'edit.html', array("curso"=>$curso->asArray()));
    }
    public function editSubmit(ResponseInterface $response, RequestInterface $request): ResponseInterface {
        $curso = $request->getParsedBody();
        $this->cursosService->update(new Curso($curso["nombre"],$curso["descripcion"],$curso["duracion"],$curso["idCurso"]));
        return $this->templateEngine->render($response, 'editSubmit.html', array());
    }
    public function formSubmit(ResponseInterface $response, RequestInterface $request): ResponseInterface {
        $curso = $request->getParsedBody();
        $this->cursosService->register($curso["nombre"],$curso["descripcion"],$curso["duracion"]);
        return $this->templateEngine->render($response, 'formSubmit.html', array());
    }

}