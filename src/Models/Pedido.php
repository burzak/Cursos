<?php

namespace Cursos\Models;

final class Pedido {

    private $email;
    private $texto;
    private $id;

    public function __construct($email, $texto, $id) {
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

    public function asArray() {
        return array(
            'email' => $this->email,
            'texto' => $this->texto,
            'id' => $this->id,
            'activo' => 1
        );
    }

}