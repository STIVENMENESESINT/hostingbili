
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
    <title>Carta de Presentación de la Propuesta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1, h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 10px;
            margin: -10px -10px 10px -10px;
            border-bottom: 1px solid #ccc;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>ANEXO N. 2</h1>
    <h2>CARTA DE PRESENTACIÓN DE LA PROPUESTA</h2>

    <form action="submit_propuesta.php" method="post">
        <div class="form-group">
            <label for="ciudadFecha">Ciudad y fecha:</label>
            <input type="text" id="ciudadFecha" name="ciudadFecha" required>
        </div>

        <div class="text-center">
            <p>Señores</p>
            <p>SERVICIO NACIONAL DE APRENDIZAJE - SENA</p>
            <p>Dirección del Sistema Nacional de Formación para el Trabajo SENA – Dirección General</p>
            <p>Calle 57 No. 8 – 69</p>
            <p>Bogotá</p>
        </div>

        <div class="form-group">
            <label for="modalidad">Modalidad:</label>
            <input type="text" id="modalidad" name="modalidad" required>
        </div>

        <div class="form-group">
            <label for="nombreRepresentante">Nombre del representante legal:</label>
            <input type="text" id="nombreRepresentante" name="nombreRepresentante" required>
        </div>

        <div class="form-group">
            <label for="domicilio">Domicilio:</label>
            <input type="text" id="domicilio" name="domicilio" required>
        </div>

        <div class="form-group">
            <label for="cedula">Cédula de ciudadanía No.:</label>
            <input type="text" id="cedula" name="cedula" required>
        </div>

        <div class="form-group">
            <label for="nombreEmpresa">Nombre de la empresa/gremio:</label>
            <input type="text" id="nombreEmpresa" name="nombreEmpresa" required>
        </div>

        <p>Apreciados señores:</p>
        <p>Yo, <span id="nombreRepresentanteTexto"></span>, domiciliado en <span id="domicilioTexto"></span>, identificado con cédula de ciudadanía No. <span id="cedulaTexto"></span> obrando en calidad de representante legal de <span id="nombreEmpresaTexto"></span>, de conformidad con las exigencias que se estipulan en el pliego, presento (presentamos) la siguiente propuesta para participar en la convocatoria que adelanta el Servicio Nacional de Aprendizaje – SENA, a través de la Dirección del Sistema Nacional de Formación para el Trabajo, con el propósito de celebrar convenio especial de cooperación en el marco de la Convocatoria del Programa de Formación Continua Especializada, razón por la cual autorizo al SENA a verificar la veracidad de la información presentada con la propuesta.</p>

        <p>En el caso de ser aceptada y seleccionada la propuesta por el SENA, me comprometo (nos comprometemos) a firmar el convenio especial de cooperación dentro del término establecido, así como a proceder con su perfeccionamiento y ejecución, también en el plazo señalado. En caso de incumplimiento de uno de los requisitos de perfeccionamiento y ejecución, el SENA puede entender que desisto (desistimos) de continuar con el proceso para la ejecución del convenio, y podrá hacer efectiva la póliza de seriedad de la propuesta.</p>

        <p>Declaro (declaramos) así mismo:</p>
        <ul>
            <li>Que conozco (conocemos) las especificaciones y anexos del pliego y acepto (aceptamos) sus contenidos.</li>
            <li>Que he (hemos) recibido las aclaraciones a este pliego.</li>
            <li>Que la propuesta fue formulada por la empresa/gremio, a partir de las necesidades de formación identificadas.</li>
            <li>Que no se realizarán cobros de ninguna índole a los beneficiarios de las acciones de formación (trabajadores en todos los niveles ocupacionales vinculados a las empresas o pertenecientes a su cadena productiva).</li>
            <li>Que garantizo contratar a los capacitadores con los perfiles requeridos en la convocatoria y presentados en la propuesta.</li>
            <li>Que diligencié y radiqué el proyecto en el aplicativo Sistema Integral de Gestión de Proyectos – SIGP - SENA.</li>
            <li>Que las empresas relacionadas en el Anexo No. 14 son afiliadas al Gremio y han autorizado el uso hasta del 50% del aporte parafiscal al SENA, realizado en la vigencia 2017 para la participación de la Convocatoria del PFCE 2018.(Este Anexo 14, Aplica para modalidad Gremio y Agrupadas).</li>
            <li>Que autorizo al SENA hacer revisiones aleatorias de las empresas relacionadas como afiliadas y/o agrupadas en el Anexo No. 14.</li>
            <li>Que cumpliré con la Transferencia de Conocimiento y Tecnología al SENA la cual corresponderá mínimo al 15% de total de los cupos ofertados.</li>
            <li>Que las empresas a las que pertenezcan los trabajadores beneficiarios de las Acciones de Formación especializadas ejecutadas a través del presente proyecto, garantizan la disponibilidad de tiempo y asistencia de sus trabajadores para atender las Acciones de Formación programadas por el proponente.</li>
            <li>Que haré (haremos) los trámites necesarios para el perfeccionamiento y ejecución del convenio especial de cooperación correspondiente, dentro de los diez (10) días hábiles siguientes a la publicación definitiva de proyectos aprobados.</li>
            <li>No hallarme (hallarnos) incurso(s) en ninguna de las causales de inhabilidad e incompatibilidad señaladas por la Constitución y la Ley.</li>
            <li>Que me (nos) comprometo (comprometemos) a otorgar las garantías requeridas.</li>
            <li>Que conozco los manuales en los cuales el SENA establece los requisitos ambientales y de seguridad y salud en el trabajo, mínimos a implementar en el desarrollo de las acciones de formación especializada. La normatividad puede variar dependiendo de la jurisdicción donde se desarrollen las acciones de formación especializadas, razón por la cual se hace necesario consultar en el siguiente link: <a href="http://compromiso.sena.edu.co/mapa/descarga.php?id=1643" target="_blank">http://compromiso.sena.edu.co/mapa/descarga.php?id=1643</a></li>
            <li>Que en el caso de que el proyecto sea aprobado, el aporte de contrapartida se encuentra garantizado de acuerdo a certificación del Revisor Fiscal cuando la empresa proponente o promotora esté obligado a tenerlo, o en su defecto por el Representante Legal o Contador, documento que hace parte integral de la propuesta presentada.</li>
            <li>Que autorizo al SENA, para que sean enviadas todas las comunicaciones relacionadas en el marco de la convocatoria DG-0001 de 2018 a los correos electrónicos registrados en el formulario digital SIGP, en caso de notificaciones de actos administrativos se autoriza los siguientes datos de contacto:</li>
        </ul>

        <div class="form-group">
            <label for="personaContacto">Persona de contacto:</label>
            <input type="text" id="personaContacto" name="personaContacto" required>
        </div>

        <div class="form-group">
            <label for="direccionNotificaciones">Dirección para notificaciones:</label>
            <input type="text" id="direccionNotificaciones" name="direccionNotificaciones" required>
        </div>

        <div class="form-group">
            <label for="telefonoCompania">Teléfono de la compañía:</label>
            <input type="text" id="telefonoCompania" name="telefonoCompania" required>
        </div>

        <div class="form-group">
            <label for="celularCompania">Celular:</label>
            <input type="text" id="celularCompania" name="celularCompania" required>
        </div>

        <div class="form-group">
            <label for="emailNotificaciones">E-mail para notificaciones:</label>
            <input type="email" id="emailNotificaciones" name="emailNotificaciones" required>
        </div>

        <div class="form-group">
            <label for="foliosFisicos">Número de folios físicos:</label>
            <input type="number" id="foliosFisicos" name="foliosFisicos" required>
        </div>

        <div class="text-right">
            <p>Firma del Representante Legal Proponente</p>
            <div class="form-group">
                <label for="firmaRepresentante">Nombre del Representante Legal Proponente:</label>
                <input type="text" id="firmaRepresentante" name="firmaRepresentante" required>
            </div>

            <div class="form-group">
                <label for="cedulaRepresentante">Cédula del Representante Legal Proponente:</label>
                <input type="text" id="cedulaRepresentante" name="cedulaRepresentante" required>
            </div>

            <div class="form-group">
                <label for="nombreEmpresaFinal">Nombre de la Empresa/Gremio Proponente:</label>
                <input type="text" id="nombreEmpresaFinal" name="nombreEmpresaFinal" required>
            </div>
        </div>

        <div class="text-center">
            <button type="submit">Enviar Propuesta</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('nombreRepresentante').addEventListener('input', function () {
        document.getElementById('nombreRepresentanteTexto').textContent = this.value;
    });

    document.getElementById('domicilio').addEventListener('input', function () {
        document.getElementById('domicilioTexto').textContent = this.value;
    });

    document.getElementById('cedula').addEventListener('input', function () {
        document.getElementById('cedulaTexto').textContent = this.value;
    });

    document.getElementById('nombreEmpresa').addEventListener('input', function () {
        document.getElementById('nombreEmpresaTexto').textContent = this.value;
    });
</script>

</body>
</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>