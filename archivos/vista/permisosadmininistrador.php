<?php
// Incluir archivo de conexión y configuración
include_once('../../include/conex.php');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Consulta para obtener la lista de roles
    $query_roles = "SELECT * FROM roles";
    $resultado_roles = mysqli_query($conn, $query_roles);

    // Consulta para obtener la lista de permisos
    $query_permisos = "SELECT * FROM permisos";
    $resultado_permisos = mysqli_query($conn, $query_permisos);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>permisos administrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->


<!-- Incluye Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Incluye jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Incluye Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous"></script>

    <style>
        /* Estilos adicionales */
        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
            transition: all 0.3s ease;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            background-color: #007bff;
        }

        .nav-link {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-item-hover:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    <!-- Sección para asignar permisos a roles -->
                    <h1>Asignar Permisos a Roles</h1>
                    <form action="guardar_permisos.php" method="POST">
                        <div class="form-group">
                            <label for="rol">Seleccionar Rol:</label>
                            <select name="rol" id="rol" class="form-control" required>
                                <option value="">Seleccione un Rol</option>
                                <?php while ($fila_rol = mysqli_fetch_assoc($resultado_roles)) : ?>
                                    <option value="<?php echo $fila_rol['id']; ?>"><?php echo $fila_rol['nombre']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Seleccionar Permisos:</label><br>
                            <?php mysqli_data_seek($resultado_permisos, 0); // Reiniciar el puntero del resultado ?>
                            <?php while ($fila_permiso = mysqli_fetch_assoc($resultado_permisos)) : ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permisos[]" value="<?php echo $fila_permiso['id']; ?>">
                                    <label class="form-check-label"><?php echo $fila_permiso['nombre']; ?></label>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Permisos</button>
                    </form>
                </div>
                <!-- Regresar -->
                <nav class="navbar navbar-dark bg-success">
                    <!-- Navbar content -->
                    <li>
                        <a href="administradorCRUD.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
                    </li>
                </nav>
            </div>
        </div>
    </div>
    <!-- Añadir Bootstrap JS (opcional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script jQuery u otros para manejar las solicitudes AJAX -->
    <script>
        // Aquí puedes agregar funciones JavaScript adicionales si las necesitas
    </script>
</body>

</html>

<?php
    // Liberar el resultado de la consulta
    mysqli_free_result($resultado_roles);
    mysqli_free_result($resultado_permisos);
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
