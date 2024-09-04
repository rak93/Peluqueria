<?php

class Cliente
{
    private $cliente_Id;
    private $galeria_Id; // Cambiado de 'nombre' a 'IdImagen'
    
    public function __get($propiedad)
    {
        return $this->$propiedad;
    }
    
    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}

?>
