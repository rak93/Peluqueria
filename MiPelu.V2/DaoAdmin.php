<?php


//Necesitamos incluir la libreria y la clase entidad asociada al DAO

require_once 'libreriaPDO.php';
require_once 'Admin.php';

class DaoAdmin extends DB 
{
   public $administradores=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->dbname=$base;
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
     $consulta="select * from administradores ";
     $param=array();
     
     $this->administradores=array();  //Vaciamos el array de las situaciones entre consulta y consulta
     
     $this->ConsultaDatos($consulta);
       
     foreach($this->filas as $fila)
     {
        $ad= new Admin();
        
        $ad->__set("idAdmin", $fila['idAdmin']);
        $ad->__set("user", $fila['user']);
        $ad->__set("pass", $fila['pass']);
       
        $this->administradores[]=$ad;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
//Necesitamos incluir la libreria y la clase entidad asociada al DAO

    }
    public function obtenerAdminPorUser($user) {
        $consulta = "SELECT * FROM administradores WHERE user = :user";
        $param = array(":user" => $user);
        
        $this->administradores = array();  
        $this->ConsultaDatos($consulta, $param);
        
        if (count($this->filas) == 1) {
            $fila = $this->filas[0]; // Recuperamos la fila devuelta
    
            // Creamos un nuevo objeto administrador y asignamos los valores de la fila
            $admin = new Admin();
            $admin->__set("user", $fila['user']);
            $admin->__set("pass", $fila['pass']);
      
            return $admin; // Retornamos el objeto administrador
        } else {
            return null; // Retornamos null si no se encuentra ningún administrador
        }
    }
    
    
    public function obtener($user, $pass) { // Obtiene el elemento por usuario y pass
        $consulta = "SELECT * FROM administradores WHERE user = :user AND pass = :pass";
        $param = array(":user" => $user, ":pass" => $pass); // Uso correcto de => para parámetros
        
        $this->ConsultaDatos($consulta, $param); // Realiza la consulta con parámetros
        
        $admin = null; // Inicializa la variable para el objeto

        if (count($this->filas) == 1) { // Verifica si se encontró un resultado
            $fila = $this->filas[0]; // Toma la primera fila

            $admin = new Admin(); // Asegúrate de crear un objeto de la clase correcta
            $admin->__set("idAdmin", $fila['idAdmin']); // Asigna valores correctos
            $admin->__set("user", $fila['user']);
        } else {
            echo "<b>El usuario y la pass no coinciden.</b>"; // Mensaje de error si no se encuentra coincidencia
        }
    
        return $admin; // Devuelve el objeto o null si no se encontró
    }

    public function obtenerAdminPorId($idAdmin)
    {
        $consulta = "SELECT * FROM administradores WHERE idAdmin = :idAdmin";
        $param = array(":idAdmin" => $idAdmin);

        $this->ConsultaDatos($consulta, $param);

        if (count($this->filas) > 0) {
            $fila = $this->filas[0];
            $admin = new Admin();
            $admin->__set("idAdmin", $fila['idAdmin']);
            $admin->__set("user", $fila['user']);
            $admin->__set("pass", $fila['pass']);
            return $admin;
        } else {
            return null;
        }
    }
    
    public function insertar(Admin $admin) {
        $consulta = "INSERT INTO administradores (user, pass) VALUES (:user, :pass)";
        $param = array(
            ":user" => $admin->__get("user"),
            ":pass" => $admin->__get("pass")
        );
        $this->ConsultaSimple($consulta, $param);
    }
    public function actualizar(Admin $admin)
    {
        $consulta = "UPDATE administradores SET user = :user, pass = :pass WHERE idAdmin = :idAdmin";
        $param = array(
            ":user" => $admin->__get("user"),
            ":pass" => $admin->__get("pass"),
            ":idAdmin" => $admin->__get("idAdmin")
        );
        $this->ConsultaSimple($consulta, $param);
    }
    public function borrar($idAdmin)
    {
        $consulta = "DELETE FROM administradores WHERE idAdmin = :idAdmin";
        $param = array(":idAdmin" => $idAdmin);
        $this->ConsultaSimple($consulta, $param);
    }
    /*
    public function mostrarCalendario() {
        $consulta = "SELECT title,start,end,color FROM clientes";
        $param = array();
        
        $this->clientes = array(); // Vaciamos el array de las clientes entre consulta y consulta
        
        $this->ConsultaDatos($consulta);
        
         
        foreach ($this->filas as $fila) {
            $cita = new Cita();

            $cita->__set("title", $fila['title']);
            $cita->__set("color", $fila['color']);
            $cita->__set("start", $fila['start']);
            $cita->__set("end", $fila['end']);
           

            
            $this->citas[] = $cita; // Insertamos el objeto con los valores de esa fila en el array de objetos
             
        }
    }
    
    
   

        public function verificarCitaDisponible($fecha, $hora_inicio, $estilista_id) {
            $consulta = "SELECT * FROM citas WHERE fecha=:fecha AND hora=:hora_inicio AND estilista_id=:estilista_id AND reservada=FALSE";
            $parametros = array(":fecha" => $fecha, ":hora_inicio" => $hora_inicio, ":estilista_id" => $estilista_id);
            
            $this->ConsultaDatos($consulta, $parametros);
            
            return count($this->filas) == 1; // Devuelve verdadero si hay una fila (cita disponible), falso en caso contrario
        }
    
    
   
   
    
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
   
   public function borrar($NIF)      //Elimina una situación de la tabla
   {
       $consulta="delete from Alumnos where NIF=:NIF";
       $param=array(":NIF"=>$NIF);
        
       $this->ConsultaSimple($consulta,$param);
          
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