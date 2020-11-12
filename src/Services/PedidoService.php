<?php

namespace Cursos\Services;

use Cursos\Models\Pedido;
use Cursos\Db\StorageInterface;

class PedidoService
{

    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'pedidos';

    public function __construct(StorageInterface $db)
    {
        $this->db = $db;
    }

    public function register($email, $texto)
    {

        $id = time() . rand();
        $pedido = new \Cursos\Models\Pedido($id, $email, $texto, 1);
        $this->db->save(self::$schema, $pedido->asArray());

        return new Pedido($id, $email, $texto, 1);
    }

    public function findAll()
    {
        $conditions = array(
            new \Cursos\DB\Condition('status', '=', 1)
        );

        $data = $this->db->find(self::$schema,$conditions);
        $out = [];
        foreach ($data as $d) {
            $out[] = new Pedido($d["idPedido"], $d["email"], $d["texto"], $d["status"]);
        }
        return $out;
    }

    public function delete(Pedido $pedido)
    {

        $conditions = array(
            new \Cursos\DB\Condition('idPedido', '=', $pedido->getIdPedido())
        );
        $pArray = $pedido->asArray();
        $pArray['status']= 0;
        return $this->db->updateOne(self::$schema, $conditions, $pArray);
    }
}
