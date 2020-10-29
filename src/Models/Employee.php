<?php

namespace Cursos\Models;

final class Employee implements \Cursos\DB\SerializeInterface {
    
    
    /**
     * @var string
     */
    private $email;
    
    /**
     * @var string
     */
    private $nombre;
    
    /**
     * @var string
     */
    private $apellido;
    
    /**
     * @var string
     */
    private $puesto;
    
    /**
     * @var string
     */
    private $programa;
    
    /**
     * @var integer
     */
    private $activo;

    public function __construct(string $email, string $nombre, string $apellido, string $puesto, string $programa, int $activo) {

        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->puesto = $puesto;
        $this->programa = $programa;
        $this->activo = $activo;
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
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getApellido() {
        return $this->apellido;
    }

    /**
     * @return string
     */
    public function getPuesto() {
        return $this->puesto;
    }

    /**
     * @return string
     */
    public function getPrograma() {
        return $this->programa;
    }

     /**
     * @return string
     */
    public function getActivo() {
        return $this->activo;
    }
    
    public function asArray() {
        return array(
            'email' => $this->email,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'puesto' => $this->puesto,
            'programa' => $this->programa,
            'activo' => $this->activo,
        );
    }

}