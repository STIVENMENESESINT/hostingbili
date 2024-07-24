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

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>

    <title>Acciones Bili</title>
    <style>
    .navbar-nav {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: row;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }

    /* Estilos adicionales */
    .navbar-dark .navbar-nav {
        display: flex;
        /* Alinea los elementos horizontalmente */
    }

    .navbar-dark .navbar-nav .nav-link {
        color: #fff;
        transition: all 0.3s ease;
        padding: 18px 15px;
        text-decoration: none;
        display: inline-block;
        /* Asegura que los enlaces estén en línea */
    }

    .navbar-dark .navbar-nav .nav-link:hover {
        background-color: #007bff;
    }

    .navbar-dark .navbar-nav li {
        display: inline-block;
        /* Asegura que los elementos de la lista estén en línea */
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

    .cabecera_menu {
        position: relative;
    }

    .fixed-top-right {
        position: absolute;
        top: 10px;
        /* Ajusta este valor según necesites */
        right: 10px;
        /* Ajusta este valor según necesites */
        z-index: 1000;
        /* Asegura que esté por encima de otros elementos */
        padding: 5px 10px;
        /* Espaciado interno */
    }

    .fixed-top-right .btn i {
        margin-right: 5px;
        /* Espacio entre el icono y el texto */
    }

    .grid-container {
        display: grid;

        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(4, 2fr);
        gap: 3px;
        justify-items: center;
        /* Centrar elementos horizontalmente */
        align-items: center;
        /* Centrar elementos verticalmente */
        border-radius: 15px;
    }
    .container2{
        position: absolute;
        left: 5rem;
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
        </aside>
        <!-- Contenido principal -->
        <?php 
            if($_SESSION['id_rol']==1){
                include_once('notificacion.php');
            }
        ?>
        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    <div class="container pt-16 rounded-container ">
                        <h1>Panel De Acciones</h1>
                        <div class="row">
                            <div class="col-sm-12">
                                    <div style="width: 70%; margin: 0 auto; ;">
                                        <?php 
                                        include_once('panel.php')
                                        ?>
                                    </div>
                            </div>
                        </div>
</body>
<!-- Regresar -->
<!--            
            </div>
        </div>
    </div>    </div><a href="inicio.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a> -->


</body>

<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>