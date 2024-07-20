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
    <title>listar desde aprendiz</title>
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
                    <!-- Sección para mostrar y editar el perfil del usuario -->
                    <div class="container">
                        
        <h1>Panel De Inicio Desde Aprendiz</h1>
        <div class="row">
            <div class="col-sm-4">
                <ul class="navbar-nav">


                <li>
                                           <a href="solicitudaprendiz.php" class="nav-link nav-item-hover">
                                               <i class="fas fa-check-double fa-fw fa-lg"></i>
                                               <span class="nav-item"> Solicitudes</span>
                                           </a>
                                       </li>

           




                    <li>
                        <a href="listarprogramadeformaciondesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-graduation-cap fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Programa Formación</span>
                        </a>
                    </li>
                    <li>
                        <a href="postularcursoaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-graduation-cap fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Postulaciones a Programa Formación</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarresultadosaprendizajedesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-book-open fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Resultado de Aprendizaje</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarcompetenciadesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-trophy fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Competencia</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarMCERdesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-list-alt fa-fw fa-lg"></i>
                            <span class="nav-item">Listar MCER</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarfichadesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-file-alt fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Ficha</span>
                        </a>
                    </li>
                    <li>
                        <a href="listartipossdesolicituddesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-file-alt fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Tipos de solicitudes</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-4">
                <ul class="navbar-nav">
                    <li>
                        <a href="creareventosdesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-file-alt fa-fw fa-lg"></i>
                            <span class="nav-item">Eventos</span>
                        </a>
                    </li>
           
           
           







           
           



                    <li>
                <a href="noticiasdesdeaprendiz.php"class="nav-link nav-item-hover">
                <i class="fas fa-file-alt fa-fw fa-lg"></i>
                    <span class="nav-item">Noticias</span>

                </a>
        </li>








                    <li>
                        <a href="enviarmensajeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-file-alt fa-fw fa-lg"></i>
                            <span class="nav-item">Mensajes</span>
                        </a>
                    </li>
                    <li>
                        <a href="http://localhost/practica_gsus/archivos/INVENTARIO-main/" class="nav-link nav-item-hover">
                            <i class="fas fa-file-alt fa-fw fa-lg"></i>
                            <span class="nav-item">Biblioteca</span>
                        </a>
                    </li>
                    <li>
                        <a href="instructoresbilinguismo.php" class="nav-link nav-item-hover">
                            <i class="fas fa-user-tie fa-fw fa-lg"></i>
                            <span class="nav-item">Instructores Bilinguismo</span>
                        </a>
                    </li>
                    <li>
                        <a href="comentarios.php" class="nav-link nav-item-hover">
                            <i class="fas fa-comment"></i>
                            <span class="nav-item">Muro de Comentarios</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-4">
                <ul class="navbar-nav">
                    <li>
                        <a href="listarjornadadesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-hourglass-start fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Jornada de Formación</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarnivelformaciondesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-award fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Nivel Formación</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarmodalidaddesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-check-double fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Modalidad</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarcategoriadesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-folder fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Categoría</span>
                        </a>
                    </li>
                    <li>
                        <a href="listargenerodesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-venus-mars fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Género</span>
                        </a>
                    </li>
                    <li>
                        <a href="listardocumentosdesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="far fa-file-alt fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Tipos de Documento</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarroldesdeaprendiza.php" class="nav-link nav-item-hover">
                            <i class="fas fa-user-tie fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Rol</span>
                        </a>
                    </li>
                    <li>
                        <a href="listarpoblaciondesdeaprendiz.php" class="nav-link nav-item-hover">
                            <i class="fas fa-users fa-fw fa-lg"></i>
                            <span class="nav-item">Listar Población</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>

            </div>
            </div>
        </div>
    </div><a href="inicio.php">
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
