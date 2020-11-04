<?php

namespace Cursos\Services;

use \Cursos\DB\StorageInterface;
use \Cursos\Models\Pedido;

final class PedidosService {

    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'pedidos';

    public function __construct(StorageInterface $db) {
        $this->db = $db;
    }

    public function register($email,$texto) {
        $id = time() . \rand();
        $pedido = new Pedido($email,$texto,$id);
        $this->db->save(self::$schema,$pedido->asArray());
        return $pedido;
    }

    public function findOne($id) {
        $conditions = array(
            new \Cursos\DB\Condition('id', '=', $id)
        );
        $d = $this->db->findOne(self::$schema, $conditions);        
            
        $out = new \Cursos\Models\Pedido($d['email'], $d['texto'], $d['id']);
    
        return $out;
    }

    public function findAll() {
        $data = $this->db->findAll(self::$schema);
        $out = array();
        foreach($data as $d) {
            if ($d['activo'] == 1) {
                $out[] = new \Cursos\Models\Pedido($d['email'], $d['texto'], $d['id']);
            }
        }
        return $out;
    }


}