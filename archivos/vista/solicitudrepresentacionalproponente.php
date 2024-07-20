
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
    <title>ANEXO N. 3 - REPRESENTACIÓN DEL PROPONENTE</title>
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
        <h3>ANEXO N. 3</h3>
        <h4>REPRESENTACIÓN DEL PROPONENTE</h4>
        <h5>(Para proyectos presentados en las Modalidades Empresas Agrupadas)</h5>
    </div>

    <p>Señores</p>
    <p>SERVICIO NACIONAL DE APRENDIZAJE - SENA<br>
    Dirección del Sistema Nacional de Formación para el Trabajo<br>
    SENA – Dirección General<br>
    Calle 57 No. 8 – 69<br>
    Bogotá</p>

    <p>Asunto: Programa de Formación Continua Especializada-Convocatoria DG-0001 de 2018</p>

    <p>Apreciados Señores:</p>

    <p>Por medio del presente escrito hacemos constar que hemos convenido como empresas agruparnos para participar en la Convocatoria del Programa de Formación Continua Especializada que tiene por objetivo: Cofinanciar proyectos de formación continua especializada, presentados por empresas, gremios, federaciones gremiales o asociaciones representativas de empresas o centrales obreras o de trabajadores legalmente constituidas(os), aportantes de parafiscales al SENA, diseñados a la medida de sus necesidades, con el fin de fomentar la formación y actualización de sus trabajadores y/o trabajadores de las empresas afiliadas a los gremios,  de todos los niveles ocupacionales y trabajadores de empresas que hagan parte de su cadena productiva, con el propósito de ampliar sus capacidades, habilidades y conocimientos específicos y así aumentar su rendimiento productivo para el beneficio estratégico  e incremento de la competitividad de las empresas beneficiarias de la formación.</p>

    <div class="form-group">
        <label for="empresa1">1. Razón Social:</label>
        <input type="text" class="form-control" id="empresa1" name="empresa1" required>
    </div>

    <div class="form-group">
        <label for="nit1">NIT:</label>
        <input type="text" class="form-control" id="nit1" name="nit1" required>
    </div>

    <div class="form-group">
        <label for="empresa2">2. Razón Social:</label>
        <input type="text" class="form-control" id="empresa2" name="empresa2" required>
    </div>

    <div class="form-group">
        <label for="nit2">NIT:</label>
        <input type="text" class="form-control" id="nit2" name="nit2" required>
    </div>

    <div class="form-group">
        <label for="aportes">Aportes: porcentaje (%) con el que participa cada integrante:</label>
        <textarea class="form-control" id="aportes" name="aportes" rows="3" required></textarea>
    </div>

    <div class="form-group">
        <label for="duracion">Duración:</label>
        <input type="text" class="form-control" id="duracion" name="duracion" value="Por el plazo de ejecución del Convenio y un (1) año más." readonly>
    </div>

    <p>Compromisos: al conformar la empresa agrupada para participar en la Convocatoria DG-0001 de 2018, sus integrantes se comprometen a:</p>

    <ol>
        <li>Participar en la presentación conjunta de la propuesta, así como a suscribir el Convenio Especial de Cooperación en caso de ser seleccionado y aprobado el proyecto presentado.</li>
        <li>Responder en forma solidaria e ilimitada por el cumplimiento total de la propuesta y de las obligaciones que se originen del Convenio suscrito con el SENA.</li>
        <li>Responder ante las sanciones por incumplimiento de las obligaciones derivadas de la propuesta y del Convenio.</li>
        <li>No ceder su participación a otra empresa.</li>
        <li>No revocar la integración de la empresa agrupada, durante el tiempo de duración del Convenio y un año más.</li>
    </ol>

    <p>Organización interna de la empresa agrupada: Para la organización y representación hemos designado como Representante de las empresas agrupadas al representante legal:</p>

    <div class="form-group">
        <label for="nombreRepresentante">Nombre completo:</label>
        <input type="text" class="form-control" id="nombreRepresentante" name="nombreRepresentante" required>
    </div>

    <div class="form-group">
        <label for="nitRepresentante">Nit:</label>
        <input type="text" class="form-control" id="nitRepresentante" name="nitRepresentante" required>
    </div>

    <p>Quien tendrá las siguientes facultades:</p>

    <ol>
        <li>Actuar en calidad de Promotor en la Convocatoria DG – 0001 de 2018 que adelanta el Servicio Nacional de Aprendizaje – SENA, a través de la Dirección del Sistema Nacional de Formación para el Trabajo y que en el evento de resultar favorecidos en este proceso, celebre el convenio especial de cooperación, en el marco de la convocatoria del Programa de Formación Continua Especializada. En la Modalidad:</li>
        <div class="form-group">
            <label for="modalidad">Modalidad:</label>
            <input type="text" class="form-control" id="modalidad" name="modalidad" required>
        </div>
        <li>Realizar el trámite de apertura de cuenta para el manejo de los recursos que nos sean asignados.</li>
        <li>Comprometer y aportar la contrapartida correspondiente a cargo de la empresa agrupada dentro del término establecido, en el caso de ser aceptada y seleccionada la propuesta por el SENA.</li>
        <li><textarea class="form-control" id="otrasFacultades" name="otrasFacultades" rows="2" placeholder="Agregar las que consideren pertinentes." required></textarea></li>
    </ol>

    <p>Para constancia se firma en la ciudad de:</p>

    <div class="form-group">
        <label for="ciudad">Ciudad:</label>
        <input type="text" class="form-control" id="ciudad" name="ciudad" required>
    </div>

    <div class="form-group">
        <label for="dia">Día:</label>
        <input type="text" class="form-control" id="dia" name="dia" required>
    </div>

    <div class="form-group">
        <label for="mes">Mes:</label>
        <input type="text" class="form-control" id="mes" name="mes" required>
    </div>

    <div class="form-group">
        <label for="ano">Año:</label>
        <input type="text" class="form-control" id="ano" name="ano" value="2018" readonly>
    </div>

    <p>para lo cual se adjuntan las certificado de existencia y representación legal de las empresas agrupadas y copia de la cédula de ciudadanía del representante legal.</p>

    <div class="form-group">
        <label for="firmaOtorgante">Firma Representante Legal del Otorgante:</label>
        <input type="text" class="form-control" id="firmaOtorgante" name="firmaOtorgante" required>
    </div>

    <div class="form-group">
        <label for="nombreOtorgante">Nombre Representante Legal del Otorgante:</label>
        <input type="text" class="form-control" id="nombreOtorgante" name="nombreOtorgante" required>
    </div>

    <div class="form-group">
        <label for="cedulaOtorgante">Cédula Representante Legal del Otorgante:</label>
        <input type="text" class="form-control" id="cedulaOtorgante" name="cedulaOtorgante" required>
    </div>

    <div class="form-group">
        <label for="empresaOtorgante">Nombre la Empresa/Gremio Otorgante:</label>
        <input type="text" class="form-control" id="empresaOtorgante" name="empresaOtorgante" required>
    </div>

    <p>En calidad de Promotor de la empresa agrupada declaro:</p>

    <ol>
        <li>Que las necesidades de formación de la empresa agrupada que represento se encuentran incluidas dentro del proyecto presentado por la Empresa Promotora.</li>
        <li>Que nos adherimos a las especificaciones y anexos del pliego y aceptamos todos sus contenidos.</li>
    </ol>

    <div class="form-group">
        <label for="firmaPromotor">Firma Representante Legal Promotor:</label>
        <input type="text" class="form-control" id="firmaPromotor" name="firmaPromotor" required>
    </div>

</div>
</body>
</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>