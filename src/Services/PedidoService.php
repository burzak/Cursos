<?php

namespace Cursos\Services;

use \Cursos\DB\StorageInterface;
use Cursos\Models\Pedido;

final class PedidoService {

    /**
     * @var StorageInterface
     */
    private $db;

    private static $schema = 'pedidos';

    public function __construct(StorageInterface $db){
        $this->db = $db;
    }

    public function registrar ($email, $texto){
        $idPedido = time().\rand();
        $status="1";
        $nuevoRegistro= new Pedido($idPedido, $email, $texto, $status);
        
        if($this->db->save(self::$schema, $nuevoRegistro->asArray())){
            return $nuevoRegistro;
        }
        return null;
        

    }

    public function findAll(){
        $conditions = array(
            new \Cursos\DB\Condition('status', '=', "1")
        );
        $data = $this->db->find(self::$schema,$conditions);
        $out = array();
        foreach($data as $d) {

                $out[] = new \Cursos\Models\Pedido($d['idPedido'],$d['email'], $d['texto'], $d['status']);
            }

        
        
        return $out;


    }

    public function borrar(Pedido $pedido){
        $conditions = array(
            new \Cursos\DB\Condition('idPedido', '=', $pedido->getId())
        );

        $data= $pedido->asArray();
        $data['status']='0';
        return $this->db->updateOne(self::$schema,$conditions,$data);    

    }

}

