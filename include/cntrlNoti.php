<?php
//https://getbootstrap.com/docs/5.0/components/modal/
include_once('conex.php');
header('Content-Type: text/html; charset='.$charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn=Conectarse();
function uploadFile($file, $destinationDir) {
    // Crear el directorio si no existe
    if (!file_exists($destinationDir)) {
        mkdir($destinationDir, 0777, true);
    }

    $targetDir = rtrim($destinationDir, '/') . '/';
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar el tamaño del archivo
    if ($file["size"] > 5000000) { // Límite de 5MB
        echo "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos de archivo
    if (($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") && $destinationDir == "uploads/images/") {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return null;
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            echo "Lo siento, hubo un error al cargar tu archivo.";
            return null;
        }
    }
}

switch ($_REQUEST['action']) {
    case 'guardarNoticia':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $titulo = $_POST["titulo"] ?? null;
        $descripcion = $_POST["descripcion"] ?? null;
        $fecha_inicio = $_POST["fecha_inicio"] ?? null;
        $fecha_fin = $_POST["fecha_fin"] ?? null;
        $url = $_POST["id_url"] ?? null;
        $imagen = $_FILES["imagen"] ?? null;
        if ($imagen) {
            $imagenPath = uploadFile($imagen, "include/uploads/images/");

            if ($imagenPath) {
                // Preparar declaración SQL
                $query = "INSERT INTO detallesolicitud 
                            (id_tiposolicitud, nombre, imagen, fecha_inicio, fecha_fin, url, descripcion)
                            VALUES 
                            (4, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($query);

                if ($stmt) {
                    $stmt->bind_param("ssssss", $titulo, $imagenPath, $fecha_inicio, $fecha_fin, $url, $descripcion);

                    if ($stmt->execute()) {
                        $jTableResult['msj'] = "Registro guardado con éxito.";
                        $jTableResult['rstl'] = "1";
                    } else {
                        $jTableResult['msj'] = "Error al guardar: " . $stmt->error;
                        $jTableResult['rstl'] = "0";
                    }

                    $stmt->close();
                } else {
                    $jTableResult['msj'] = "Error al preparar la consulta: " . $conn->error;
                    $jTableResult['rstl'] = "0";
                }
            } else {
                $jTableResult['msj'] = "Falló la carga de archivos.";
                $jTableResult['rstl'] = "0";
            }
        } else {
            $jTableResult['msj'] = "Imagen no proporcionada.";
            $jTableResult['rstl'] = "0";
        }

        print json_encode($jTableResult);
    break;
    case 'noticiaCreado':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $jTableResult['noticia'] = "";
        $query = "
                    SELECT id_solicitud, imagen AS imagen, nombre AS titulo, fecha_inicio AS fecha_mostrada, descripcion, detallesolicitud.id_categoria
                    FROM 
                        solicitud
                    JOIN 
                        detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                    WHERE 
                        (detallesolicitud.id_tiposolicitud = 23 OR detallesolicitud.id_tiposolicitud = 4) AND 
                        (solicitud.id_estado = 4 OR solicitud.id_estado = 9)"; 
    
        $result = mysqli_query($conn, $query);
        // Verificar si se encontraron resultados
        if (mysqli_num_rows($result) > 0) {
            $jTableResult['msj'] = "Noticia Creada con Exito.";
            $jTableResult['rstl'] = "1";
            $jTableResult['noticia'] = ''; // Inicializar la variable
    
            while ($registro = mysqli_fetch_array($result)) {
                // Concatenar el contenido HTML para las tarjetas
                $jTableResult['noticia'] .= '
                    <div class=" rounded-container"
                        <div class="row blog-item px-3 pb-5">
                        <div class="cards ">
                        
                            <div class="imagenta">
                                <a href="">
                                    <img src="../../include/' . $registro["imagen"] . '" alt="Image">
                                </a>
                            </div>
                                
                                                     
                            <div class="cards__content">
                                <h3 class="cards__title">' . $registro["titulo"] . '</h3>
                                <div class="cards__description">
                                    <small class="mr-2 text-muted"><i class="fa fa-calendar-alt"></i> ' . $registro["fecha_mostrada"] . '</small>
                                    <small class="mr-2 text-muted"><i class="fa fa-folder"></i> Web Design</small>
                                    <small class="mr-2 text-muted"><i class="fa fa-comments"></i> 15 Comments</small>
                                    <p>' . $registro["descripcion"] . '</p>
                                </div>
                            </div>
                            ';
                            
                            
            
                        if ($registro["id_categoria"] == 3) {
                            if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4) {
                                $jTableResult['noticia'] .= '
                                        <a class="cards__button btn btn-link p-0" href=""><button type="button"  data-bs-toggle="modal" data-bs-target="#OfertModal" id="detalle_oferta" class="cards__button" data-id="' . $registro['id_solicitud'] . '">Me Interesa </button></a>
                                        
                                    </div>
                                </div>';
                            } else {
                                $jTableResult['noticia'] .= '
                                    <a class="cards__button btn btn-link p-0" href="">Read More <i class="fa fa-angle-right"></i></a>
                                    <div class="col-sm-2"></div>
                                </div>
                            </div>';
                            }
                        } else {
                            $jTableResult['noticia'] .= '
                                <a class="cards__button btn btn-link p-0" href="">Read More <i class="fa fa-angle-right"></i></a>
                                <div class="col-sm-2"></div>
                        </div>
                       </div>
                        </div>';
                        }
                    }
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['msj'] = "Error al Crear la noticia.";
                    $jTableResult['rstl'] = "0";
                }
            $jTableResult['noticia'] .= '</div';
        print json_encode($jTableResult);
        
    break;
    case 'registroCursoNew':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        
        // Preparar la consulta SQL para insertar en programaformacion
        $query = "INSERT INTO programaformacion (nombre, fecha_cierre, fecha_inicio, id_modalidad, id_jornada, id_estado, horas_curso) 
                    VALUES (?, ?, ?, ?, ?, 9, ?)";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "sssiii",
                $_POST['nombre'],
                $_POST['fecha_cierre'],
                $_POST['fecha_inicio'],
                $_POST['id_modalidad'],
                $_POST['id_jornada'],
                $_POST['horas_curso']
            );
            if (mysqli_stmt_execute($stmt)) {
                $id_programaformacion = mysqli_insert_id($conn);
    
                // Insertar en detallesolicitud
                $query_detalle = "INSERT INTO detallesolicitud (nombre, descripcion, imagen, fecha_inicio, fecha_fin, url, id_programaformacion, id_categoria,id_tiposolicitud) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?,3,23)";
                if ($stmt_detalle = mysqli_prepare($conn, $query_detalle)) {
                    mysqli_stmt_bind_param($stmt_detalle, "ssssssi",
                        $_POST['titulo'],
                        $_POST['descripcion'],
                        $_POST['imagen'],
                        $_POST['fecha_mostrada'],
                        $_POST['fecha_fin'],
                        $_POST['url'],
                        $id_programaformacion

                    );
                    if (mysqli_stmt_execute($stmt_detalle)) {
                        $id_detallesolicitud = mysqli_insert_id($conn);
                        
                        // Insertar en solicitud
                        $query_solicitud = "INSERT INTO solicitud (id_detallesolicitud, id_userprofile,id_estado,fecha_creacion) VALUES (?, ?,3,NOW())";
                        if ($stmt_solicitud = mysqli_prepare($conn, $query_solicitud)) {
                            mysqli_stmt_bind_param($stmt_solicitud, "iis",
                                $id_detallesolicitud,
                                $_SESSION['id_userprofile'],
                                
                            );
                            if (mysqli_stmt_execute($stmt_solicitud)) {
                                mysqli_commit($conn);
                                $jTableResult['msj'] = "El primer paso esta echo..";
                                $jTableResult['rstl'] = "1";
                            } else {
                                mysqli_rollback($conn);
                                $jTableResult['msj'] = "Error al guardar en solicitud.";
                                $jTableResult['rstl'] = "0";
                            }
                            mysqli_stmt_close($stmt_solicitud);
                        } else {
                            mysqli_rollback($conn);
                            $jTableResult['msj'] = "Error al preparar la consulta para guardar en solicitud.";
                            $jTableResult['rstl'] = "0";
                        }
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['msj'] = "Error al guardar en detallesolicitud.";
                        $jTableResult['rstl'] = "0";
                    }
                    mysqli_stmt_close($stmt_detalle);
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['msj'] = "Error al preparar la consulta para guardar en detallesolicitud.";
                    $jTableResult['rstl'] = "0";
                }
            } else {
                mysqli_rollback($conn);
                $jTableResult['msj'] = "Error al guardar en programaformacion.";
                $jTableResult['rstl'] = "0";
            }
            mysqli_stmt_close($stmt);
        } else {
            $jTableResult['msj'] = "Error al preparar la consulta para guardar en programaformacion.";
            $jTableResult['rstl'] = "0";
        }
        echo json_encode($jTableResult);
    break;
    case 'actualizarSolicitud':
        $id_solicitud = $_POST['id_solicitud'];
        $estado = isset($_POST['id_estado']) ? $_POST['id_estado'] : null;
        $responsable = isset($_POST['id_responsable']) ? $_POST['id_responsable'] : null;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
        $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;
        $fecha_mostrada = isset($_POST['fecha_mostrada']) ? $_POST['fecha_mostrada'] : null;
        $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
        $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
        $url = isset($_POST['url']) ? $_POST['url'] : null;
        $updateFields = [];
    
        if ($estado !== null) {
            $updateFields[] = "solicitud.id_estado = '$estado'";
        }
        if ($responsable !== null) {
            $updateFields[] = "solicitud.id_responsable = '$responsable'";
        }
        if ($descripcion !== null) {
            $updateFields[] = "detallesolicitud.descripcion = '$descripcion'";
        }
        if ($titulo !== null) {
            $updateFields[] = "detallesolicitud.titulo = '$titulo'";
        }
        if ($imagen !== null) {
            $updateFields[] = "detallesolicitud.imagen = '$imagen'";
        }
        if ($fecha_mostrada !== null) {
            $updateFields[] = "detallesolicitud.fecha_mostrada = '$fecha_mostrada'";
        }
        if ($fecha_inicio !== null) {
            $updateFields[] = "detallesolicitud.fecha_inicio = '$fecha_inicio'";
        }
        if ($fecha_fin !== null) {
            $updateFields[] = "detallesolicitud.fecha_fin = '$fecha_fin'";
        }
        if ($url !== null) {
            $updateFields[] = "detallesolicitud.url = '$url'";
        }
    
        if (!empty($updateFields)) {
            $updateQuery = implode(", ", $updateFields);
            $query = "UPDATE solicitud
                        JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                        JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                        SET $updateQuery
                        WHERE solicitud.id_solicitud = '$id_solicitud'";
    
            if ($result = mysqli_query($conn, $query)) {
                // Realizar una nueva consulta para obtener el estado actualizado
                $query_estado = "SELECT id_estado FROM solicitud WHERE id_solicitud = '$id_solicitud'";
                $resultado_estado = mysqli_query($conn, $query_estado);
                $row_estado = mysqli_fetch_assoc($resultado_estado);
    
                if ($row_estado['id_estado'] == 6) {
                    $query = "UPDATE solicitud
                                SET fecha_asignada = NOW()
                                WHERE id_solicitud = '$id_solicitud'";
                    $resultado = mysqli_query($conn, $query);
                }
    
                mysqli_commit($conn);
                $jTableResult['msj'] = "Actualizado con éxito.";
                $jTableResult['rstl'] = "1";
            } else {
                mysqli_rollback($conn);
                $jTableResult['msj'] = "Error al actualizar.";
                $jTableResult['rstl'] = "0";
            }
        } else {
            $jTableResult['msj'] = "No se proporcionaron datos para actualizar.";
            $jTableResult['rstl'] = "0";
        }
    
        print json_encode($jTableResult);
    break;
    case 'Postular':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $userprofile = $_SESSION['id_userprofile'];
    
        // Verificar si el archivo se ha subido sin errores
        if (isset($_FILES['documentos_usuarios']) && $_FILES['documentos_usuarios']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'C:/xampp/htdocs/practica/archivos/vista/doc_usu/'; // Asegúrate de usar una ruta absoluta correcta
            $uploadFile = $uploadDir . basename($_FILES['documentos_usuarios']['name']);
            
            // Crear el directorio si no existe
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            if (move_uploaded_file($_FILES['documentos_usuarios']['tmp_name'], $uploadFile)) {
                $query = "INSERT INTO usersxoferta (id_userprofile, id_solicitud, documento,detalle) VALUES ('$userprofile', '" . $_POST['id_solicitud'] . "', '$uploadFile','" . $_POST['detalle'] . "')";
                if ($result = mysqli_query($conn, $query)) {
                    mysqli_commit($conn);
                    $jTableResult['rst'] = "1";
                    $jTableResult['ms'] = "Ofertado con éxito";
                } else {
                    $jTableResult['rst'] = "2";
                    $jTableResult['ms'] = "No ofertado con éxito";
                }
            } else {
                $jTableResult['rst'] = "2";
                $jTableResult['ms'] = "Error al mover el archivo";
            }
        } else {
            $jTableResult['rst'] = "2";
            $jTableResult['ms'] = "Error al subir el archivo: " . $_FILES['documentos_usuarios']['error'];
        }
        
        print json_encode($jTableResult);
    break;
    case 'ListarSolicitud_of':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['Listof'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
        $query = "SELECT 
        s.id_solicitud,
        s.id_estado, 
        u.nombre, 
        u.id_rol,
        j.nombre AS nom_jornada,
        m.nombre AS nom_modalidad,
        nf.nombre AS nom_nf,
        d.nombre_dpto AS nom_dpto, 
        m_municipio.nombre_municipio AS nom_muni, 
        p.nombre_poblado AS nom_vereda, 
        u.nombre_dos,
        u.apellido, 
        au.nombre AS area_usu, 
        ts.nombre AS Nombre_Solicitud, 
        ds.id_tiposolicitud,
        ds.descripcion,
        a.nombre AS nom_area,
        pf.nombre AS nom_pf,
        pf.horas_curso,
        pf.fecha_inicio,
        pf.fecha_cierre,
        r.nombre AS nom_rol
        FROM 
            solicitud s
        LEFT JOIN  
            userprofile u ON s.id_userprofile = u.id_userprofile
        LEFT JOIN   
            detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
        LEFT JOIN
            programaformacion pf ON ds.id_programaformacion = pf.id_programaformacion
        LEFT JOIN  
            departamentos d ON u.cod_dpto = d.cod_dpto
        LEFT JOIN  
            municipios m_municipio ON u.cod_municipio = m_municipio.cod_municipio
        LEFT JOIN  
            poblados p ON u.cod_poblado = p.cod_poblado
        LEFT JOIN   
            tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
        LEFT JOIN  
            area au ON u.id_area = au.id_area
        LEFT JOIN  
            area a ON pf.id_area = a.id_area
        LEFT JOIN
            jornada j ON pf.id_jornada = j.id_jornada
        LEFT JOIN
            modalidad m ON pf.id_modalidad = m.id_modalidad
        LEFT JOIN
            nivelformacion nf ON pf.id_nivel_formacion = nf.id_nivel_formacion
            LEFT JOIN
            rol r ON u.id_rol = r.id_rol
        WHERE 
            s.id_solicitud = '$id_solicitud'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['Listof'] .= "
                    <form id='postulacionForm' enctype='multipart/form-data' class='form-container'>
                        <label class='label-identifier'>Encargado</label>
                        <label id='solicitante' class='form-control'>
                            " . $registro['nombre'] . " " . $registro['nombre_dos'] . " " . $registro['apellido'] . "
                        </label>
                        <br>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='label-identifier'>Cargo </h6>
                                <h6 class='form-control'>" . $registro['nom_rol'] . "</h6>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='label-identifier'>Area Publicitante</h6>
                                <h6 class='form-control'>" . $registro['area_usu'] . "</h6>
                            </div>
                        </div>
                        <br>
                        <h5><strong>Informacion y Estado</strong></h5>
                        <label class='label-identifier'>Nombre Curso Ofertado</label>
                        <h6 class='form-control'>" . $registro['nom_pf'] . "</h6>
                        <br>
                        <label class='label-identifier'>Jornada Curso Ofertado</label>
                        <h6 class='form-control'>" . $registro['nom_jornada'] . "</h6>
                        <br>
                        <label class='label-identifier'>Modalidad Curso Ofertado</label>
                        <h6 class='form-control'>" . $registro['nom_modalidad'] . "</h6>
                        <br>
                        <label class='label-identifier'>Nivel Academico Curso Ofertado</label>
                        <h6 class='form-control'>" . $registro['nom_nf'] . "</h6>
                        <br>
                        <label class='label-identifier'>Horas Totales de Curso Ofertado</label>
                        <h6 class='form-control'>" . $registro['horas_curso'] . "</h6>
                        <br>
                        <label class='label-identifier'>Fecha Inicio de Curso Ofertado</label>
                        <h6 class='form-control'>" . $registro['fecha_inicio'] . "</h6>
                        <br>
                        <label class='label-identifier'>Fecha Fin de Curso Ofertado</label>
                        <h6 class='form-control'>" . $registro['fecha_cierre'] . "</h6>
                        <br>
                        <label class='label-identifier'>Detalles Oferta</label>
                        <br>
                        <label id='detalles' name='detalles' class='form-control'>" . $registro['descripcion'] . "</label>
                        <br>
                        <label class='label-identifier'>Area Curso</label>
                        <h6 class='form-control'>" . $registro['nom_area'] . "</h6>
                        <br>
                        <hr>";

                    if ($_SESSION['id_rol'] == '1') {
                        $jTableResult ['Listof'] .= "
                        <div class='mb-3'>
                            <label class='form-label'>Motivo Postulacion:</label>
                            <textarea rows='5' class='form-control' id='detalle' name='detalle'></textarea>
                        </div>
                        </form>";
                    } else {
                        $jTableResult ['Listof'] .= "
                        <div class='mb-3'>
                            <label class='form-label'>¿Cuenta con los usuarios requeridos?</label>
                            <input type='file' class='form-control' id='documentos_usuarios' name='documentos_usuarios'>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Descripción:</label>
                            <textarea rows='5' class='form-control' id='detalle' name='detalle'></textarea>
                        </div>
                        </form>
                    ";
                }
                $jTableResult['Listof'] .= "</form>";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case'SubirContenido':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
        $query ="UPDATE solicitud s
                    SET s.id_estado = 9
                WHERE s.id_solicitud = '$id_solicitud'";
        if($result= mysqli_query($conn,$query)){
            mysqli_commit($conn);
            $jTableResult['rst']= "1";
            $jTableResult['ms'] = "Ofertado con exito";
        }
        else{
            $jTableResult['rst']= "2";
            $jTableResult['ms'] = " NO Ofertado con exito";
        }
        print json_encode($jTableResult);
    break;
    case'SubirContenidoN':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
        $query ="UPDATE solicitud s
                    SET s.id_estado = 4
                WHERE s.id_solicitud = '$id_solicitud'";
        if($result= mysqli_query($conn,$query)){
            mysqli_commit($conn);
            $jTableResult['rst']= "1";
            $jTableResult['ms'] = "Ofertado con exito";
        }
        else{
            $jTableResult['rst']= "2";
            $jTableResult['ms'] = " NO Ofertado con exito";
        }
        print json_encode($jTableResult);
    break;
}
mysqli_close($conn);
    ?>