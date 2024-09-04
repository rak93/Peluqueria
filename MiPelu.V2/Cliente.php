<?php

class Cliente
{
    private $IdCliente;
    private $nombre;
    private $Apellido1;
    private $Apellido2;
    private $telefono;
    private $user;
    private $pass;
    private $observaciones;
    
    
    public function __get($propiedad)
    {
        return $this->$propiedad;
    }
    
    public function __set($propiedad,$valor)
    {
        $this->$propiedad=$valor;
    }
    
}



?>
