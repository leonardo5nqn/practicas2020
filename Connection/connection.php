<?php 
    class Conexion
    {
        // <------------------- Atributos --------------------->
        private $dbhost ="localhost"; // dominio del host o ip de la BD
        private $dbusuario ="root"; // Nombre de usuario de la BD
        private $dbpassword =""; // Password de la BD
        private $dbname = "rotary"; // BD a la que se quiere conectar
        public $conn;
        // <------------------- Métodos --------------------->
        public function conectarDB() // función para concetar a la base de datos
        {
            // parametros para una nueva conexión mysql
            $this->conn = null;

            $this->conn = new mysqli($this->dbhost,$this->dbusuario,$this->dbpassword,$this->dbname);
            
            if(!$this->conn) // consulta si la conexión no se realizó correctamente y devuelve el error
            {
                die("Error de conexión: " . $this->conn->connect_error);
            }

            echo "Conexión establecida con la base de datos..";
        }
    }
?>