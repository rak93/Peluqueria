<?php

class Cita
{
    private $Id;
    private $estilista_id;
    private $fecha;
    private $hora_cita;
    private $cliente_id;
    private $title;
    private $color;
    private $start;
    private $end;
    private $fyh_creacion;
    private $fyh_actualizacion;
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
