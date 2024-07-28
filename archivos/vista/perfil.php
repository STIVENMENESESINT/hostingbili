<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset=' . $charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Consulta para obtener los datos del usuario usando una declaración preparada
    $query = "SELECT * FROM userprofile WHERE id_userprofile = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['id_userprofile']);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado && $resultado->num_rows > 0) {
        // Recuperar los datos del usuario
        $fila = $resultado->fetch_assoc();
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
    <title>Actualizar Usuario </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->


    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Incluye jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Incluye Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous"></script>

</head>

<style>
.container {
    background: rgba(255, 255, 255, 0.95);
    padding: 50px;
    padding-right: 50px;
    padding-left: 50px;
    border-radius: 30px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
    max-width: 1400px;
    width: 95%;
}
</style>
< <body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>

        </aside>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">
                <div id="contenido">
                    <!-- Sección para mostrar y editar el perfil del usuario -->
         
                    <form action="actualizar_perfil.php" method="POST" id="formActualizarUsuario">
                        <!-- Campos del formulario -->
                        <h1 class="modal-title w-100 text-center">Actualizar Usuario</h1>
                        
                        <div class="modal-body">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <label for="nombre" class="col-form-label">Primer Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($fila['nombre']); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="nombre_dos" class="col-form-label">Segundo Nombre:</label>
                                    <input type="text" class="form-control" id="nombre_dos" name="nombre_dos" value="<?php echo htmlspecialchars($fila['nombre_dos'] ?? ''); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="apellido" class="col-form-label">Primer Apellido:</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($fila['apellido']); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="apellido_dos" class="col-form-label">Segundo Apellido:</label>
                                    <input type="text" class="form-control" id="apellido_dos" name="apellido_dos" value="<?php echo htmlspecialchars($fila['apellido_dos'] ?? ''); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="celular" class="col-form-label">Número de Celular:</label>
                                    <input type="text" class="form-control" id="celular" name="celular" value="<?php echo htmlspecialchars($fila['celular']); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="correo" class="col-form-label">Correo Electrónico:</label>
                                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($fila['correo']); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="correo_sena" class="col-form-label">Correo Electrónico mi sena:</label>
                                    <input type="email" class="form-control" id="correo_sena" name="correo_sena" value="<?php echo htmlspecialchars($fila['correo_sena'] ?? ''); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="estadoUsu" class="col-form-label">Estado:</label>
                                    <input type="text" class="form-control" id="estadoUsu" name="estadoUsu" value="<?php echo htmlspecialchars($fila['id_estado']); ?>">
                                </div>
                            </div>



                               
                            <!-- <div class="col-sm-6">
                                <label for="id_rol" class="col-form-label">Rol:</label>
                                <select class="form-control" id="id_rol" name="id_rol" title='' style='cursor:pointer;'></select>
                            </div> -->



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" name="btnActualizarUsuario" id="btnActualizarUsuario">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            $.post("../../include/ctrlIndex.php", {
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
    </body>

</html>

<?php
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