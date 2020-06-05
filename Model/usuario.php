<?php 
    class Usuario
    {
        // Atributos
        private $nombreDeUsuario;
        private $contrasenia;
        private $rol;
        private $mail;

        // Atributos relacionados con DB
        private static $tabla='usuario';

        // Constructor
        private function __construct($nombreDeUsuario, $contrasenia,$rol,$mail)     
        {         
            $this->setIdRol($idRol);  
            $this->setDescripcion($descripcion); 
        }

        // Getters & Setters
        // nombre de usuario
        public function getNombreDeUsuario()
        {
            return $this->nombreDeUsuario;
        }
        public function setNombreDeUsuario($nombreDeUsuario)
        {
            $this->nombreDeUsuario = $nombreDeUsuario;
        }
        // contraseña de usuario
        public function getContrasenia()
        {
            return $this->contrasenia;
        }
        public function setCotnrasenia($contrasenia)
        {
            $this->contrasenia = $contrasenia;
        }
        // rol de usuario
        public function getIdRol()
        {
            return $this->idRol;
        }
        public function setIdRol($idRol)
        {
            $this->idRol = $idRol;
        }
        // mail de usuario
        public function getMail()
        {
            return $this->mail;
        }
        public function setMail($mail)
        {
            $this->mail=$mail;
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
    }
?>