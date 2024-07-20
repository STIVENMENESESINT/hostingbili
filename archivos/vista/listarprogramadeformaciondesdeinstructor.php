 
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
  
            <div class="content__page">
                <!-- Sección para agregar nuevo programa de formación -->
                <h1>Administrar Programas de Formación</h1>
                <form id="formAgregarPrograma" method="POST" action="procesar_formulario.php">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="id_jornada">ID Jornada:</label>
                        <select class="form-control" id="id_jornada" name="id_jornada" required>
                            <option value="">Seleccione una jornada</option>
                            <?php
                            // Consulta para obtener las jornadas desde la base de datos
                            $query = "SELECT id_jornada, nombre FROM jornada";
                            $resultado = mysqli_query($conn, $query);
                            if ($resultado) {
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . $fila['id_jornada'] . "'>" . $fila['nombre'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Error al cargar las jornadas</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_mcer">ID MCER:</label>
                        <select class="form-control" id="id_mcer" name="id_mcer" required>
                            <option value="">Seleccione un nivel MCER</option>
                            <?php
                            $queryMCER = "SELECT id_mcer, nombre FROM mcer";
                            $resultadoMCER = mysqli_query($conn, $queryMCER);
                            if ($resultadoMCER) {
                                while ($fila = mysqli_fetch_assoc($resultadoMCER)) {
                                    echo "<option value='" . $fila['id_mcer'] . "'>" . $fila['nombre'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Error al cargar los niveles MCER</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_modalidad">ID Modalidad:</label>
                        <select class="form-control" id="id_modalidad" name="id_modalidad" required>
                            <option value="">Seleccione una modalidad</option>
                            <?php
                            $sqlModalidades = "SELECT * FROM modalidad";
                            $resultModalidades = $conn->query($sqlModalidades);
                            if ($resultModalidades->num_rows > 0) {
                                while ($row = $resultModalidades->fetch_assoc()) {
                                    echo "<option value='" . $row['id_modalidad'] . "'>" . $row['nombre'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No hay modalidades disponibles</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_nivel_formacion">ID Nivel de Formación:</label>
                        <select class="form-control" id="id_nivel_formacion" name="id_nivel_formacion" required>
                            <option value="">Seleccione un nivel de formación</option>
                            <?php
                            $sqlNivelesFormacion = "SELECT * FROM nivelformacion";
                            $resultNivelesFormacion = $conn->query($sqlNivelesFormacion);
                            if ($resultNivelesFormacion->num_rows > 0) {
                                while ($row = $resultNivelesFormacion->fetch_assoc()) {
                                    echo "<option value='" . $row['id_nivel_formacion'] . "'>" . $row['nombre'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No hay niveles de formación disponibles</option>";
                            }
                            ?>
                        </select>
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
                
                    <button type="submit" id="btnAgregarPrograma" class="btn btn-primary">Agregar Programa</button>
                    </form>
              
              
                </form>
            </div>
        </div>




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
  
    </div>
            
           
    </div>
        </div>
    </div><a href="listardesdeinstructor.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>   

 
 
 
 
 

    <!-- Script jQuery para agregar programa -->
    <script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Acción al hacer clic en el botón de agregar programa
        $(document).on("click", "#btnAgregarPrograma", function(event) {
            event.preventDefault(); // Evitar el envío tradicional del formulario

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
            $.post("procesar_formularioprograma.php", {
                action: 'AgregarProgramaFormacion',
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
                ficha: ficha
            }, function(data) {
                if (data.rst === "1") {
                    alert('Programa agregado con éxito');
                    $("#formAgregarPrograma")[0].reset(); // Limpiar el formulario
                } else {
                    alert('Error al agregar el programa: ' + data.ms);
                }
            }, 'json').fail(function(xhr, status, error) {
                console.error(xhr);
                alert('Hubo un error al procesar la solicitud. Por favor, inténtelo de nuevo.');
            });
        });
    });






$(document).ready(function() {
    // Acción al hacer clic en el botón de agregar programa
    $(document).on("click", "#btnAgregarPrograma2", function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

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
        $.post("procesar_formulario.php", {
            action: 'AgregarProgramaFormacion',
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
            ficha: ficha
        }, function(data) {
            if (data.rst === "1") {
                alert('Programa agregado con éxito');
                $("#formAgregarPrograma")[0].reset(); // Limpiar el formulario
            } else {
                alert('Error al agregar el programa: ' + data.ms);
            }
        }, 'json').fail(function(xhr, status, error) {
            console.error(xhr);
            alert('Hubo un error al procesar la solicitud. Por favor, inténtelo de nuevo.');
        });
    });
});









$(document).ready(function() {
            // Acción al hacer clic en el botón de agregar programa
            $(document).on("click", "#btnAgregarPrograma3", function() {
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


$(document).ready(function () {
     // Evento delegado para los botones de editar nivel MCER
     $('#mcer-lista').on('click', '.btn-editar-mcer', function () {
         var mcerId = $(this).data('id');
         // Aquí puedes implementar la lógica para editar el nivel MCER específico
         console.log('Editar nivel MCER con ID: ' + mcerId);
     });
     // Evento delegado para los botones de detalles de nivel MCER
     $('#mcer-lista').on('click', '.btn-detalles-mcer', function () {
         var mcerId = $(this).data('id');
         // Lógica para mostrar detalles del nivel MCER específico
         console.log('Detalles del nivel MCER con ID: ' + mcerId);
     });
     // Evento delegado para los botones de eliminar nivel MCER
     $('#mcer-lista').on('click', '.btn-eliminar-mcer', function () {
         var mcerId = $(this).data('id');
         // Lógica para eliminar el nivel MCER específico
         console.log('Eliminar nivel MCER con ID: ' + mcerId);
     });
 });


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


     $(document).ready(function() {
       // Acción al hacer clic en el botón de agregar nivel de formación
       $(document).on("click", "#btnAgregarNivelFormacion", function() {
           // Enviar solicitud AJAX para agregar nivel de formación
           $.post("../../include/ctrlIndex3.php", {
               action: 'AgregarNivelFormacion',
               nombre: $("#nombre").val()
           }, function(data) {
               if (data.rst == "1") {
                   alert('Nivel de formación agregado con éxito');
                   $("#formAgregarNivelFormacion")[0].reset(); // Limpiar el formulario
               } else {
                   alert('Error al agregar el nivel de formación: ' + data.ms);
               }
           }, 'json');
       });
   });


   $(document).ready(function() {
            // Acción al hacer clic en el botón de agregar ficha
            $(document).on("click", "#btnAgregarFicha", function() {
                // Enviar solicitud AJAX para agregar ficha
                $.post("../../include/ctrlIndex3.php", {
                    action: 'AgregarFicha',
                    ficha: $("#ficha").val(),
                    id_programaformacion: $("#id_programaformacion").val()
                }, function(data) {
                    if (data.rst == "1") {
                        alert('Ficha agregada con éxito');
                        $("#formAgregarFicha")[0].reset(); // Limpiar el formulario
                    } else {
                        alert('Error al agregar la ficha: ' + data.ms);
                    }
                }, 'json');
            });
        });



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





   
   
   
   
   






































      
           
           
           
           

           
           
           








   
   
   
   
   
   
   
   
   
   

   
   
   
   
   
   

   
   
   
   
   
   
