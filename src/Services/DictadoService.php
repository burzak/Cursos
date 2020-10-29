<?php

namespace Cursos\Services;

use \Cursos\DB\StorageInterface;
use \Cursos\Services\CursoService;

final class DictadoService {

    /**
     * @var StorageInterface
     */
    private $db;

    /**
     * @var CursoService
     */
    private $cursoService;

    private static $schema = 'dictados';

    public function __construct(StorageInterface $db, CursoService $cursoService) {
        $this->db = $db;
        $this->cursoService = $cursoService;
    }

    public function register($curso, $fechaInicio, $fechaFin) {
        $idDictado = microtime() . rand();
        $dictado = new \Cursos\Models\Dictado($idDictado, $curso, $fechaInicio, $fechaFin, 1);
        $this->db->save(self::$schema, $dictado->asArray());
        return $dictado;
    }

    /**
     * @return Dictado[]
     */
    public function findAll() {
        $data = $this->db->findAll(self::$schema);
        $out = array();
        foreach($data as $d) {
            $curso = $this->cursoService->findOne($d['idCurso']);
            $out[] = new \Cursos\Models\Dictado($d['idDictado'], $curso, $d['fechaInicio'], $d['fechaFin'], $d['activo']);
        }
        return $out;
    }

    public function update($idDictado, $curso, $fechaInicio, $fechaFin) {
        $nuevoDictado = new \Cursos\Models\Dictado($idDictado, $curso, $fechaInicio, $fechaFin, 1);
        $conditions = array(
            new \Cursos\DB\Condition('idDictado', '=', $nuevoDictado->getIdDictado())
        );
        if($this->db->updateOne(self::$schema, $conditions, $nuevoDictado->asArray())){
            return $nuevoDictado;
        }
        return null;
    }

    /**
     * @param string $idDictado
     * @return Dictado|null
     */
    public function findOne(string $idDictado) {
        $data = $this->db->findAll(self::$schema);
        foreach($data as $d) {
            if($d['idDictado'] == $idDictado){
                $curso = $this->cursoService->findOne($d['idCurso']);
                return new \Cursos\Models\Dictado($d['idDictado'], $curso, $d['fechaInicio'], $d['fechaFin'], $d['activo']);
            }
        }
        return null;
    }

    public function deactive(\Cursos\Models\Dictado $dictado) {
        $nuevoDictado = new \Cursos\Models\Dictado($dictado->getIdDictado(), 
                                                    $dictado->getCurso(),
                                                    $dictado->getFechaInicio(),
                                                    $dictado->getFechaFin(),
                                                    0);
        $conditions = array(
            new \Cursos\DB\Condition('idDictado', '=', $nuevoDictado->getIdDictado())
        );
        if($this->db->updateOne(self::$schema, $conditions, $nuevoDictado->asArray())){
            return $nuevoDictado;
        }
        return null;
    }

    public function activate(\Cursos\Models\Dictado $dictado) {
        $nuevoDictado = new \Cursos\Models\Dictado($dictado->getIdDictado(), 
                                                    $dictado->getCurso(),
                                                    $dictado->getFechaInicio(),
                                                    $dictado->getFechaFin(),
                                                    1);
        $conditions = array(
            new \Cursos\DB\Condition('idDictado', '=', $nuevoDictado->getIdDictado())
        );
        if($this->db->updateOne(self::$schema, $conditions, $nuevoDictado->asArray())){
            return $nuevoDictado;
        }
        return null;
    }
}