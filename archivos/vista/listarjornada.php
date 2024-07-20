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
    // Consulta para obtener los datos del usuario
    $query = "SELECT * FROM userprofile 
    WHERE id_userprofile = " . $_SESSION['id_userprofile'];
    $resultado = mysqli_query($conn, $query);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado) {
        // Recuperar los datos del usuario
        $fila = mysqli_fetch_assoc($resultado);
    }
}

// Manejo de las acciones
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id_jornada = $_POST['id_jornada'];

    if ($action == 'edit') {
        $nombre = $_POST['nombre'];
        $sql = "UPDATE jornada SET nombre='$nombre' WHERE id_jornada=$id_jornada";
        $conn->query($sql);
    } elseif ($action == 'copy') {
        $nombre = $_POST['nombre'];
        $sql = "INSERT INTO jornada (nombre) VALUES ('$nombre')";
        $conn->query($sql);
    } elseif ($action == 'delete') {
        $sql = "DELETE FROM jornada WHERE id_jornada=$id_jornada";
        $conn->query($sql);
    }
}

// Consulta para obtener los datos
$sql = "SELECT * FROM jornada";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agregar jornadas</title>
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
                    <!-- Sección para mostrar y editar el perfil del usuario -->
                    <h1>Agregar Nueva Jornada</h1>
        <form id="formAgregarJornada">
            <div class="form-group">
                <label for="nombreJornada">Nombre de la Jornada:</label>
                <input type="text" class="form-control" id="nombreJornada" name="nombreJornada" required>
            </div>
            <button type="button" class="btn btn-primary" id="btnAgregarJornada">
                Agregar Jornada
            </button>
           
        </form>
        <br>
        <br><br>
        <br>


    <h2>Detalle de Jornada</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <form method='post'>
                            <td>{$row['id_jornada']}</td>
                            <td><input type='text' name='nombre' value='{$row['nombre']}'></td>
                            <td>
                                <input type='hidden' name='id_jornada' value='{$row['id_jornada']}'>
                                <button type='submit' name='action' value='edit' class='btn btn-primary'>Editar</button>
                                <button type='submit' name='action' value='copy' class='btn btn-success'>Copiar</button>
                                <button type='submit' name='action' value='delete' class='btn btn-danger'>Borrar</button>
                            </td>
                        </form>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay registros</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div></div></div></div></div><a href="listardesdepaneldeadministrador.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>


                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Acción al hacer clic en el botón de agregar jornada
            $(document).on("click", "#btnAgregarJornada", function() {
                // Enviar solicitud AJAX para agregar jornada
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarJornada',
                    nombre: $("#nombreJornada").val()
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Jornada agregada con éxito');
                        $("#formAgregarJornada")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar la jornada: ' + data.ms);
                    }
                }, 'json');
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
