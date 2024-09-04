<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreriaPDO.php';
require_once 'estilista.php';

class DaoEstilistas extends DB 
{
   public $estilistas=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->dbname=$base;
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
     $consulta="select * from estilista ";
     $param=array();
     
     $this->estilistas=array();  //Vaciamos el array de las situaciones entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $esti= new Estilista();
        $esti->__set("IdEstilista", $fila['IdEstilista']);
        $esti->__set("nif", $fila['nif']);
       $esti->__set("nombre", $fila['nombre']);
        $esti->__set("Apellido1", $fila['Apellido1']);
        $esti->__set("Apellido2", $fila['Apellido2']);
       
         $esti->__set("foto", $fila['foto']);
        
        $this->estilistas[]=$esti;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }
   
   
    
   public function obtener($IdEstilista)          //Obtenemos el elemento a partir de su Id
   {
       $consulta="select * from Alumnos where IdEstilista=:IdEstilista";
       $param=array(":IdEstilista"=>$IdEstilista);
        
       $this->ConsultaDatos($consulta,$param);
       
       if (count($this->filas)==1 )
       {
           $fila=$this->filas[0];  //Recuperamos la fila devuelta
           
           $esti= new Estilista();
           $esti->__set("IdEstilista", $fila['IdEstilista']);
           $esti->__set("nif", $fila['nif']);
          $esti->__set("nombre", $fila['nombre']);
           $esti->__set("apellido1", $fila['apellido1']);
           $esti->__set("apellido2", $fila['apellido2']);
           $esti->__set("email", $fila['email']);
           $esti->__set("contraseña", $fila['contraseña']);
           $esti->__set("telefono", $fila['telefono']);
            $esti->__set("foto", $fila['foto']);
           
           $this->estilistas[]=$esti;   
           
       }
       else 
       {
           echo "<b>El NIF introducido no corresponde con ningun alumno</b>";
       }
   
       return $esti;
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