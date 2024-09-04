<?php

class tratamiento
{
    private $idTratamiemto;
    private $nombre;
    private $descripcion; // Corregido el nombre de la propiedad
    private $duracion;

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
