<?php

namespace Cursos\Models;

class Pedido {

    private $idPedido;
    private $email;
    private $texto;
    private $status;

    public function __construct($idPedido,$email, $texto, $status) {

        $this->idPedido = $idPedido;
        $this->email = $email;
        $this->texto = $texto;
        $this->status = $status;
    }

    public function getIdPedido(){
        return $this->idPedido;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getTexto(){
        return $this->texto;
    }
    
    public function getStatus(){
        return $this->status;
    }

    public function asArray() {

        return array(
            'idPedido' => $this->idPedido,
            'email' => $this->email,
            'texto' => $this->texto,
            'status' => $this->status
        );
        
    }

}