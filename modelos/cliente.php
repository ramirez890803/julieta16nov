<?php
require_once '../config/conexion.php';//Llamar a archivo de conexion.

class Cliente {
    private $pdo;

    public function __construct() { // funcion construccion 
        $this->pdo = (new Conexion())->conectar();
    }

    // Método para agregar un cliente
    public function agregarCliente($RFC_clie, $Curp, $nombre_Clie, $ApePatClie, $ApeMatClie, $DomiClie, $Correo_Clie, $TelClie) {
        $sql = "INSERT INTO clientes (RFC_clie, Curp, nombre_Clie, ApePatClie, ApeMatClie, DomiClie, Correo_Clie, TelClie) 
                VALUES (:RFC_clie, :Curp, :nombre_Clie, :ApePatClie, :ApeMatClie, :DomiClie, :Correo_Clie, :TelClie)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':RFC_clie', $RFC_clie);
        $stmt->bindParam(':Curp', $Curp);
        $stmt->bindParam(':nombre_Clie', $nombre_Clie);
        $stmt->bindParam(':ApePatClie', $ApePatClie);
        $stmt->bindParam(':ApeMatClie', $ApeMatClie);
        $stmt->bindParam(':DomiClie', $DomiClie);
        $stmt->bindParam(':Correo_Clie', $Correo_Clie);
        $stmt->bindParam(':TelClie', $TelClie);
        return $stmt->execute();
    }

    // Método para obtener todos los clientes
    public function obtenerClientes() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para actualizar un cliente
    public function actualizarCliente($idclie, $RFC_clie, $Curp, $nombre_Clie, $ApePatClie, $ApeMatClie, $DomiClie, $Correo_Clie, $TelClie) {
        $sql = "UPDATE clientes 
                SET RFC_clie = :RFC_clie, 
                    Curp = :Curp, 
                    nombre_Clie = :nombre_Clie, 
                    ApePatClie = :ApePatClie, 
                    ApeMatClie = :ApeMatClie, 
                    DomiClie = :DomiClie, 
                    Correo_Clie = :Correo_Clie, 
                    TelClie = :TelClie 
                WHERE idclie = :idclie";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idclie', $idclie);
        $stmt->bindParam(':RFC_clie', $RFC_clie);
        $stmt->bindParam(':Curp', $Curp);
        $stmt->bindParam(':nombre_Clie', $nombre_Clie);
        $stmt->bindParam(':ApePatClie', $ApePatClie);
        $stmt->bindParam(':ApeMatClie', $ApeMatClie);
        $stmt->bindParam(':DomiClie', $DomiClie);
        $stmt->bindParam(':Correo_Clie', $Correo_Clie);
        $stmt->bindParam(':TelClie', $TelClie);
        return $stmt->execute();
    }

    // Método para eliminar un cliente
    public function eliminarCliente($idclie) {
        $sql = "DELETE FROM clientes WHERE idclie = :idclie";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idclie', $idclie);
        return $stmt->execute();
    }
}
?>