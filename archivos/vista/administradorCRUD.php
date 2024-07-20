<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset='.$charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Consulta para obtener los datos del usuario
    $query = "SELECT * FROM userprofile 
    WHERE id_userprofile = " . $_SESSION['id_userprofile'];
    $resultado = mysqli_query($conn, $query);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado) {
        // Recuperar los datos del usuario
        $fila = mysqli_fetch_assoc($resultado);
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
    <title>Inicio Administrador</title>
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


</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
            <?php      include_once('modal1.php');?>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>
        <!-- Contenido principal -->








        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    <!-- Sección para mostrar y editar el perfil del usuario -->
                    <h1 class="mb-4"> Menu INICIO Y Administración de Recursos</h1>





                    <div class="container bg-white pt-5">
                        <?php include_once('publicarnoticiacarrusel.php'); ?>
                    </div>

                </div>
            </div>









            <li>
                                <a href="comentarios.php" class="nav-link nav-item-hover">
                                <i class="fas fa-comment"></i>
                                <span class="nav-item">Muro de Comentarios</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=" creareventos.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-file-alt fa-fw fa-lg"></i>
                                        <span class="nav-item">eventos</span>
                                    </a>
                                </li>         









<nav class="navbar navbar-light navbar-custom" style="background-color: #00ff00;">
    <a href="paneldeadministrador.php" class="nav-item">
        <i class="fas fa-plus"></i> AGREGAR COMPONENTES AL SISTEMA
    </a>
</nav>

<nav class="navbar navbar-dark bg-primary navbar-custom">
    <a href="editardesdepaneladministrador.php" class="nav-item">
        <i class="fas fa-edit"></i> EDITAR COMPONENTES DEL SISTEMA
    </a>
</nav>


<nav class="navbar navbar-dark navbar-custom" style="background-color: #800080;">
    <a href="listardesdepaneldeadministrador.php" class="nav-item">
        <i class="fas fa-list"></i> LISTAR COMPONENTES DEL SISTEMA
    </a>
</nav>

<nav class="navbar navbar-light navbar-custom" style="background-color: #ff0000;">
    <a href="eliminardesdeadministrador.php" class="nav-item">
        <i class="fas fa-trash"></i> ELIMINAR COMPONENTES DEL SISTEMA
    </a>
</nav>



</div>












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
      
                        <button type="submit" class="btn btn-primary">Guardar Permisos</button>
                    </form>
                </div>

                </nav>
            </div>
        </div>
    </div>


        </form>
    </div></div><a href="listardesdepaneldeadministrador.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>



    
    
    <!-- Añadir Bootstrap JS (opcional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Script jQuery para manejar las solicitudes AJAX -->
    <script>
   
            // Función genérica para agregar elementos
            function agregarElemento(accion, campoNombre) {
                var nombre = $('#' + campoNombre).val();
                $.post("../../include/ctrlIndex3.php", {
                    action: accion,
                    nombre: nombre
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Elemento agregado con éxito');
                        $('#' + campoNombre).val(''); // Limpiar el campo después de agregar
                    } else {
                        alert('Error al agregar el elemento: ' + data.ms);
                    }
                }, 'json');
            }

    </script>
</body>
<?php
    } else {
        // Si hay un error en la consulta, imprimir el mensaje de error
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>