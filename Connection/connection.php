<?php
//CREADO LA CLASE DE CONEXION     
class Conexion
{
    private static $instance = null;
    //AGREGO LA CONEXION A LA BASE DE DATOS        
    private static $host = "localhost";
    private static $usuario = "root";
    private static $pass = "";
    private static $nameBD = "rotary";
    private static $error = "No Encontrado";
    // Generar un constructor de conexión tomando las variables de la clase       
    function __construct()
    {
        self::$instance = new mysqli(self::$host, self::$usuario, self::$pass, self::$nameBD);
    }
    // funcion de realizar la conexión, retorna una instancia de la misma       
    public static function conectar()
    {
        if (self::$instance == null) {
            new Conexion();
        }
        return self::$instance;
    }
    // funcion para cerrar la conexión instanciada previamente           
    public static function cerrarConexion()
    {
        self::$instance->close();
        self::$instance = null;
    }
    // Función genérica de BD para buscar todos los elementos de una tabla
    public static function findAll($table)
    {
        self::conectar();
        $query = "SELECT * FROM {$table}"; // alamceno la query a realizar a la bd
        if ($result = self::$instance->query($query)) {
            $return = array();
            while ($obj = $result->fetch_array()) {
                $return[] = $obj;
            }
            return $return;
        } else return false;
    }
    // funcion generica de la BD para buscar de manera filtrada
    public static function find($table, $search)
    {
        self::conectar();
        $query = "SELECT * FROM {$table} WHERE {$search}";
        if ($result = self::$instance->query($query)) {
            $return = array();
            while ($obj = $result->fetch_array()) {
                $return[] = $obj;
            }
        } else {
            $return = self::$error;
        }
        return $return;
    }
    // funcion generica de BD para buscar un resultado
    public static function findOne($table, $search)
    {
        self::conectar();
        $query = "SELECT * FROM {$table} WHERE {$search} LIMIT 0,1";
        if ($result = self::$instance->query($query)) {
            $return = array();
            if ($result->num_rows > 0)
                while ($obj = $result->fetch_array()) {
                    $return[] = $obj;
                }
            else $return = 0;
        } else {
            $return = 0; //self::$error;
        }
        return $return;
    }
    // Funcion genérica de BD para borrar un registro
    public static function delete($table, $id)
    {
        self::conectar();
        $query = "DELETE FROM {$table} WHERE id={$id} ";
        echo self::$instance->query($query);
        if ($result = self::$instance->query($query)) {
            return "Borrado con exito";
        } else {
            return self::$error;
        }
    }
    // Funcion generica de BD para insertar un registro
    public static function insert($table, $data)
    {
        self::conectar();
        $keys = "";
        $values = "";
        foreach ($data as $key => $value) {
            $keys .= "$key,";
            if (is_int($value) == False) $values .= "'{$value}',";
            else $values .= "{$value},";
        }
        $keys = substr($keys, 0, -1);
        $values = substr($values, 0, -1);
        $query = "INSERT INTO {$table} ({$keys}) VALUES ({$values})";
        if ($result = self::$instance->query($query)) {
            return "Creado con exito";
        } else {
            return self::$error;
        }
    }
    // Funcion generica de BD para actualizar un registro
    public static function update($table, $data, $id)
    {
        self::conectar();
        $state = "";
        foreach ($data as $key => $value) {
            $state += $key + "=" + $value + ",";
        }
        $query = "UPDATE {$table} SET {$state} WHERE id={$id}";
        if ($result = self::$instance->query($query)) {
            return "Actualizado con exito";
        } else {
            return self::$error;
        }
    }
}
