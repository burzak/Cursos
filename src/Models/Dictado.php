<?php

namespace Cursos\Models;

final class Dictado implements \Cursos\DB\SerializeInterface {
    /**
     * @var string
     */
    private $idDictado;

    /**
     * @var Curso
     */
    private $curso;

    /**
     * @var integer
     */
    private $fechaInicio;

    /**
     * @var integer
     */
    private $fechaFin;

    /**
     * @var integer
     */
    private $activo;


    public function __construct(string $idDictado, Curso $curso, int $fechaInicio, int $fechaFin, int $activo) {
        $this->idDictado = $idDictado;
        $this->curso = $curso;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->activo = $activo;
    }

    public function getIdDictado() {
        return $this->idDictado;
    }

    /**
     * @return Curso
     */
    public function getCurso() {
        return $this->curso;
    }

    /**
     * @return integer
     */
    public function getFechaInicio() {
        return $this->fechaInicio;
    }
    
    /**
     * @return integer
     */
    public function getFechaFin() {
        return $this->fechaFin;
    }

    /**
     * @return integer
     */
    public function getActivo() {
        return $this->activo;
    }

    public function asArray() {
        return array(
            'idDictado' => $this->idDictado,
            'idCurso' => $this->curso->getIdCurso(),
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
            'activo' => $this->activo,
        );
    }
}