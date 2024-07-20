
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
    <title>Acta Concertación de Transferencia de Conocimiento y Tecnología al SENA</title>
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
        .table-form {
            width: 100%;
            margin-bottom: 20px;
        }
        .table-form th, .table-form td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table-form th {
            background-color: #f2f2f2;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="ruta/a/la/imagen.png" alt="Encabezado" class="img-fluid">
        <h3>SERVICIO NACIONAL DE APRENDIZAJE</h3>
        <h4>DIRECCIÓN DEL SISTEMA NACIONAL DE FORMACIÓN PARA EL TRABAJO</h4>
        <h4>PROGRAMA DE FORMACIÓN CONTINUA ESPECIALIZADA - CONVOCATORIA DG-0001 DE 2018</h4>
        <h4>ACTA CONCERTACIÓN DE TRANSFERENCIA DE CONOCIMIENTO Y TECNOLOGÍA AL SENA</h4>
        <p>Nota: Los beneficiarios de la transferencia tienen los mismos deberes y derechos del trabajador de la empresa/gremio. Por ende, su participación debe ser certificada.</p>
    </div>

    <form action="procesar_formulario.php" method="POST">
        <div class="form-section">
            <label for="fechaPresentacion">FECHA DE PRESENTACIÓN:</label>
            <div class="form-row">
                <div class="col">
                    <input type="number" class="form-control" id="diaPresentacion" name="diaPresentacion" placeholder="Día" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" id="mesPresentacion" name="mesPresentacion" placeholder="Mes" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" id="anoPresentacion" name="anoPresentacion" placeholder="Año" required>
                </div>
            </div>
        </div>

        <table class="table-form">
            <thead>
                <tr>
                    <th>N° DE A.F.</th>
                    <th>NOMBRE ACCIÓN DE FORMACIÓN</th>
                    <th>NOMBRE UNIDADES TEMÁTICAS (UT)</th>
                    <th>TIPO DE TRANSFERENCIA</th>
                    <th>PERFIL BENEFICIARIOS</th>
                    <th>OBJETIVO DE LA TRANSFERENCIA</th>
                    <th>No. HORAS AF</th>
                    <th>NUMERO DE GRUPO</th>
                    <th>FECHA DE INICIO</th>
                    <th>FECHA FINALIZACIÓN</th>
                    <th>DÍAS SESIONES DE FORMACIÓN</th>
                    <th>HORARIO</th>
                    <th>DEPARTAMENTO SEDE DE LA EMPRESA</th>
                    <th>MUNICIPIO SEDE DE LA EMPRESA</th>
                    <th>DIRECCIÓN DE CAPACITACIÓN O LUGAR DE LA PASANTIA</th>
                    <th>CAPACITADOR Y/O ENTIDAD CAPACITADORA Ó RESPONSABLE PASANTÍA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="numAf" required></td>
                    <td><input type="text" name="nombreAccionFormacion" required></td>
                    <td><input type="text" name="nombreUnidadesTematicas" required></td>
                    <td><input type="text" name="tipoTransferencia" required></td>
                    <td><input type="text" name="perfilBeneficiarios" required></td>
                    <td><input type="text" name="objetivoTransferencia" required></td>
                    <td><input type="number" name="numHorasAf" required></td>
                    <td><input type="number" name="numGrupo" required></td>
                    <td><input type="date" name="fechaInicio" required></td>
                    <td><input type="date" name="fechaFinalizacion" required></td>
                    <td><input type="text" name="diasSesionesFormacion" required></td>
                    <td><input type="text" name="horario" required></td>
                    <td><input type="text" name="departamentoSede" required></td>
                    <td><input type="text" name="municipioSede" required></td>
                    <td><input type="text" name="direccionCapacitacion" required></td>
                    <td><input type="text" name="capacitador" required></td>
                </tr>
            </tbody>
        </table>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar Acta</button>
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