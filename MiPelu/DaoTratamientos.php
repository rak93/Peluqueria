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
        
        $tratam->__set("idTratamiemto", $fila['idTratamiemto']);
        $tratam->__set("nombre", $fila['nombre']);
        $tratam->__set("descripcion", $fila['descripcion']);
        $tratam->__set("duracion", $fila['duracion']);

        
        $this->tratamientos[]=$tratam;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }

   
   
    
   public function obtener($nombre)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select * from Alumnos where nombre=:nombre";
       $param=array(":nombre"=>$nombre);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $tratam= new tratamiento();
           
        
        
           $tratam->__set("idTratamiemto", $fila['idTratamiemto']);
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
   
  /* 
   public function borrar($NIF)      //Elimina una situación de la tabla
   {
       $consulta="delete from Alumnos where NIF=:NIF";
       $param=array(":NIF"=>$NIF);
        
       $this->ConsultaSimple($consulta,$param);
          
   }
   
   public function insertar($alu)      //Recibe como parámetro un objeto con la situación administrativa
   {
      $consulta="insert into Alumnos values(:NIF,
                                            :Nombre,
                                            :Apellido1,
                                            :Apellido2, 
                                            :Telefono,
                                            :Premios,
                                            :FechaNac,
                                            :Foto )";
       
      $param=array();
      
      $param[":NIF"]=$alu->__get("NIF");
      $param[":Nombre"]=$alu->__get("Nombre");
      $param[":Apellido1"]=$alu->__get("Apellido1");
      $param[":Apellido2"]=$alu->__get("Apellido2");
      $param[":Telefono"]=$alu->__get("Telefono");
      $param[":Premios"]=$alu->__get("Premios");
      $param[":FechaNac"]=$alu->__get("FechaNac");
      $param[":Foto"]=$alu->__get("Foto");
      
      $this->ConsultaSimple($consulta,$param);
   
   }

   public function actualizar($alu)     //Recibimos como parámetro un objeto con los datos a actualizar   
   { 
       $consulta="update Alumnos set Nombre=:Nombre,
                                     Apellido1=:Apellido1,
                                     Apellido2=:Apellido2, 
                                     Telefono=:Telefono,    
                                     Premios=:Premios,
                                     FechaNac=:FechaNac,
                                     Foto=:Foto          where NIF=:NIF";
       
       $param=array();
       
       $param[":NIF"]=$alu->__get("NIF");
       $param[":Nombre"]=$alu->__get("Nombre");
       $param[":Apellido1"]=$alu->__get("Apellido1");
       $param[":Apellido2"]=$alu->__get("Apellido2");
       $param[":Telefono"]=$alu->__get("Telefono");
       $param[":Premios"]=$alu->__get("Premios");
       $param[":FechaNac"]=$alu->__get("FechaNac");
       $param[":Foto"]=$alu->__get("Foto");
       
       $this->ConsultaSimple($consulta,$param);
       
   }

   */


}







?>