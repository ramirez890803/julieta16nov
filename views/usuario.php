<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../styles/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- FontAwesome -->
</head>
<body>
<!-- Menu lateral -->
    <div id="sidebar" class="bg-dark text-white p-3">
        <h4 class="text-center mb-4">Menú</h4>
        <nav class="nav flex-column">
            <a class="nav-link text-white py-3" href="usuario.php" data-page="usuarios">
                <i class="fas fa-users me-3"></i>Usuarios
            </a>
            <a class="nav-link text-white py-3" href="clientes.php" data-page="clientes">
                <i class="fas fa-address-book me-3"></i>Clientes
            </a>
            <a class="nav-link text-white py-3" href="#" data-page="proveedores">
                <i class="fas fa-truck me-3"></i>Proveedores
            </a>
            <a class="nav-link text-white py-3" href="cat_serv.php" data-page="catalogo_servicios">
                <i class="fas fa-cogs me-3"></i>Catálogo de Servicios
            </a>
            <a class="nav-link text-white py-3" href="cat_para.php" data-page="parametros_cortes">
                <i class="fas fa-sliders-h me-3"></i>Parámetros de Cortes
            </a>
        </nav>
        <div class="mt-4 text-center">
            <span>Admin: Martin Ramirez</span>
            <a href="logout.php" class="btn btn-danger mt-2 w-100">Cerrar Sesión</a>
        </div>
    </div>

    <div id="content" class="container-fluid">
        <div class="container mt-4">
            <h1>Gestión de Usuarios</h1>
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-custom" id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                    <i class="fas fa-plus"></i>Agregar Usuario
                </button>
                <button class="btn btn-custom-imprimir" id="btnImprimir" data-bs-toggle="" data-bs-target="#">
                    <a href="../controllers/reportes.php" target="_blank"><i class="far fa-file-pdf"></i>Imprimir Listado de Usuarios</a>
                </button>
            </div>

            <div class="table-responsive">
            <table class="table table-bordered display"  id="tablaUsuarios">
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
                            <div class="invalid-feedback" id="errorNombre"></div>
                        </div>
                        <div class="mb-3">
                            <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellidoPaterno" required>
                            <div class="invalid-feedback" id="errorApellidoPaterno"></div>
                        </div>
                        <div class="mb-3">
                            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellidoMaterno" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" required>
                            <div class="invalid-feedback" id="errorUsuario"></div>

                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                            <div class="invalid-feedback" id="errorPassword"></div>
                        </div>
                        <div class="mb-3">
                            <label for="privi_id" class="form-label">Privilegio</label>
                            <select class="form-control" id="privi_id" required>
                                <option value="" disabled selected>Seleccionar Privilegio</option>
                                <option value="1">Administrador</option>
                                <option value="2">Estilista</option>
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
                    <input type="hidden" id="usuarioId"> <!-- Campo oculto para el ID del usuario -->
                    <div class="mb-3">
                        <label for="nombreEditar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreEditar" required>
                        <div class="invalid-feedback" id="errorNombreEditar"></div>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoPaternoEditar" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaternoEditar" required>
                        <div class="invalid-feedback" id="errorApellidoPaternoEditar"></div>
                    </div>
                    <div class="mb-3">
                        <label for="apellidoMaternoEditar" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaternoEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuarioEditar" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuarioEditar" required>
                        <div class="invalid-feedback" id="errorUsuarioEditar"></div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordEditar" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordEditar" required>
                        <div class="invalid-feedback" id="errorPasswordEditar"></div>
                    </div>
                    <div class="mb-3">
                        <label for="privi_idEditar" class="form-label">Privilegio</label>
                        <select class="form-control" id="privi_idEditar" required>
                           <option value="" disabled selected>Seleccionar Privilegio</option>
                                <option value="1">Administrador</option>
                                <option value="2">Estilista</option>
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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</body>
</html>
</body>
</html>
<script>

$(document).ready(function() {
    // Inicialización de DataTable
    const tabla = $('#tablaUsuarios').DataTable({
        language: { 
            url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
        },
        responsive: true
    });

    // Cargar los usuarios
    cargarUsuarios();

    function cargarUsuarios() {
        $.post('../controllers/controlador_usuarios.php', { accion: 'obtener' }, function(data) {
            try {
                const usuarios = JSON.parse(data);
                tabla.clear();  // Limpiar la tabla antes de agregar nuevos datos
                usuarios.forEach(u => {
                    tabla.row.add([
                        u.id,
                        u.Nombre_Us,
                        u.ApellidoPat_Us,
                        u.ApellidoMat_Us,
                        u.username,
                        u.privilegio,
                        `<button class="btn btn-warning btn-sm btnEditar" data-id="${u.id}" data-nombre="${u.Nombre_Us}" data-apellido-paterno="${u.ApellidoPat_Us}" data-apellido-materno="${u.ApellidoMat_Us}" data-usuario="${u.username}" data-password="${u.password}" data-privi-id="${u.privi_id}">Editar</button>
                         <button class="btn btn-danger btn-sm btnEliminar" data-id="${u.id}">Eliminar</button>`
                    ]);
                });
                tabla.draw();  // Redibujar la tabla con los nuevos datos
            } catch (e) {
                console.error("Error al cargar usuarios:", e.message);
                alert("Error al cargar usuarios");
            }
        }).fail(function() {
            alert("Error al comunicarse con el servidor.");
        });
    }
        $('#formAgregarUsuario').submit(function(event) {
    event.preventDefault();

    // Limpiar estados anteriores
    $('#formAgregarUsuario input').removeClass('is-invalid');
    $('.invalid-feedback').text('');

    const nombre = $('#nombre').val().trim();
    const apellidoPaterno = $('#apellidoPaterno').val().trim();
    const apellidoMaterno = $('#apellidoMaterno').val().trim();
    const usuario = $('#usuario').val().trim();
    const password = $('#password').val().trim();
    const privi_id = $('#privi_id').val();

       // Expresión regular para solo letras (incluye acentos y espacios)
const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

let errores = false;

// Validación para nombre
if (!nombre) {
    $('#nombre').addClass('is-invalid');
    $('#errorNombre').text("El Nombre no puede estar vacío.");
    errores = true;
} else if (nombre.length < 3) {
    $('#nombre').addClass('is-invalid');
    $('#errorNombre').text("El Nombre debe tener al menos 3 letras.");
    errores = true;
} else if (!soloLetras.test(nombre)) {
    $('#nombre').addClass('is-invalid');
    $('#errorNombre').text("El Nombre solo puede contener letras.");
    errores = true;
}

// Validación para apellido paterno
if (!apellidoPaterno) {
    $('#apellidoPaterno').addClass('is-invalid');
    $('#errorApellidoPaterno').text("El campo Apellido Paterno no puede estar vacío.");
    errores = true;
} else if (apellidoPaterno.length < 3) {
    $('#apellidoPaterno').addClass('is-invalid');
    $('#errorApellidoPaterno').text("El Apellido Paterno debe tener al menos 3 letras.");
    errores = true;
} else if (!soloLetras.test(apellidoPaterno)) {
    $('#apellidoPaterno').addClass('is-invalid');
    $('#errorApellidoPaterno').text("El Apellido Paterno solo puede contener letras.");
    errores = true;
}

// Validación para usuario
if (!usuario) {
    $('#usuario').addClass('is-invalid');
    $('#errorUsuario').text("El campo Usuario no puede estar vacío.");
    errores = true;
}



// Validación para contraseña
if (!password) {
    $('#password').addClass('is-invalid');
    $('#errorPassword').text("El campo Password no puede estar vacío.");
    errores = true;
}

// Validación para privilegio
if (!privi_id) {
    alert("Debes seleccionar un privilegio.");
    errores = true;
}

if (errores) {
    return; // Detener envío si hay errores
}
    const datos = {
        nombre,
        apellidoPaterno,
        apellidoMaterno,
        usuario,
        password,
        privi_id
    };

    $.post('../controllers/controlador_usuarios.php', { accion: 'agregar', ...datos }, function(data) {
        try {
            const respuesta = JSON.parse(data);

            if (respuesta.status === 'ok') {
                $('#modalAgregar').modal('hide');
                $('#formAgregarUsuario')[0].reset();
                cargarUsuarios();
            } else if (respuesta.status === 'error') {
    const campo = respuesta.campo;
    const mensaje = respuesta.error;

    if (campo === 'nombre') {
        $('#nombre').addClass('is-invalid');
        $('#errorNombre').text(mensaje);
    }

    if (campo === 'apellidoPaterno') {
        $('#apellidoPaterno').addClass('is-invalid');
        $('#errorApellidoPaterno').text(mensaje);
    }

    if (campo === 'usuario') {
        $('#usuario').addClass('is-invalid');
        $('#errorUsuario').text(mensaje);
    }

    if (campo === 'password') {
        $('#password').addClass('is-invalid');
        $('#errorPassword').text(mensaje);
    }
            }
        } catch (e) {
            console.error("Error de formato en la respuesta del servidor:", e);
        }
    }).fail(function() {
        alert("Error al comunicarse con el servidor.");
    });
});

$(document).on('click', '.btnEditar', function() {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const apellidoPaterno = $(this).data('apellido-paterno');
            const apellidoMaterno = $(this).data('apellido-materno');
            const usuario = $(this).data('usuario');
            const privi_id = $(this).data('privi-id');

            $('#usuarioId').val(id);
            $('#nombreEditar').val(nombre);
            $('#apellidoPaternoEditar').val(apellidoPaterno);
            $('#apellidoMaternoEditar').val(apellidoMaterno);
            $('#usuarioEditar').val(usuario);
            $('#privi_idEditar').val(privi_id);
            $('#passwordEditar').val('');

            $('#modalEditar').modal('show');
        });

        $(document).on('click', '.btnEditar', function() {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const apellidoPaterno = $(this).data('apellido-paterno');
            const apellidoMaterno = $(this).data('apellido-materno');
            const usuario = $(this).data('usuario');
            const privi_id = $(this).data('privi-id');

            $('#usuarioId').val(id);
            $('#nombreEditar').val(nombre);
            $('#apellidoPaternoEditar').val(apellidoPaterno);
            $('#apellidoMaternoEditar').val(apellidoMaterno);
            $('#usuarioEditar').val(usuario);
            $('#privi_idEditar').val(privi_id);
            $('#passwordEditar').val('');

            $('#modalEditar').modal('show');
        });


$('#formEditarUsuario').submit(function(e) {
    e.preventDefault();

    // Limpiar errores anteriores
    $('#formEditarUsuario input').removeClass('is-invalid');
    $('#formEditarUsuario .invalid-feedback').text('');

    const id = $('#usuarioId').val();
    const nombre = $('#nombreEditar').val().trim();
    const apellidoPaterno = $('#apellidoPaternoEditar').val().trim();
    const apellidoMaterno = $('#apellidoMaternoEditar').val().trim();
    const usuario = $('#usuarioEditar').val().trim();
    const password = $('#passwordEditar').val().trim();
    const privi_id = $('#privi_idEditar').val();

    const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
    let errores = false;

    if (!nombre) {
        $('#nombreEditar').addClass('is-invalid');
        $('#errorNombreEditar').text("El Nombre no puede estar vacío.");
        errores = true;
    } else if (nombre.length < 3) {
        $('#nombreEditar').addClass('is-invalid');
        $('#errorNombreEditar').text("El Nombre debe tener al menos 3 letras.");
        errores = true;
    } else if (!soloLetras.test(nombre)) {
        $('#nombreEditar').addClass('is-invalid');
        $('#errorNombreEditar').text("El Nombre solo puede contener letras.");
        errores = true;
    }

    if (!apellidoPaterno) {
        $('#apellidoPaternoEditar').addClass('is-invalid');
        $('#errorApellidoPaternoEditar').text("El Apellido Paterno no puede estar vacío.");
        errores = true;
    } else if (apellidoPaterno.length < 3) {
        $('#apellidoPaternoEditar').addClass('is-invalid');
        $('#errorApellidoPaternoEditar').text("Debe tener al menos 3 letras.");
        errores = true;
    } else if (!soloLetras.test(apellidoPaterno)) {
        $('#apellidoPaternoEditar').addClass('is-invalid');
        $('#errorApellidoPaternoEditar').text("Solo puede contener letras.");
        errores = true;
    }

    if (!usuario) {
        $('#usuarioEditar').addClass('is-invalid');
        $('#errorUsuarioEditar').text("El campo Usuario no puede estar vacío.");
        errores = true;
    }

    if (!password) {
        $('#passwordEditar').addClass('is-invalid');
        $('#errorPasswordEditar').text("El campo Password no puede estar vacío.");
        errores = true;
    }

    if (!privi_id) {
        alert("Debes seleccionar un privilegio.");
        errores = true;
    }

    if (errores) return;

    $.post('../controllers/controlador_usuarios.php', {
        accion: 'actualizar',
        id,
        nombre,
        apellidoPat: apellidoPaterno,
        apellidoMat: apellidoMaterno,
        usuario,
        password,
        privi_id
    }, function(response) {
        try {
            const res = JSON.parse(response);
            if (res.status === 'ok') {
                $('#modalEditar').modal('hide');
                cargarUsuarios();
            } else if (res.status === 'error') {
                const campo = res.campo;
                const mensaje = res.error;

                if (campo === 'nombre') {
                    $('#nombreEditar').addClass('is-invalid');
                    $('#errorNombreEditar').text(mensaje);
                }
                if (campo === 'apellidoPaterno') {
                    $('#apellidoPaternoEditar').addClass('is-invalid');
                    $('#errorApellidoPaternoEditar').text(mensaje);
                }
                if (campo === 'usuario') {
                    $('#usuarioEditar').addClass('is-invalid');
                    $('#errorUsuarioEditar').text(mensaje);
                }
                if (campo === 'password') {
                    $('#passwordEditar').addClass('is-invalid');
                    $('#errorPasswordEditar').text(mensaje);
                }
            }
        } catch (e) {
            alert("Respuesta inesperada del servidor.");
        }
    }).fail(function() {
        alert("Error al comunicarse con el servidor.");
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