<?php 
require_once '../modelos/usuario.php';

$accion = $_POST['accion'] ?? '';
$usuarioModel = new Usuario();

try {
    switch ($accion) {
        case 'agregar':
            // Validación de campos obligatorios
            if (
                empty($_POST['nombre']) || 
                empty($_POST['apellidoPaterno']) || 
                empty($_POST['apellidoMaterno']) || 
                empty($_POST['usuario']) || 
                empty($_POST['password']) || 
                empty($_POST['privi_id'])
            ) {
                echo json_encode(['status' => 'error', 'error' => "Todos los campos son obligatorios."]);
                exit;
            }
        
            // Sanitizar y validar datos
            $nombre = htmlspecialchars($_POST['nombre']);
            $apellidoPat = htmlspecialchars($_POST['apellidoPaterno']);
            $apellidoMat = htmlspecialchars($_POST['apellidoMaterno']);
            $usuario = htmlspecialchars($_POST['usuario']);
            $password = $_POST['password'];
            $privi_id = (int)$_POST['privi_id'];
        
            // Validaciones adicionales del lado del servidor para el Nombre del Usuario.
            if (strlen($nombre) < 3) {
                echo json_encode(['status' => 'error', 'error' => "El Nombre debe tener al menos 3 letras."]);
                exit;
            }
            
            if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $nombre)) {
                echo json_encode(['status' => 'error', 'error' => "El Nombre solo puede contener letras."]);
                exit;
            }
        
            if (strlen($apellidoPat) < 3) {
                echo json_encode(['status' => 'error', 'error' => "El Apellido Paterno debe tener al menos 3 letras."]);
                exit;
            }
               // Validaciones adicionales del lado del servidor para el apellido Paterno del Usuario.
            if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/', $apellidoPat)) {
                echo json_encode(['status' => 'error', 'error' => "El Apellido Paterno solo puede contener letras."]);
                exit;
            }
                    // Validar que el usuario no exista ya en la base de datos
            if ($usuarioModel->usuarioExiste($usuario)) {
                echo json_encode(['status' => 'error', 'campo' => 'usuario', 'error' => "El nombre de usuario ya está en uso en base de datos."]);
                exit;
            }

            // Llamar al método del modelo
            if ($usuarioModel->agregarUsuario($nombre, $apellidoPat, $apellidoMat, $usuario, $password, $privi_id)) {
                echo json_encode(['status' => 'ok']);
            } else {
                echo json_encode(['status' => 'error', 'error' => "Error al agregar el usuario."]);
            }
            break;

        case 'obtener':
            // Obtener usuarios y enviarlos como JSON
            $usuarios = $usuarioModel->obtenerUsuarios();
            echo json_encode($usuarios);
            break;

        case 'actualizar':
            // Validación de campos obligatorios
            if (
                empty($_POST['id']) || 
                empty($_POST['nombre']) || 
                empty($_POST['apellidoPat']) || 
                empty($_POST['apellidoMat']) || 
                empty($_POST['usuario']) || 
                empty($_POST['password']) || 
                empty($_POST['privi_id'])
            ) {
                throw new Exception("Todos los campos son obligatorios.");
            }

            // Sanitizar datos
            $id = (int)$_POST['id'];
            $nombre = htmlspecialchars($_POST['nombre']);
            $apellidoPat = htmlspecialchars($_POST['apellidoPat']);
            $apellidoMat = htmlspecialchars($_POST['apellidoMat']);
            $usuario = htmlspecialchars($_POST['usuario']);
            $password = htmlspecialchars($_POST['password']);
            $privi_id = (int)$_POST['privi_id'];

            //llama al controlador para ejecutar la sentencia de validacion//
            if ($usuarioModel->usuarioExisteExcepto($usuario, $id)) {
                echo json_encode(['status' => 'error', 'campo' => 'usuario', 'error' => "El nombre de usuario ya está en uso en base de datos."]);
                exit;
            }

            // Llamar al método del modelo
            if ($usuarioModel->actualizarUsuario($id, $nombre, $apellidoPat, $apellidoMat, $usuario, $password, $privi_id)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al actualizar el usuario.");
            }
            break; // //  


        case 'eliminar':
            // Validación de campo obligatorio
            if (empty($_POST['id'])) {
                throw new Exception("ID del usuario es obligatorio.");
            }

            $id = (int)$_POST['id'];

            // Llamar al método del modelo
            if ($usuarioModel->eliminarUsuario($id)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al eliminar el usuario.");
            }
            break; ///  


        default:
            throw new Exception("Acción no válida.");
    }
} catch (Exception $e) {
    // Respuesta de error
    echo json_encode(['error' => $e->getMessage()]);
}
?>
