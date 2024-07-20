
<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset=' . $charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])) {
?>
<!Doctype html>
<html lang="es">

<head>
    <?php
                    // Incluir el archivo de cabecera que probablemente contiene enlaces a CSS y otros metadatos
                    include_once('cabecera.php');
                    ?>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario General de Solicitudes</title>
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
                <?php
                    // Incluir el menú de navegación
                    include_once('menu.php');
                    ?>
            </div>

        </aside>

        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">
                <div id="conten">
                    <?php
                    // Incluir el archivo de cabecera que probablemente contiene enlaces a CSS y otros metadatos
                    include_once('cabeceraMenu.php');
                    ?>




    <div class="container">

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaración Compromiso Anticorrupción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section label {
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h3>DECLARACIÓN COMPROMISO ANTICORRUPCIÓN</h3>
    </div>

    <p>Señores</p>
    <p>SERVICIO NACIONAL DE APRENDIZAJE - SENA<br>
    Dirección del Sistema Nacional de Formación para el Trabajo SENA – Dirección General<br>
    Calle 57 No. 8 – 69<br>
    Bogotá</p>

    <p>Asunto: Programa de Formación Continua Especializada. Convocatoria DG-0001 de 2018</p>

    <form action="procesar_declaracion.php" method="POST">
        <div class="form-group">
            <label for="modalidad">Modalidad:</label>
            <input type="text" class="form-control" id="modalidad" name="modalidad" required>
        </div>

        <div class="form-group">
            <label for="nombre">Yo,</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="domicilio">domiciliado en</label>
            <input type="text" class="form-control" id="domicilio" name="domicilio" required>
        </div>

        <div class="form-group">
            <label for="cedula">identificado con cédula de ciudadanía No.</label>
            <input type="text" class="form-control" id="cedula" name="cedula" required>
        </div>

        <div class="form-group">
            <label for="representacion">obrando en calidad de representante legal de</label>
            <input type="text" class="form-control" id="representacion" name="representacion" required>
        </div>

        <p>Manifiesto que:</p>

        <ol>
            <li>Apoyamos la acción del Estado colombiano y de El Servicio Nacional de Aprendizaje – SENA, para fortalecer la transparencia y la rendición de cuentas de la administración pública.</li>
            <li>No estamos en causal de inhabilidad e incompatibilidad alguna para celebrar el convenio del Programa de Formación Continua Especializada.</li>
            <li>Nos comprometemos a no ofrecer, a no dar dádivas, sobornos o cualquier forma de halago, retribuciones o prebenda a servidores públicos o asesores del SENA, directamente o a través de sus empleados, contratistas o terceros.</li>
            <li>Nos comprometemos a no efectuar acuerdos, o realizar actos o conductas que tengan por objeto o efecto la colusión en el proceso del Programa de Formación Continua Especializada.</li>
            <li>Nos comprometemos a revelar la información que sobre el presente proceso del Programa de Formación Continua Especializada cuando la soliciten los organismos de control de la República de Colombia.</li>
            <li>Nos comprometemos a comunicar a nuestros empleados y asesores el contenido del presente Compromiso Anticorrupción, explicar su importancia y las consecuencias de su incumplimiento por nuestra parte, y la de nuestros empleados o asesores.</li>
            <li>Conocemos las consecuencias derivadas del incumplimiento del presente compromiso anticorrupción.</li>
        </ol>

        <div class="form-group">
            <label for="fecha">En constancia de lo anterior, firmo (firmamos) este documento a los</label>
            <input type="text" class="form-control" id="dia" name="dia" placeholder="Día" required>
            <input type="text" class="form-control" id="mes" name="mes" placeholder="Mes" required>
            <input type="text" class="form-control" id="ano" name="ano" placeholder="Año" required>
        </div>

        <div class="form-group">
            <label for="firma">Firma del representante legal del Proponente</label>
            <input type="text" class="form-control" id="firma" name="firma" required>
        </div>

        <div class="form-group">
            <label for="nombreRepresentante">Nombre:</label>
            <input type="text" class="form-control" id="nombreRepresentante" name="nombreRepresentante" required>
        </div>

        <div class="form-group">
            <label for="cargo">Cargo:</label>
            <input type="text" class="form-control" id="cargo" name="cargo" required>
        </div>

        <div class="form-group">
            <label for="empresa">Empresa:</label>
            <input type="text" class="form-control" id="empresa" name="empresa" required>
        </div>

        <div class="form-group">
            <label for="documentoIdentidad">Documento de Identidad:</label>
            <input type="text" class="form-control" id="documentoIdentidad" name="documentoIdentidad" required>
        </div>

        <div class="form-group">
            <label for="firmaPlural">Firma de todos los representantes legales del Proponente en los casos de figura plural, consorcios y uniones temporales, modalidad agrupada y gremial</label>
            <textarea class="form-control" id="firmaPlural" name="firmaPlural" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="nombrePlural">Nombre:</label>
            <input type="text" class="form-control" id="nombrePlural" name="nombrePlural" required>
        </div>

        <div class="form-group">
            <label for="cargoPlural">Cargo:</label>
            <input type="text" class="form-control" id="cargoPlural" name="cargoPlural" required>
        </div>

        <div class="form-group">
            <label for="empresaPlural">Empresa:</label>
            <input type="text" class="form-control" id="empresaPlural" name="empresaPlural" required>
        </div>

        <div class="form-group">
            <label for="documentoIdentidadPlural">Documento de Identidad:</label>
            <input type="text" class="form-control" id="documentoIdentidadPlural" name="documentoIdentidadPlural" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar Declaración</button>
        </div>
    </form>
</div>
</body>
</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>