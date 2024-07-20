<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset='.$charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])){
?>



<!Doctype html>
<html lang="es">

<head>
    <?php
        include_once('cabecera.php');

        ?>


    <script type='text/javascript' src="../../herramientas/js/instructor.js"></script>
    <link rel="stylesheet" href="../../herramientas/css/instructor.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>instructores de bilinguismo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->


    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Incluye jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Incluye Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous">
    </script>






    <style>
    .container {
        height: 294px;
        width: 296px;
        color: white;
        perspective: 800px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }





    .card-top-para {
        font-size: 16px;
        font-weight: bold;
    }

    .container:hover>.card {
        cursor: pointer;
        transform: rotateX(180deg) rotateZ(-180deg);
    }




    .heading {
        font-size: 22px;
        font-weight: bold;
    }





    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .fixed-top-right {
        position: absolute;
        top: 10px;
        /* Ajusta este valor según necesites */
        right: 10px;
        /* Ajusta este valor según necesites */
        z-index: 1000;
        /* Asegura que esté por encima de otros elementos */
        background-color: white;
        /* Fondo blanco para mejor visibilidad */

        padding: 5px 10px;
        /* Espaciado interno */
    }




    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        /* Espacio entre tarjetas */
    }

    .col-sm-10 {
        padding: 100px;
        /* Añadir padding al contenedor de la columna */
    }
    </style>

</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php
                    // Incluir el menú de navegación
                    include_once('menu.php');
                    ?>
            </div>
        </aside>
        <!-- Contenido principal -->
                <style >
                        .cabecera_menu {
                            position: relative;
                        }
                        .fixed-top-right {
                            position: absolute;
                            top: 10px; /* Ajusta este valor según necesites */
                            right: 10px; /* Ajusta este valor según necesites */
                            z-index: 1000; /* Asegura que esté por encima de otros elementos */
                            
                            padding: 5px 10px; /* Espaciado interno */
                        }
                        .fixed-top-right .btn i {
                            margin-right: 5px; /* Espacio entre el icono y el texto */
                        }
                    </style>
        <button type="button" class="btn nav-link nav-item-hover fixed-top-right" onclick="goBack()">
            <i class="fas fa-arrow-left fa-fw fa-lg"></i>
            <span class="nav-item">Volver</span>
        </button>

        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        <div class="layout__content">
            <div class="content__page">


                <div>
                    <div class="col-sm-10 gb-white" class="">
                        <h1>INSTRUCTORES Bilingüismo</h1>
                        <di>
                            <div id="id_cardInstru" class="card-container"></div>
                        </di>

                    </div>
                </div>

</body>

<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>