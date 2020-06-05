<?php 
    class Estado
    {
        // Atributos de la Clase
        private $idEstado;
        private $descripcion;

        // Atributos relacionados con BD
        private static $tabla;

        // Constructor
        private function __construct($idEstado, $descripcion)     
        {         
            $this->setIdEstado($idEstado);  
            $this->setDescripcion($descripcion); 
        }

        // Getters & Setters
        // idEstado
        public function setIdEstado($id)
        {
            $this->idEstado=$id;
        }
        public function getIdEstado()
        {
            return $this->idEstado;
        }
        // Descripcion
        public function setDescripcion($descripcion)
        {
            $this->descripcion=$descripcion;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }

        // Métodos relacionados con BD
        public static function findAll()
        {
            $return=array();
            $res = Conexion::findAll(self::$tabla);
            foreach($res as $r)
            {
                $estado = new Estado($r['idEstado'],$r['descripcion']);
                $return[]=$estado;
            }
            return $return;
        }
        
    }
?>