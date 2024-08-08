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
    <link rel="stylesheet" href="../../herramientas/css/style.css">
    <title>Acciones Bili</title>
    <style>
    .notificacion2 {
        position: absolute;
        left: 85%;

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
        <div class="notificacion2">
            <?php 
                if($_SESSION['id_rol']==2){
                    include_once('notificacion.php');
                }
            ?>
        </div>
        <div class="container layout__content">
            <div class=" content__page">
                <div id="contenido">
                    <div class=" pt-16 rounded-container ">
                        <h1 class="title">Panel De Acciones</h1>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="navbar">
                                    <?php 
                                        include_once('panel.php')
                                        ?>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <h1>Dashboard general</h1>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <img class="img-fluid" src="../../imagenes/money.png" alt="">
                                            </div>
                                        </div>

                                        <h6 class="card-subtitle mb-2 text-muted">Total ventas</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <img class="img-fluid" src="../../imagenes/target.png" alt="">
                                            </div>
                                        </div>

                                        <h6 class="card-subtitle mb-2 text-muted">Clientes registrados</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <img class="img-fluid" src="../../imagenes/customer.png" alt="">
                                            </div>
                                        </div>

                                        <h6 class="card-subtitle mb-2 text-muted">Clientes en los últimos 30 días</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <img class="img-fluid" src="../../imagenes/meeting.png" alt="">
                                            </div>
                                        </div>

                                        <h6 class="card-subtitle mb-2 text-muted">Clientes en el último año</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 my-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3>Clientes por departamento</h3>
                                        <canvas id="grafica"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 my-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3>Edad</h3>
                                        <canvas id="graficaEdad"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 my-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3>Ventas del año actual</h3>
                                        <canvas id="graficaVentas"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 my-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3>Clientes por año</h3>
                                        <canvas id="graficaClientes"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>