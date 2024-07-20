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
    $id_modalidad = $_POST['id_modalidad'];

    if ($action == 'edit') {
        $nombre = $_POST['nombre'];
        $sql = "UPDATE modalidad SET nombre='$nombre' WHERE id_modalidad=$id_modalidad";
        $conn->query($sql);
    } elseif ($action == 'copy') {
        $nombre = $_POST['nombre'];
        $sql = "INSERT INTO modalidad (nombre) VALUES ('$nombre')";
        $conn->query($sql);
    } elseif ($action == 'delete') {
        $sql = "DELETE FROM modalidad WHERE id_modalidad=$id_modalidad";
        $conn->query($sql);
    }
}

// Consulta para obtener los datos de las modalidades
$sql = "SELECT * FROM modalidad";
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
    <title>Administrar Modalidades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->
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
                    <!-- Sección para agregar nueva modalidad -->
                    <h1>Agregar Nueva Modalidad</h1>
                    <form id="formAgregarModalidad">
                        <div class="form-group">
                            <label for="nombreModalidad">Nombre de la Modalidad:</label>
                            <input type="text" class="form-control" id="nombreModalidad" name="nombreModalidad" required>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnAgregarModalidad">
                            Agregar Modalidad
                        </button>
                    </form>
                    <br><br>
                    <!-- Sección para listar y gestionar las modalidades existentes -->
                    <h2>Listado de Modalidades</h2>
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
                                            <td>{$row['id_modalidad']}</td>
                                            <td><input type='text' name='nombre' value='{$row['nombre']}'></td>
                                            <td>
                                                <input type='hidden' name='id_modalidad' value='{$row['id_modalidad']}'>
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
                   
                </div>
            </div>
        </div>
    </div> <a href="listarmodalidad.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>
    <!-- Script necesario para el manejo de eventos con jQuery -->
    <script>
        $(document).ready(function() {
            // Acción al hacer clic en el botón de agregar modalidad
            $(document).on("click", "#btnAgregarModalidad", function() {
                // Enviar solicitud AJAX para agregar modalidad
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarModalidad',
                    nombre: $("#nombreModalidad").val()
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Modalidad agregada con éxito');
                        $("#formAgregarModalidad")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar la modalidad: ' + data.ms);
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
