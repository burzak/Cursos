<?php

namespace Cursos\Models;

final class Curso implements \Cursos\DB\SerializeInterface {
    /**
     * @var string
     */
    private $idCurso;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    public function __construct(string $idCurso, string $name, string $description) {
        $this->idCurso = $idCurso;
        $this->name = $name;
        $this->description = $description;
    }

    public function getIdCurso() {
        return $this->idCurso;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    public function asArray() {
        return array(
            'idCurso' => $this->idCurso,
            'name' => $this->name,
            'description' => $this->description,
        );
    }
}