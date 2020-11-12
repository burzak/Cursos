<?php

namespace Cursos\Models;


class Pedido {

     /**
     * @var string
     */
    private $email;

        /**
     * @var string
     */
    private $texto;

           /**
     * @var string
     */
    private $idPedido;

           /**
     * @var string
     */
    private $status;


    public function __construct( string $idPedido, string $email,string $texto, string $status)
    {
        $this->idPedido=$idPedido;
        $this->email=$email;
        $this->texto=$texto;
        $this->status=$status;

    }
    public function getId(){
        return $this->idPedido;
    }
    public function getEmail(){
        return $this->email;
    }

    public function getTexto(){
        return $this->texto;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
   

    public function asArray(){
        return array(
            'idPedido' => $this->idPedido,
            'email'=> $this->email,
            'texto'=> $this->texto,
            'status'=> $this->status,
        );
    }
}
