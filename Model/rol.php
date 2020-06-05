<?php 
    class Rol
    {
        // Atributos
        private $idRol;
        private $descripcion;

        // Atributos relacionados con DB
        private static $tabla;

        // Constructor
        private function __construct($idRol, $descripcion)     
        {         
            $this->setIdRol($idRol);  
            $this->setDescripcion($descripcion); 
        }

        // Getters & Setters
        public function getIdRol()
        {
            return $this->idRol;
        }
        public function setIdRol($idRol)
        {
            $this->idRol = $idRol;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        // Métodos CRUD
        // Busca Todos
        public static function findAll()
        {
            $return=array();
            $res=Conexion::findAll(self::$tabla);
            foreach($res as $r)
            {
                $rol = new Rol($r['idRol'],$r['descripcion']);
                $return[]=$rol;
            }
            return $return;
        }
        // Crear uno
        public static function insert($descripcion)
        {
            
        }
    }
?>