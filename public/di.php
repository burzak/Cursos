<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

/** CLASSES */

interface Saludador {
    public function saludar();
}

class BuenaOnda implements Saludador {
    public function saludar() {
        return "Hola chabon, tanto tiempo!\n";
    }
}

class MalaOnda implements Saludador {
    public function saludar() {
        return "Ehhhh, que pasa?\n";
    }
}

class MasoOMenosBuenaOnda implements Saludador {
    public function saludar() {
        return "Ah, hola, como anda?\n";
    }
}

class Bipolar implements Saludador {

    public function __construct(BuenaOnda $bo, MalaOnda $mo) {
        $this->bo = $bo;
        $this->mo = $mo;
    }

    public function saludar() {
        $r = rand(1,10);
        if ($r>5) {
            return $this->bo->saludar();
        }
        return $this->mo->saludar();
    }
}

class Negocio {
    private $recepcionista;
    public function __construct(Saludador $recepcionista) {
        $this->recepcionista = $recepcionista;
    }

    public function abrirPuerta() {
        $saludo = $this->recepcionista->saludar();
        $saludo .= "Pase y vea tranquil@\n";
        return $saludo;
    }
}


/***********/


$containerBuilder = new \DI\ContainerBuilder();
$container = $containerBuilder->build();
$container->set("Saludador", \DI\autowire("Bipolar"));



/** Codigo */
$negocio = $container->get("Negocio");
echo $negocio->abrirPuerta();