<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
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
        <a class="nav-link active" href="clientes.php" data-page="clientes">Clientes</a>
        <a class="nav-link" href="proveedores.php" data-page="proveedores">Proveedores</a>
        <a class="nav-link" href="" data-page="catalogo_servicios">Catálogo de Servicios</a>
        <a class="nav-link" href="" data-page="parametros_cortes">Parámetros de Cortes</a>
    </nav>
    <div class="mt-4">
        <span>Admin: Martin Ramirez</span>
        <a href="logout.php" class="btn btn-danger mt-2 w-100">Cerrar Sesión</a>
    </div>
</div>

<div id="content">
    <div class="container mt-4">
        <h1>Gestión de Clientes</h1>
        <button class="btn btn-success mb-3" id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Cliente</button>
        <table class="table table-bordered" id="tablaClientes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>RFC</th>
                    <th>Curp</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Domicilio</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal para agregar cliente -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarLabel">Agregar Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarCliente">
                    <div class="mb-3">
                        <label for="RFC" class="form-label">RFC</label>
                        <input type="text" class="form-control" id="RFC" required>
                    </div>
                    <div class="mb-3">
                        <label for="Curp" class="form-label">Curp</label>
                        <input type="text" class="form-control" id="Curp" required>
                    </div>
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
                        <input type="text" class="form-control" id="apellidoMaterno">
                    </div>
                    <div class="mb-3">
                        <label for="domicilio" class="form-label">Domicilio</label>
                        <input type="text" class="form-control" id="domicilio">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar cliente -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarCliente">
                    <div class="mb-3">
                        <label for="RFCEditar" class="form-label">RFC</label>
                        <input type="text" class="form-control" id="RFCEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="CurpEditar" class="form-label">Curp</label>
                        <input type="text" class="form-control" id="CurpEditar" required>
                    </div>
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
                        <input type="text" class="form-control" id="apellidoMaternoEditar">
                    </div>
                    <div class="mb-3">
                        <label for="domicilioEditar" class="form-label">Domicilio</label>
                        <input type="text" class="form-control" id="domicilioEditar">
                    </div>
                    <div class="mb-3">
                        <label for="correoEditar" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correoEditar">
                    </div>
                    <div class="mb-3">
                        <label for="telefonoEditar" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefonoEditar">
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
        obtenerClientes();

        function obtenerClientes() {
            $.post('../controllers/controlador_clientes.php', { accion: 'obtener' }, function(data) {
                try {
                    const clientes = JSON.parse(data);
                    let filas = '';
                    clientes.forEach(c => {
                        filas += `<tr>
                            <td>${c.idclie}</td>
                            <td>${c.RFC_clie}</td>
                            <td>${c.Curp}</td>
                            <td>${c.nombre_Clie}</td>
                            <td>${c.ApePatClie}</td>
                            <td>${c.ApeMatClie}</td>
                            <td>${c.DomiClie}</td>
                            <td>${c.Correo_Clie}</td>
                            <td>${c.TelClie}</td>
                            <td>
                                <button class="btn btn-warning btnEditar" data-id="${c.idclie}">Editar</button>
                                <button class="btn btn-danger btnEliminar" data-id="${c.idclie}">Eliminar</button>
                            </td>
                        </tr>`;
                    });
                    $('#tablaClientes tbody').html(filas);
                } catch (error) {
                    console.error('Error al obtener los clientes', error);
                }
            });
        }

        $('#formAgregarCliente').submit(function(event) {
            event.preventDefault();
            const cliente = {
                RFC: $('#RFC').val(),
                Curp: $('#Curp').val(),
                nombre: $('#nombre').val(),
                apellidoPaterno: $('#apellidoPaterno').val(),
                apellidoMaterno: $('#apellidoMaterno').val(),
                domicilio: $('#domicilio').val(),
                correo: $('#correo').val(),
                telefono: $('#telefono').val()
            };

            $.post('../controllers/controlador_clientes.php', { accion: 'agregar', ...cliente }, function(data) {
                $('#modalAgregar').modal('hide');
                obtenerClientes();
            });
        });

        $('#tablaClientes').on('click', '.btnEditar', function() {
            const id = $(this).data('id');
            $.post('../controllers/controlador_clientes.php', { accion: 'obtenerCliente', id: id }, function(data) {
                const cliente = JSON.parse(data);
                $('#RFCEditar').val(cliente.RFC_clie);
                $('#CurpEditar').val(cliente.Curp);
                $('#nombreEditar').val(cliente.nombre_Clie);
                $('#apellidoPaternoEditar').val(cliente.ApePatClie);
                $('#apellidoMaternoEditar').val(cliente.ApeMatClie);
                $('#domicilioEditar').val(cliente.DomiClie);
                $('#correoEditar').val(cliente.Correo_Clie);
                $('#telefonoEditar').val(cliente.TelClie);
                $('#modalEditar').modal('show');
            });
        });

        $('#formEditarCliente').submit(function(event) {
            event.preventDefault();
            const cliente = {
                id: $('#RFCEditar').val(),
                RFC: $('#RFCEditar').val(),
                Curp: $('#CurpEditar').val(),
                nombre: $('#nombreEditar').val(),
                apellidoPaterno: $('#apellidoPaternoEditar').val(),
                apellidoMaterno: $('#apellidoMaternoEditar').val(),
                domicilio: $('#domicilioEditar').val(),
                correo: $('#correoEditar').val(),
                telefono: $('#telefonoEditar').val()
            };

            $.post('../controllers/controlador_clientes.php', { accion: 'editar', ...cliente }, function(data) {
                $('#modalEditar').modal('hide');
                obtenerClientes();
            });
        });

        $('#tablaClientes').on('click', '.btnEliminar', function() {
            const id = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
                $.post('../controllers/controlador_clientes.php', { accion: 'eliminar', id: id }, function() {
                    obtenerClientes();
                });
            }
        });
    });
</script>
</body>
</html>