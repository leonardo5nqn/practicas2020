<?php 
    include_once('../Connection/connection.php');
    class Pedido
    {
        // Atributos de la Clase
        private $idSolicitud;
        private $descripcion;
        private $usuario;
        private $estado;
        private $validacion;

        // Atributos relacionados con BD
        private static $tabla='solicitud';

        // Constructor
        public function __construct($descripcion,$usuario,$estado,$validacion)     
        {         
            $this->setDescripcion($descripcion); 
            $this->setUsuario($usuario);
            $this->setEstado($estado);
            $this->setValidacion($validacion);
        }

        // Getters & Setters
        public function setIdSolicitud($id)
        {
            $this->idSolicitud=$id;
        }
        public function getIdSolicitud()
        {
            return $this->idSolicitud;
        }
        public function setDescripcion($descripcion)
        {
            $this->descripcion=$descripcion;
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
        public function setEstado($estado)
        {
            $this->estado=$estado;
        }
        public function getEstado()
        {
            return $this->estado;
        }
        public function setValidacion($validacion)
        {
            $this->validacion=$validacion;
        }
        public function getValidacion()
        {
            return $this->validacion;
        }

        // Métodos relacionados con BD
        public static function findAll()
        {
            $return=array();
            $res = Conexion::findAll(self::$tabla);
            foreach($res as $r)
            {
                $pedido = new Pedido($r['idSolicitud'],$r['descripcion'],$r['usuario'],$r['estado'],$r['validacion']);
                $return[]=$pedido;
            }
            return $return;
        }
        public function create()
        {
            $data = $this->modelToArray();
            $res = Conexion::insert(self::$tabla, $data);
            if($res!=false) return True;
            else return False;
        }

        public function modelToArray()
        {
            $data = [];
            $data['idSolicitud'] = $this->getIdSolicitud();
            $data['descripcion'] = $this->getDescripcion();
            $data['usuario'] = $this->getUsuario();
            $data['estado'] = $this->getEstado();
            $data['validacion'] = $this->getValidacion();
            return $data;
        }
        
    }
?>