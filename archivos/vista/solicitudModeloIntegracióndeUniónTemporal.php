
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
        <h2>Modelo Integración de Unión Temporal</h2>
        <p>Por medio del presente escrito hacemos constar que hemos integrado la Unión Temporal <input type="text"required> _, para participar en la Convocatoria del Programa de Formación Continua Especializada que tiene por objetivo: Cofinanciar proyectos de formación continua especializada, presentados por empresas, gremios, federaciones gremiales o asociaciones representativas de empresas o centrales obreras o de trabajadores legalmente constituidas(os), aportantes de parafiscales al SENA, diseñados a la medida de sus necesidades, con el fin de fomentar la formación y actualización de sus trabajadores y/o trabajadores de las empresas afiliadas a los gremios, de todos los niveles ocupacionales y trabajadores de empresas que hagan parte de su cadena productiva, con el propósito de ampliar sus capacidades, habilidades y conocimientos específicos y así aumentar su rendimiento productivo para el beneficio estratégico e incremento de la competitividad de las empresas beneficiarias de la formación.</p>
        
        <h3>Integrantes de la Unión Temporal:</h3>
        <div class="form-group">
            <label for="razon_social1">1. Razón Social:</label>
            <input type="text" id="razon_social1" name="razon_social1" required>
        </div>
        <div class="form-group">
            <label for="nit1">NIT:</label>
            <input type="text" id="nit1" name="nit1" required>
        </div>
        <div class="form-group">
            <label for="razon_social2">2. Razón Social:</label>
            <input type="text" id="razon_social2" name="razon_social2" required>
        </div>
        <div class="form-group">
            <label for="nit2">NIT:</label>
            <input type="text" id="nit2" name="nit2" required>
        </div>

        <h3>Aportes:</h3>
        <div class="form-group">
            <label for="aportes">Porcentaje (%) con el que participa cada integrante:</label>
            <textarea id="aportes" name="aportes" rows="4" required></textarea>
        </div>

        <h3>Duración:</h3>
        <p>Por el plazo de ejecución del Convenio y un (1) año más.</p>

        <h3>Compromisos:</h3>
        <p>Al conformar la Unión Temporal para participar en la Convocatoria DG-0001 de 2018, sus integrantes se comprometen a:</p>
        <ol>
            <li>Participar en la presentación conjunta de la propuesta, así como a suscribir el Convenio Especial de Cooperación en caso de ser seleccionado y aprobado el proyecto presentado.</li>
            <li>Responder en forma solidaria e ilimitada por el cumplimiento total de la propuesta y de las obligaciones que se originen del Convenio suscrito con el SENA.</li>
            <li>Responder ante las sanciones por incumplimiento de las obligaciones derivadas de la propuesta y del Convenio de acuerdo con la participación en la ejecución de cada uno de los miembros de la Unión Temporal.</li>
            <li>No ceder su participación en la Unión Temporal a otro integrante de la misma.</li>
            <li>No ceder su participación en la Unión Temporal a terceros sin la autorización previa del SENA.</li>
            <li>No revocar la Unión Temporal durante el tiempo de duración del Convenio y un año más.</li>
            <li>En caso de ser adjudicatario, constituir un RUT unificado en nombre de la Unión Temporal dentro de los tres (3) días siguientes a la publicación de Acta de Aprobación por parte del Consejo Directivo Nacional del SENA en la página web oficial.</li>
        </ol>

        <h3>Organización interna de la Unión Temporal:</h3>
        <p>Para la organización de la Unión Temporal hemos designado como Representante Legal a <input type="text"required>, quien tendrá las siguientes facultades:</p>
        <div class="form-group">
            <textarea id="facultades" name="facultades" rows="6" required></textarea>
        </div>

        <p>Para constancia se firma el presente documento en <input type="text"required>, a los <input type="text"required> días del mes de <input type="text"required> de <input type="text"required>.</p>

        <div class="form-group">
            <label for="nombres_firmas">Nombres y firmas:</label>
            <textarea id="nombres_firmas" name="nombres_firmas" rows="4" required></textarea>
        </div>

        <p><strong>NOTA:</strong> Los proponentes podrán adicionar el contenido de este anexo, siempre que el mismo contenga la información mínima exigida en él.</p>

        <button type="submit">Enviar</button>
    </div>
</body>
</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>