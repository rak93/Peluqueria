<?php

require_once 'libreriaPDO.php';
require_once 'tratamiento.php';

class DaoTratamientos extends DB 
{
   public $tratamientos=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->dbname=$base;
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
     $consulta="select * from tratamientos ";
     $param=array();
     
     $this->tratamientos=array();  //Vaciamo s el array de las situaciones entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $tratam= new tratamiento();
        
        $tratam->__set("idTratamiento", $fila['idTratamiento']);
        $tratam->__set("nombre", $fila['nombre']);
        $tratam->__set("descripcion", $fila['descripcion']);
        $tratam->__set("duracion", $fila['duracion']);

        
        $this->tratamientos[]=$tratam;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }

   
   
    
   public function obtener($nombre)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select * from tratamientos where nombre=:nombre";
       $param=array(":nombre"=>$nombre);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $tratam= new tratamiento();
           
        
        
           $tratam->__set("idTratamiento", $fila['idTratamiento']);
           $tratam->__set("nombre", $fila['nombre']);
           $tratam->__set("descripcion", $fila['descripcion']);
           $tratam->__set("duracion", $fila['duracion']);
           
       }
       else 
       {
           echo "<b>El nombre introducido no corresponde con ningun tratamiento</b>";
       }
   
       return $tratam;
   } public function obtenerID($id)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select * from tratamientos where idTratamiento=:id";
       $param=array(":id"=>$id);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $tratam= new tratamiento();
           
        
        
           $tratam->__set("idTratamiento", $fila['idTratamiento']);
           $tratam->__set("nombre", $fila['nombre']);
           $tratam->__set("descripcion", $fila['descripcion']);
           $tratam->__set("duracion", $fila['duracion']);
           
       }
       else 
       {
           echo "<b>El nombre introducido no corresponde con ningun tratamiento</b>";
       }
   
       return $tratam;
   }
   public function borrarTratamiento($idTratamiento) {
    // Verifica que el parámetro idTratamiento no esté vacío
    

    // Consulta para eliminar un tratamiento por su identificador
    $consulta = "DELETE FROM tratamientos WHERE idTratamiento = :idTratamiento";

    // Parámetros para la consulta
    $param = array(":idTratamiento" => $idTratamiento);

    // Ejecutar la consulta con manejo de errores

        $this->ConsultaSimple($consulta, $param); // Ejecutar la consulta con los parámetros
 
}
public function insertarTratamiento($tratamiento) {
    // Consulta para insertar un nuevo tratamiento en la tabla tratamientos
    $consulta = "INSERT INTO tratamientos (nombre, descripcion, duracion) 
                 VALUES (:nombre, :descripcion, :duracion)";
    
    // Parámetros para la consulta
    $param = array(
        ":nombre" => $tratamiento->__get("nombre"),
        ":descripcion" => $tratamiento->__get("descripcion"),
        ":duracion" => $tratamiento->__get("duracion")
    );
    
    // Ejecutar la consulta
    $this->ConsultaSimple($consulta, $param);
}
public function actualizarTratamiento($tratamiento) {
    // Consulta para actualizar un tratamiento por su identificador
    $consulta = "UPDATE tratamientos SET 
        nombre = :nombre,
        descripcion = :descripcion,
        duracion = :duracion
        WHERE idTratamiento = :idTratamiento";

    // Parámetros para la consulta
    $param = array(
        ":idTratamiento" => $tratamiento->__get("idTratamiento"), // Identificador único del tratamiento
        ":nombre" => $tratamiento->__get("nombre"),
        ":descripcion" => $tratamiento->__get("descripcion"),
        ":duracion" => $tratamiento->__get("duracion")
    );

    // Ejecutar la consulta con manejo de errores
 
        $this->ConsultaSimple($consulta, $param); // Ejecutar la consulta con los parámetros

}


  /* 
 
   

   */


}







?>