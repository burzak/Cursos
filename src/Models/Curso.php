<?php

namespace Cursos\Models;

final class Curso
{
    private $nombre;
    private $desc;
    private $duracion;
    private $idCurso;

    public function __construct($nombre, $desc, $duracion, $idCurso)
    {
        $this->nombre = $nombre;
        $this->idCurso = $idCurso;
        $this->desc = $desc;
        $this->duracion = $duracion;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->desc;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    public function getId()
    {
        return $this->idCurso;
    }

    public function asArray() {

        return array(
            'nombre' => $this->nombre,
            'descripcion' => $this->desc,
            'duracion' => $this->duracion,
            'idCurso' => $this->idCurso
        );
        
    }
}