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

                    <!-- El contenido dinámico se cargará aquí -->
                

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud de Reconocimiento competencias</title>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <style>
        /* Estilos para el formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type=text], input[type=email], input[type=tel], textarea, select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button[type=submit] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            width: 100%;
            display: block;
            margin-top: 20px;
        }

        button[type=submit]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulario de Solicitud de Reconocimiento competencias</h1>

        <form action="procesar_reconocimiento.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <textarea id="direccion" name="direccion" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>

            <div class="form-group">
                            <label for="comentarios">Comentarios:</label>
                            <textarea id="comentarios" name="comentarios" rows="4"></textarea>
                        </div>

         

                        <div class="form-group">
                            <label for="archivo">Archivo Adjunto:</label>
                            <input type="file" id="archivo" name="archivo">
                        </div>

    
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio:</label>
                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio">
                        </div>

                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin:</label>
                            <input type="datetime-local" id="fecha_fin" name="fecha_fin">
                        </div>



                        <div class="form-group">
                            <label for="id_jornada">Jornada:</label>
                            <select id="id_jornada" name="id_jornada">
                                <option value="1">Jornada 1</option>
                                <option value="2">Jornada 2</option>
                                <!-- Agrega más opciones según tu base de datos -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_modalidad">Modalidad:</label>
                            <select id="id_modalidad" name="id_modalidad">
                                <option value="1">Modalidad 1</option>
                                <option value="2">Modalidad 2</option>
                                <!-- Agrega más opciones según tu base de datos -->
                            </select>
                        </div>


            <div class="form-group">
                <label for="creditos_reconocer">Créditos a Reconocer:</label>
                <input type="number" id="creditos_reconocer" name="creditos_reconocer" min="1" required>
            </div>

            <div class="form-group">
                <label for="comentarios">Comentarios Adicionales:</label>
                <textarea id="comentarios" name="comentarios" rows="4"></textarea>
            </div>
            <label for="competencia">Competencia:</label>
    <select class="form-control" id="competencia" name="competencia" required>
        <option value="">Seleccione una competencia</option>
            <div class="form-group">
                <label for="archivo">Archivo Adjunto:</label>
                <input type="file" id="archivo" name="archivo">
            </div>
            <div class="form-group">
                <label for="programaformacion">Programa de Formación:</label>
                <select id="programaformacion" name="programaformacion" required>
                    <option value="">Seleccione un programa</option>
     
                    <?php
                    // Consulta para obtener los programas de formación disponibles
                    $query_programas = "SELECT id_programaformacion, nombre FROM programaformacion WHERE tipo = 'empresa'";
                    $resultado_programas = mysqli_query($conn, $query_programas);

                    // Verificar si se ejecutó la consulta correctamente
                    if ($resultado_programas && mysqli_num_rows($resultado_programas) > 0) {
                        // Mostrar los programas de formación
                        while ($fila_programa = mysqli_fetch_assoc($resultado_programas)) {
                            echo "<option value='" . $fila_programa['id_programaformacion'] . "'>" . $fila_programa['nombre'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay programas disponibles</option>";
                    }

                    // Liberar el resultado de la consulta
                    mysqli_free_result($resultado_programas);
                    ?>
                </select>
            </div>
            <div class="form-group">

       
    </select>
</div>

    

            <button type="submit">Enviar Solicitud de Reconocimiento</button>
        </form>
    </div>
</body>
</html>


<?php
        // Incluir el archivo de conexión a la base de datos
        include_once('../../include/conex.php');

        // Consulta para obtener las competencias ordenadas por id_competencia descendente
        $query_competencias = "SELECT id_competencia, nombre FROM competencia ORDER BY id_competencia DESC";
        $resultado_competencias = mysqli_query($conn, $query_competencias);

        // Verificar si se ejecutó la consulta correctamente
        if ($resultado_competencias && mysqli_num_rows($resultado_competencias) > 0) {
            // Mostrar las opciones del select
            while ($fila_competencia = mysqli_fetch_assoc($resultado_competencias)) {
                echo "<option value='" . $fila_competencia['id_competencia'] . "'>" . $fila_competencia['nombre'] . "</option>";
            }
        } else {
            echo "<option value=''>No hay competencias disponibles</option>";
        }

        // Liberar el resultado de la consulta
        mysqli_free_result($resultado_competencias);
        mysqli_close($conn);
        ?>
<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Consulta para obtener las competencias ordenadas por id_competencia descendente
$query_competencias = "SELECT id_competencia, nombre FROM competencia ORDER BY id_competencia DESC";
$resultado_competencias = mysqli_query($conn, $query_competencias);

// Verificar si se ejecutó la consulta correctamente
if ($resultado_competencias && mysqli_num_rows($resultado_competencias) > 0) {
    // Mostrar las opciones del select
    while ($fila_competencia = mysqli_fetch_assoc($resultado_competencias)) {
        echo "<option value='" . $fila_competencia['id_competencia'] . "'>" . $fila_competencia['nombre'] . "</option>";
    }
} else {
    echo "<option value=''>No hay competencias disponibles</option>";
}

// Liberar el resultado de la consulta
mysqli_free_result($resultado_competencias);
mysqli_close($conn);
?>

<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>
