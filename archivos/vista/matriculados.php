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
    <title>Solicitud postular programa de formacion</title>
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

        .btn-sena-editar {
    background-color: #28a745; /* Verde institucional del SENA */
    color: #fff; /* Texto blanco */
    border-color: #28a745; /* Borde verde */
}

.btn-sena-editar:hover {
    background-color: #4CAF50; /* Verde más oscuro al pasar el mouse */
    border-color: #45a049; /* Borde verde más oscuro al pasar el mouse */
}




.btn-sena-eliminar {
    background-color: #dc3545; /* Rojo institucional del SENA */
    color: #fff; /* Texto blanco */
    border-color: #dc3545; /* Borde rojo */
}

.btn-sena-eliminar:hover {
    background-color: #c82333; /* Rojo oscuro al pasar el mouse */
    border-color: #bd2130; /* Borde rojo oscuro al pasar el mouse */
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
        
            <!-- Sección para mostrar y editar el perfil del usuario -->
            <h1>Postular un nuevo aprendiz a una lista de espera para un futuro programa de formación</h1>

            <!-- Formulario para agregar o editar observaciones -->
            <form method="post" action="procesar_matriculaobs.php">
                <div class="form-group">
                    <label for="idalumno">Identificación del aspirante:</label>
                    <input type="text" class="form-control" id="idalumno" name="idalumno" required>
                </div>
                <div class="form-group">
                    <label for="codalumno">Nombre del aspirante:</label>
                    <input type="text" class="form-control" id="codalumno" name="codalumno" required>
                </div>
                <div class="form-group">
                    <label for="codmatri">Correo electrónico:</label>
                    <input type="text" class="form-control" id="codmatri" name="codmatri" required>
                </div>





                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>





                <div class="form-group">
                    <label for="programaformacion">Programa de Formación:</label>
                    <select class="form-control" id="programaformacion" name="programaformacion" required>
                        <option value="">Seleccione un programa</option>
                        <?php
                        // Consulta para obtener los programas de formación
                        $query = "SELECT id_programaformacion, nombre FROM programaformacion";
                        $resultado = mysqli_query($conn, $query);
                        // Verificar si se ejecutó la consulta correctamente
                        if ($resultado) {
                            // Mostrar los datos de la consulta
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $fila['id_programaformacion'] . "'>" . $fila['nombre'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Error al cargar programas</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="obs">Observación:</label>
                    <textarea class="form-control" id="obs" name="obs" required></textarea>
                </div>




                <button type="submit" class="btn btn-sena-editar">Guardar</button>
            </form>


      

            <h2>Lista de Observaciones</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identificación del aspirante</th>
                        <th>Nombre del aspirante</th>
                        <th>Correo electrónico</th>
                        <th>Fecha</th>
                        <th>Observación</th>
                        <th>Programa de Formación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener las observaciones de matrícula junto con el nombre del programa de formación
                    $query = "SELECT mo.*, pf.nombre AS programa_nombre FROM matriculaobs mo 
                              LEFT JOIN programaformacion pf ON mo.codmatri = pf.id_programaformacion";
                    $resultado = mysqli_query($conn, $query);
                    // Verificar si se ejecutó la consulta correctamente
                    if ($resultado) {
                        // Mostrar los datos de la consulta
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $fila['idobs'] . "</td>";
                            echo "<td>" . $fila['idalumno'] . "</td>";
                            echo "<td>" . $fila['codalumno'] . "</td>";
                            echo "<td>" . $fila['codmatri'] . "</td>";
                            echo "<td>" . $fila['fecha'] . "</td>";
                            echo "<td>" . $fila['obs'] . "</td>";
                            echo "<td>" . $fila['programaformacion'] . "</td>";

                            echo "<td>
                                <a href='editar_matriculaobs.php?id=" . $fila['idobs'] . "' class='btn btn-sena-editar'>Editar</a>
                                <a href='eliminar_matriculaobs.php?id=" . $fila['idobs'] . "' class='btn btn-sena-eliminar'>Eliminar</a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

   


             
             </div>
    </div>    </div><a href="listardesdepaneldeadministrador.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

    <!-- Añadir Bootstrap JS (opcional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script jQuery para manejar las solicitudes AJAX -->
    <script>
        // Función genérica para agregar elementos
        function agregarElemento(accion, campoNombre) {
            var nombre = $('#' + campoNombre).val();
            $.post("../../include/ctrlIndex3.php", {
                action: accion,
                nombre: nombre
            }, function(data) {
                if (data.rst == "1") {
                    alert('Elemento agregado con éxito');
                    $('#' + campoNombre).val(''); // Limpiar el campo después de agregar
                } else {
                    alert('Error al agregar el elemento: ' + data.ms);
                }
            }, 'json');
        }
    </script>
</body>
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



























