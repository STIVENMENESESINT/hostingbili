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








</head>
<style>
.container {
    background: rgba(255, 255, 255, 0.95);
    padding: 50px;
    padding-right: 50px;
    padding-left: 50px;
    border-radius: 30px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
    max-width: 1400px;
    width: 95%;

}

.title {
    color: #3498db;
    font-size: 7em;
    margin-bottom: 0px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    font-weight: bold;
    letter-spacing: 1px;
}

.divider {
    height: 6px;
    width: 150px;
    background-color: #04324d;
    margin: 30px auto;
    border-radius: 3px;
}
</style>

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



        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        <div class="layout__content">
            <div class="container content__page">
                <h1 class="title">INSTRUCTORES Bilingüismo<br> </h1>

                <div class="divider"></div>


                <div>
                    <div class="col-sm-10 ">


                        <div>
                            <div id="id_cardInstru" class="card-container"></div>
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