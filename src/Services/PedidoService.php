<?php

namespace Cursos\Services;
use \Cursos\Models\Pedido;
use \Cursos\DB\StorageInterface;

class PedidoService {
    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'pedido';

    public function __construct(StorageInterface $db) {
        $this->db = $db;
    }

    public function register($email,$texto){
        $id = time().rand();
        $pedido = new Pedido($email,$texto,$id);

        $this->db->save(self::$schema, $pedido->asArray());
        return $pedido;
    }
    public function findOne($idPedido){
        $conditions = array(
            new \Cursos\DB\Condition('id', '=', $idPedido)
        );
        $d = $this->db->findOne(self::$schema, $conditions);
        
        $out = new \Cursos\Models\Pedido($d['email'],$d['curso_texto'],$d['id']);
            
        return $out;
    }
}