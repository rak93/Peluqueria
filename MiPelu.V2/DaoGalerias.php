<?php
require_once 'libreriaPDO.php';
require_once 'galerias.php';

class DaoGaleria extends DB {
    public $galerias = array(); // Array para almacenar los resultados de las consultas
    
    public function __construct($base) {
        $this->dbname = $base;
    }
    
    // Listar todas las galerías
    public function listar() {
        $consulta = "SELECT * FROM galeria";
        $this->galerias = array(); // Vaciamos el array de galerías
        
        $this->ConsultaDatos($consulta);
        
        foreach ($this->filas as $fila) {
            $galeria = new Galeria();
            $galeria->__set("id", $fila['id']);
            $galeria->__set("descripcion", $fila['descripcion']);
            $galeria->__set("foto", $fila['foto']);
            $galeria->__set("alto", $fila['alto']);
            $galeria->__set("ancho", $fila['ancho']);
            
            $this->galerias[] = $galeria; // Insertamos el objeto en el array de galerías
        }
    }
    
    // Insertar una nueva galería
    public function insertar($galeria) {
        $consulta = "INSERT INTO galeria (descripcion, foto, alto, ancho) VALUES (:descripcion, :foto, :alto, :ancho)";
        
        $param = array(
            ":descripcion" => $galeria->__get("descripcion"),
            ":foto" => $galeria->__get("foto"),
            ":alto" => $galeria->__get("alto"),
            ":ancho" => $galeria->__get("ancho"),
        );
        
        $this->ConsultaSimple($consulta, $param);
    }
    
    // Borrar una galería por su ID
    public function borrar($id) {
        $consulta = "DELETE FROM galeria WHERE id = :id";
        $param = array(":id" => $id);
        
        $this->ConsultaSimple($consulta, $param);
    }

    // Obtener una galería por su ID
    public function obtener($id) {
        $consulta = "SELECT * FROM galeria WHERE id = :id";
        $param = array(":id" => $id);
        
        $this->ConsultaDatos($consulta, $param);
        
        if (count($this->filas) == 1) {
            $fila = $this->filas[0]; // Recuperamos la fila devuelta
            $galeria = new Galeria();
            
            $galeria->__set("id", $fila['id']);
            $galeria->__set("descripcion", $fila['descripcion']);
            $galeria->__set("foto", $fila['foto']);
            $galeria->__set("alto", $fila['alto']);
            $galeria->__set("ancho", $fila['ancho']);
            
            return $galeria;
        } else {
            return null; // No se encontró la galería con el ID proporcionado
        }
    }

    // Actualizar una galería por su ID
    public function actualizar($galeria) {
        $consulta = "UPDATE galeria SET descripcion = :descripcion, foto = :foto, alto = :alto, ancho = :ancho WHERE id = :id";
        
        $param = array(
            ":id" => $galeria->__get("id"),
            ":descripcion" => $galeria->__get("descripcion"),
            ":foto" => $galeria->__get("foto"),
            ":alto" => $galeria->__get("alto"),
            ":ancho" => $galeria->__get("ancho"),
        );
        
        $this->ConsultaSimple($consulta, $param);
    }
}

?>
