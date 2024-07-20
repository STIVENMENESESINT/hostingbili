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
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>programa de formacion</title>
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
                    <h1>Perfil de Usuario </h1>
                    <form action="actualizar_perfil.php" method="POST">
                        <!-- Campos del formulario -->
                        <h1 class="modal-title w-100 text-center">Actualizar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
                            <form id="formActualizarUsuario">
                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <label for="nombre" class="col-form-label">Primer Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            value="<?php echo $fila['nombre']; ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="nombre_dos" class="col-form-label">Segundo Nombre:</label>
                                        <input type="text" class="form-control" id="nombre_dos" name="nombre_dos"
                                            value="<?php echo isset($fila['nombre_dos']) ? $fila['nombre_dos'] : ''; ?>">
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-sm-6">
                                            <label for="apellido" class="col-form-label">Primer Apellido:</label>
                                            <input type="text" class="form-control" id="apellido" name="apellido"
                                                value="<?php echo $fila['apellido']; ?>">
                                        </div>


                                        <div class="col-sm-6">
                                            <label for="apellido_dos" class="col-form-label">Segundo Apellido:</label>
                                            <input type="text" class="form-control" id="apellido_dos"
                                                name="apellido_dos"
                                                value="<?php echo isset($fila['apellido_dos']) ? $fila['apellido_dos'] : ''; ?>">
                                        </div>




                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <label for="numeroiden" class="col-form-label">Número de
                                                    Documento:</label>
                                                <input type="text" class="form-control" id="numeroiden"
                                                    name="numeroiden" value="<?php echo $fila['numeroiden']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="id_doc" class="col-form-label">Tipo Documento:</label>
                                                <select class="form-control" id="id_doc" name="id_doc" title=''
                                                    style='cursor:pointer;'></select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <label for="celular" class="col-form-label">Número de Celular:</label>
                                                <input type="text" class="form-control" id="celular" name="celular"
                                                    value="<?php echo $fila['celular']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="cod_dpto" class="col-form-label">Departamento:</label>
                                                <select class="form-control" id="cod_dpto" name="cod_dpto"></select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <label for="cod_municipio" class="col-form-label">Municipio:</label>
                                                <select class="form-control" id="cod_municipio" name="cod_municipio"
                                                    title='' style='cursor:pointer;'>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="cod_poblado" class="col-form-label">Poblado:</label>
                                                <select class="form-control" id="cod_poblado" name="cod_poblado"
                                                    title='' style='cursor:pointer;'></select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <label for="direccion" class="col-form-label">Dirección:</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion"
                                                    value="<?php echo $fila['direccion']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="rolUsuFK" class="col-form-label">Rol:</label>
                                                <input type="text" class="form-control" id="rolUsuFK" name="rolUsuFK"
                                                    value="<?php echo $fila['id_rol']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <label for="clave" class="col-form-label">Clave:</label>
                                                <input type="password" class="form-control" id="clave" name="clave">
                                            </div>



                                            <div class="col-sm-6">
                                                <label for="fecha_nacimiento" class="col-form-label">Fecha de
                                                    Nacimiento:</label>
                                                <?php
            $fecha_nacimiento = isset($fila['fecha_nacimiento']) ? $fila['fecha_nacimiento'] : '';
            if (!empty($fecha_nacimiento)) {
                $dateTime = new DateTime($fecha_nacimiento);
                $fechaFormateada = $dateTime->format('Y-m-d');
            } else {
                $fechaFormateada = '';
            }
            echo '<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="' . $fechaFormateada . '">';
            ?>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <label for="correo" class="col-form-label">Correo Electrónico:</label>
                                                <input type="email" class="form-control" id="correo" name="correo"
                                                    value="<?php echo $fila['correo']; ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="correo_sena" class="col-form-label">Correo Electrónico mi
                                                    sena:</label>
                                                <input type="email" class="form-control" id="correo_sena"
                                                    name="correo_sena"
                                                    value="<?php echo isset($fila['correo_sena']) ? $fila['correo_sena'] : ''; ?>">
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="estadoUsu" class="col-form-label">Estado:</label>
                                                <input type="text" class="form-control" id="estadoUsu" name="estadoUsu"
                                                    value="<?php echo $fila['id_estado']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>


                                            <button type="button" class="btn btn-primary" name="btnActualizarUsuario"
                                                id="btnActualizarUsuario">Actualizar</button>
                                        </div>
                            </form>

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
            'json').fail(function(xhr, status, error) {
            console.error(error);
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
















        
        $(document).on("click", "#btnActualizarUsuario", function() {
            var alertMessage = ""; // Mensaje de alerta

            // Enviar solicitud AJAX para actualizar usuario
            $.post("../../include/ctrlIndex2.php", {
                action: 'actualizarusuario',
                fecha_nacimiento: $("#fecha_nacimiento").val(),
                nombre: $("#nombre").val(),
                nombre_dos: $("#nombre_dos").val(),
                direccion: $("#direccion").val(),
                apellido: $("#apellido").val(),
                apellido_dos: $("#apellido_dos").val(),
                clave: $("#clave").val(),
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
                    alert('Error al actualizar el usuario: ' + data.msj)
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