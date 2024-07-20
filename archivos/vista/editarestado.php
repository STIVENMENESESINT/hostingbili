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
    <title>Actualizar Estado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <div class="col-sm-6">
                                    <label for="estadoUsu" class="col-form-label">Estado:</label>
                                    <input type="text" class="form-control" id="estadoUsu" name="estadoUsu" value="<?php echo htmlspecialchars($fila['id_estado']); ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
    <label for="rolUsuFK" class="col-form-label">Rol Actual:</label>
    <input type="text" class="form-control" id="rolUsuFK" name="rolUsuFK" value="<?php echo htmlspecialchars($fila['id_rol']); ?>" disabled>
</div>

                               
                                <div class="col-sm-6">
                                <label for="id_rol" class="col-form-label">Rol:</label>
                                <select class="form-control" id="id_rol" name="id_rol" title='' style='cursor:pointer;'></select>
                                </div>


                <?php

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Consulta para obtener todos los perfiles de usuario ordenados por user_id descendente
    $query = "SELECT * FROM `userprofile` ORDER BY `user_id` DESC";
    $resultado = mysqli_query($conn, $query);

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado) {
        // Mostrar los resultados en una tabla o de la forma que desees
       
       
       
       
        echo '<table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>';
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo '<tr>
                    <td>'.$fila['id_userprofile'].'</td>
                    <td>'.$fila['nombre'].'</td>
                    <td>'.$fila['apellido'].'</td>
                    <td>'.$fila['correo'].'</td>
                    <td>'.$fila['id_estado'].'</td>
                    <td><a href="actualizar_estado.php?id='.$fila['id_userprofile'].'">Actualizar Estado</a></td>
                </tr>';
        }
        echo '</table>';
    } else {
        // Si hay un error en la consulta, imprimir el mensaje de error
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>



</body>
</html>




<script>
    $(document).ready(function() {
        $.post("../../include/select.php", {
                action: 'crgrDepto'
            },
            function(data) {
                $("#cod_dpto").html(data.listDepto);
            },
            'json'
        );


        $(document).on("change", "#cod_dpto", function() {
            $.post("../../include/select.php", {
                action: 'crgrMuni',
                cod_dpto: $("#cod_dpto").val()
            }, function(data) {
                $("#cod_municipio").html(data.listMuni);
            }, 'json');
        });

        $(document).on("change", "#cod_municipio", function() {
            $.post("../../include/select.php", {
                action: 'crgrPoblados',
                cod_municipio: $("#cod_municipio").val()
            }, function(data) {
                $("#cod_poblado").html(data.listPoblado);
            }, 'json');
        });


        $.post("../../include/select.php", {
                action: 'crgrTiposDoc'
            },
            function(data) {
                $("#id_doc").html(data.lisTiposD);
            },
            'json').fail(function(xhr, status, error) {
            console.error(error);
        });

        $.post("../../include/ctrlIndex3.php", {
                action: 'crgrRoles'
            },
            function(data) {
                $("#id_rol").html(data.listRoles);
            },
            'json'
        );

        $.post("../../include/select.php", {
                action: 'crgrEstadoUsuario'
            },
            function(data) {
                $("#estadoUsu").html(data.listEstadoUsu);
            },
            'json'
        );

        // Manejar el clic del botón de actualizar usuario
        $(document).on("click", "#btnActualizarUsuario", function() {
            var alertMessage = ""; // Mensaje de alerta

            // Enviar solicitud AJAX para actualizar usuario
            $.post("../../include/ctrlIndex3.php", {
                action: 'actualizarusuario',
                fecha_nacimiento: $("#fecha_nacimiento").val(),
                nombre: $("#nombre").val(),
                nombre_dos: $("#nombre_dos").val(),
                direccion: $("#direccion").val(),
                apellido: $("#apellido").val(),
                apellido_dos: $("#apellido_dos").val(),
                clave: $("#clave").val(),
                id_rol: $("#id_rol").val(),
                correo: $("#correo").val(),
                correo_sena: $("#correo_sena").val(),
                id_doc: $("#id_doc").val(),
                numeroiden: $("#numeroiden").val(),
                celular: $("#celular").val(),
                estadoUsu: $("#estadoUsu").val(),
                cod_dpto: $("#cod_dpto").val(),
                cod_municipio: $("#cod_municipio").val(),
                cod_poblado: $("#cod_poblado").val()
            }, function(data) {
                if (data.rstl == "1") {
                    alert('Usuario actualizado con éxito');
                    clearForm(); // Limpiar el formulario
                } else {
                    alert('Error al actualizar el usuario: ' + data.msj);
                }
            }, 'json');
        });
    });
    </script>


















<?php
    } 

    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
