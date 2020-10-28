<?php

namespace Cursos\Services;

use \Cursos\DB\StorageInterface;

final class CursoService {

    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'cursos';

    public function __construct(StorageInterface $db) {
        $this->db = $db;
    }

    public function register($name, $description) {
        $idCurso = microtime() . rand();
        $curso = new \Cursos\Models\Curso($idCurso, $name, $description);
        $this->db->save(self::$schema, $curso->asArray());
        return $curso;
    }

    /**
     * @return Curso[]
     */
    public function findAll() {
        $data = $this->db->findAll(self::$schema);
        $out = array();
        foreach($data as $d) {
            $out[] = new \Cursos\Models\Curso($d['idCurso'], $d['name'], $d['description']);
        }
        return $out;
    }

    public function update($idCurso, $name, $description) {
        $nuevoCurso = new \Cursos\Models\Curso($idCurso, $name, $description);
        $conditions = array(
            new \Cursos\DB\Condition('idCurso', '=', $nuevoCurso->getIdCurso())
        );
        if($this->db->updateOne(self::$schema, $conditions, $nuevoCurso->asArray())){
            return $nuevoCurso;
        }
        return null;
    }

    /**
     * @param string $idCurso
     * @return Curso|null
     */
    public function findOne(string $idCurso) {
        $data = $this->db->findAll(self::$schema);
        foreach($data as $d) {
            if($d['idCurso'] == $idCurso){
                return new \Cursos\Models\Curso($d['idCurso'], $d['name'], $d['description']);
            }
        }
        return null;
    }
}