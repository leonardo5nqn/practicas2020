<?php 
    class Rol
    {
        // <----------- Atributos ---------->
        private $idRol;
        private $descripcion;

        // <----------- Getter Setter ----->
        public function getRol()
        {
            return $this->$idRol;
        }
        public function setRol($rol)
        {
            $this->$idRol = $rol;
        }
        public function getDescripcion()
        {
            return $this->$descripcion;
        }
        public function setDescripcion($descripcion)
        {
            $this->$descripcion = $descripcion;
        }

    }


?>