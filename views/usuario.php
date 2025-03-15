<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
        }
        #sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 15px;
        }
        #content {
            flex: 1;
            padding: 15px;
        }
        #sidebar .nav-link {
            padding: 10px;
            font-weight: bold;
        }
        #sidebar .nav-link.active {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

<div id="sidebar">
    <h4>Menú</h4>
    <nav class="nav flex-column">
        <a class="nav-link" href="usuario.php" data-page="usuarios">Usuarios</a>
        <a class="nav-link" href="clientes.php" data-page="clientes">Clientes</a>
        <a class="nav-link" href="#" data-page="proveedores">Proveedores</a>
        <a class="nav-link" href="cat_serv.php" data-page="catalogo_servicios">Catálogo de Servicios</a>
        <a class="nav-link" href="cat_para.php" data-page="parametros_cortes">Parámetros de Cortes</a>
    </nav>
    <div class="mt-4">
        <span id="//">Admin: Martin Ramirez</span>
        <a href="logout.php" class="btn btn-danger mt-2 w-100">Cerrar Sesión</a>
    </div>
</div>

<div id="content">
    <div class="container mt-4">
        <h1>Gestión de Usuarios</h1>
        <div class="d-flex justify-content-between mb-3">
    <button class="btn btn-success" id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalAgregar">
        Agregar Usuario
    </button>
    <button class="btn btn-info" id="btnImprimir" data-bs-toggle="" data-bs-target="#">
      <a href="../controllers/reportes.php" target="_blank"> <i class="far fa-file-pdf"></i>Imprimir Listado de Clientes </a> <!-- Boton para imprimir reporte en fpdf -->
    </button>
</div>
        
            <table class="table table-bordered" id="tablaUsuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Usuario</th>
                    <th>Privilegio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal para agregar usuario -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarLabel">Agregar Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarUsuario">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="privi_id" class="form-label">Privilegio</label>
                        <select class="form-control" id="privi_id" required>
                            <option value="" disabled selected>Seleccionar Privilegio</option>
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar usuario -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarUsuario">
                    <div class="mb-3">
                        <label for="nombreEditar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoPaternoEditar" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaternoEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoMaternoEditar" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaternoEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuarioEditar" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuarioEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordEditar" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="privi_idEditar" class="form-label">Privilegio</label>
                        <select class="form-control" id="privi_idEditar" required>
                            <option value="" disabled selected>Seleccionar Privilegio</option>
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Cargar los usuarios
        cargarUsuarios();

        function cargarUsuarios() {
            $.post('../controllers/controlador_usuarios.php', { accion: 'obtener' }, function(data) {
                try {
                    const usuarios = JSON.parse(data);
                    let filas = '';
                    usuarios.forEach(u => {
                        filas += `<tr>
                            <td>${u.id}</td>
                            <td>${u.Nombre_Us}</td>
                            <td>${u.ApellidoPat_Us}</td>
                            <td>${u.ApellidoMat_Us}</td>
                            <td>${u.username}</td>
                            <td>${u.privilegio  }</td>
                            <td>
                                <button class="btn btn-warning btn-sm btnEditar" data-id="${u.id}" data-nombre="${u.Nombre_Us}" data-apellido-paterno="${u.ApellidoPat_Us}" data-apellido-materno="${u.ApellidoMat_Us}" data-usuario="${u.username}" data-password="${u.password}" data-privi-id="${u.privi_id}">Editar</button>
                                <button class="btn btn-danger btn-sm btnEliminar" data-id="${u.id}">Eliminar</button>
                            </td>
                        </tr>`;
                    });
                    $('#tablaUsuarios tbody').html(filas);
                } catch (e) {
                    console.error("Error al cargar usuarios:", e.message);
                }
            }).fail(function() {
                alert("Error al comunicarse con el servidor.");
            });
        }

        $('#formAgregarUsuario').submit(function(event) {
    event.preventDefault(); // Evita el envío normal del formulario

    const usuario = {
        nombre: $('#nombre').val(),
        apellidoPaterno: $('#apellidoPaterno').val(),
        apellidoMaterno: $('#apellidoMaterno').val(),
        usuario: $('#usuario').val(),
        password: $('#password').val(),
        privi_id: $('#privi_id').val()
    };

    console.log(usuario);  // Verifica los datos antes de enviarlos

    $.post('../controllers/controlador_usuarios.php', { accion: 'agregar', ...usuario }, function(data) {
        $('#modalAgregar').modal('hide'); // Cierra el modal
        cargarUsuarios(); // Recarga la lista de usuarios en la tabla
    }).fail(function() {
        alert("Error al enviar los datos.");
    });
});


        // Abrir el modal de editar usuario
        $(document).on('click', '.btnEditar', function() {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const apellidoPaterno = $(this).data('apellido-paterno');
            const apellidoMaterno = $(this).data('apellido-materno');
            const usuario = $(this).data('usuario');
          //  const password = $(this).data('password');
            const privi_id = $(this).data('privi-id');

            $('#nombreEditar').val(nombre);
            $('#apellidoPaternoEditar').val(apellidoPaterno);
            $('#apellidoMaternoEditar').val(apellidoMaterno);
            $('#usuarioEditar').val(usuario);
          //  $('#passwordEditar').val(password);
            $('#privi_idEditar').val(privi_id);
            $('#modalEditar').modal('show');
        });

        // Guardar cambios en el usuario
        $('#formEditarUsuario').on('submit', function(e) {
            e.preventDefault();

            const id = $('.btnEditar').data('id'); // Obtiene el id del usuario seleccionado para editar
            const nombre = $('#nombreEditar').val().trim();
            const apellidoPaterno = $('#apellidoPaternoEditar').val().trim();
            const apellidoMaterno = $('#apellidoMaternoEditar').val().trim();
            const usuario = $('#usuarioEditar').val().trim();
            const password = $('#passwordEditar').val().trim();
            const privi_id = $('#privi_idEditar').val();

            $.post('../controllers/controlador_usuarios.php', {
                accion: 'actualizar',
                id: id,
                nombre: nombre,
                apellidoPat: apellidoPaterno,
                apellidoMat: apellidoMaterno,
                usuario: usuario,
                password: password,
                privi_id: privi_id,
            }, function(response) {
                try {
                    const res = JSON.parse(response);
                    if (res.status === 'ok') {
                        $('#modalEditar').modal('hide');
                        cargarUsuarios(); // Recargar la tabla después de guardar los cambios
                    } else {
                        alert("Error al editar el usuario: " + res.error);
                    }
                } catch (e) {
                    alert("Respuesta inesperada del servidor.");
                }
            }).fail(function() {
                alert("Error al conectarse con el servidor.");
            });
        });

        // Confirmar y eliminar usuario
        $(document).on('click', '.btnEliminar', function() {
            const id = $(this).data('id');
            const confirmar = confirm("Esta operación no se puede deshacer.¿Estás seguro de eliminar este Usuario?");
            if (confirmar) {
                $.post('../controllers/controlador_usuarios.php', {
                    accion: 'eliminar',
                    id: id
                }, function(response) {
                    try {
                        const res = JSON.parse(response);
                        if (res.status === 'ok') {
                            cargarUsuarios(); // Recargar la tabla después de eliminar el usuario
                        } else {
                            alert("Error al eliminar el usuario: " + res.error);
                        }
                    } catch (e) {
                        alert("Respuesta inesperada del servidor.");
                    }
                }).fail(function() {
                    alert("Error al conectarse con el servidor.");
                });
            }
        });
    });
</script>
</body>
</html>