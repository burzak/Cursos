<?php

namespace Cursos\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomeController {
    
    /**
     * @var \Cursos\Templates\TemplateEngineInterface
     */
    private $templateEngine;

    // constructor receives container instance
    public function __construct(\Cursos\Templates\TemplateEngineInterface $templateEngine) {
        $this->templateEngine = $templateEngine;
    }
 
    public function index(ResponseInterface $response): ResponseInterface {
        return $this->templateEngine->render($response, 'index.html', array());
    }

}