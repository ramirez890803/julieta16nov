<?php
require_once '../config/conexion.php';//Llamar a archivo de conexion.

class Usuario {  //clase usuario//
    private $pdo;

    public function __construct() { // funcion construccion 
        $this->pdo = (new Conexion())->conectar();
    }

    public function agregarUsuario($nombre, $apellidoPat, $apellidoMat, $usuario, $password, $privi_id) { //funcion para agregar usuarios a base de datos//
        $sql = "INSERT INTO usuarios (Nombre_Us, ApellidoPat_Us, ApellidoMat_Us, username, password, privi_id) VALUES (:nombre, :apellidoPat, :apellidoMat, :usuario, :password, :privi_id)";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([
            ':nombre' => $nombre,
            ':apellidoPat' => $apellidoPat,
            ':apellidoMat' => $apellidoMat,
            ':usuario' => $usuario,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':privi_id' => $privi_id
        ])) {
            throw new Exception("Error al ejecutar la consulta: " . implode(", ", $stmt->errorInfo()));
        }
        return true;
    }

    public function obtenerUsuarios() { //funcion para obtener los datos de la base datos//
        $sql = "SELECT usuarios.id, usuarios.Nombre_Us ,usuarios.ApellidoPat_Us, usuarios.ApellidoMat_Us,usuarios.username, privilegios.privilegio
        FROM usuarios
        INNER JOIN privilegios ON privilegios.id_privi = usuarios.privi_id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id, $nombre, $apellidoPat, $apellidoMat, $usuario,$password, $privilegio) { //funcion para aactualizar datos de usuario//
        $sql = "UPDATE usuarios SET Nombre_Us = :nombre, ApellidoPat_Us = :apellidoPat, ApellidoMat_Us = :apellidoMat, username = :usuario, password=:password, privi_id = :privilegio WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':apellidoPat' => $apellidoPat,
            ':apellidoMat' => $apellidoMat,
            ':usuario' => $usuario,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':privilegio' => $privilegio
        ])) {
            throw new Exception("Error al actualizar el usuario: " . implode(", ", $stmt->errorInfo()));
        }
        return true;
    }

    public function eliminarUsuario($id) {//funcion para eliminar usuario//
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute([':id' => $id])) {
            throw new Exception("Error al eliminar el usuario: " . implode(", ", $stmt->errorInfo()));
        }
        return true;
    }
}
?>