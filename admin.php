<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Estética Julieta</title>
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
        <span id="username">Admin: Martin Ramirez</span>
        <a href="logout.php" class="btn btn-danger mt-2 w-100">Cerrar Sesión</a>
    </div>
</div>

<div id="content">
    <!-- El contenido dinámico se cargará aquí -->
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Cargar contenido inicial
        loadPage('clientes'); // Cambia a 'usuarios' si deseas cargar la página de usuarios por defecto

        // Manejar clic en el menú
        $('#sidebar .nav-link').on('click', function(event) {
            event.preventDefault();
            const page = $(this).data('page');
            loadPage(page);
            $('#sidebar .nav-link').removeClass('active');
            $(this).addClass('active');
        });

        function loadPage(page) {
            $('#content').load(`views/${page}.php`, function(response, status, xhr) {
                if (status == 'error') {
                    $('#content').html('<p>Lo sentimos, hubo un error al cargar el contenido.</p>');
                }
            });
        }
    });
</script>

</body>
</html>
