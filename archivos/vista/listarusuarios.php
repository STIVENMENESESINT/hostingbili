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
    <meta charset="UTF-8">
    <title>Listar Usuarios</title>

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


    <h2>Listado de Usuarios</h2>
    <div id="id_userprofile"></div>

    

        function mostrarUsuarios(usuarios) {
            var html = '<table border="1">';
            html += '<tr><th>ID</th><th>Documento</th><th>Clave</th><th>Fecha Nacimiento</th><th>Fecha Registro</th><th>Nombre</th><th>Nombre Dos</th><th>Apellido</th><th>Apellido Dos</th><th>Celular</th><th>Correo</th><th>Correo SENA</th><th>Dirección</th><th>Estado</th><th>Ficha</th><th>Género</th><th>Rol</th><th>ID Usuario</th><th>Departamento</th><th>Municipio</th><th>Poblado</th><th>Población</th><th>Tipo Doc.</th><th>Empresa</th><th>Área</th><th>Imagen</th></tr>';
        
           


    usuarios.forEach(function(usuario) {
        html += '<tr>';
        html += '<td>' + usuario.id_userprofile + '</td>';
        html += '<td>' + usuario.numeroiden + '</td>';
        html += '<td>' + usuario.clave + '</td>';
        html += '<td>' + usuario.fecha_nacimiento + '</td>';
        html += '<td>' + usuario.fecha_registro + '</td>';
        html += '<td>' + usuario.nombre + '</td>';
        html += '<td>' + usuario.nombre_dos + '</td>';
        html += '<td>' + usuario.apellido + '</td>';
        html += '<td>' + usuario.apellido_dos + '</td>';
        html += '<td>' + usuario.celular + '</td>';
        html += '<td>' + usuario.correo + '</td>';
        html += '<td>' + usuario.correo_sena + '</td>';
        html += '<td>' + usuario.direccion + '</td>';
        html += '<td>' + usuario.id_estado + '</td>';
        html += '<td>' + usuario.id_ficha + '</td>';
        html += '<td>' + usuario.id_genero + '</td>';
        html += '<td>' + usuario.id_rol + '</td>';
        html += '<td>' + usuario.user_id + '</td>';
        html += '<td>' + usuario.cod_dpto + '</td>';
        html += '<td>' + usuario.cod_municipio + '</td>';
        html += '<td>' + usuario.cod_poblado + '</td>';
        html += '<td>' + usuario.cod_poblacion + '</td>';
        html += '<td>' + usuario.id_doc + '</td>';
        html += '<td>' + usuario.id_empresa + '</td>';
        html += '<td>' + usuario.id_area + '</td>';
        html += '<td>' + usuario.imagen + '</td>';
        html += '</tr>';
    });

    html += '</table>';


    $('#usuarios').html(html);
}
    });

    </div>
    <div>            </div>
    <div>            </div>
 
    <div>

   
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