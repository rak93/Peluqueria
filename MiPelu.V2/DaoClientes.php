<?php

require_once 'libreriaPDO.php';
require_once 'Cliente.php';

class DaoClientes extends DB 
{
    public $clientes = array();  
    
    public function __construct($base)  
    {
        $this->dbname = $base;
    }
    
    public function listar()       
    {
        $consulta = "SELECT * FROM clientes";
        $param = array(); // Corrected variable name

        $this->clientes = array();  
        
        $this->ConsultaDatos($consulta, $param);
        
        foreach ($this->filas as $fila) {
            $cli = new Cliente();
            
            $cli->__set("IdCliente", $fila['IdCliente']);
            $cli->__set("nombre", $fila['nombre']);
            $cli->__set("Apellido1", $fila['Apellido1']);
            $cli->__set("Apellido2", $fila['Apellido2']);
            $cli->__set("telefono", $fila['telefono']);
            $cli->__set("observaciones", $fila['observaciones']);
            $cli->__set("user", $fila['user']);
            $cli->__set("pass", $fila['pass']);
            
            $this->clientes[] = $cli;   
        }
    }
    
    public function insertarCliente($cliente) {
        $consulta = "INSERT INTO clientes (nombre, Apellido1, Apellido2, telefono, observaciones, user, pass) VALUES (:nombre, :Apellido1, :Apellido2, :telefono, :observaciones, :user, :pass)";
        
        $param = array(
            ":nombre" => $cliente->__get("nombre"),
            ":Apellido1" => $cliente->__get("Apellido1"),
            ":Apellido2" => $cliente->__get("Apellido2"),
            ":telefono" => $cliente->__get("telefono"),
            ":observaciones" => $cliente->__get("observaciones"),
            ":user" => $cliente->__get("user"),
            ":pass" => $cliente->__get("pass")
        );
        
        $this->ConsultaSimple($consulta, $param);
    }
    
    public function borrar($id)      
    {
        $consulta = "DELETE FROM clientes WHERE IdCliente = :id";
        $param = array(":id" => $id);
        
        $this->ConsultaSimple($consulta, $param);
    }
    
    public function actualizarCliente($cliente) {
        $consulta = "UPDATE clientes SET 
            nombre = :nombre, 
            Apellido1 = :Apellido1, 
            Apellido2 = :Apellido2, 
            telefono = :telefono, 
            observaciones = :observaciones,
            user = :user,
            pass = :pass
            WHERE IdCliente = :IdCliente";
        
        $param = array(
            ":nombre" => $cliente->__get("nombre"),
            ":Apellido1" => $cliente->__get("Apellido1"),
            ":Apellido2" => $cliente->__get("Apellido2"),
            ":telefono" => $cliente->__get("telefono"),
            ":observaciones" => $cliente->__get("observaciones"),
            ":user" => $cliente->__get("user"),
            ":pass" => $cliente->__get("pass"),
            ":IdCliente" => $cliente->__get("IdCliente")
        );
        
        $this->ConsultaSimple($consulta, $param);
    }
    
    public function obtenerClientePorId($id) {
        $consulta = "SELECT * FROM clientes WHERE IdCliente = :id";
        $param = array(":id" => $id);
        
        $this->clientes = array();  
        $this->ConsultaDatos($consulta, $param);
        
        if (count($this->filas) == 1) {
            $fila = $this->filas[0]; 

            $cliente = new Cliente();
            $cliente->__set("IdCliente", $fila['IdCliente']);
            $cliente->__set("nombre", $fila['nombre']);
            $cliente->__set("Apellido1", $fila['Apellido1']);
            $cliente->__set("Apellido2", $fila['Apellido2']);
            $cliente->__set("telefono", $fila['telefono']);
            $cliente->__set("observaciones", $fila['observaciones']);
            $cliente->__set("user", $fila['user']);
            $cliente->__set("pass", $fila['pass']);
            
            return $cliente;
        } else {
            return null; // Handle case where no client is found
        }
    }
    
    public function insertarClienteRe($cliente) {
        $this->insertarCliente($cliente); // Reuse the insertarCliente method
    }

    public function obtenerPorUser($user) {
        $consulta = "SELECT * FROM clientes WHERE user = :user";
        $param = array(":user" => $user);

        $this->clientes = array();  
        $this->ConsultaDatos($consulta, $param);
        
        if (count($this->filas) == 1) {
            $fila = $this->filas[0]; 

            $cliente = new Cliente();
            $cliente->__set("IdCliente", $fila['IdCliente']);
            $cliente->__set("nombre", $fila['nombre']);
            $cliente->__set("Apellido1", $fila['Apellido1']);
            $cliente->__set("Apellido2", $fila['Apellido2']);
            $cliente->__set("telefono", $fila['telefono']);
            $cliente->__set("observaciones", $fila['observaciones']);
            $cliente->__set("user", $fila['user']);
            $cliente->__set("pass", $fila['pass']);
            
            return $cliente;
        } else {
            return null; // Return null if no client with the given username is found
        }
    }
}
?>
