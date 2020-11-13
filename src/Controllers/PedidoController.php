<?php

namespace Cursos\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Cursos\Models\Pedido;

class PedidoController{

    /**
     * @var \Cursos\Templates\TemplateEngineInterface
     */
    private $templateEngine;

    // constructor receives container instance
    public function __construct(\Cursos\Templates\TemplateEngineInterface $templateEngine, \Cursos\Services\PedidoService $pedidoService) {
        $this->templateEngine = $templateEngine;
        $this->pedidoService = $pedidoService;
    }

    public function index( ResponseInterface $response) : ResponseInterface {
        $listadoPedidos = $this->pedidoService->findAll();
        return $this->templateEngine->render($response,'pedidos.html',array('pedidos'=>$listadoPedidos));
    }

    public function form(ResponseInterface $response){
        return $this->templateEngine->render($response,'pedidosForm.html',array());
    }

    public function formSubmit(ResponseInterface $response, RequestInterface $request){
        $data = $request->getParsedBody();
        $this->pedidoService->registrar($data['email'],$data['texto']);
        return $this->templateEngine->render($response, 'pedidoSubmit.html',array());
    }
}