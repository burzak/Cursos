<?php

namespace Cursos\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PedidosController
{

    /**
     * @var \Cursos\Templates\TemplateEngineInterface
     */
    private $templateEngine;

    /**
     * @var \Cursos\Services\PedidoService
     */
    private $pedidoService;

    // constructor receives container instance
    public function __construct(\Cursos\Templates\TemplateEngineInterface $templateEngine,
        \Cursos\Services\PedidoService $pedidoService
    ) {
        $this->templateEngine = $templateEngine;
        $this->pedidoService = $pedidoService;
    }

    public function index(ResponseInterface $response): ResponseInterface
    {
        return $this->templateEngine->render($response, 'pedido/index.html', array());
    }

    function list(ResponseInterface $response): ResponseInterface {
        $items = $this->pedidoService->findAll();
        return $this->templateEngine->render($response, 'pedido/list.html', ['items' => $items]);
    }

    public function register(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $item = $this->pedidoService->register($request->email, $request->description);
        return $this->templateEngine->render($response, 'pedido/list.html', ['item' => $item]);
    }

    public function formSubmit(ResponseInterface $response, ServerRequestInterface $request): ResponseInterface
    {
        $pedido = false;
        if ($request->getMethod() == 'POST') {
            $parsedBody = $request->getParsedBody();
            if (!empty($parsedBody['email']) && !empty($parsedBody['description'])) {
                if (empty($parsedBody['id'])) {
                    $pedido = $this->pedidoService->register($parsedBody['email'], $parsedBody['description']);
                    
                } else {
                    
                    $pedido = new \Cursos\Models\Pedido($parsedBody['id'],
                    $parsedBody['email'], 
                    $parsedBody['description'],0);
                    $resultado = $this->pedidoService->hide($pedido);
                    if(!$resultado){
                        $pedido = false;
                    } 
                    
                }
            } else {
                $pedido = null;
            }
        }
        
        return $this->templateEngine->render($response, 'pedido/form-submit.html', array('pedido' => $pedido));}

}
