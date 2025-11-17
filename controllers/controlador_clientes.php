<?php
require_once '../modelos/cliente.php';

$accion = $_POST['accion'] ?? '';
$clienteModel = new Cliente();

try {
    switch ($accion) {
        case 'agregar':
            if (
                empty($_POST['RFC_clie']) || 
                empty($_POST['Curp']) || 
                empty($_POST['nombre_Clie']) || 
                empty($_POST['ApePatClie'])
            ) {
                throw new Exception("Los campos RFC, CURP, nombre y apellido paterno son obligatorios.");
            }

            $RFC_clie    = htmlspecialchars($_POST['RFC_clie']);
            $Curp        = htmlspecialchars($_POST['Curp']);
            $nombre_Clie = htmlspecialchars($_POST['nombre_Clie']);
            $ApePatClie  = htmlspecialchars($_POST['ApePatClie']);
            $ApeMatClie  = htmlspecialchars($_POST['ApeMatClie'] ?? '');
            $DomiClie    = htmlspecialchars($_POST['DomiClie'] ?? '');
            $Correo_Clie = htmlspecialchars($_POST['Correo_Clie'] ?? '');
            $TelClie     = htmlspecialchars($_POST['TelClie'] ?? '');

            if (!preg_match('/^([A-ZÑ&]{3,4})?(\d{6})?([A-Z\d]{3})?$/i', $RFC_clie)) {
                throw new Exception("RFC inválido.");
            }
            if (!preg_match('/^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z\d]{2}$/i', $Curp)) {
                throw new Exception("CURP inválido.");
            }
            if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $nombre_Clie)) {
                throw new Exception("El nombre solo debe contener letras.");
            }
            if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $ApePatClie)) {
                throw new Exception("El apellido paterno solo debe contener letras.");
            }
            if ($Correo_Clie && !filter_var($Correo_Clie, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Correo inválido.");
            }
            if ($TelClie && !preg_match('/^\d{10}$/', $TelClie)) {
                throw new Exception("Teléfono inválido.");
            }

            // En agregar, se define el idclie en 0 para evitar warning
            $idclie = 0;
            if ($clienteModel->RFC_clieExiste($RFC_clie)) {
                throw new Exception("La RFC ya en Base de Datos Asignado a otro cliente.");
            }
            if ($clienteModel->CurpExiste($Curp)) {
                throw new Exception("La CURP ya existe en Base de Datos Asignado a otro cliente.");
            }

            if ($clienteModel->agregarCliente($RFC_clie, $Curp, $nombre_Clie, $ApePatClie, $ApeMatClie, $DomiClie, $Correo_Clie, $TelClie)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al agregar el cliente.");
            }
            break;

        case 'obtener':
            $clientes = $clienteModel->obtenerClientes();
            echo json_encode($clientes);
            break;

            case 'actualizar':
                if (
                    empty($_POST['idclie']) || 
                    empty($_POST['RFC_clie']) || 
                    empty($_POST['Curp']) || 
                    empty($_POST['nombre_Clie']) || 
                    empty($_POST['ApePatClie'])
                ) {
                    throw new Exception("Todos los campos obligatorios deben completarse.");
                }
            
                $idclie = (int)($_POST['idclie'] ?? 0);
                $RFC_clie    = htmlspecialchars($_POST['RFC_clie']);
                $Curp        = htmlspecialchars($_POST['Curp']);
                $nombre_Clie = htmlspecialchars($_POST['nombre_Clie']);
                $ApePatClie  = htmlspecialchars($_POST['ApePatClie']);
                $ApeMatClie  = htmlspecialchars($_POST['ApeMatClie'] ?? '');
                $DomiClie    = htmlspecialchars($_POST['DomiClie'] ?? '');
                $Correo_Clie = htmlspecialchars($_POST['Correo_Clie'] ?? '');
                $TelClie     = htmlspecialchars($_POST['TelClie'] ?? '');
            
                if (!preg_match('/^([A-ZÑ&]{3,4})?(\d{6})?([A-Z\d]{3})?$/i', $RFC_clie)) {
                    throw new Exception("RFC inválido.");
                }
                if (!preg_match('/^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z\d]{2}$/i', $Curp)) {
                    throw new Exception("CURP inválido.");
                }
                if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $nombre_Clie)) {
                    throw new Exception("El nombre solo debe contener letras.");
                }
                if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $ApePatClie)) {
                    throw new Exception("El apellido paterno solo debe contener letras.");
                }
                if ($Correo_Clie && !filter_var($Correo_Clie, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Correo inválido.");
                }
                if ($TelClie && !preg_match('/^\d{10}$/', $TelClie)) {
                    throw new Exception("Teléfono inválido.");
                }
            
                // En la actualización, se pasa el ID actual para excluirlo en la validación
                if ($clienteModel->RFC_clieExiste($RFC_clie, $idclie)) {
                    throw new Exception("La RFC ya existe en Base de Datos Asignado a otro cliente.");
                }
                if ($clienteModel->CurpExiste($Curp, $idclie)) {
                    throw new Exception("La CURP ya existe Base de Datos Asignado a otro cliente..");
                }
            
                if ($clienteModel->actualizarCliente($idclie, $RFC_clie, $Curp, $nombre_Clie, $ApePatClie, $ApeMatClie, $DomiClie, $Correo_Clie, $TelClie)) {
                    echo json_encode(['status' => 'ok']);
                } else {
                    throw new Exception("Error al actualizar el cliente.");
                }
                break;

        case 'eliminar':
            if (empty($_POST['idclie'])) {
                throw new Exception("ID del cliente es obligatorio.");
            }
    
            $idclie = (int)$_POST['idclie'];
    
            if ($clienteModel->eliminarCliente($idclie)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al eliminar el usuario.");
            }
            break;
    }
} catch (Exception $e) {
    $mensaje = $e->getMessage();
    // Determinar el campo según el mensaje
    $campo = "";
    if (strpos($mensaje, "CURP") !== false) {
        $campo = "Curp";
    } elseif (strpos($mensaje, "RFC") !== false) {
        $campo = "RFC";
    }
    echo json_encode(['error' => $mensaje, 'campo' => $campo]);
}
?>