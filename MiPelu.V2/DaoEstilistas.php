<?php

require_once 'libreriaPDO.php';
require_once 'estilista.php';

class DaoEstilistas extends DB
{
    public $estilistas = array();  // Array of objects with the query results

    public function __construct($base)  // Specify the database to act on when instantiating the DAO
    {
        $this->dbname = $base;
    }

    public function listar() // List the content of the table
    {
        $consulta = "SELECT * FROM estilista";
        $param = array();

        $this->estilistas = array(); // Empty the array between queries

        $this->ConsultaDatos($consulta, $param); // Ensure the correct parameters are passed

        foreach ($this->filas as $fila) {
            $esti = new Estilista();
            $esti->__set("IdEstilista", $fila['IdEstilista']);
            $esti->__set("nif", $fila['nif']);
            $esti->__set("nombre", $fila['nombre']);
            $esti->__set("Apellido1", $fila['Apellido1']);
            $esti->__set("Apellido2", $fila['Apellido2']);
            $esti->__set("telefono", $fila['telefono']);
            $esti->__set("foto", $fila['foto']);
            $esti->__set("user", $fila['user']);
            $esti->__set("pass", $fila['pass']);

            $this->estilistas[] = $esti; // Insert the object with the values of that row into the array of objects
        }
    }

    public function obtenerEstilistaPorNIF($nif)
    {
        $consulta = "SELECT * FROM estilista WHERE nif = :nif";
        $parametros = array(":nif" => $nif);

        $this->consultaDatos($consulta, $parametros);

        if (count($this->filas) == 1) {
            $fila = $this->filas[0];

            $estilista = new Estilista();
            $estilista->__set("IdEstilista", $fila['IdEstilista']);
            $estilista->__set("nif", $fila['nif']);
            $estilista->__set("nombre", $fila['nombre']);
            $estilista->__set("Apellido1", $fila['Apellido1']);
            $estilista->__set("Apellido2", $fila['Apellido2']);
            $estilista->__set("telefono", $fila['telefono']);
            $estilista->__set("user", $fila['user']);
            $estilista->__set("pass", $fila['pass']);
            $estilista->__set("foto", $fila['foto']);

            return $estilista;
        } else {
            return null;
        }
    }

    public function obtener($idEstilista)
    {
        $consulta = "SELECT * FROM estilista WHERE IdEstilista = :idEstilista";
        $parametros = array(":idEstilista" => $idEstilista);

        $this->consultaDatos($consulta, $parametros);

        if (count($this->filas) == 1) {
            $fila = $this->filas[0];

            $estilista = new Estilista();
            $estilista->__set("IdEstilista", $fila['IdEstilista']);
            $estilista->__set("nif", $fila['nif']);
            $estilista->__set("nombre", $fila['nombre']);
            $estilista->__set("Apellido1", $fila['Apellido1']);
            $estilista->__set("Apellido2", $fila['Apellido2']);
            $estilista->__set("telefono", $fila['telefono']);
            $estilista->__set("user", $fila['user']);
            $estilista->__set("pass", $fila['pass']);
            $estilista->__set("foto", $fila['foto']);

            return $estilista;
        } else {
            return null;
        }
    }

    public function borrarEstilista($IdEstilista)
    {
        $consulta = "DELETE FROM estilista WHERE IdEstilista = :IdEstilista";
        $param = array(":IdEstilista" => $IdEstilista);

        $this->ConsultaSimple($consulta, $param);
    }

   

    public function insertarEstilistaRe($esti)
    {
        $consulta = "INSERT INTO estilista (nif, nombre, Apellido1, Apellido2, telefono, foto, user, pass) VALUES (:nif, :nombre, :Apellido1, :Apellido2, :telefono, :foto, :user, :pass)";
        $param = array(
            ":nif" => $esti->__get("nif"),
            ":nombre" => $esti->__get("nombre"),
            ":Apellido1" => $esti->__get("Apellido1"),
            ":Apellido2" => $esti->__get("Apellido2"),
            ":telefono" => $esti->__get("telefono"),
            ":foto" => $esti->__get("foto"),
            ":user" => $esti->__get("user"),
            ":pass" => $esti->__get("pass"),
        );

        $this->ConsultaSimple($consulta, $param);
    }

    public function actualizarEstilista($esti)
    {
        $consulta = "UPDATE estilista SET 
            nif = :nif,
            nombre = :nombre,
            Apellido1 = :Apellido1,
            Apellido2 = :Apellido2,
            telefono = :telefono,
            foto = :foto,
            user = :user,
            pass = :pass
            WHERE IdEstilista = :IdEstilista";

        $param = array(
            ":IdEstilista" => $esti->__get("IdEstilista"),
            ":nif" => $esti->__get("nif"),
            ":nombre" => $esti->__get("nombre"),
            ":Apellido1" => $esti->__get("Apellido1"),
            ":Apellido2" => $esti->__get("Apellido2"),
            ":telefono" => $esti->__get("telefono"),
            ":foto" => $esti->__get("foto"),
            ":user" => $esti->__get("user"),
            ":pass" => $esti->__get("pass")
        );

        $this->ConsultaSimple($consulta, $param);
    }

    public function obtenerPorUser($user)
    {
        $consulta = "SELECT * FROM estilista WHERE user = :user";
        $param = array(":user" => $user);

        $this->ConsultaDatos($consulta, $param);
        $estilista = new Estilista();

        if (count($this->filas) == 1) {
            $fila = $this->filas[0];

            $estilista->__set("IdEstilista", $fila['IdEstilista']);
            $estilista->__set("nif", $fila['nif']);
            $estilista->__set("nombre", $fila['nombre']);
            $estilista->__set("Apellido1", $fila['Apellido1']);
            $estilista->__set("Apellido2", $fila['Apellido2']);
            $estilista->__set("telefono", $fila['telefono']);
            $estilista->__set("user", $fila['user']);
            $estilista->__set("pass", $fila['pass']);
            $estilista->__set("foto", $fila['foto']);

            $this->estilistas[] = $estilista;
            return $estilista;
        } else {
            return null;
        }
    }
}
?>
