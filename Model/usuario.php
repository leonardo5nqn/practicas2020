<?php 
    include_once('../Connection/connection.php');
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
            $this->setNombreDeUsuario($nombreDeUsuario);
            $this->setCotnrasenia($contrasenia);
            $this->setIdRol($rol);  
            $this->setMail($mail);
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
        // Buscar uno
        public static function findOne($search)
        {
            $res = Conexion::findOne(self::$tabla, $search);
            if($res) return $res;
            else return 0;
        }

        public static function create($username,$password,$rol,$mail)
        {

        }

        // Métodos Relacionados
        public static function login($username,$password)
        {
            $password=md5($password);
            $busqueda = "nombreDeUsuario = '{$username}' && contrasenia = '{$password}'";
            $user=Usuario::findOne($busqueda);
            if($user!=0) return True;
            else return False;
        }

        public static function register($username, $password, $mail)
        {
            $usuario = new Usuario($username,$password,'',$mail);
            $isUser = Usuario::findOne("nombreDeUsuario = '{$username}'");
            if($isUser!=0) {
                return True;
                Usuario::create();
            }
            else return False;
        }
    }
?>