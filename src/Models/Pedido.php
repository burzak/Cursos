<?php

namespace Cursos\Models;

class Pedido{
    private $email;
    private $texto;
    private $id;
    public function __construct(String $email,String $texto,String $id)
    {
        $this->email = $email;
        $this->texto = $texto;
        $this->id = $id;
    }


    public function getEmail(){
        return $this->email;
    }
    public function getTexto(){
        return $this->texto;
    }
    public function getId(){
        return $this->id;
    }
    public function asArray() {
        return array(
            'email' => $this->getEmail(),
            'curso_texto' => $this->getTexto(),
            'id' => $this->getId(),
        );
    }
}