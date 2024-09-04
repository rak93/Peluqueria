<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreriaPDO.php';
require_once 'cita.php';
class DaoCitas extends DB {
    public $citas = array(); // Array de objetos con el resultado de las consultas
    
    public function __construct($base) {
        $this->dbname = $base;
    }
    
    public function listar() {
        $consulta = "SELECT * FROM citas";
        $param = array();
        
        $this->citas = array(); // Vaciamos el array de las citas entre consulta y consulta
        
        $this->ConsultaDatos($consulta);
        
        foreach ($this->filas as $fila) {
            $cita = new Cita();
            $cita->__set("Id", $fila['Id']);
            $cita->__set("estilista_id", $fila['estilista_id']);
            $cita->__set("fecha", $fila['fecha']);
           
            $cita->__set("id_cliente", $fila['id_cliente']);
            $cita->__set("title", $fila['title']);
            $cita->__set("color", $fila['color']);
            $cita->__set("start", $fila['start']);
            $cita->__set("end", $fila['end']);


            
            $this->citas[] = $cita; // Insertamos el objeto con los valores de esa fila en el array de objetos
        }
    }
    
    public function listarfecha($fecha) {
        $consulta = "SELECT * FROM citas where fecha=:fecha";
        $param = array(":fecha"=>$fecha);
        
        $this->citas = array(); // Vaciamos el array de las citas entre consulta y consulta
        
        $this->ConsultaDatos($consulta);
        
        foreach ($this->filas as $fila) {
            $cita = new Cita();
            $cita->__set("Id", $fila['Id']);
            $cita->__set("estilista_id", $fila['estilista_id']);
            $cita->__set("fecha", $fila['fecha']);
           
            $cita->__set("id_cliente", $fila['id_cliente']);
            $cita->__set("title", $fila['title']);
            $cita->__set("color", $fila['color']);
            $cita->__set("start", $fila['start']);
            $cita->__set("end", $fila['end']);


            
            $this->citas[] = $cita; // Insertamos el objeto con los valores de esa fila en el array de objetos
        }
    }
 
    public function mostrarCalendario() {
        $consulta = "SELECT title,start,end,color FROM citas";
        $param = array();
        
        $this->citas = array(); // Vaciamos el array de las citas entre consulta y consulta
        
        $this->ConsultaDatos($consulta);
        /*
         
        foreach ($this->filas as $fila) {
            $cita = new Cita();

            $cita->__set("title", $fila['title']);
            $cita->__set("color", $fila['color']);
            $cita->__set("start", $fila['start']);
            $cita->__set("end", $fila['end']);
           

            
            $this->citas[] = $cita; // Insertamos el objeto con los valores de esa fila en el array de objetos
             
        }*/
    }
    
  
        public function insertar($cita) {
            $consulta = "INSERT INTO citas (
                estilista_id, fecha, cliente_id, title, color, start, end
            ) VALUES (
                :estilista_id, :fecha, :cliente_id, :title, :color, :start, :end
            )";
        
            $param = array(
                ":estilista_id" => $cita->__get("estilista_id"),
                ":fecha" => $cita->__get("fecha"),
                ":cliente_id" => $cita->__get("cliente_id"),
                ":title" => $cita->__get("title"),
                ":color" => $cita->__get("color"),
                ":start" => $cita->__get("start"),
                ":end" => $cita->__get("end"),
            );
        
            $this->ConsultaSimple($consulta, $param);
        
        
       
    }
    
        
    
    
   

        public function verificarCitaDisponible($fecha, $hora_inicio, $estilista_id) {
            $consulta = "SELECT * FROM citas WHERE fecha=:fecha AND hora=:hora_inicio AND estilista_id=:estilista_id AND reservada=FALSE";
            $parametros = array(":fecha" => $fecha, ":hora_inicio" => $hora_inicio, ":estilista_id" => $estilista_id);
            
            $this->ConsultaDatos($consulta, $parametros);
            
            return count($this->filas) == 1; // Devuelve verdadero si hay una fila (cita disponible), falso en caso contrario
        }
    
        public function borrar($id)      //Elimina una situación de la tabla
        {
            $consulta="delete from citas where id=:id";
            $param=array(":id"=>$id);
             
            $this->ConsultaSimple($consulta,$param);
               
        }
   
   /*
    
   public function obtener($NIF)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select * from Alumnos where NIF=:NIF";
       $param=array(":NIF"=>$NIF);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $alu= new Alumno();
           
           $alu->__set("NIF", $fila['NIF']);
           $alu->__set("Nombre", $fila['Nombre']);
           $alu->__set("Apellido1", $fila['Apellido1']);
           $alu->__set("Apellido2", $fila['Apellido2']);
           $alu->__set("Telefono", $fila['Telefono']);
           $alu->__set("Premios", $fila['Premios']);
           $alu->__set("FechaNac", $fila['FechaNac']);
           $alu->__set("Foto", $fila['Foto']);
           
       }
       else 
       {
           echo "<b>El NIF introducido no corresponde con ningun alumno</b>";
       }
   
       return $alu;
   }
   

   
  public function insertar($cita) {
    $consulta = "INSERT INTO citas (fecha, hora_inicio, hora_fin, estilista_id, reservada) VALUES (:fecha, :hora_inicio, :hora_fin, :estilista_id, :reservada)";
    
    $param = array(
        ":fecha" => $cita->__get("fecha"),
        ":hora_inicio" => $cita->__get("hora_inicio"),
        ":hora_fin" => $cita->__get("hora_fin"),
        ":estilista_id" => $cita->__get("estilista_id"),
        ":reservada" => $cita->__get("reservada")
    );
    
    $this->ConsultaSimple($consulta, $param);
}

public function actualizar($cita) {
    $consulta = "UPDATE citas SET fecha=:fecha, hora_inicio=:hora_inicio, hora_fin=:hora_fin, estilista_id=:estilista_id, reservada=:reservada WHERE id=:id";
    
    $param = array(
        ":fecha" => $cita->__get("fecha"),
        ":hora_inicio" => $cita->__get("hora_inicio"),
        ":hora_fin" => $cita->__get("hora_fin"),
        ":estilista_id" => $cita->__get("estilista_id"),
        ":reservada" => $cita->__get("reservada"),
        ":id" => $cita->__get("id")
    );
    
    $this->ConsultaSimple($consulta, $param);
}


   public function obtenerHorasReservadas($fecha, $estilista_id) {
    $consulta = "SELECT hora_inicio FROM citas WHERE fecha=:fecha AND estilista_id=:estilista_id AND reservada=TRUE";
    
    $param = array();
    $param[":fecha"] = $fecha;
    $param[":estilista_id"] = $estilista_id;
    
    $this->ConsultaDatos($consulta, $param);
    
    $horas_reservadas = array();
    foreach ($this->filas as $fila) {
        $horas_reservadas[] = $fila['hora_inicio'];
    }
    
    return $horas_reservadas;
}
*/

}







?> 