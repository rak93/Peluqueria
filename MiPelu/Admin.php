<?php

class Admin
{
   
    private $idAdmin;
    private $nombreAdmin;
    private $contraseña;
    
    
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
