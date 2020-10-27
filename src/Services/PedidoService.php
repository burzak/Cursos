<?php

namespace Cursos\Services;

use \Cursos\DB\StorageInterface;

final class PedidoService {

    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'pedidos';

    public function __construct(StorageInterface $db) {
        $this->db = $db;
    }

    public function register($email, $description) {
        $id = microtime() . rand();
        $pedido = new \Cursos\Models\Pedido($id, $email, $description);
        $this->db->save(self::$schema, $pedido->asArray());
        return $pedido;
    }

    /**
     * @return Pedido[]
     */
    public function findAll() {
        $data = $this->db->findAll(self::$schema);
        $out = array();
        foreach($data as $d) {
            if ($d['active'] == 1) {
                $out[] = new \Cursos\Models\Pedido($d['id'], $d['email'], $d['description']);
            }
        }
        return $out;
    }

    public function hide(\Cursos\Models\Pedido $pedido) {
        $nuevoPedido = new \Cursos\Models\Pedido($pedido->getId(),
                                                 $pedido->getEmail(),
                                                 $pedido->getDescription(),
                                                 0);
        $conditions = array(
            new \Cursos\DB\Condition('id', '=', $pedido->getId())
        );
        return $this->db->updateOne(self::$schema, $conditions, $nuevoPedido->asArray());
    }
}