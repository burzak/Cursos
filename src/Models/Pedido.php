<?php

namespace Cursos\Models;

final class Pedido implements \Cursos\DB\SerializeInterface {
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $active;
    
    /**
     * @var string 
     */
    private $id;

    public function __construct(string $id, string $email, string $description, $active=1) {
        $this->id = $id;
        $this->email = $email;
        $this->description = $description;
        $this->active = $active;
    }

    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    public function getActive() {
        return $this->active;
    }

    public function asArray() {
        return array(
            'id' => $this->id,
            'email' => $this->email,
            'description' => $this->description,
            'active' => $this->active,
        );
    }
}