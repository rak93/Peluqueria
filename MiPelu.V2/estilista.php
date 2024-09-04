<?php

class Estilista
{
    private $idEstilista;
    private $nif;
    private $Nombre;
    private $Apellido1;
    private $Apellido2;
    private $telefono;
    private $foto;
    private $user;
    private $pass;

    public function __get($propiedad)
    {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor)
    {
        $this->$propiedad = $valor;
    }
}
