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
</head>
<style>
.container {
    background: rgba(255, 255, 255, 0.95);
    padding: 50px;
    padding-right: 50px;
    padding-left: 50px;
    padding-right: 50px;
    padding-left: 50px;
    border-radius: 30px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
    max-width: 1400px;
    width: 95%;
}

.navbar {
    display: flex;
    justify-content: center;
    background-color: #04324d;
    padding: 15px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>

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
            if($_SESSION['id_rol']==2){
                include_once('notificacion.php');
            }
        ?>
        <div class="layout__content">
            <div class="container content__page">
                <div id="contenido">
                    <div class=" pt-16 rounded-container ">
                        <h1>Panel De Acciones</h1>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="navbar">
                                    <?php 
                                        include_once('panel.php')
                                        ?>
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