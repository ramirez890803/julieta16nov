<?php 
require_once '../modelos/cliente.php';

$accion = $_POST['accion'] ?? '';
$clienteModel = new Cliente();

try {
    switch ($accion) {
        case 'agregar':
            // Validación de campos obligatorios
            if (
                empty($_POST['rfc']) || 
                empty($_POST['curp']) || 
                empty($_POST['nombre']) || 
                empty($_POST['apellidoPaterno'])
            ) {
                throw new Exception("Los campos RFC, CURP, nombre y apellido paterno son obligatorios.");
            }

            // Sanitizar datos
            $RFC_clie = htmlspecialchars($_POST['rfc']);
            $Curp = htmlspecialchars($_POST['curp']);
            $nombre_Clie = htmlspecialchars($_POST['nombre']);
            $ApePatClie = htmlspecialchars($_POST['apellidoPaterno']);
            $ApeMatClie = htmlspecialchars($_POST['apellidoMaterno'] ?? '');
            $DomiClie = htmlspecialchars($_POST['domicilio'] ?? '');
            $Correo_Clie = htmlspecialchars($_POST['correo'] ?? '');
            $TelClie = htmlspecialchars($_POST['telefono'] ?? '');

            // Llamar al método del modelo
            if ($clienteModel->agregarCliente($RFC_clie, $Curp, $nombre_Clie, $ApePatClie, $ApeMatClie, $DomiClie, $Correo_Clie, $TelClie)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al agregar el cliente.");
            }
            break;

        case 'obtener':
            // Obtener clientes y enviarlos como JSON
            $clientes = $clienteModel->obtenerClientes();
            echo json_encode($clientes);
            break;

        case 'actualizar':
            // Validación de campos obligatorios
            if (
                empty($_POST['idclie']) || 
                empty($_POST['RFC_clie']) || 
                empty($_POST['Curp']) || 
                empty($_POST['nombre_Clie']) || 
                empty($_POST['ApePatClie'])
            ) {
                throw new Exception("Los campos ID, RFC, CURP, nombre y apellido paterno son obligatorios.");
            }

            // Sanitizar datos
            $idclie = (int)$_POST['idclie'];
            $RFC_clie = htmlspecialchars($_POST['RFC_clie']);
            $Curp = htmlspecialchars($_POST['Curp']);
            $nombre_Clie = htmlspecialchars($_POST['nombre_Clie']);
            $ApePatClie = htmlspecialchars($_POST['ApePatClie']);
            $ApeMatClie = htmlspecialchars($_POST['ApeMatClie'] ?? '');
            $DomiClie = htmlspecialchars($_POST['DomiClie'] ?? '');
            $Correo_Clie = htmlspecialchars($_POST['Correo_Clie'] ?? '');
            $TelClie = htmlspecialchars($_POST['TelClie'] ?? '');

            // Llamar al método del modelo
            if ($clienteModel->actualizarCliente($idclie, $RFC_clie, $Curp, $nombre_Clie, $ApePatClie, $ApeMatClie, $DomiClie, $Correo_Clie, $TelClie)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al actualizar el cliente.");
            }
            break;

        case 'eliminar':
            // Validación de campo obligatorio
            if (empty($_POST['idclie'])) {
                throw new Exception("ID del cliente es obligatorio.");
            }

            $idclie = (int)$_POST['idclie'];

            // Llamar al método del modelo
            if ($clienteModel->eliminarCliente($idclie)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al eliminar el cliente.");
            }
            break;

        default:
            throw new Exception("Acción no válida.");
    }
} catch (Exception $e) {
    // Respuesta de error
    echo json_encode(['error' => $e->getMessage()]);
}
?>