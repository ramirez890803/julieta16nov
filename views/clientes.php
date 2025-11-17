<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../styles/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
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
            <h1>Gestión de Cliente</h1>
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-custom" id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                    <i class="fas fa-plus"></i>Agregar Cliente
                </button>
                <button class="btn btn-custom-imprimir" id="btnImprimir" data-bs-toggle="" data-bs-target="#">
                    <a href="../controllers/reportes_cliente.php" target="_blank"><i class="far fa-file-pdf"></i>Imprimir Listado de Clientes</a>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered display" id="tablaClientes">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RFC</th>
                            <th>CURP</th>
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
    </div>

    <!-- Modal Agregar Cliente -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarLabel">Agregar Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="clienteForm">
                        <div class="mb-3">
                            <label for="RFC_clie" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="RFC_clie" required>
                            <div class="invalid-feedback" id="errorRFC"></div>
                        </div>
                        <div class="mb-3">
                            <label for="Curp" class="form-label">CURP</label>
                            <input type="text" class="form-control" id="Curp" required>
                            <div class="invalid-feedback" id="errorCurp"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nombre_Clie" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_Clie" required>
                            <div class="invalid-feedback" id="errorNombre"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ApePatClie" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="ApePatClie" required>
                            <div class="invalid-feedback" id="errorApellidoPaterno"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ApeMatClie" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="ApeMatClie">
                            <div class="invalid-feedback" id="errorApellidoMaterno"></div>
                        </div>
                        <div class="mb-3">
                            <label for="DomiClie" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="DomiClie">
                        </div>
                        <div class="mb-3">
                            <label for="Correo_Clie" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="Correo_Clie">
                            <div class="invalid-feedback" id="errorCorreo"></div>
                        </div>
                        <div class="mb-3">
                            <label for="TelClie" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="TelClie">
                            <div class="invalid-feedback" id="errorTelefono"></div>
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
                        <input type="hidden" id="idclieEditar">
                        <div class="mb-3">
                            <label for="RFC_clieEditar" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="RFC_clieEditar" required>
                            <div class="invalid-feedback" id="errorRFCEd"></div>
                        </div>
                        <div class="mb-3">
                            <label for="CurpEditar" class="form-label">CURP</label>
                            <input type="text" class="form-control" id="CurpEditar" required>
                            <div class="invalid-feedback" id="errorCurpEd"></div>
                        </div>
                        <div class="mb-3">
                            <label for="nombre_ClieEditar" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_ClieEditar" required>
                            <div class="invalid-feedback" id="errorNombreEd"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ApePatClieEditar" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="ApePatClieEditar" required>
                            <div class="invalid-feedback" id="errorApellidoPaternoEd"></div>
                        </div>
                        <div class="mb-3">
                            <label for="ApeMatClieEditar" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="ApeMatClieEditar">
                            <div class="invalid-feedback" id="errorApellidoMaternoEd"></div>
                        </div>
                        <div class="mb-3">
                            <label for="DomiClieEditar" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="DomiClieEditar">
                        </div>
                        <div class="mb-3">
                            <label for="Correo_ClieEditar" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="Correo_ClieEditar">
                            <div class="invalid-feedback" id="errorCorreoEd"></div>
                        </div>
                        <div class="mb-3">
                            <label for="TelClieEditar" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="TelClieEditar">
                            <div class="invalid-feedback" id="errorTelefonoEd"></div>
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
    <script>
  let tabla;
  $(document).ready(function() {
    // Inicialización de DataTable
    tabla = $('#tablaClientes').DataTable({
      language: { 
        url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
      },
      responsive: true
    });

    cargarClientes();

    function cargarClientes() {
      $.post('../controllers/controlador_clientes.php', { accion: 'obtener' }, function (data) {
        try {
          const clientes = JSON.parse(data);
          tabla.clear();
          clientes.forEach(c => {
            tabla.row.add([
              c.idclie,
              c.RFC_clie,
              c.Curp,
              c.nombre_Clie,
              c.ApePatClie,
              c.ApeMatClie,
              c.DomiClie,
              c.Correo_Clie,
              c.TelClie,
              `<button class="btn btn-warning btn-sm btnEditar" data-idclie="${c.idclie}">Editar</button>
               <button class="btn btn-danger btn-sm btnEliminar" data-idclie="${c.idclie}">Eliminar</button>`
            ]);
          });
          tabla.draw();
        } catch (e) {
          alert('Error al cargar los clientes');
        }
      }).fail(function() {
        alert("Error al conectarse con el servidor.");
      });
    }

    // Expresiones regulares de validación (igual que en el servidor)
    const rfcPattern = /^([A-ZÑ&]{3,4})?(\d{6})?([A-Z\d]{3})?$/i;
    const curpPattern = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z\d]{2}$/i;
    const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const telPattern = /^\d{10}$/;

    // VALIDACIONES PARA AGREGAR CLIENTE
    $('#clienteForm').submit(function (event) {
  event.preventDefault();
  $('#clienteForm input').removeClass('is-invalid');
  $('.invalid-feedback').text('');

  // Obtener valores
  const rfc = $('#RFC_clie').val().trim();
  const curp = $('#Curp').val().trim();
  const nombre = $('#nombre_Clie').val().trim();
  const apePat = $('#ApePatClie').val().trim();
  const apeMat = $('#ApeMatClie').val().trim();
  const domicilio = $('#DomiClie').val().trim();
  const correo = $('#Correo_Clie').val().trim();
  const telefono = $('#TelClie').val().trim();
  let errores = false;

  // Validar RFC (obligatorio y con patrón)
  if (!rfc) {
    $('#RFC_clie').addClass('is-invalid');
    $('#errorRFC').text("El RFC es obligatorio.");
    errores = true;
  } else if (!rfcPattern.test(rfc)) {
    $('#RFC_clie').addClass('is-invalid');
    $('#errorRFC').text("RFC inválido.");
    errores = true;
  }

  // Validar CURP (obligatorio y con patrón)
  if (!curp) {
    $('#Curp').addClass('is-invalid');
    $('#errorCurp').text("El CURP es obligatorio.");
    errores = true;
  } else if (!curpPattern.test(curp)) {
    $('#Curp').addClass('is-invalid');
    $('#errorCurp').text("CURP inválido.");
    errores = true;
  }

  // Validar Nombre
  if (!nombre) {
    $('#nombre_Clie').addClass('is-invalid');
    $('#errorNombre').text("El nombre es obligatorio.");
    errores = true;
  } else if (!soloLetras.test(nombre)) {
    $('#nombre_Clie').addClass('is-invalid');
    $('#errorNombre').text("El nombre solo debe contener letras.");
    errores = true;
  }

  // Validar Apellido Paterno
  if (!apePat) {
    $('#ApePatClie').addClass('is-invalid');
    $('#errorApellidoPaterno').text("El apellido paterno es obligatorio.");
    errores = true;
  } else if (!soloLetras.test(apePat)) {
    $('#ApePatClie').addClass('is-invalid');
    $('#errorApellidoPaterno').text("El apellido paterno solo debe contener letras.");
    errores = true;
  }

  // Validar Apellido Materno (opcional)
  if (apeMat && !soloLetras.test(apeMat)) {
    $('#ApeMatClie').addClass('is-invalid');
    $('#errorApellidoMaterno').text("El apellido materno solo debe contener letras.");
    errores = true;
  }

  // Validar correo (opcional)
  if (correo && !emailPattern.test(correo)) {
    $('#Correo_Clie').addClass('is-invalid');
    $('#errorCorreo').text("Correo inválido.");
    errores = true;
  }

  // Validar teléfono (opcional, 10 dígitos)
  if (telefono && !telPattern.test(telefono)) {
    $('#TelClie').addClass('is-invalid');
    $('#errorTelefono').text("Teléfono inválido.");
    errores = true;
  }

  if (errores) return;

  // Enviar también idclie:0 para evitar warnings en el controlador
  const datos = {
    idclie: 0,
    RFC_clie: rfc,
    Curp: curp,
    nombre_Clie: nombre,
    ApePatClie: apePat,
    ApeMatClie: apeMat,
    DomiClie: domicilio,
    Correo_Clie: correo,
    TelClie: telefono,
    accion: 'agregar'
  };

  $.post('../controllers/controlador_clientes.php', datos, function (response) {
    console.log(response); // Para depurar
    try {
      const res = JSON.parse(response);
      if (res.status === 'ok') {
        $('#modalAgregar').modal('hide');
        $('#clienteForm')[0].reset();
        cargarClientes();
      } else {
        if (res.error && res.campo) {
          // Si el controlador devuelve "campo": "RFC", se asigna el error al input con id "RFC_clie" y se muestra en "errorRFC"
          if (res.campo === 'RFC') {
            $('#RFC_clie').addClass('is-invalid');
            $('#errorRFC').text(res.error);
          } else if (res.campo === 'Curp') {
            $('#Curp').addClass('is-invalid');
            $('#errorCurp').text(res.error);
          } else if (res.error && res.campo) {
            $('#' + res.campo).addClass('is-invalid');
            $('#error' + res.campo.charAt(0).toUpperCase() + res.campo.slice(1)).text(res.error);
          }
        } else {
          alert(res.error || 'Ocurrió un error al guardar');
        }
      }
    } catch (e) {
      alert('Error en la respuesta del servidor');
    }
});
    });

    
    // Cargar datos en el modal de edición
    $(document).on('click', '.btnEditar', function () {
      const fila = $(this).closest('tr');
      const datos = tabla.row(fila).data();

      $('#idclieEditar').val(datos[0]);
      $('#RFC_clieEditar').val(datos[1]);
      $('#CurpEditar').val(datos[2]);
      $('#nombre_ClieEditar').val(datos[3]);
      $('#ApePatClieEditar').val(datos[4]);
      $('#ApeMatClieEditar').val(datos[5]);
      $('#DomiClieEditar').val(datos[6]);
      $('#Correo_ClieEditar').val(datos[7]);
      $('#TelClieEditar').val(datos[8]);

      $('#modalEditar').modal('show');
    });

    // VALIDACIONES PARA EDITAR CLIENTE
    $(document).on('click', '.btnEditar', function () {
  const fila = $(this).closest('tr');
  const datos = tabla.row(fila).data();

  $('#idclieEditar').val(datos[0]);
  $('#RFC_clieEditar').val(datos[1]);
  $('#CurpEditar').val(datos[2]);
  $('#nombre_ClieEditar').val(datos[3]);
  $('#ApePatClieEditar').val(datos[4]);
  $('#ApeMatClieEditar').val(datos[5]);
  $('#DomiClieEditar').val(datos[6]);
  $('#Correo_ClieEditar').val(datos[7]);
  $('#TelClieEditar').val(datos[8]);

  $('#modalEditar').modal('show');
});

// VALIDACIONES PARA EDITAR CLIENTE
$('#formEditarCliente').submit(function (e) {
  e.preventDefault();

  // Limpiar estados de error previos
  $('#formEditarCliente input').removeClass('is-invalid');
  $('.invalid-feedback').text('');

  // Obtener los valores de los campos
  const idclie    = $('#idclieEditar').val();
  const rfc       = $('#RFC_clieEditar').val().trim();
  const curp      = $('#CurpEditar').val().trim();
  const nombre    = $('#nombre_ClieEditar').val().trim();
  const apePat    = $('#ApePatClieEditar').val().trim();
  const apeMat    = $('#ApeMatClieEditar').val().trim();
  const domicilio = $('#DomiClieEditar').val().trim();
  const correo    = $('#Correo_ClieEditar').val().trim();
  const telefono  = $('#TelClieEditar').val().trim();
  let errores     = false;

  // Validar RFC (obligatorio y con patrón)
  if (!rfc) {
    $('#RFC_clieEditar').addClass('is-invalid');
    $('#errorRFCEd').text("El RFC es obligatorio.");
    errores = true;
  } else if (!rfcPattern.test(rfc)) {
    $('#RFC_clieEditar').addClass('is-invalid');
    $('#errorRFCEd').text("RFC inválido.");
    errores = true;
  }

  // Validar CURP (obligatorio y con patrón)
  if (!curp) {
    $('#CurpEditar').addClass('is-invalid');
    $('#errorCurpEd').text("El CURP es obligatorio.");
    errores = true;
  } else if (!curpPattern.test(curp)) {
    $('#CurpEditar').addClass('is-invalid');
    $('#errorCurpEd').text("CURP inválido.");
    errores = true;
  }

  // Validar Nombre (obligatorio y solo letras)
  if (!nombre) {
    $('#nombre_ClieEditar').addClass('is-invalid');
    $('#errorNombreEd').text("El nombre es obligatorio.");
    errores = true;
  } else if (!soloLetras.test(nombre)) {
    $('#nombre_ClieEditar').addClass('is-invalid');
    $('#errorNombreEd').text("El nombre solo debe contener letras.");
    errores = true;
  }

  // Validar Apellido Paterno (obligatorio y solo letras)
  if (!apePat) {
    $('#ApePatClieEditar').addClass('is-invalid');
    $('#errorApellidoPaternoEd').text("El apellido paterno es obligatorio.");
    errores = true;
  } else if (!soloLetras.test(apePat)) {
    $('#ApePatClieEditar').addClass('is-invalid');
    $('#errorApellidoPaternoEd').text("El apellido paterno solo debe contener letras.");
    errores = true;
  }

  // Validar Apellido Materno (opcional, pero si se ingresa, solo letras)
  if (apeMat && !soloLetras.test(apeMat)) {
    $('#ApeMatClieEditar').addClass('is-invalid');
    $('#errorApellidoMaternoEd').text("El apellido materno solo debe contener letras.");
    errores = true;
  }

  // Validar correo (opcional)
  if (correo && !emailPattern.test(correo)) {
    $('#Correo_ClieEditar').addClass('is-invalid');
    $('#errorCorreoEd').text("Correo inválido.");
    errores = true;
  }

  // Validar teléfono (opcional, debe tener 10 dígitos)
  if (telefono && !telPattern.test(telefono)) {
    $('#TelClieEditar').addClass('is-invalid');
    $('#errorTelefonoEd').text("Teléfono inválido.");
    errores = true;
  }

  if (errores) return;  // Detener el envío si hay errores

  // Armar objeto de datos para enviar vía AJAX
  const datos = {
    idclie:      idclie,
    RFC_clie:    rfc,
    Curp:        curp,
    nombre_Clie: nombre,
    ApePatClie:  apePat,
    ApeMatClie:  apeMat,
    DomiClie:    domicilio,
    Correo_Clie: correo,
    TelClie:     telefono,
    accion:      'actualizar'
  };

  $.post('../controllers/controlador_clientes.php', datos, function(response) {
    console.log(response); // Para depuración
    try {
      const res = JSON.parse(response);
      if (res.status === 'ok') {
        $('#modalEditar').modal('hide');
        $('#formEditarCliente')[0].reset();
        cargarClientes();
      } else {
        if (res.error && res.campo) {
          if (res.campo === 'RFC') {
            $('#RFC_clieEditar').addClass('is-invalid');
            $('#errorRFCEd').text(res.error);
          } else if (res.campo === 'Curp') {
            $('#CurpEditar').addClass('is-invalid');
            $('#errorCurpEd').text(res.error);
          } else {
            $('#' + res.campo).addClass('is-invalid');
            $('#error' + res.campo.charAt(0).toUpperCase() + res.campo.slice(1) + 'Ed').text(res.error);
          }
        } else {
          alert(res.error || 'Ocurrió un error al actualizar el cliente');
        }
      }
    } catch (e) {
      alert("Error en la respuesta del servidor.");
    }
      }).fail(function() {
        alert("Error al comunicarse con el servidor.");
      });
    });

    // Confirmar y eliminar cliente
    $(document).on('click', '.btnEliminar', function () {
      const idclie = $(this).data('idclie');
      const confirmar = confirm("Esta operación no se puede deshacer. ¿Estás seguro de eliminar este Cliente?");
      if (confirmar) {
        $.post('../controllers/controlador_clientes.php', { accion: 'eliminar', idclie: idclie }, function (response) {
          try {
            const res = JSON.parse(response);
            if (res.status === 'ok') {
              cargarClientes();
            } else {
              alert("Error al eliminar el cliente: " + res.error);
            }
          } catch (e) {
            console.error("Error al parsear JSON:", e);
          }
        }).fail(function () {
          alert("Error al conectarse con el servidor.");
        });
      }
    });
  });
</script>