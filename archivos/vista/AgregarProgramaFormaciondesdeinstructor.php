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
    $id_programaformacion = $_POST['id_programaformacion'];

    if ($action == 'edit') {
        // Recuperar datos del formulario
        $nombre = $_POST['nombre'];
      
        $id_jornada = $_POST['id_jornada'];
        $id_mcer = $_POST['id_mcer'];
        $id_modalidad = $_POST['id_modalidad'];
        $id_nivel_formacion = $_POST['id_nivel_formacion'];
        $matriculados = $_POST['matriculados'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_cierre = $_POST['fecha_cierre'];
        $horas_curso = $_POST['horas_curso'];
        $id_estado = $_POST['id_estado'];
        $ficha = $_POST['ficha'];
       
        
        // Preparar y ejecutar consulta de actualización
        $sql = "UPDATE programaformacion SET nombre='$nombre',  id_jornada='$id_jornada', id_mcer='$id_mcer', id_modalidad='$id_modalidad', id_nivel_formacion='$id_nivel_formacion', matriculados='$matriculados', fecha_inicio='$fecha_inicio', fecha_cierre='$fecha_cierre', horas_curso='$horas_curso', id_estado='$id_estado', ficha='$ficha' WHERE id_programaformacion=$id_programaformacion";
        $conn->query($sql);
    } elseif ($action == 'copy') {
        // Recuperar datos del formulario
        $nombre = $_POST['nombre'];
       
        $id_jornada = $_POST['id_jornada'];
        $id_mcer = $_POST['id_mcer'];
        $id_modalidad = $_POST['id_modalidad'];
        $id_nivel_formacion = $_POST['id_nivel_formacion'];
        $matriculados = $_POST['matriculados'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_cierre = $_POST['fecha_cierre'];
        $horas_curso = $_POST['horas_curso'];
        $id_estado = $_POST['id_estado'];
        $ficha = $_POST['ficha'];
        

        // Preparar y ejecutar consulta de inserción
        $sql = "INSERT INTO programaformacion (nombre, id_jornada, id_mcer, id_modalidad, id_nivel_formacion, matriculados, fecha_inicio, fecha_cierre, horas_curso, id_estado, ficha ) VALUES ('$nombre', '$id_competencia', '$id_jornada', '$id_mcer', '$id_modalidad', '$id_nivel_formacion', '$matriculados', '$fecha_inicio', '$fecha_cierre', '$horas_curso', '$id_estado', '$ficha')";
        $conn->query($sql);
    } elseif ($action == 'delete') {
        // Recuperar id del programa de formación a eliminar
        $sql = "DELETE FROM programaformacion WHERE id_programaformacion=$id_programaformacion";
        $conn->query($sql);
    }
}

// Consulta para obtener los programas de formación
$sql = "SELECT * FROM programaformacion";
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
    <title>Administrar Programas de Formación</title>
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
                    <!-- Sección para agregar nuevo programa de formación -->
                    <h1>Administrar Programas de Formación</h1>
                    <form id="formAgregarPrograma">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                       
                       
                       
                       
                        <div class="form-group">
                            <label for="id_jornada">ID Jornada:</label>
                            <input type="text" class="form-control" id="id_jornada" name="id_jornada" required>
                        </div>
                        <div class="form-group">
                            <label for="id_mcer">ID MCER:</label>
                            <input type="text" class="form-control" id="id_mcer" name="id_mcer" required>
                        </div>
                        <div class="form-group">
                            <label for="id_modalidad">ID Modalidad:</label>
                            <input type="text" class="form-control" id="id_modalidad" name="id_modalidad" required>
                        </div>
                        <div class="form-group">
                            <label for="id_nivel_formacion">ID Nivel de Formación:</label>
                            <input type="text" class="form-control" id="id_nivel_formacion" name="id_nivel_formacion" required>
                        </div>
                        <div class="form-group">
                            <label for="matriculados">Matriculados:</label>
                            <input type="number" class="form-control" id="matriculados" name="matriculados" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio:</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_cierre">Fecha de Cierre:</label>
                            <input type="date" class="form-control" id="fecha_cierre" name="fecha_cierre" required>
                        </div>
                        <div class="form-group">
                            <label for="horas_curso">Horas del Curso:</label>
                            <input type="number" class="form-control" id="horas_curso" name="horas_curso" required>
                        </div>
                        <div class="form-group">
                            <label for="id_estado">Estado:</label>
                            <input type="text" class="form-control" id="id_estado" name="id_estado" required>
                        </div>
                        <div class="form-group">
                            <label for="ficha">Ficha:</label>
                            <input type="text" class="form-control" id="ficha" name="ficha" required>
                        </div>
                       
                       
                       
                       
                        <button type="button" class="btn btn-primary" id="btnAgregarPrograma">Agregar Programa</button>
                    </form>
                    <br><br>

                    <!-- Tabla de detalles de programas de formación -->
                    <h2>Detalle de Programas de Formación</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                               
                                <th>ID Jornada</th>
                                <th>ID MCER</th>
                                <th>ID Modalidad</th>
                                <th>ID Nivel Formación</th>
                                <th>Matriculados</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Cierre</th>
                                <th>Horas del Curso</th>
                                <th>Estado</th>
                                <th>Ficha</th>
                           
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <form method='post'>
                                                <td>{$row['id_programaformacion']}</td>
                                                <td><input type='text' name='nombre' value='{$row['nombre']}'></td>
                                          
                                                <td><input type='text' name='id_jornada' value='{$row['id_jornada']}'></td>
                                                <td><input type='text' name='id_mcer' value='{$row['id_mcer']}'></td>
                                                <td><input type='text' name='id_modalidad' value='{$row['id_modalidad']}'></td>
                                                <td><input type='text' name='id_nivel_formacion' value='{$row['id_nivel_formacion']}'></td>
                                                <td><input type='number' name='matriculados' value='{$row['matriculados']}'></td>
                                                <td><input type='date' name='fecha_inicio' value='{$row['fecha_inicio']}'></td>
                                                <td><input type='date' name='fecha_cierre' value='{$row['fecha_cierre']}'></td>
                                                <td><input type='number' name='horas_curso' value='{$row['horas_curso']}'></td>
                                                <td><input type='text' name='id_estado' value='{$row['id_estado']}'></td>
                                                <td><input type='text' name='ficha' value='{$row['ficha']}'></td>
                                             
                                                <td>
                                                    <input type='hidden' name='id_programaformacion' value='{$row['id_programaformacion']}'>
                                                    <button type='submit' name='action' value='edit' class='btn btn-primary'>Editar</button>
                                                    <button type='submit' name='action' value='copy' class='btn btn-success'>Copiar</button>
                                                    <button type='submit' name='action' value='delete' class='btn btn-danger'>Borrar</button>
                                                </td>
                                            </form>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='15'>No hay registros</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
         
    </form> </div> </div> </div> </div>
</div><a href="listarprogramadeformaciondesdeinstructor.php">
                        <i class="fas fa-arrow-circle-left"></i>
                        <span class="nav-item">Regresar</span>
                    </a>      <!-- Añadir Bootstrap JS (
    
    
    

    <!-- Script jQuery para agregar programa -->
    <script>
        $(document).ready(function() {
            // Acción al hacer clic en el botón de agregar programa
            $(document).on("click", "#btnAgregarPrograma", function() {
                // Recuperar datos del formulario
                var nombre = $("#nombre").val();
            
                var id_jornada = $("#id_jornada").val();
                var id_mcer = $("#id_mcer").val();
                var id_modalidad = $("#id_modalidad").val();
                var id_nivel_formacion = $("#id_nivel_formacion").val();
                var matriculados = $("#matriculados").val();
                var fecha_inicio = $("#fecha_inicio").val();
                var fecha_cierre = $("#fecha_cierre").val();
                var horas_curso = $("#horas_curso").val();
                var id_estado = $("#id_estado").val();
                var ficha = $("#ficha").val();
               

                // Enviar solicitud AJAX para agregar programa
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarPrograma',
                    nombre: nombre,
                 
                    id_jornada: id_jornada,
                    id_mcer: id_mcer,
                    id_modalidad: id_modalidad,
                    id_nivel_formacion: id_nivel_formacion,
                    matriculados: matriculados,
                    fecha_inicio: fecha_inicio,
                    fecha_cierre: fecha_cierre,
                    horas_curso: horas_curso,
                    id_estado: id_estado,
                    ficha: ficha,
                
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Programa agregado con éxito');
                        $("#formAgregarPrograma")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar el programa: ' + data.ms);
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













































































    
    
    
    
    
    
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 














