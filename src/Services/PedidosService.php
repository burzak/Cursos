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
        $pedido = new Pedido($email,$texto,$id,1);
        $this->db->save(self::$schema,$pedido->asArray());
        return $pedido;
    }

    public function findOne($id) {
        $conditions = array(
            new \Cursos\DB\Condition('id', '=', $id)
        );
        $d = $this->db->findOne(self::$schema, $conditions);        
            
        $out = new \Cursos\Models\Pedido($d['email'], $d['texto'], $d['id'],$d['active']);
    
        return $out;
    }

    public function findAll() {
        $data = $this->db->findAll(self::$schema);
        $out = array();
        foreach($data as $d) {
            if ($d['active'] == 1) {
                $out[] = new \Cursos\Models\Pedido($d['email'], $d['texto'], $d['id'],$d['active']);
            }
        }
        return $out;
    }

    public function hide(Pedido $pedido)
    {
        
        $newPedido = new Pedido($pedido->getEmail(), $pedido->getTexto(),$pedido->getId(),0);
        
        $conditions = array(
            new \Cursos\DB\Condition('id', '=', $newPedido->getId())
        );

        if($this->db->updateOne(self::$schema, $conditions, $newPedido->asArray())){
            return $newPedido;
        }

        return null;
    }
}