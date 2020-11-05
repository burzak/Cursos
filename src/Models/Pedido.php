<?php

namespace Cursos\Models;

final class Pedido {

    private $email;
    private $texto;
    private $id;
    private $active;

    public function __construct($email, $texto, $id, $active) {
        $this->active = $active;
        $this->email = $email;
        $this->texto = $texto;
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    } 

    public function getTexto() {
        return $this->texto;
    } 

    public function getId() {
        return $this->id;
    } 

    public function getActive()
    {
        return $this->active;
    }

    public function asArray() {
        return array(
            'email' => $this->email,
            'texto' => $this->texto,
            'id' => $this->id,
            'active' => $this->active
        );
    }

}