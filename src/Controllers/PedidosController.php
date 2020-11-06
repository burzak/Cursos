<?php

namespace Cursos\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Cursos\Models\Pedido;

final class PedidosController {

    /**
     * @var \Cursos\Templates\TemplateEngineInterface
     */
    private $templateEngine;
    private $pedidosService;

    // constructor receives container instance
    public function __construct(\Cursos\Templates\TemplateEngineInterface $templateEngine, \Cursos\Services\PedidosService $pedidosService) {
        $this->pedidosService = $pedidosService;
        $this->templateEngine = $templateEngine;
    }
 
    public function index(ResponseInterface $response): ResponseInterface {
        return $this->templateEngine->render($response, 'index.html', array());
    }

    public function view(ResponseInterface $response): ResponseInterface {
        $pedidos = $this->pedidosService->findAll();
        return $this->templateEngine->render($response, 'viewPedido.html', array("pedidos"=>$pedidos));
    }

    public function form(ResponseInterface $response): ResponseInterface {
        return $this->templateEngine->render($response, 'formPedido.html', array());
    }
    
    public function formSubmit(ResponseInterface $response, RequestInterface $request): ResponseInterface {
        $pedido = $request->getParsedBody();
        $this->pedidosService->register($pedido["email"],$pedido["texto"],$pedido["activo"]);
        return $this->templateEngine->render($response, 'formSubmitPedido.html', array());
    }

}