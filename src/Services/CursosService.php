<?php

namespace Cursos\Services;

use Cursos\Models\Curso;
use \Cursos\DB\StorageInterface;

final class CursosService
{
    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'cursos';

    public function __construct(StorageInterface $db) {
        $this->db = $db;
    }

    public function register(string $nombre, string $desc, string $duracion)
    {   
        $idCurso = time().\rand();

        $curso = new Curso($nombre, $desc, $duracion, $idCurso);

        $this->db->save(self::$schema,$curso->asArray());

        return $curso;  
    }

    public function findOne(string $idCurso)
    {
        $conditions = array(
            new \Cursos\DB\Condition('idCurso', '=', $idCurso)
        );
        $d = $this->db->findOne(self::$schema, $conditions);        
        
        if($d)
        {
           return new Curso($d['nombre'], $d['descripcion'], $d['duracion'],$d['idCurso']);
        }
        return null;
    }

    public function update(Curso $curso)
    {
        $conditions = array(
            new \Cursos\DB\Condition('idCurso', '=', $curso->getId())
        );

        if($this->db->updateOne(self::$schema, $conditions, $curso->asArray())){
            return $curso;
        }

        return null;
    }

    public function findAll():array
    {
        $data = $this->db->findAll(self::$schema);

        $out = array();

        foreach($data as $d) {
            $out[] = new Curso($d['nombre'], $d['descripcion'], $d['duracion'], $d['idCurso']);
        }
        
        return $out;
    }
}