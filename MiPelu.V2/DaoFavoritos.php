<?php
require_once 'libreriaPDO.php';
require_once 'favoritos.php';
class DaoFavoritos extends DB {
    public $favoritos = array();  // Array de objetos con el resultado de las consultas

    public function __construct($base)  // Al instanciar el dao especificamos sobre qué BBDD queremos que actúe 
    {
        $this->dbname = $base;
    }

    // Obtiene los favoritos por ID de cliente
    public function obtenerFavoritosPorIdCliente($idCliente) {
        $consulta = "SELECT galeria_id FROM favoritos WHERE cliente_id = :cliente_id";
        $param = array(":cliente_id" => $idCliente);
        $this->ConsultaDatos($consulta, $param);
        
        $favoritos = [];
        foreach ($this->filas as $fila) {
            $favoritos[] = $fila['galeria_id'];
        }
        return $favoritos;
    }

    public function agregarFavorito($idCliente, $idGaleria) {
        $consulta = "INSERT INTO favoritos (cliente_id, galeria_id) VALUES (:cliente_id, :galeria_id)";
        $param = array(":cliente_id" => $idCliente, ":galeria_id" => $idGaleria);
        $this->ConsultaSimple($consulta, $param);
    }

    public function eliminarFavorito($idCliente, $idGaleria) { // Corregido el nombre de la variable a camelCase
        $consulta = "DELETE FROM favoritos WHERE cliente_id = :cliente_id AND galeria_id = :galeria_id";
        $param = array(":cliente_id" => $idCliente, ":galeria_id" => $idGaleria);
        $this->ConsultaSimple($consulta, $param);
    }
}

?>
