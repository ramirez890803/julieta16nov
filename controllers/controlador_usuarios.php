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
                throw new Exception("Todos los campos son obligatorios.");
            }

            // Sanitizar datos
            $nombre = htmlspecialchars($_POST['nombre']);
            $apellidoPat = htmlspecialchars($_POST['apellidoPaterno']);
            $apellidoMat = htmlspecialchars($_POST['apellidoMaterno']);
            $usuario = htmlspecialchars($_POST['usuario']);
            $password = htmlspecialchars($_POST['password']);
            $privi_id = (int)$_POST['privi_id'];

            // Llamar al método del modelo
            if ($usuarioModel->agregarUsuario($nombre, $apellidoPat, $apellidoMat, $usuario, $password, $privi_id)) {
                echo json_encode(['status' => 'ok']);
            } else {
                throw new Exception("Error al agregar el usuario.");
            }
            break; //  

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
