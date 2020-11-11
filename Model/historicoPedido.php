<?php 
    include_once('../Connection/connection.php');
    class HistoricoPedido 
    {
        private $id;
        private $Solicitud;
        private $Estado;
        private $Usuario;
        private $FechaActualizacion;

        private static $tabla = 'historicosolicitud';

        function __construct($id,$Solicitud,$Estado,$Usuario,$FechaActualizacion)
        {
            $this->setId($id);
            $this->setSolicitud($Solicitud);
            $this->setEstado($Estado);
            $this->setUsuario($Usuario);
            $this->setFechaActualizacion($FechaActualizacion);
        }

        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getSolicitud()
        {
            return $this->Solicitud;
        }
        public function setSolicitud($Solicitud)
        {
            $this->id = $Solicitud;
        }
        public function getEstado()
        {
            return $this->Estado;
        }
        public function setEstado($Estado)
        {
            $this->id = $Estado;
        }
        public function getUsuario()
        {
            return $this->Usuario;
        }
        public function setUsuario($Usuario)
        {
            $this->id = $Usuario;
        }
        public function getFechaActualizacion()
        {
            return $this->FechaActualizacion;
        }
        public function setFechaActualizacion($FechaActualizacion)
        {
            $this->id = $FechaActualizacion;
        }

        public static function findAll()
        {
            $return=array();
            $res=Conexion::findAll(self::$tabla);
            foreach($res as $r)
            {
                $rol = new Rol($r['id'],$r['Solicitud'],$r['Estado'],$r['Usuario'],$r['FechaActualizacion']);
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
 
        public function modelToArray()
        {
            $data = [];
            $data['id'] = $this->getId();
            $data['Solicitud'] = $this->getSolicitud();
            $data['Estado'] = $this->getEstado();
            $data['Usuario'] = $this->getUsuario();
            $data['FechaActualizacion'] = $this->getFechaActualizacion();
            return $data;
        }
    }
?>