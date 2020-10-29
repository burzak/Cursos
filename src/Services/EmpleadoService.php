<?php

namespace Cursos\Services;

use \Cursos\DB\StorageInterface;

final class EmpleadoService {

    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'employees';

    public function __construct(StorageInterface $db) {
        $this->db = $db;
    }

    public function register( $email,  $nombre,  $apellido,  $puesto,  $programa,  $activo) {

        $empleado = new \Cursos\Models\Employee($email,  $nombre,  $apellido,  $puesto,  $programa,  $activo);
        $this->db->save(self::$schema, $empleado->asArray());
        return $empleado;
    }

     /**
     * @return Empleado[]
     */
    public function findAll() {
        $data = $this->db->findAll(self::$schema);
        $out = array();
        foreach($data as $d) {
            if ($d['activo'] == 1) {
                $out[] = new \Cursos\Models\Employee($d['email'], $d['nombre'], $d['apellido'], $d['puesto'], $d['programa'], $d['activo']);
            }
        }
        return $out;
    }

    /**
     * @return Empleado
     */
    public function update($email,$nombre,$apellido,$puesto,$programa,$activo) {
        $nuevoEmpleado = new \Cursos\Models\Employee($email,
        $nombre,
        $apellido,
        $puesto,
        $programa,
        $activo
        );

        $conditions = array(
        new \Cursos\DB\Condition('email', '=', $email)
        );
        if($this->db->updateOne(self::$schema, $conditions, $nuevoEmpleado->asArray())){
            return $nuevoEmpleado;
        }
        return null;
   
    }

      /**
     * @return Empleado
     */
    public function delete(\Cursos\Models\Employee $empleado) {
        $nuevoempleado = new \Cursos\Models\Employee($empleado->getEmail(),
                                                 $empleado->getNombre(),
                                                 $empleado->getApellido(),
                                                 $empleado->getPuesto(),
                                                 $empleado->getPrograma(),
                                                 0);
        $conditions = array(
            new \Cursos\DB\Condition('email', '=', $empleado->getEmail())
        );
        return $this->db->updateOne(self::$schema, $conditions, $nuevoempleado->asArray());
    }

    /**
     * @return Empleado
     */
    public function findOne($email) {
        $conditions = array(
            new \Cursos\DB\Condition('email', '=', $email)
        );
        $d = $this->db->findOne(self::$schema, $conditions);
        $out = null;
        
            
                $out = new \Cursos\Models\Employee($d['email'], $d['nombre'], $d['apellido'], $d['puesto'], $d['programa'], $d['activo']);
            
    
        return $out;
    }

}