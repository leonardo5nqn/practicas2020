<?php 
    include_once('../Connection/connection.php');
    include_once('./rol.php');
    class Usuario
    {
        private $id;
        private $nombreDeUsuario;
        private $contrasenia;
        private $rol;
        private $mail;

        private static $tabla='usuario';

        function __construct($id,$nombreDeUsuario, $contrasenia,$rol,$mail)     
        {         
            $this->setId($id);
            $this->setNombreDeUsuario($nombreDeUsuario);
            $this->setContrasenia($contrasenia);
            $this->setRol($rol);  
            $this->setMail($mail);
        }

        public function getNombreDeUsuario()
        {
            return $this->nombreDeUsuario;
        }
        public function setNombreDeUsuario($nombreDeUsuario)
        {
            $this->nombreDeUsuario = $nombreDeUsuario;
        }
    
        public function getContrasenia()
        {
            return $this->contrasenia;
        }
        public function setContrasenia($contrasenia)
        {
            $this->contrasenia = $contrasenia;
        }
      
        public function getRol()
        {
            return $this->rol;
        }
        public function setRol($rol)
        {
            $this->rol = $rol;
        }
      
        public function getMail()
        {
            return $this->mail;
        }
        public function setMail($mail)
        {
            $this->mail=$mail;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id=$id;
        }

        public static function findAll()
        {
            $return=array();
            $res=Conexion::findAll(self::$tabla);
            foreach($res as $r)
            {
                $rol = new Rol($r['id'],$r['nombreDeUsuario'],$r['contrasenia'],$r['rol'],$r['mail']);
                $return[]=$rol;
            }
            return $return;
        }
       
        public static function findOne($search)
        {
            $res = Conexion::findOne(self::$tabla, $search);
            if($res!=0) return $res;
            else return False;
        }

        public function create()
        {
            $data = $this->modelToArray();
            $res = Conexion::insert(self::$tabla, $data);
            if($res!=0) return True;
            else return False;
        }

        public function update($id)
        {
            $data = $this->modelToArray();
            $res = Conexion::update(self::$tabla,$data,$id);
            if($res!=0) return True;
            else return False;
        }

        public static function login($username,$password)
        {
            $password=$password;//md5($password);
            $busqueda = "nombreDeUsuario = '{$username}' && contrasenia = '{$password}'";
            $user=Usuario::findOne($busqueda);
            if($user!=0) return $user;
            else return False;
        }

        public function modelToArray()
        {
            $data = [];
            $data['id'] = $this->getId();
            $data['nombreDeUsuario'] = $this->getNombreDeUsuario();
            $data['mail'] = $this->getMail();
            $data['rol'] = $this->getRol();
            $data['contrasenia'] = $this->getContrasenia();
            return $data;
        }
    }
?>