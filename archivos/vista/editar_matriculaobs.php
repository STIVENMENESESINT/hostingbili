<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset='.$charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Verificar si se ha enviado el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idobs'])) {
        // Obtener el ID de la observación a editar desde el formulario
        $idobs = $_POST['idobs'];

        // Validar y obtener los otros campos del formulario
        $idalumno = mysqli_real_escape_string($conn, $_POST['idalumno']);
        $codalumno = mysqli_real_escape_string($conn, $_POST['codalumno']);
        $codmatri = mysqli_real_escape_string($conn, $_POST['codmatri']);
        $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
        $obs = mysqli_real_escape_string($conn, $_POST['obs']);
        $programaformacion = mysqli_real_escape_string($conn, $_POST['programaformacion']);

        // Query para actualizar la observación en la base de datos
        $query = "UPDATE matriculaobs SET idalumno='$idalumno', codalumno='$codalumno', codmatri='$codmatri', fecha='$fecha', obs='$obs', programaformacion='$programaformacion' WHERE idobs=$idobs";

        // Ejecutar la consulta de actualización
        if (mysqli_query($conn, $query)) {
            echo "Observación actualizada correctamente.";
        } else {
            echo "Error al actualizar la observación: " . mysqli_error($conn);
        }
    }

    // Obtener el ID de la observación a editar desde la URL
    if (isset($_GET['id'])) {
        $idobs = $_GET['id'];

        // Consulta para obtener los datos de la observación a editar
        $query = "SELECT * FROM matriculaobs WHERE idobs=$idobs";
        $resultado = mysqli_query($conn, $query);

        // Verificar si se ejecutó la consulta correctamente y si hay resultados
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Recuperar los datos de la consulta
            $fila = mysqli_fetch_assoc($resultado);
        } else {
            echo "Error al ejecutar la consulta o no se encontraron registros.";
            // Puedes redirigir o manejar el error según sea necesario
        }

        // Liberar el resultado de la consulta si existe
        if ($resultado) {
            mysqli_free_result($resultado);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editar solicitudes postular programa de formacion</title>
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

    <style>
        /* Estilos adicionales */
        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
            transition: all 0.3s ease;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            background-color: #007bff;
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
    </style>
</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    <!-- Sección para mostrar y editar la observación de matrícula -->
                    <h1>Editar Postulacion a Programa De Formacion Nuevo</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="idobs" value="<?php echo isset($fila['idobs']) ? $fila['idobs'] : ''; ?>">
                        <div class="form-group">
                            <label for="idalumno">Identificacion Del Aspirante:</label>
                            <input type="text" class="form-control" id="idalumno" name="idalumno" value="<?php echo isset($fila['idalumno']) ? $fila['idalumno'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="codalumno">Nombre Del Aspirante:</label>
                            <input type="text" class="form-control" id="codalumno" name="codalumno" value="<?php echo isset($fila['codalumno']) ? $fila['codalumno'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="codmatri">Correo Electronico Del Aspirante:</label>
                            <input type="text" class="form-control" id="codmatri" name="codmatri" value="<?php echo isset($fila['codmatri']) ? $fila['codmatri'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo isset($fila['fecha']) ? $fila['fecha'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="obs">Observación:</label>
                            <textarea class="form-control" id="obs" name="obs" required><?php echo isset($fila['obs']) ? $fila['obs'] : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="programaformacion">Programa De Formación Al Que Aspira:</label>
                            <select class="form-control" id="programaformacion" name="programaformacion" required>
                                <option value="">Seleccione un programa</option>
                                <?php
                                // Consulta para obtener los programas de formación
                                $query = "SELECT id_programaformacion, nombre FROM programaformacion";
                                $resultado_pf = mysqli_query($conn, $query);

                                // Verificar si se ejecutó la consulta correctamente
                                if ($resultado_pf && mysqli_num_rows($resultado_pf) > 0) {
                                    // Mostrar los datos de la consulta
                                    while ($fila_pf = mysqli_fetch_assoc($resultado_pf)) {
                                        $selected = (isset($fila['programaformacion']) && $fila['programaformacion'] == $fila_pf['id_programaformacion']) ? "selected" : "";
                                        echo "<option value='" . $fila_pf['id_programaformacion'] . "' $selected>" . $fila_pf['nombre'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Error al cargar programas</option>";
                                }

                                // Liberar el resultado de la consulta de programas de formación
                                if ($resultado_pf) {
                                    mysqli_free_result($resultado_pf);
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>            <a href="paneldeadministrador.php" class="btn btn-primary" id="btnRegresar">
                    Regresar
                </a>
            </div>
        </div>
    </div>
    <!-- Añadir Bootstrap JS (opcional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    // Liberar el resultado de la consulta si está definido y no es nulo
    if (isset($resultado)) {
        mysqli_free_result($resultado);
    }
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>