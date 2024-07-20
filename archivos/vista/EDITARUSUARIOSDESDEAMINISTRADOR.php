<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Consulta para obtener los datos del usuario
    $query = "SELECT * FROM userprofile WHERE id_userprofile = " . $_SESSION['id_userprofile'];
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
    $id_userprofile = $_POST['id_userprofile'];

    if ($action == 'edit') {
        // Recuperar datos del formulario
        $nombre = $_POST['nombre'];
        $id_rol = $_POST['id_rol'];
        $correo = $_POST['correo'];
        $id_estado = $_POST['id_estado'];
        
        // Verificar si numeroiden está definido antes de asignarlo
        $numeroiden = isset($_POST['numeroiden']) ? $_POST['numeroiden'] : '';
        
        // Verificar si clave está definido antes de asignarlo
        $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

        // Preparar y ejecutar consulta de actualización
        $sql = "UPDATE userprofile SET nombre='$nombre', id_rol='$id_rol', correo='$correo', id_estado=$id_estado, numeroiden='$numeroiden', clave='$clave' WHERE id_userprofile=$id_userprofile";
        $conn->query($sql);
    } elseif ($action == 'copy') {
        // Recuperar datos del formulario
        $nombre = $_POST['nombre'];
        $id_rol = $_POST['id_rol'];
        $correo = $_POST['correo'];
        $id_estado = $_POST['id_estado'];
        
        // Verificar si numeroiden está definido antes de asignarlo
        $numeroiden = isset($_POST['numeroiden']) ? $_POST['numeroiden'] : '';
        
        // Verificar si clave está definido antes de asignarlo
        $clave = isset($_POST['clave']) ? $_POST['clave'] : '';

        // Preparar y ejecutar consulta de inserción
        $sql = "INSERT INTO userprofile (nombre, id_rol, correo, id_estado, numeroiden, clave) VALUES ('$nombre', '$id_rol', '$correo', $id_estado, '$numeroiden', '$clave')";
        $conn->query($sql);
    } elseif ($action == 'delete') {
        // Recuperar id del usuario a eliminar
        $sql = "DELETE FROM userprofile WHERE id_userprofile=$id_userprofile";
        $conn->query($sql);
    }
}

// Consulta para obtener los perfiles de usuario
$sql = "SELECT * FROM userprofile";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Perfiles de Usuario</title>
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
                    <!-- Sección para agregar nuevo perfil de usuario -->
                    <h1>Administrar Perfiles de Usuario</h1>
                    <form id="formAgregarUsuario">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="id_rol">id_rol:</label>
                            <input type="text" class="form-control" id="id_rol" name="id_rol" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="id_estado">Estado:</label>
                            <input type="text" class="form-control" id="id_estado" name="id_estado" required>
                        </div>
                        <div class="form-group">
                            <label for="numeroiden">Número de Identificación:</label>
                            <input type="text" class="form-control" id="numeroiden" name="numeroiden" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave:</label>
                            <input type="password" class="form-control" id="clave" name="clave" required>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnAgregarUsuario">Agregar Usuario</button>
                    </form>
                    <br><br>

                    <!-- Tabla de detalles de perfiles de usuario -->
                    <h2>Detalle de Perfiles de Usuario</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>id_rol</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Número de Identificación</th>
                                <th>Clave</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <form method='post'>
                                                <td>{$row['id_userprofile']}</td>
                                                <td><input type='text' name='nombre' value='{$row['nombre']}'></td>
                                                <td><input type='text' name='id_rol' value='{$row['id_rol']}'></td>
                                                <td><input type='email' name='correo' value='{$row['correo']}'></td>
                                                <td><input type='text' name='id_estado' value='{$row['id_estado']}'></td>
                                                <td><input type='text' name='numeroiden' value='{$row['numeroiden']}'></td>
                                                <td><input type='password' name='clave' value='{$row['clave']}'></td>
                                                <td>
                                                    <input type='hidden' name='id_userprofile' value='{$row['id_userprofile']}'>
                                                    <button type='submit' name='action' value='edit' class='btn btn-primary'>Editar</button>
                                                    <button type='submit' name='action' value='copy' class='btn btn-success'>Copiar</button>
                                                    <button type='submit' name='action' value='delete' class='btn btn-danger'>Borrar</button>
                                                </td>
                                            </form>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No hay registros</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </div>   <a href="listardesdepaneldeadministrador.php">
        <i class="fas fa-arrow-circle-left"></i>
        <span class="nav-item">Regresar</span>
    </a>

    <!-- Script jQuery para agregar usuario -->
    <script>
        $(document).ready(function() {
            // Acción al hacer clic en el botón de agregar usuario
            $(document).on("click", "#btnAgregarUsuario", function() {
                // Recuperar datos del formulario
                var nombre = $("#nombre").val();
                var id_rol = $("#id_rol").val();
                var correo = $("#correo").val();
                var id_estado = $("#id_estado").val();
                var numeroiden = $("#numeroiden").val();
                var clave = $("#clave").val();

                // Enviar solicitud AJAX para agregar usuario
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarUsuario',
                    nombre: nombre,
                    id_rol: id_rol,
                    correo: correo,
                    id_estado: id_estado,
                    numeroiden: numeroiden,
                    clave: clave
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Usuario agregado con éxito');
                        $("#formAgregarUsuario")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar el usuario: ' + data.ms);
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
