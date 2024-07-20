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
    <title>crear instructor</title>
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
                    <h1>Formulario de Inserción instructor </h1>
                    <nav class="navbar navbar-dark bg-dark">
                        <!-- Navbar content -->
                        <li>
                            <a href="paneldeinserciondesdeinstructor.php">
                                <i class="fas fa-user-cog"></i>
                                <span class="nav-item">Crear</span>
                            </a>
                        </li>
                        
                    </nav>
                    <!-- Menú principal -->
                    <div class="row">
                        <div class="col-sm-4">
                            <nav class="navbar navbar-dark bg-primary">
                                <!-- Navbar content -->
                                <li>
                                    <a href="editardesdepaneldeinstructor.php">
                                        <i class="fas fa-chart-bar"></i>
                                        <span class="nav-item">Editar</span>
                                    </a>
                                </li>


                                <nav class="navbar navbar-dark bg-success">
                        <!-- Navbar content -->
                        <li>
                            <a href="listardesdeinstructor.php">
                                <i class="fas fa-user-cog"></i>
                                <span class="nav-item">Listar</span>
                            </a>
                        </li>
                    </nav>

                    
                            </nav>
                        </div>
                        <div class="col-sm-4">
                            <ul class="navbar-nav">



















                            
                                <li>
                                    <a href="AgregarProgramaFormaciondesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-graduation-cap fa-fw fa-lg"></i>
                                        <span class="nav-item"> solicitud Agregar Programa Formación</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="AgregarNuevoResultadodeAprendizajedesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-book-open fa-fw fa-lg"></i>
                                        <span class="nav-item">Solicitud Agregar Nuevo Resultado De Aprendizaje</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="postulaciondesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-graduation-cap fa-fw fa-lg"></i>
                                        <span class="nav-item">Postulación APRENDIZ CURSOS  </span>
                                    </a>
                                </li>

          
                                <li>
                                    <a href="solicitud.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-book-open fa-fw fa-lg"></i>
                                        <span class="nav-item">Crear Una  Solicitud</span>
                                    </a>
                                </li>



                                <li>
                                    <a href="panelsolicitudesinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-book-open fa-fw fa-lg"></i>
                                        <span class="nav-item">Panel De Solicitudes</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="agregarcompetenciadesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-trophy fa-fw fa-lg"></i>
                                        <span class="nav-item">solicitud  Agregar Competencia</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="AgregarFichadesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-file-alt fa-fw fa-lg"></i>
                                        <span class="nav-item">solicitud Agregar Ficha</span>
                                    </a>
                                </li>

                                <li>
                                <a href="creareventosdesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-graduation-cap fa-fw fa-lg"></i>
                                        <span class="nav-item">eventos</span>
                                    </a>
                                </li>


                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <ul class="navbar-nav">
     

                                <li>
                                    <a href="AgregarCategoriadesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-folder fa-fw fa-lg"></i>
                                        <span class="nav-item">solicitud Agregar Categoría</span>
                                    </a>
                                </li>
            
                                <li>
                                    <a href="publicarnoticiadesdeinstructor.php" class="nav-link nav-item-hover">
                                        <i class="fas fa-folder fa-fw fa-lg"></i>
                                        <span class="nav-item">solicitud Agregar Noticia</span>
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
                    </div>
                </div>
                <!-- Regresar -->
                <nav class="navbar navbar-dark bg-success">
                    <!-- Navbar content -->
                    <li>
                    <a href="panelinstructor.php">
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
    <!-- Script jQuery para manejar las solicitudes AJAX -->
    <script>
        // Función genérica para agregar elementos
        function agregarElemento(accion, campoNombre) {
            var nombre = $('#' + campoNombre).val();
            $.post("../../include/ctrlIndex2.php", {
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
