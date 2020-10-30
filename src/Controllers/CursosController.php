<?php

namespace Cursos\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CursosController {
    
    /**
     * @var \Cursos\Templates\TemplateEngineInterface
     */
    private $templateEngine;

    // constructor receives container instance
    public function __construct(\Cursos\Templates\TemplateEngineInterface $templateEngine, \Cursos\Services\CursoService $cursoService) {
        $this->templateEngine = $templateEngine;
        $this->cursoService = $cursoService;
    }
 
    public function view(ResponseInterface $response): ResponseInterface {
        return $this->templateEngine->render($response, 'cursos/view.html', array(
            'cursos' => $this->cursoService->findAll(),
        ));
    }

    public function form(ResponseInterface $response): ResponseInterface {
        return $this->templateEngine->render($response, 'cursos/form.html', array());
    }

    public function formSubmit(ResponseInterface $response, ServerRequestInterface $request): ResponseInterface {
        $curso = false;
        if($request->getMethod() == 'POST'){
            $parsedBody = $request->getParsedBody();
            if(!empty($parsedBody['name']) && !empty($parsedBody['description'])){
                if(empty($parsedBody['idCurso'])){
                    $curso = $this->cursoService->register($parsedBody['name'], $parsedBody['description']);
                    $curso = $this->cursoService->findOne($curso->getIdCurso());
                }else{
                    $curso = $this->cursoService->update($parsedBody['idCurso'], $parsedBody['name'], $parsedBody['description']);
                }
            }else{
                $curso = null;
            }
        }
        return $this->templateEngine->render($response, 'cursos/form-submit.html', array(
            'curso' => $curso,
        ));
    }

    public function edit(ResponseInterface $response, $idCurso): ResponseInterface {
        $curso = $this->cursoService->findOne($idCurso);
        if(!$curso){
            return $response
                ->withHeader('Location', '/cursos/')
                ->withStatus(302);
        }

        return $this->templateEngine->render($response, 'cursos/form.html', array(
            'curso' => $curso,
        ));
    }

}