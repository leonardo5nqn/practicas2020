<?php
include_once('../Connection/connection.php');
class Pedido
{
    // Atributos de la Clase
    private $idSolicitud;
    private $descripcion;
    private $usuario;
    private $fechaPedido;

    // Atributos relacionados con BD
    private static $tabla = 'solicitud';

    // Constructor
    public function __construct($idSolicitud, $descripcion, $usuario, $fechaPedido)
    {
        $this->setIdSolicitud($idSolicitud);
        $this->setDescripcion($descripcion);
        $this->setUsuario($usuario);
        $this->setFechaPedido($fechaPedido);
    }

    // Getters & Setters
    public function setIdSolicitud($id)
    {
        $this->idSolicitud = $id;
    }
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function setFechaPedido($fechaPedido)
    {
        $this->fechaPedido = $fechaPedido;
    }
    public function getFechaPedido()
    {
        return $this->fechaPedido;
    }

    // Métodos relacionados con BD
    public static function findAll()
    {
        $return = [];
        $res = Conexion::findAll(self::$tabla);
        if ($res != false) {
            foreach ($res as $r) {
                $pedido = new Pedido($r['id'], $r['descripcion'], $r['usuario'], $r['fechaPedido']);
                $data = $pedido->modelToArray();
                $return[] = $data;
            }
            return $return;
        } else return false;
    }

    public static function findOne($search)
    {
        $res = Conexion::findOne(self::$tabla, $search);
        if ($res != 0) return $res;
        else return False;
    }

    public function update($id, $data)
    {
        $res = Conexion::findOne(self::$tabla, `Search = ${$id}`);
        if ($res != false) {
            $inputData = [];
            echo $data;
            $resData = Conexion::update(self::$tabla, $inputData, $id);
        }
    }

    public static function delete($id)
    {
        $res = Conexion::delete(self::$tabla, $id);
        echo $res;
        return ($res === true ? true : false);
    }

    public function create()
    {
        $data = $this->modelToArray();
        $res = Conexion::insert(self::$tabla, $data);
        if ($res != false) return True;
        else return False;
    }

    public function modelToArray()
    {
        $data = [];
        $data['id'] = $this->getIdSolicitud();
        $data['descripcion'] = $this->getDescripcion();
        $data['usuario'] = $this->getUsuario();
        $data['fechaPedido'] = $this->getFechaPedido();
        return $data;
    }
}
