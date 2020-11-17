<?php 
    include_once('../Connection/connection.php');
    class Validacion 
    {
        private $id;
        private $AFavor;
        private $EnContra;
        private $Resultado;
        private $FechaCierreVotacion;
        private $HistoricoAsociado;

        private static $tabla = 'validacion';

        public function __construct($id,$AFavor,$EnContra,$Resultado,$FechaCierreVotacion,$HistoricoAsociado)
        {
            $this->setId($id);
            $this->setAFavor($AFavor);
            $this->setEnContra($EnContra);
            $this->setResultado($Resultado);
            $this->setFechaCierreVotacion($FechaCierreVotacion);
            $this->setHistoricoAsociado($HistoricoAsociado);
        }

        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
        }
        public function getAFavor()
        {
            return $this->AFavor;
        }
        public function setAFavor($AFavor)
        {
            $this->AFavor = $AFavor;
        }
        public function getEnContra()
        {
            return $this->EnContra;
        }
        public function setEnContra($EnContra)
        {
            $this->EnContra = $EnContra;
        }
        public function getResultado()
        {
            return $this->Resultado;
        }
        public function setResultado($Resultado)
        {
            $this->Resultado = $Resultado;
        }
        public function getFechaCierreVotacion()
        {
            return $this->FechaCierreVotacion;
        }
        public function setFechaCierreVotacion($FechaCierreVotacion)
        {
            $this->FechaCierreVotacion = $FechaCierreVotacion;
        }
        public function getHistoricoAsociado()
        {
            return $this->HistoricoAsociado;
        }
        public function setHistoricoAsociado($HistoricoAsociado)
        {
            $this->HistoricoAsociado = $HistoricoAsociado;
        }

        public static function findAll()
        {
            $return=array();
            $res=Conexion::findAll(self::$tabla);
            foreach($res as $r)
            {
                $rol = new Rol($r['id'],$r['AFavor'],$r['EnContra'],$r['Resultado'],$r['FechaCierreVotacion'],$r['HistoricoAsociado']);
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
            $data['AFavor'] = $this->getAFavor();
            $data['EnContra'] = $this->getEnContra();
            $data['Resultado'] = $this->getResultado();
            $data['FechaCierreVotacion'] = $this->getFechaCierreVotacion();
            $data['HistoricoAsociado'] = $this->getHistoricoAsociado();
            return $data;
        }
    }
?>