<?php
//https://getbootstrap.com/docs/5.0/components/modal/
include_once('conex.php');
header('Content-Type: text/html; charset='.$charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn=Conectarse();
switch ($_REQUEST['action']) 
{

    case 'RegistroSoliNew':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        function sanitize_input($input) {
            return isset($input) && $input !== '' && $input !== 'undefined' ? "'" . $input . "'" : "NULL";
        }
        $id_resultado_aprendizaje = sanitize_input($_POST['id_resultado_aprendizaje']);
        $id_competencia = sanitize_input($_POST['id_competencia']);
        $nombre = sanitize_input($_POST['nombre']);
        $fecha_inicio = sanitize_input($_POST['fecha_inicio']);
        $jornada = sanitize_input($_POST['id_jornada']);
        $instagram = sanitize_input($_POST['instagram']);
        $facebook = sanitize_input($_POST['facebook']);
        $youtube = sanitize_input($_POST['youtube']);
        $twitter = sanitize_input($_POST['twitter']);
        $imagen = sanitize_input($_POST['imagen']);
        $dpto = sanitize_input($_POST['cod_dpto']);
        $municipio = sanitize_input($_POST['cod_municipio']);
        $vereda = sanitize_input($_POST['cod_poblado']);
        $ficha = sanitize_input($_POST['ficha']);
        $descripcion = sanitize_input($_POST['descripcion']);
        $id_nivel_formacion = sanitize_input($_POST['id_nivel_formacion']);
        $id_programaformacion = sanitize_input($_POST['id_programaformacion']);
        
        // Manejo de la carga del archivo
        $uploadDir = 'doc_usu/';
        $archivoPath = "NULL";
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
            $archivoPath = $uploadDir . basename($_FILES['archivo']['name']);
            
            // Crear el directorio si no existe
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            if (!move_uploaded_file($_FILES['archivo']['tmp_name'], $archivoPath)) {
                $jTableResult['rst'] = "0";
                $jTableResult['ms'] = "Error al mover el archivo";
                print json_encode($jTableResult);
                return; // Cambiado a return en lugar de break
            }
            
            // Ajuste para que archivoPath sea tratado como cadena de texto en la consulta
            $archivoPath = "'" . $archivoPath . "'";
        }
        
        // Consulta para insertar datos en la base de datos
        $query = "INSERT INTO detallesolicitud SET
                    id_tiposolicitud = '" . $_POST['id_tiposolicitud'] . "', 
                    nombre = $nombre,
                    id_jornada = $jornada, 
                    fecha_inicio = $fecha_inicio,
                    instagram = $instagram, 
                    facebook = $facebook, 
                    youtube = $youtube, 
                    twitter = $twitter, 
                    imagen = $imagen, 
                    descripcion = $descripcion,
                    cod_dpto = $dpto, 
                    cod_municipio = $municipio, 
                    ficha= $ficha,
                    id_competencia = $id_competencia,
                    id_resultado_aprendizaje = $id_resultado_aprendizaje,
                    id_nivel_formacion = $id_nivel_formacion,
                    id_programaformacion = $id_programaformacion,
                    cod_poblado = $vereda, 
                    documento = $archivoPath;";
    
        if ($result = mysqli_query($conn, $query)) {
            mysqli_commit($conn);
            $jTableResult['rst'] = "1";
            $mensaje = "Su solicitud fue enviada con Exito\r\n a la coordinacion de Bilinguismo del centro agropecuario\r\nNombre de la solicitud .......";
            @mail('flortasconjersoncamilo@gmail.com', 'Solicitud Exitosa', $mensaje);
        } else {
            mysqli_rollback($conn);
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al guardar.";
        }
    
        print json_encode($jTableResult);
    break;
    case 'TipoSoliNew': // este nombra esta patentado. no utilizar. tomar otro diferente para cada uno.
        $jTableResult = array();
        $jTableResult['rst']="";
        $jTableResult['ms']="";
            $query="INSERT INTO tiposolicitud SET
                    id_rol ='".$_POST['id_rol']."', 
                    nombre ='".$_POST['nombre']."';"; 
            if($result= mysqli_query($conn,$query)){
                    mysqli_commit($conn);
                    $jTableResult['rst']= "1";
                    $jTableResult['ms']="Tipo de Solicitud Guardado con exito";
                    // El mensaje
                    $mensaje = "Su solicitud fue enviada con Exito\r\n a la coordinacion de Bilinguismo del centro agropecuario\r\nNombre de la solicitud .......";
                    @mail('flortasconjersoncamilo@gmail.com', 'Mi título', $mensaje);
                    }
            else{
                    mysqli_rollback($conn);
                    $jTableResult['ms']= "Error al guardar.";				
                    $jTableResult['rst']= "0";  }
        print json_encode($jTableResult);
    break;
    case 'Solicitud':
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        
        $empresa = isset($_POST['id_empresa']) && !empty($_POST['id_empresa']) ? $_POST['id_empresa'] : NULL;
        $responsable = isset($_POST['id_responsable']) && !empty($_POST['id_responsable']) ? $_POST['id_responsable'] : NULL;

        $query = "SELECT MAX(id_detallesolicitud) as lastId FROM detallesolicitud;"; 
        $arreglo = mysqli_query($conn, $query);
        if ($arreglo) {
            $result = mysqli_fetch_array($arreglo);
            if ($result) {
                $varid = $result['lastId'];
                $query = "INSERT INTO solicitud (id_detallesolicitud, id_estado, id_userprofile, fecha_creacion, id_empresa, id_responsable) 
                            VALUES ('$varid', 3, '".$_SESSION['id_userprofile']."', NOW(), ?, ?)";
                
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ii", $empresa, $responsable);
    
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_commit($conn);
                    $jTableResult['ms'] = "Solicitud guardada con éxito.";
                    $jTableResult['rst'] = "1";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['ms'] = "Error al guardar metadatos.";
                    $jTableResult['rst'] = "0";
                }
            } else {
                $jTableResult['ms'] = "Error al obtener el último id de detallesolicitud.";
                $jTableResult['rst'] = "0";
            }
        } else {
            $jTableResult['ms'] = "Error en la consulta de id_detallesolicitud.";
            $jTableResult['rst'] = "0";
        }
        
        print json_encode($jTableResult);
    break;
    case 'detalleSolicitud':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListDetalle'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
                        $query = "SELECT 
                                s.id_solicitud,
                                s.fecha_creacion,
                                s.fecha_respuesta,
                                s.fecha_asignada,
                                u.nombre, 
                                d.nombre_dpto AS nom_dpto, 
                                m.nombre_municipio AS nom_muni, 
                                p.nombre_poblado AS nom_vereda, 
                                et.nombre AS nom_estado, 
                                u.nombre_dos,
                                u.apellido,
                                ur.nombre_dos AS nom_dosR,
                                ur.apellido AS apellidoR,
                                ur.nombre AS nomR,
                                e.nombre AS nom_Empresa, 
                                ts.nombre AS Nombre_Solicitud, 
                                ds.id_tiposolicitud,
                                ds.descripcion,
                                a.nombre AS nom_area,
                                pf.nombre AS nom_pgf,
                                pf.matriculados,
                                pf.fecha_inicio,
                                pf.fecha_cierre,
                                pf.horas_curso,
                                pf.ficha,
                                epf.nombre AS estado_nom_pgf,
                                j.nombre AS nom_jornada,
                                md.nombre AS nom_modalidad,
                                nf.nombre AS nom_nivelF
                            FROM 
                                solicitud s
                            LEFT JOIN 
                                programaformacion pf ON s.id_programaformacion = pf.id_programaformacion
                            LEFT JOIN 
                                nivelformacion nf ON pf.id_nivel_formacion = nf.id_nivel_formacion
                            LEFT JOIN 
                                modalidad md ON pf.id_modalidad = md.id_modalidad
                            LEFT JOIN 
                                jornada j ON pf.id_jornada = j.id_jornada
                            LEFT JOIN 
                                estado epf ON pf.id_estado = epf.id_estado
                            LEFT JOIN  
                                estado et ON s.id_estado = et.id_estado
                            LEFT JOIN  
                                userprofile ur ON s.id_responsable = ur.id_userprofile
                            LEFT JOIN  
                                userprofile u ON s.id_userprofile = u.id_userprofile
                            LEFT JOIN  
                                detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
                            LEFT JOIN  
                                departamentos d ON ds.cod_dpto = d.cod_dpto
                            LEFT JOIN  
                                municipios m ON ds.cod_municipio = m.cod_municipio
                            LEFT JOIN  
                                poblados p ON ds.cod_poblado = p.cod_poblado
                            LEFT JOIN  
                                empresa e ON s.id_empresa = e.id_empresa
                            LEFT JOIN  
                                tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
                            LEFT JOIN 
                                area a ON ds.id_area = a.id_area
                            WHERE 
                                s.id_solicitud = '$id_solicitud';
                        ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                if ($registro['id_tiposolicitud'] == 1){
                    $jTableResult['ListDetalle'] .= "
                    <div class='form-container'>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Fecha Realizacion Solicitud</label>
                            <label class='data-field'></label>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Empresa</label>
                            <label class='data-field'></label>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Solicitante</label>
                            <label class='data-field' id='solicitante'></label>
                        </div>
                        <br>
                        <h5 class='label-identifier'><strong>Ubicación Sugerida Para Solicitud</strong></h5>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Departamento</h6>
                            <label class='data-field'></label>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Municipio</h6>
                            <label class='data-field'></label>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Vereda</h6>
                            <label class='data-field'></label>
                        </div>
                        <br>
                        <div class='course-data-field'>
                            <label class='label-identifier' for='detalles'>Detalles</label>
                            <br>
                            <textarea id='detalles' name='detalles'></textarea>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Área</label>
                            <label class='data-field'></label>
                        </div>
                        <br>
                        <div class='course-data-field'>
                            <label class='label-identifier' for='archivo'>Cargar Archivo solicitud (solo archivos de tipo pdf)</label>
                            <input type='file' id='archivo' name='archivo' accept='.pdf'>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Responsable</h6>
                            <label class='data-field'></label>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Estado</h6>
                            <label class='data-field'></label>
                        </div>
                        <hr>
                        <div class='course-data-container'>
                            <h2 class='label-identifier'>DATOS DE CURSO</h2>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Fecha Asignacion</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Nombre curso</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Fecha inicio</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Fecha cierre</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Numero de ficha</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Horas de curso</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Modalidad</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Jornada</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Nivel de Formacion</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Matriculados</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Estado</label>
                                <label class='data-field'></label>
                            </div>
                            <div class='course-data-field'>
                                <label class='label-identifier'>Certificados</label>
                                <input type='number' id='certificates' value='0' />
                            </div>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Fecha Respuesta Solicitud</label>
                            <label class='data-field'></label>
                        </div>
                    </div>

                ";
                }elseif($registro['id_tiposolicitud'] == 2){
                    $jTableResult['ListDetalle'] .= "
                    <h1>hola</h1>
                    ";
                }
                }
            }else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        
        echo json_encode($jTableResult);
    break;
    case 'ListarSolicitud':
        $jTableResult = array();
        $id_solicitud = $_POST['id_solicitud'];
        $query = "SELECT solicitud.id_solicitud, detallesolicitud.*,e.nombre AS Nom_Estado, up.nombre AS Nom_Responsable, tiposolicitud.nombre AS Nombre_Solicitud, detallesolicitud.id_tiposolicitud
                    FROM solicitud
                    JOIN userprofile up ON solicitud.id_userprofile = up.id_userprofile
                    JOIN estado e ON solicitud.id_estado = e.id_estado
                    JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                    JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud 
                    WHERE solicitud.id_solicitud = '$id_solicitud'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $registro = mysqli_fetch_assoc($result); // Usar fetch_assoc para obtener una fila asociativa
            $jTableResult = [
                'rstl' => '1',
                'solicitud' => $registro
            ];
            if ($registro['id_tiposolicitud'] == 1) {
            }
        } else {
            $jTableResult = [
                'rstl' => '0',
                'msj' => 'Error al obtener los datos.'
            ];
        }
        echo json_encode($jTableResult);
    break;
    case 'ListarSolicitud_asignacion':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListAsign'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
                        $query = "SELECT 
                                    s.id_solicitud, 
                                    u.nombre, 
                                    u.id_rol,
                                    d.nombre_dpto AS nom_dpto, 
                                    m.nombre_municipio AS nom_muni, 
                                    p.nombre_poblado AS nom_vereda, 
                                    u.nombre_dos,
                                    u.apellido, 
                                    e.nombre AS nom_Empresa, 
                                    ts.nombre AS Nombre_Solicitud, 
                                    ds.id_tiposolicitud,
                                    ds.descripcion,
                                    ds.documento,
                                    a.nombre AS nom_area
                                FROM 
                                    solicitud s
                                LEFT JOIN  
                                    userprofile u ON s.id_userprofile = u.id_userprofile
                                LEFT JOIN   
                                    detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
                                LEFT JOIN  
                                    departamentos d ON ds.cod_dpto = d.cod_dpto
                                LEFT JOIN  
                                    municipios m ON ds.cod_municipio = m.cod_municipio
                                LEFT JOIN  
                                    poblados p ON ds.cod_poblado = p.cod_poblado
                                LEFT JOIN   
                                    empresa e ON u.id_empresa = e.id_empresa
                                LEFT JOIN   
                                    tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
                                LEFT JOIN  
                                    area a ON ds.id_area = a.id_area
                                WHERE 
                                    s.id_solicitud = '$id_solicitud';";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['ListAsign'] .= "
                    <div class='form-container'>
                        ";
                        if ($registro['id_rol'] == 4){
                            echo
                            "
                            <label class='label-identifier'>Empresa</label>
                            <label class='data-field'>" . $registro['nom_Empresa'] . "</label>";
                        }
                        
                        $jTableResult['ListAsign'] .= " <label class='label-identifier'>Solicitante</label>
                        <label class='data-field' id='solicitante'>" . $registro['nombre'] . "</label>
                        <br>
                        
                        <h5 class='label-identifier'><strong>Ubicación Sugerida Para Solicitud</strong></h5>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='label-identifier'>Departamento</h6>
                                <label class='data-field'>" . $registro['nom_dpto'] . "</label>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='label-identifier'>Municipio</h6>
                                <label class='data-field'>" . $registro['nom_muni'] . "</label>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='label-identifier'>Vereda</h6>
                                <label class='data-field'>" . $registro['nom_vereda'] . "</label>
                            </div>
                        </div>
                        <br>
                        
                        <label class='label-identifier' for='detalles'>Detalles</label>
                        <br>
                        <textarea id='detalles' name='detalles'>" . $registro['descripcion'] . "</textarea>
                        <br>
                        <label class='label-identifier' for='archivo'>Descargar Información Cargada por Usuario</label>
                        <label class='data-field'><a href='../../include/" . $registro['documento'] . "' download>Descargar Documento</a></label>
                        <br/>
                        <hr>
                        <h3 class='label-identifier'>Asignación</h3>
                        <h6 class='label-identifier'>Responsable</h6>
                        <select id='id_responsable'></select>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                        <button type='button' class='create-button' id='btnGuardarCambios2'>Asignar</button>
                    </div>
                ";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case 'ListarSolicitud_pf':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListPf'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
                        $query = "SELECT 
                                    s.id_solicitud, 
                                    u.nombre, 
                                    d.nombre_dpto AS nom_dpto, 
                                    m.nombre_municipio AS nom_muni, 
                                    p.nombre_poblado AS nom_vereda, 
                                    u.nombre_dos,
                                    u.apellido, 
                                    e.nombre AS nom_Empresa, 
                                    ts.nombre AS Nombre_Solicitud, 
                                    ds.id_tiposolicitud,
                                    ds.descripcion,
                                    a.nombre AS nom_area,
                                    pf.nombre AS nom_pf
                                FROM 
                                    solicitud s
                                LEFT JOIN
                                    programaformacion pf ON s.id_programaformacion = pf.id_programaformacion
                                LEFT JOIN  
                                    userprofile u ON s.id_userprofile = u.id_userprofile
                                LEFT JOIN   
                                    detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
                                LEFT JOIN  
                                    departamentos d ON u.cod_dpto = d.cod_dpto
                                LEFT JOIN  
                                    municipios m ON u.cod_municipio = m.cod_municipio
                                LEFT JOIN  
                                    poblados p ON u.cod_poblado = p.cod_poblado
                                LEFT JOIN   
                                    empresa e ON u.id_empresa = e.id_empresa
                                LEFT JOIN   
                                    tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
                                LEFT JOIN  
                                    area a ON pf.id_area = a.id_area
                                WHERE 
                                    s.id_solicitud = '$id_solicitud';";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['ListPf'] .= "
                    <div class='form-container'>
                <label class='label-identifier'>Solicitante</label>
                <label class='data-field' id='solicitante'></label>
                <br>
                <h5 class='label-identifier'><strong>Ubicación Solicitante</strong></h5>
                <div class='row mt-3'>
                    <div class='col-sm-12'>
                        <h6 class='modal-title'>Departamento</h6>
                        <label class='data-field'></label>
                    </div>
                </div>
                <div class='row mt-3'>
                    <div class='col-sm-12'>
                        <h6 class='modal-title'>Municipio</h6>
                        <label class='data-field'></label>
                    </div>
                </div>
                <div class='row mt-3'>
                    <div class='col-sm-12'>
                        <h6 class='modal-title'>Vereda</h6>
                        <label class='data-field'></label>
                    </div>
                </div>
                <br>
                <label class='label-identifier' for='detalles'>Detalles</label>
                <br>
                <textarea id='detalles' name='detalles'></textarea>
                <br>
                <hr>
                <h3 class='label-identifier'>Asignación</h3>
                <hr>
                <h6 class='label-identifier'>Responsable</h6>
                <select id='id_responsable'></select>
                <h6 class='label-identifier'>Estado</h6>
                <select id='id_estado'></select>
                <hr>
                <h3 class='label-identifier'>Responder</h3>
                <hr>
                <h6 class='label-identifier'>Detalle Respuesta</h6>
                <textarea id='detalle_respuesta' name='detalles'></textarea>
                <h6 class='label-identifier'>Cargar Información</h6>
                <label class='label-identifier' for='archivo'>Cargar Archivo Respuesta solicitud (solo archivos de tipo pdf)</label>
                <input type='file' id='archivo' name='archivo' accept='.pdf'>
                <br/>
                <button id='btnAceptarSoli' class='create-button' data-id=''>Dar Respuesta</button>
            </div>
            ";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case 'AlertaOferta':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListOf'] = "";
    
        $queryUsuarios = "SELECT 
                        s.id_solicitud,
                        COUNT(uf.id_userprofile) AS total_users,
                        SUM(CASE WHEN u.id_rol = 1 THEN 1 ELSE 0 END) AS role_1_users,
                        SUM(CASE WHEN u.id_rol = 4 THEN 1 ELSE 0 END) AS role_4_users
                    FROM 
                        usersxoferta uf
                    JOIN 
                        solicitud s ON uf.id_solicitud = s.id_solicitud
                    JOIN 
                        userprofile u ON uf.id_userprofile = u.id_userprofile
                    WHERE 
                        s.id_estado = 9";
                        if ($_SESSION['id_rol'] != 3) {
                            $queryUsuarios .= " AND s.id_userprofile='" . $_SESSION['id_userprofile'] . "'";
                        }
                        $queryUsuarios .= " GROUP BY s.id_solicitud;";
        
        $resultado = mysqli_query($conn, $queryUsuarios);
        
        if ($resultado) {
            while ($regis = mysqli_fetch_array($resultado)) {
                if ($regis['role_1_users'] >= 30) {
                    $jTableResult['rst'] = "1";
                    $jTableResult['ms'] .= $regis['id_solicitud'] . ", ";
                }
                if ($regis['role_4_users'] >= 1) {
                    $jTableResult['rst'] = "2";
                    $jTableResult['ms'] .= $regis['id_solicitud'] . ", ";
                }
            }
            // Elimina la última coma y espacio
            $jTableResult['ms'] = rtrim($jTableResult['ms'], ', ');
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case 'ListarOferta':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListOf'] = "";
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
            pf.fecha_cierre
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
            WHERE 
                s.id_solicitud = '$id_solicitud'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['ListOf'] .= "
                <div class='form-container'>
                    <br>
                    <h5><strong>Informacion y Estado</strong></h5>
                    <label class='label-identifier'>Nombre Curso Ofertado</label>
                    <label class='data-field'>" . $registro['nom_pf'] . "</label>
                    <br>
                    <label class='label-identifier'>Jornada Curso Ofertado</label>
                    <label class='data-field'>" . $registro['nom_jornada'] . "</label>
                    <br>
                    <label class='label-identifier'>Modalidad Curso Ofertado</label>
                    <label class='data-field'>" . $registro['nom_modalidad'] . "</label>
                    <br>
                    <label class='label-identifier'>Fecha Inicio de Curso Ofertado</label>
                    <label class='data-field'>" . $registro['fecha_inicio'] . "</label>
                    <br>
                    <label class='label-identifier'>Fecha Fin de Curso Ofertado</label>
                    <label class='data-field'>" . $registro['fecha_cierre'] . "</label>
                    <br>
                    <label class='label-identifier'>Detalles</label>
                    <br>
                    <textarea id='detalles' name='detalles'>" . $registro['descripcion'] . "</textarea>
                    <br>
                ";

                if ($registro['id_estado'] == '9') {
                    $queryUsuarios = "SELECT u.nombre AS nom_Uof, s.id_solicitud, uf.documento, u.correo, u.celular, td.nombre AS nom_doc, u.numeroiden
                                        FROM usersxoferta uf 
                                        JOIN solicitud s ON uf.id_solicitud = s.id_solicitud
                                        JOIN userprofile u ON uf.id_userprofile = u.id_userprofile
                                        JOIN tipodocumento td ON u.id_doc = td.id_doc
                                        WHERE uf.id_solicitud ='$id_solicitud'";
                    $resultado = mysqli_query($conn, $queryUsuarios);

                    if ($resultado) {
                        if (mysqli_num_rows($resultado) > 0) {
                            while ($regis = mysqli_fetch_array($resultado)) {
                                $jTableResult['rst'] = "1";
                                $jTableResult['ms'] = "Exitoso";
                                $documentURL = str_replace('C:/xampp/htdocs', '', $regis['documento']);

                                $jTableResult['ListOf'] .= "
                                    <hr>
                                    <h2 class='label-identifier'>Usuarios Interesados</h2>
                                    <h5 class='label-identifier'>Nombre</h5>
                                    <label class='data-field'>" . $regis['nom_Uof'] . "</label>
                                    <h5 class='label-identifier'>Correo</h5>
                                    <label class='data-field'>" . $regis['correo'] . "</label>
                                    <h5 class='label-identifier'>Telefono</h5>
                                    <label class='data-field'>" . $regis['celular'] . "</label>
                                    <h5 class='label-identifier'>Tipo de Documento</h5>
                                    <label class='data-field'>" . $regis['nom_doc'] . "</label>
                                    <h5 class='label-identifier'>Numero de Documento</h5>
                                    <label class='data-field'>" . $regis['numeroiden'] . "</label>
                                    
                                    <h1 class='label-identifier'>Documento para Descargar</h1>
                                    <label class='data-field'><a href='../../include/" . $regis['documento'] . "' download>Descargar Documento</a></label>";
                            }
                        } else {
                            $jTableResult['ListOf'] .= "
                                <h5 class='label-identifier'>Aun no hay Usuarios Interesados en la Oferta</h5>";
                        }
                    } else {
                        $jTableResult['rst'] = "0";
                        $jTableResult['ms'] = "Error en la consulta de usuarios interesados: " . mysqli_error($conn);
                    }
                    // Bloques else if para verificar id_rol, solo si id_estado es 9
                    if ($registro['id_rol'] != '2') {
                        $jTableResult['ListOf'] .= "
                            <hr>
                            <h3 class='label-identifier'>Asignacion</h3>
                            <h6 class='label-identifier'>Detalle Asignacion</h6>
                            <textarea id='detalle_respuesta' name='detalles'></textarea>
                            <h6 class='label-identifier'>Responsable</h6>
                            <select id='id_responsable'></select>
                            <div class='course-buttons'>
                                <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                                <button type='button' class='create-button' id='btnGuardarCambios2' data-id='" . $registro['id_solicitud'] . "'>Asignar</button>
                            </div>";
                    } elseif ($registro['id_rol'] == '2') {
                        $jTableResult['ListOf'] .= "
                            <h3 class='label-identifier'>Responder</h3>
                            <h6 class='label-identifier'>Ficha</h6>
                            <textarea id='ficha' name='ficha'></textarea>
                            <br>
                            <h6 class='label-identifier'>Detalle Respuesta</h6>
                            <input type='text' id='detalle_respuesta' name='detalles'></input><br/>
                            <h6>Cargue Archivo de Aprendices</h6>
                            <label class='modal-title' for='archivo'>Cargar Archivo solicitud</label>
                            <input type='file' id='archivo' name='archivo'>
                            <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                            <button id='btnAceptarSoliOf' class='create-button' data-id='" . $registro['id_solicitud'] . "'>Dar Respuesta</button>
                            ";
                    } 
                    
                }else  {
                    $jTableResult['ListOf'].='
                    <div class="modal-footer">
                    <button type="button" class="close-button" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="create-button" id="subirNoti2">Subir</button>
                </div>';
                }
                $jTableResult['ListOf'] .= "</div>";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case 'ListarSoliAsesoramiento':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListAA'] = "";
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
                    u.numeroiden,
                    au.nombre AS area_usu, 
                    ts.nombre AS Nombre_Solicitud, 
                    ds.id_tiposolicitud,
                    ds.descripcion,
                    a.nombre AS nom_area,
                    pf.nombre AS nom_pf,
                    pf.horas_curso,
                    pf.fecha_inicio,
                    pf.fecha_cierre,
                    r.nombre AS r_nombre,
                    td.nombre AS td_nombre
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
                LEFT JOIN
                    tipodocumento td ON u.id_doc=td.id_doc
                    WHERE 
                        s.id_solicitud = '$id_solicitud'
        ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['ListAA'] .= "
                    <div class='form-container'>
                        <h1>Datos Usuario</h1><br>
                        <h4 class='label-identifier'>Nombre Usuario</h4>
                        <label class='data-field'>" . $registro['nombre'] . " " . $registro['nombre_dos'] . " " . $registro['apellido'] . "</label><br>
                        <h4 class='label-identifier'>Tipo Documento</h4><br>
                        <label class='data-field'>" . $registro['td_nombre'] . "</label><br>
                        <h4 class='label-identifier'>Numero Documento</h4><br>
                        <label>" . $registro['numeroiden'] . "</label><br>
                        <br>
                        <h4 class='label-identifier'>Rol Usuario</h4>
                            <label class='data-field'>" . $registro['r_nombre'] . "</label>
                            <hr>
                            <h3 class='label-identifier'>Asignacion</h3>
                            <hr>
                            <h6 class='label-identifier'>Detalle Asignacion</h6>
                            <textarea id='detalle_respuesta' name='detalles'></textarea>
                            <h6 class='label-identifier'>Responsable</h6>
                            <select id='id_responsable'></select>
                            <div class='course-buttons'>
                                <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                                <button type='button' class='create-button' id='btnGuardarCambios2' data-id='" . $registro['id_solicitud'] . "'>Asignar</button>
                            </div>
                            <hr>
                            <h3 class='label-identifier'>Responder</h3>
                            <hr>
                            <h6 class='label-identifier'>Detalle Respuesta</h6>
                            <textarea id='detalle_respuesta' name='detalles'></textarea><br/>
                            <button id='btnAceptarSoli' class='create-button' data-id='" . $registro['id_solicitud'] . "'>Dar Respuesta</button>
                    </div>
                ";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case 'aceptarSolicitudOf':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $id_solicitud = $_POST['id_solicitud'];
        $mensaje = $_POST['detalle_respuesta'];
        $correo=$_SESSION['correo'];
        $ficha = isset($_POST['ficha']) && !empty($_POST['ficha']) ? $_POST['ficha'] : NULL;
        // $mensaje = $_POST['mensaje'];
        $query = "UPDATE solicitud s  
          JOIN detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
          JOIN programaformacion pf ON ds.id_programaformacion = pf.id_programaformacion
          SET pf.ficha = '$ficha', pf.id_estado = '7',s.id_estado = '7'
          WHERE s.id_solicitud = '$id_solicitud'";

        if ($result = mysqli_query($conn, $query)) {
            mysqli_commit($conn);
            // enviar correo URGENTE MIRAR SI SE HACE DESDE PHPMAILER O SOLO EMAIL
            @mail($correo, 'Solicitud Exitosa', $mensaje);
            $jTableResult['msj'] = "Solicitud Confimada con éxito.";
            $jTableResult['rstl'] = "1";
        } else {
            mysqli_rollback($conn);
            $jTableResult['msj'] = "Error al Confirmar la solicitud.";
            $jTableResult['rstl'] = "0";
        }
        print json_encode($jTableResult);
    break;
    case 'aceptarSolicitud':
                $jTableResult = array();
                $jTableResult['rstl'] = "";
                $jTableResult['msj'] = "";
                $id_solicitud = $_POST['id_solicitud'];
                $mensaje = $_POST['detalle_respuesta'];
                $correo=$_SESSION['correo'];
                // $mensaje = $_POST['mensaje'];
                $query = "UPDATE solicitud 
                SET id_estado = 4, fecha_respuesta = NOW() 
                WHERE id_solicitud = '$id_solicitud'";
                if ($result = mysqli_query($conn, $query)) {
                    mysqli_commit($conn);
                    // enviar correo URGENTE MIRAR SI SE HACE DESDE PHPMAILER O SOLO EMAIL
                    @mail($correo, 'Solicitud Exitosa', $mensaje);
                    $jTableResult['msj'] = "Solicitud Confimada con éxito.";
                    $jTableResult['rstl'] = "1";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['msj'] = "Error al Confirmar la solicitud.";
                    $jTableResult['rstl'] = "0";
                }
                print json_encode($jTableResult);
    break;
    case 'crgrTipoSolicitud':
        $jTableResult = array();                
        $jTableResult['lisTiposS']="";
        if ($_SESSION['id_rol'] == 3) {
            $query = "SELECT id_tiposolicitud, nombre FROM tiposolicitud WHERE id_tiposolicitud <> 4 AND id_tiposolicitud <> 23";
        } else {
            $query = "SELECT id_tiposolicitud, nombre FROM tiposolicitud  WHERE id_rol = '".$_SESSION['id_rol']."' OR adso ='".$_SESSION['id_rol']."' ";
        }
        $resultado = mysqli_query($conn, $query);
        
        while($registro = mysqli_fetch_array($resultado)) {
            // Agregar los radio buttons al resultado
            $jTableResult['lisTiposS'] .= "<input type='radio' name='tipo_solicitud' value='" . $registro['id_tiposolicitud'] . "'>" . $registro['nombre'] . "<br>";
        }
        // Devolver el resultado como JSON
        print json_encode($jTableResult);
    break;
    case 'eliminarSolicitud':
                $jTableResult = array();
                $jTableResult['rstl'] = "";
                $jTableResult['msj'] = "";
            
                $query = "DELETE FROM solicitud WHERE id_solicitud = '" . $_POST['id_solicitud'] . "'";
                if ($result = mysqli_query($conn, $query)) {
                    mysqli_commit($conn);
                    $jTableResult['msj'] = "Solicitud eliminada con éxito.";
                    $jTableResult['rstl'] = "1";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['msj'] = "Error al eliminar la solicitud.";
                    $jTableResult['rstl'] = "0";
                }
                print json_encode($jTableResult);
    break;
    case 'denegarSolicitud':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $id_solicitud = $_POST['id_solicitud'];
        $mensaje = $_POST['detalle_cancel'];
        $correo=$_SESSION['correo'];
        $query = "UPDATE solicitud 
        SET id_estado = 5
        WHERE id_solicitud = '$id_solicitud'";
        if ($result = mysqli_query($conn, $query)) {
            mysqli_commit($conn);
            @mail($correo, 'Solicitud Cancelada', $mensaje);
            $jTableResult['msj'] = "Solicitud Denegada con éxito.";
            $jTableResult['rstl'] = "1";
        } else {
            mysqli_rollback($conn);
            $jTableResult['msj'] = "Error al Denegar la solicitud.";
            $jTableResult['rstl'] = "0";
        }
        print json_encode($jTableResult);
    break;
    case 'actualizarSolicitud':
        $id_solicitud = $_POST['id_solicitud'];
        $responsable = isset($_POST['id_responsable']) ? $_POST['id_responsable'] : null;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
        $updateFields = [];
        if ($responsable !== null) {
            $updateFields[] = "solicitud.id_responsable = '$responsable'";
        }
        if ($descripcion !== null) {
            $updateFields[] = "detallesolicitud.descripcion = '$descripcion'";
        }
    
        if (!empty($updateFields)) {
            $updateQuery = implode(", ", $updateFields);
            $query = "UPDATE solicitud
                        JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                        JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                        SET solicitud.id_estado=6, $updateQuery
                        WHERE solicitud.id_solicitud = '$id_solicitud'";
    
            if ($result = mysqli_query($conn, $query)) {
                    $query = "UPDATE solicitud
                                SET fecha_asignada = NOW()
                                WHERE id_solicitud = '$id_solicitud'";
                    $resultado = mysqli_query($conn, $query);
                mysqli_commit($conn);
                $jTableResult['msj'] = "Realizado Con Exito.";
                $jTableResult['rstl'] = "1";
            } else {
                mysqli_rollback($conn);
                $jTableResult['msj'] = "Cancelado.";
                $jTableResult['rstl'] = "0";
            }
        } else {
            $jTableResult['msj'] = "No se proporcionaron datos para actualizar.";
            $jTableResult['rstl'] = "0";
        }
    
        print json_encode($jTableResult);
    break;
    case 'MisSoli':
            $jTableResult = array();
            $jTableResult['rs'] = "";
            $jTableResult['Ms'] = "";
            $jTableResult['tabla'] = ""; 
            // Iniciar la construcción de la tabla
            $jTableResult['tabla'] .= '
                <div class="container">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>';
                                        if ($_SESSION['id_rol'] == 3) {
                                            $jTableResult['tabla'] .= '<th>Tipo Solicitud</th>
                                                                        <th>Solicitante</th>';
                                        } else {
                                            $jTableResult['tabla'] .= '<th>Tipo Solicitud</th>';
                                        }
                    $jTableResult['tabla'] .= '<th>Descripción</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    <tbody>';
                    
                    // Consulta para verificar si el id_userprofile está presente en la tabla solicitud
                    $query = "SELECT id_userprofile FROM solicitud WHERE id_userprofile='" . $_SESSION['id_userprofile'] . "'";
                    $resultado = mysqli_query($conn, $query);
                    // Verificar si se encontraron resultados
                    if (mysqli_num_rows($resultado) > 0) {
                        // Consulta para obtener las solicitudes y sus detalles asociados
                        $busqueda = "SELECT solicitud.id_solicitud, detallesolicitud.descripcion, solicitud.id_estado, estado.nombre AS nombre_estado,
                                        tiposolicitud.nombre AS nombre_tipo, userprofile.nombre AS nombre_autor
                                    FROM solicitud
                                    JOIN estado ON solicitud.id_estado = estado.id_estado 
                                    JOIN userprofile ON solicitud.id_userprofile = userprofile.id_userprofile
                                    JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                                    JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                                    WHERE  solicitud.id_estado != 3 AND solicitud.id_estado != 9 AND solicitud.id_estado != 6 
                                    ";
                                    if ($_SESSION['id_rol'] != 3) {
                                        $busqueda .= " AND solicitud.id_userprofile='" . $_SESSION['id_userprofile'] . "'";
                                    }
                                    $busqueda .= " ORDER BY solicitud.id_solicitud DESC"; 
                        $result = mysqli_query($conn, $busqueda);
                        if (mysqli_num_rows($result) > 0) {
                            $jTableResult['rs'] = "1";  
                            while($registro = mysqli_fetch_array($result)) {
                                $jTableResult['tabla'] .= "<tr>
                                                            <td>" . $registro['id_solicitud'] . "</td>
                                                            <td>" . $registro['nombre_tipo'] . "</td>";
                                                                if ($_SESSION['id_rol'] == 3) {
                                                                    $jTableResult['tabla'] .= "<td>" . $registro['nombre_autor'] . "</td>";
                                                                }
                                                                $jTableResult['tabla'] .= "<td>" . $registro['descripcion'] . "</td>
                                                                                            <td>" . $registro['nombre_estado'] . "</td>
                                                                                            <td>";
                                                                if ($_SESSION['id_rol'] == 3) {
                                                                    $jTableResult['tabla'] .= '<button id="btnEditarSoli" class="btn btn-warning btn-sm  local" data-bs-toggle="modal" data-bs-target="#editSolicitudModal" data-id="' . $registro['id_solicitud'] . '">Ver Soli</button>
                                                                                                <button id="modalCancel" class="btn btn-danger btn-sm  local" data-bs-toggle="modal" data-bs-target="#cancelSolicitudModal" data-id="' . $registro['id_solicitud'] . '">Denegar Soli</button>
                                                                                                <button id="btnAceptarSoli" class="btn btn-success cursor:pointer;  local" data-id="' . $registro['id_solicitud'] . '">Aceptar Soli</button>';
                                                                } elseif ($registro['id_estado'] == 4){
                                                                    $jTableResult['tabla'].='<button id="detalleSolicitud" class="btn btn-warning btn-sm  local" data-bs-toggle="modal" data-bs-target="#detallesolicitud" data-id="' . $registro['id_solicitud'] . '">Ver Solicitud</button>';
                                                                }
                                                                else {
                                                                    $jTableResult['tabla'] .= '<button id="btnEditarSoli" class="btn btn-warning btn-sm  local" data-bs-toggle="modal" data-bs-target="#editSolicitudModal"  data-id="' . $registro['id_solicitud'] . '">Editar</button>
                                                                                                <button id="btnEliminarSoli" class="btn btn-danger btn-sm  local">Cancelar</button>';
                                                                }
                                $jTableResult['tabla'] .= "</td></tr>";
                            }
                    $jTableResult['tabla'] .= "</tbody></table></div></div>";
                }else{
                    $jTableResult['rs'] = "2";
                    $jTableResult['Ms'] = "Tu Solicitud Aun no tiene una respuesta.";
                }
            } else {
                $jTableResult['rs'] = "3";
                $jTableResult['Ms'] = "No has realizado ninguna Solicitud.";
            }
        
            print json_encode($jTableResult);
    break;
    case 'MisSoli_sin':
            $jTableResult = array();
            $jTableResult['rs'] = "";
            $jTableResult['Ms'] = "";
            $jTableResult['tabla'] = ""; 
        
            // Iniciar la construcción de la tabla
            $jTableResult['tabla'] .= '
                <div class="container">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>';
                                        if ($_SESSION['id_rol'] == 3) {
                                            $jTableResult['tabla'] .= '<th>Tipo Solicitud</th>
                                                                        <th>Solicitante</th>';
                                        } else {
                                            $jTableResult['tabla'] .= '<th>Tipo Solicitud</th>';
                                        }
                    $jTableResult['tabla'] .= '<th>Descripción</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    <tbody>';
                        // Consulta para obtener las solicitudes y sus detalles asociados
                        $busqueda = "SELECT solicitud.id_solicitud, detallesolicitud.descripcion, solicitud.id_estado, estado.nombre AS nombre_estado, tiposolicitud.id_tiposolicitud AS idtiposolicitud, 
                                            tiposolicitud.nombre AS nombre_tipo, userprofile.nombre AS nombre_autor
                                        FROM solicitud
                                        JOIN estado ON solicitud.id_estado = estado.id_estado
                                        JOIN userprofile ON solicitud.id_userprofile = userprofile.id_userprofile
                                        JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                                        JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                                        WHERE solicitud.id_estado = 3 
                                        ORDER BY solicitud.id_solicitud DESC";
                        $result = mysqli_query($conn, $busqueda);
                        
                        if (mysqli_num_rows($result) > 0) {
                            $jTableResult['rs'] = "1";
                            // Recorrer los resultados y construir la lista de opciones
                            while($registro = mysqli_fetch_array($result)) {
                                $jTableResult['tabla'] .= "<tr>
                                                            <td>" . $registro['id_solicitud'] . "</td>
                                                            <td>" . $registro['nombre_tipo'] . "</td>";
                                                                if ($_SESSION['id_rol'] == 3) {
                                                                    $jTableResult['tabla'] .= "<td>" . $registro['nombre_autor'] . "</td>";
                                                                }
                                                                $jTableResult['tabla'] .= "<td>" . $registro['descripcion'] . "</td>
                                                                                            <td>" . $registro['nombre_estado'] . "</td>
                                                                                            <td>";
                                                                if ($_SESSION['id_rol'] == 3) {
                                                                    $jTableResult['tabla'] .= '
                                                                                                <button id="modalCancel" class="btn btn-danger btn-sm  local" data-bs-toggle="modal" data-bs-target="#cancelSolicitudModal" data-id="' . $registro['id_solicitud'] . '">Denegar Soli</button>
                                                                                                <button  class="btn btn-success  local"';
                                                                        if ($registro['idtiposolicitud'] == 1) {
                                                                            $jTableResult['tabla'] .= ' id="btn_asign" data-bs-toggle="modal" data-bs-target="#AceptSolicitudModal" data-id="' . $registro['id_solicitud'] . '" > Asignar</button>';
                                                                        }
                                                                        elseif ($registro['idtiposolicitud'] == 2) {
                                                                            $jTableResult['tabla'] .= ' id="btn_pf" data-bs-toggle="modal" data-bs-target="#AceptSolicitud2Modal" data-id="' . $registro['id_solicitud'] . '"> Asignar</button>';
                                                                        }
                                                                        elseif ($registro['idtiposolicitud'] == 3) {
                                                                            $jTableResult['tabla'] .= ' id="BtnAsesoramientoA" data-bs-toggle="modal" data-bs-target="#AceptSolicitud3Modal" data-id="' . $registro['id_solicitud'] . '"> Responder</button>';
                                                                        }elseif ($registro['idtiposolicitud'] == 4) {
                                                                            $jTableResult['tabla'] .= ' id="btn_subir"  data-bs-toggle="modal" data-bs-target="#AceptSolicitud2Modal" data-id="' . $registro['id_solicitud'] . '"> Subir</button>';
                                                                        }elseif ($registro['idtiposolicitud'] == 5) {
                                                                            $jTableResult['tabla'] .= ' id="Ecompetencia"  data-bs-toggle="modal" data-bs-target="#AceptSolicitud5Modal" data-id="' . $registro['id_solicitud'] . '"> Responder</button>';
                                                                        }elseif ($registro['idtiposolicitud'] == 10) {
                                                                            $jTableResult['tabla'] .= ' id="instructorProto" data-bs-toggle="modal" data-bs-target="#AceptSolicitud4Modal" data-id="' . $registro['id_solicitud'] . '"> Responder</button>';
                                                                        }elseif($registro['idtiposolicitud']== 23){
                                                                            $jTableResult['tabla'].='<button id="detalleOferta" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#OfertaModal"  cursor:pointer;" data-id="' . $registro['id_solicitud'] . '">Mirar Oferta</button>';
                                                                        }
                                                                }
                                $jTableResult['tabla'] .= "</td></tr>";
                            }
                            $jTableResult['tabla'] .= "</tbody></table></div></div>"; // Cerrar la tabla y los elementos HTML
            }
        
        print json_encode($jTableResult);
    break;
    case 'MisOfertas':
        $jTableResult = array();
        $jTableResult['rs'] = "";
        $jTableResult['Ms'] = "";
        $jTableResult['tabla'] = ""; 
        // Iniciar la construcción de la tabla
        $jTableResult['tabla'] .= '
            <div class="container">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Programa</th>';
                                if ($_SESSION['id_rol'] == 3) {
                                    $jTableResult['tabla'] .= '
                                                                <th>Autor Oferta</th>';
                                }
            $jTableResult['tabla'] .= '
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            <tbody>';
            // Consulta para verificar si el id_userprofile está presente en la tabla solicitud
                // Consulta para obtener las solicitudes y sus detalles asociados
                $busqueda = "SELECT solicitud.id_solicitud, detallesolicitud.descripcion, solicitud.id_estado, estado.nombre AS nombre_estado,
                                tiposolicitud.nombre AS nombre_tipo, userprofile.nombre AS nombre_autor,userprofile.correo, programaformacion.nombre AS nombre_pf, programaformacion.ficha
                            FROM solicitud
                            JOIN estado ON solicitud.id_estado = estado.id_estado 
                            JOIN userprofile ON solicitud.id_userprofile = userprofile.id_userprofile
                            JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                            JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                            JOIN programaformacion ON detallesolicitud.id_programaformacion = programaformacion.id_programaformacion
                            WHERE detallesolicitud.id_categoria = 3 AND solicitud.id_estado = 9 
                ";
                    if ($_SESSION['id_rol'] != 3) {
                    $busqueda .= " AND solicitud.id_userprofile='" . $_SESSION['id_userprofile'] . "'";
                    }
                    $busqueda .= " ORDER BY solicitud.id_solicitud DESC"; 
                    $result = mysqli_query($conn, $busqueda);
                if (mysqli_num_rows($result) > 0) {
                    $jTableResult['rs'] = "1";  
                    while($registro = mysqli_fetch_array($result)) {
                        $jTableResult['tabla'] .= "<tr>
                                                    <td>" . $registro['id_solicitud'] . "</td>
                                                    <td>" . $registro['nombre_pf'] . "</td>";
                                                        if ($_SESSION['id_rol'] == 3) {
                                                            $jTableResult['tabla'] .= "<td>
                                                            
                                                            " . $registro['nombre_autor'] . "<br>
                                                            " . $registro['correo'] . "
                                                            </td>";
                                                        }
                                                        $jTableResult['tabla'] .= "
                                                                                    <td>" . $registro['nombre_estado'] . "</td>";
                                                        $jTableResult['tabla'] .= '<td> 
                                                                                    <button id="modalCancel" class="btn btn-danger btn-sm  local" data-bs-toggle="modal" data-bs-target="#cancelSolicitudModal" data-id="' . $registro['id_solicitud'] . '">Cancelar Oferta</button>
                                                                                    <button id="detalleOferta" class="btn btn-success  local" data-bs-toggle="modal" data-bs-target="#OfertaModal"  cursor:pointer;" data-id="' . $registro['id_solicitud'] . '">Mirar Oferta</button>';
                        $jTableResult['tabla'] .= "</td></tr>";
                    }
                    $jTableResult['tabla'] .= "</tbody></table></div>";
            }else{
                $jTableResult['rs'] = "2";
                $jTableResult['Ms'] = "Tu Solicitud Aun no tiene una respuesta.";
            }
    
        print json_encode($jTableResult);
    break;
    case 'buscarSolicitud':
        $jTableResult = array();
        $jTableResult['rstl']="";
        $jTableResult['msj']="";
        $jTableResult['listaSoli']='
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>';
                            if ($_SESSION['id_rol'] == 3) {
                                $jTableResult['listaSoli'] .= '<th>Tipo Solicitud</th>
                                                            <th>Solicitante</th>';
                            } else {
                                $jTableResult['listaSoli'] .= '<th>Tipo Solicitud</th>';
                            }
                            $jTableResult['listaSoli'].='
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    <tbody>';
                    $id_rol = $_SESSION['id_rol'];
                    $id_userprofile = $_SESSION['id_userprofile'];
                    $dato_txt = $_POST['dato_txt'];
                    
                    // Construir la cláusula WHERE en función del rol del usuario
                    $whereClause = "";
                    if ($id_rol != 3) {
                        $whereClause .= "solicitud.id_userprofile = '$id_userprofile' AND ";
                    }
                    // Agregar el filtro de búsqueda
                    $whereClause .= "(userprofile.nombre = '$dato_txt' 
                                        OR tiposolicitud.nombre = '$dato_txt' 
                                        OR estado.nombre = '$dato_txt' 
                                        OR userprofile.apellido = '$dato_txt' 
                                        OR userprofile.correo = '$dato_txt' 
                                        OR userprofile.numeroiden = '$dato_txt' 
                                        OR userprofile.nombre_dos = '$dato_txt')";
                    // Construir la consulta completa
                    $query = "SELECT 
                                solicitud.id_solicitud, 
                                userprofile.nombre AS solicitante_nom, 
                                userprofile.nombre_dos AS solicitante_nomdos, 
                                userprofile.correo AS solicitante_correo, 
                                userprofile.apellido AS solicitante_apellido, 
                                userprofile.numeroiden AS solicitante_iden, 
                                estado.nombre AS nombre_estado, 
                                tiposolicitud.nombre AS nombre_tipo, 
                                detallesolicitud.descripcion, 
                                detallesolicitud.id_tiposolicitud,
                                solicitud.id_estado
                            FROM solicitud
                            JOIN estado ON solicitud.id_estado = estado.id_estado 
                            JOIN userprofile ON solicitud.id_userprofile = userprofile.id_userprofile
                            JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                            JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                            WHERE $whereClause";
            $resultado = mysqli_query($conn, $query);
            $numero = mysqli_num_rows($resultado);
            if($numero==0){
                $jTableResult['listaSoli']="<thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;No existen coincidencias.</th></tr></thead>";
                $jTableResult['msj']= "NO EXISTEN DATOS.";
                $jTableResult['rslt']= "0";						
            }else{
                while($registro = mysqli_fetch_array($resultado)){
                    $jTableResult['listaSoli'].="<tr>";
                    $jTableResult['listaSoli'].="<tr>
                                                    <td>" . $registro['id_solicitud'] . "</td>
                                                    <td>" . $registro['nombre_tipo'] . "</td>";
                                                        if ($_SESSION['id_rol'] == 3) {
                                                            $jTableResult['listaSoli'] .= "<td>" . $registro['solicitante_nom'] . "</td>";
                                                        }
                                                        $jTableResult['listaSoli'] .= "<td>" . $registro['descripcion'] . "</td>
                                                                                    <td>" . $registro['nombre_estado'] . "</td>
                                                                                    <td>";
                                                            if ($registro['id_estado'] == 4){
                                                                    $jTableResult['listaSoli'].='<button id="detalleSolicitud" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detallesolicitud" data-id="' . $registro['id_solicitud'] . '">Ver Soli</button>';
                                                                }
                                                        else {
                                                            $jTableResult['listaSoli'] .= '<button id="btnEditarSoli" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSolicitudModal" data-id="' . $registro['id_solicitud'] . '">Editar</button>
                                                                                        <button id="btnEliminarSoli" class="btn btn-danger btn-sm">Cancelar</button>';
                                                        }
                    $jTableResult['listaSoli'].="</tr>";
                }
                $jTableResult['msj']= "";
                $jTableResult['rstl']= "1";						
            }
        print json_encode($jTableResult);
    break;
    case 'asignaciones':
        $jTableResult = array();
        $jTableResult['rs'] = "";
        $jTableResult['Ms'] = "";
        $jTableResult['tabla'] = ""; 
    
        // Iniciar la construcción de la tabla
        $jTableResult['tabla'] .= '
        <div class="container">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>';
                            if ($_SESSION['id_rol'] == 3) {
                                $jTableResult['tabla'] .= '<th>Tipo Solicitud</th>
                                                            <th>Solicitante</th>';
                            } else {
                                $jTableResult['tabla'] .= '<th>Tipo Solicitud</th>';
                            }
        $jTableResult['tabla'] .= '<th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        <tbody>';
    
        // Consulta para verificar si el id_userprofile está presente en la tabla solicitud
        $query = "SELECT id_responsable FROM solicitud WHERE id_responsable='" . $_SESSION['id_userprofile'] . "'";
        $resultado = mysqli_query($conn, $query);
        // Verificar si se encontraron resultados
        if (mysqli_num_rows($resultado) > 0) {
            // Consulta para obtener las solicitudes y sus detalles asociados
            $busqueda = "SELECT solicitud.id_solicitud, detallesolicitud.descripcion, solicitud.id_estado, estado.nombre AS nombre_estado, tiposolicitud.id_tiposolicitud AS idtiposolicitud, 
                                tiposolicitud.nombre AS nombre_tipo, userprofile.nombre AS nombre_autor
                            FROM solicitud
                            JOIN estado ON solicitud.id_estado = estado.id_estado
                            JOIN userprofile ON solicitud.id_userprofile = userprofile.id_userprofile
                            JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                            JOIN tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                            WHERE solicitud.id_responsable='" . $_SESSION['id_userprofile'] . "' AND solicitud.id_estado=6";
            $result = mysqli_query($conn, $busqueda);
            
            if (mysqli_num_rows($result) > 0) {
                $jTableResult['rs'] = "1";
                // Recorrer los resultados y construir la lista de opciones
                while($registro = mysqli_fetch_array($result)) {
                    $jTableResult['tabla'] .= "<tr>
                                                <td>" . $registro['id_solicitud'] . "</td>
                                                <td>" . $registro['nombre_tipo'] . "</td>";
                                                    
                                                    $jTableResult['tabla'] .= "<td>" . $registro['descripcion'] . "</td>
                                                                                <td>" . $registro['nombre_estado'] . "</td>
                                                                                <td>";
                                                    $jTableResult['tabla'] .= '
                                                                                <button id="modalCancel" class="btn btn-danger btn-sm  local" data-bs-toggle="modal" data-bs-target="#cancelSolicitudModal" data-id="' . $registro['id_solicitud'] . '">Denegar Soli</button>
                                                                                <button  class="btn btn-success  local"';
                                                    if ($registro['idtiposolicitud'] == 1) {
                                                                    $jTableResult['tabla'] .= ' id="btn_asign" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="' . $registro['id_solicitud'] . '" > Dar Respuesta</button>';
                                                                }
                                                                elseif ($registro['idtiposolicitud'] == 2) {
                                                                    $jTableResult['tabla'] .= ' id="" data-bs-toggle="modal" data-bs-target="#AceptSolicitudModal" data-id="' . $registro['id_solicitud'] . '"> Asignar</button>';
                                                                }
                                                                elseif ($registro['idtiposolicitud'] == 3) {
                                                                    $jTableResult['tabla'] .= ' id="btn_LRa" data-bs-toggle="modal" data-bs-target="#ListRaAsignModal" data-id="' . $registro['id_solicitud'] . '"> Dar Respuesta</button>';
                                                                }elseif ($registro['idtiposolicitud'] == 5) {
                                                                    $jTableResult['tabla'] .= ' id="btn_LEc"  data-bs-toggle="modal" data-bs-target="#ListEcAsignModal" data-id="' . $registro['id_solicitud'] . '">  Dar Respuesta</button>';
                                                                }elseif ($registro['idtiposolicitud'] == 10) {
                                                                    $jTableResult['tabla'] .= ' id="" data-bs-toggle="modal" data-bs-target="#AceptSolicitudModal" data-id="' . $registro['id_solicitud'] . '"> Responder</button>';
                                                                }
                    $jTableResult['tabla'] .= "</td></tr>";
                }
                $jTableResult['tabla'] .= "</tbody></table></div>"; // Cerrar la tabla y los elementos HTML
            } else {
                $jTableResult['rs'] = "2";
                $jTableResult['Ms'] = "No hay solicitudes Asignadas";
            }
        }
    
        print json_encode($jTableResult);
    break;
    case 'Asignado_Crear':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['Asignform'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
                        $query = "SELECT 
                                    s.id_solicitud, 
                                    u.nombre, 
                                    d.nombre_dpto AS nom_dpto, 
                                    m.nombre_municipio AS nom_muni, 
                                    p.nombre_poblado AS nom_vereda, 
                                    et.nombre AS nom_estado, 
                                    u.nombre_dos,
                                    u.apellido,
                                    ur.nombre_dos AS nom_dosR,
                                    ur.apellido AS apellidoR,
                                    ur.nombre AS nomR,
                                    e.nombre AS nom_Empresa, 
                                    ts.nombre AS Nombre_Solicitud, 
                                    ds.id_tiposolicitud,
                                    ds.descripcion,
                                    a.nombre AS nom_area
                                FROM 
                                    solicitud s
                                LEFT JOIN  
                                    estado et ON s.id_estado = et.id_estado
                                LEFT JOIN  
                                    userprofile ur ON s.id_responsable = ur.id_userprofile
                                LEFT JOIN  
                                    userprofile u ON s.id_userprofile = u.id_userprofile
                                LEFT JOIN  
                                    detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
                                LEFT JOIN  
                                    departamentos d ON ds.cod_dpto = d.cod_dpto
                                LEFT JOIN  
                                    municipios m ON ds.cod_municipio = m.cod_municipio
                                LEFT JOIN  
                                    poblados p ON ds.cod_poblado = p.cod_poblado
                                LEFT JOIN  
                                    empresa e ON s.id_empresa = e.id_empresa
                                LEFT JOIN  
                                    tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
                                LEFT JOIN 
                                    area a ON ds.id_area = a.id_area
                                WHERE 
                                    s.id_solicitud = '$id_solicitud';
                        ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['Asignform'] .= "
                    <div class='container'>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Empresa</label>
                            <label class='data-field'>" . $registro['nom_Empresa'] . "</label>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Solicitante</label>
                            <label id='solicitante' class='form-control'>" . $registro['nombre'] . " " . $registro['nombre_dos'] . " " . $registro['apellido'] . "</label>
                        </div>
                        <br>
                        <h5 class='label-identifier'><strong>Ubicación Sugerida Para Solicitud</strong></h5>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Departamento</h6>
                            <h6 class='form-control'>" . $registro['nom_dpto'] . "</h6>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Municipio</h6>
                            <h6 class='form-control'>" . $registro['nom_muni'] . "</h6>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Vereda</h6>
                            <h6 class='form-control'>" . $registro['nom_vereda'] . "</h6>
                        </div>
                        <br>
                        <div class='course-data-field'>
                            <label class='label-identifier' for='detalles'>Detalles</label>
                            <br>
                            <textarea id='detalles' name='detalles' class='form-control'>" . $registro['descripcion'] . "</textarea>
                        </div>
                        <br>
                        <div class='course-data-field'>
                            <label class='label-identifier' for='archivo'>Cargar Archivo solicitud (solo archivos de tipo pdf)</label>
                            <input type='file' id='archivo' name='archivo' accept='.pdf' class='form-control'>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Responsable</h6>
                            <label class='form-control'>" . $registro['nomR'] . " " . $registro['nom_dosR'] . " " . $registro['apellidoR'] . "</label>
                        </div>
                        <div class='course-data-field'>
                            <h6 class='label-identifier'>Estado</h6>
                            <label class=form-control'>" . $registro['nom_estado'] . "</label>
                        </div><br>
                        <h2 class='label-identifier'>DATOS DE CURSO</h2>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Nombre curso</label>
                            <input type='text' id='nombre' class='form-control' />
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Fecha inicio</label>
                            <input type='date' id='fecha_inicio' class='form-control' />
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Fecha cierre</label>
                            <input type='date' id='fecha_cierre' class='form-control' />
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Numero de ficha</label>
                            <input type='number' id='ficha' value='0' class='form-control' />
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Horas de curso</label>
                            <input type='number' id='horas' value='0' class='form-control' />
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Modalidad</label>
                            <select id='id_modalidad' class='form-control'>
                            </select>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Jornada</label>
                            <select id='id_jornada' class='form-control'>
                            </select>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Nivel de Formacion</label>
                            <select id='id_nivel_formacion' class='form-control'>
                            </select>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Matriculados</label>
                            <input type='number' id='matriculados' value='0' class='form-control' />
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Estado</label>
                            <select id='id_estado' class='form-control'>
                                <option value='0' selected >seleccione:.</option>
                            </select>
                        </div>
                        <div class='course-data-field'>
                            <label class='label-identifier'>Certificados</label>
                            <input type='number' id='certificates' value='0' class='form-control' />
                        </div>
                    </div>
                ";
                }
            }else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        
        echo json_encode($jTableResult);
    break;
    case 'registroCursoNew':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $id_solicitud = $_POST['id_solicitud'];
    
        // Preparar la consulta SQL para insertar en programaformacion
        $query = "INSERT INTO programaformacion (nombre, fecha_cierre, fecha_inicio, id_modalidad, id_jornada, id_nivel_formacion, matriculados, id_estado, horas_curso, ficha) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 7, ?, ?)";
    
        // Preparar la consulta SQL
        if ($stmt = mysqli_prepare($conn, $query)) {
            // Bindear los parámetros
            mysqli_stmt_bind_param($stmt, "sssiiiiiii",
                $_POST['nombre'],
                $_POST['fecha_cierre'],
                $_POST['fecha_inicio'],
                $_POST['id_modalidad'],
                $_POST['id_jornada'],
                $_POST['id_nivel_formacion'],
                $_POST['matriculados'],
                $_POST['horas_curso'],
                $_POST['ficha']
            );
    
            // Ejecutar la consulta
            if (mysqli_stmt_execute($stmt)) {
                // Obtener el último id insertado
                $id_programaformacion = mysqli_insert_id($conn);
    
                // Preparar la consulta para actualizar la solicitud
                $query_update = "UPDATE solicitud SET id_estado = 4, fecha_respuesta = NOW(), id_programaformacion = ? WHERE id_solicitud = ?";
    
                // Inicializar la declaración
                if ($stmt_update = mysqli_prepare($conn, $query_update)) {
                    // Enlazar los parámetros
                    mysqli_stmt_bind_param($stmt_update, 'ii', $id_programaformacion, $id_solicitud);
    
                    // Ejecutar la declaración
                    if (mysqli_stmt_execute($stmt_update)) {
                        mysqli_commit($conn);
                        $jTableResult['msj'] = "Registro guardado y solicitud actualizada con éxito.";
                        $jTableResult['rstl'] = "1";
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['msj'] = "Error al actualizar la solicitud.";
                        $jTableResult['rstl'] = "0";
                    }
    
                    // Cerrar el statement de actualización
                    mysqli_stmt_close($stmt_update);
                } else {
                    $jTableResult['msj'] = "Error al preparar la consulta para actualizar la solicitud.";
                    $jTableResult['rstl'] = "0";
                }
            } else {
                mysqli_rollback($conn);
                $jTableResult['msj'] = "Error al guardar en programaformacion.";
                $jTableResult['rstl'] = "0";
            }
    
            // Cerrar el statement de inserción
            mysqli_stmt_close($stmt);
        } else {
            $jTableResult['msj'] = "Error al preparar la consulta para guardar en programaformacion.";
            $jTableResult['rstl'] = "0";
        }
    
        // Enviar la respuesta en formato JSON
        echo json_encode($jTableResult);
    break;
    case 'noticiaCreado':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $jTableResult['noticia'] = "";
        $id_solicitud = $_POST['id_solicitud'];
    
        // Asegúrate de que la variable $id_solicitud está correctamente escapada para evitar inyección SQL
        $id_solicitud = mysqli_real_escape_string($conn, $id_solicitud);
    
        // Imprimir la consulta para depuración
            $query = "SELECT 
                            solicitud.id_solicitud,
                            detallesolicitud.imagen AS imagen, 
                            detallesolicitud.nombre AS titulo, 
                            detallesolicitud.fecha_inicio AS fecha_mostrada, 
                            detallesolicitud.descripcion,
                            detallesolicitud.id_detallesolicitud
                        FROM 
                            solicitud
                        JOIN 
                            detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                        WHERE 
                            detallesolicitud.id_tiposolicitud = 4 AND 
                            solicitud.id_estado = 3 AND 
                            solicitud.id_solicitud = '$id_solicitud'";
        
    
        $result = mysqli_query($conn, $query);
    
        // Verificar si se encontraron resultados
        if (mysqli_num_rows($result) > 0) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['msj'] = "Noticia Creada con Exito.";
                $jTableResult['rstl'] = "1";
                // Concatenar el contenido HTML para las tarjetas
                $jTableResult['noticia'] .= '
                <div class="row blog-item px-3 pb-5">
                    <div class="col-md-5" id="foto">
                        <img src="../../include/' . $registro["imagen"] . '" class="img-fluid mb-4 mb-md-0" accordingly alt=" Image">
                    </div>
                    <div class="col-md-7">
                        <h3 class="mt-md-4 px-md-3 mb-2 py-2 bg-white font-weight-bold">' . $registro["titulo"] . '</h3>
                        <div class="d-flex mb-3">
                            <small class="mr-2 text-muted"><i class="fa fa-calendar-alt"></i> ' . $registro["fecha_mostrada"] . '</small>
                            <small class="mr-2 text-muted"><i class="fa fa-folder"></i> Web Design</small>
                            <small class="mr-2 text-muted"><i class="fa fa-comments"></i> 15 Comments</small>
                        </div>
                        <p>' . $registro["descripcion"] . '</p>
                        <a class="btn btn-link p-0" href="">Read More <i class="fa fa-angle-right"></i></a>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-button" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="create-button" id="subirNoti">Subir</button>
                </div>';
            }
        } else {
            mysqli_rollback($conn);
            $jTableResult['msj'] = "Error al Crear la noticia.";
            $jTableResult['rstl'] = "0";
        }
        print json_encode($jTableResult);
    break;
    case 'Cancel':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['msj'] = "";
        $jTableResult['cancel'] = "";
        $id_solicitud = $_POST['id_solicitud'];
        // Identifica que la variable $id_solicitud está correctamente escapada para evitar inyección SQL
        $id_solicitud = mysqli_real_escape_string($conn, $id_solicitud);
            $query = "SELECT 
                            s.id_solicitud
                        FROM 
                            solicitud s
                        WHERE 
                            s.id_solicitud = '$id_solicitud'";
        $result = mysqli_query($conn, $query);
        // Verificar si se encontraron resultados
        if (mysqli_num_rows($result) > 0) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['msj'] = "Cancel Creada con Exito.";
                $jTableResult['rst'] = "1";
                // Concatenar el contenido HTML para las tarjetas
                $jTableResult['cancel'] .= '
                <div class="row mt-3">
                            <div class="col-sm-12">
                                <h6 class="modal-title">Motivo Denegacion...</h6>
                                <input type="text" class="form-control modal-textbox" id="detalle_cancel" name="detalle_cancel"
                                    placeholder="Motivo Denegacion Solicitud" title="Motivo Denegacion">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close-button" data-bs-dismiss="modal">Cerrar</button>
                        <button id="btnCancelarSoli" type="button" class="create-button" data-id="' . $registro['id_solicitud'] . '">Confirmar</button>
                    </div>';
            }
        } else {
            mysqli_rollback($conn);
            $jTableResult['msj'] = "Error al Crear.";
            $jTableResult['rst'] = "0";
        }
        print json_encode($jTableResult);
    break;
    case 'instructorProto':
            $jTableResult = array();
            $jTableResult['rstl'] = "";
            $jTableResult['msj'] = "";
            $jTableResult['tarjeta'] = "";
            $id_solicitud = $_POST['id_solicitud'];
            $query = "SELECT 
                        solicitud.id_solicitud,
                        solicitud.id_estado,
                        j.nombre AS nombre_jornada,
                        r.nombre AS nombre_rol, 
                        userprofile.nombre, 
                        userprofile.id_rol,
                        userprofile.nombre_dos, 
                        userprofile.apellido, 
                        detallesolicitud.id_tiposolicitud,
                        detallesolicitud.twitter, 
                        detallesolicitud.facebook, 
                        detallesolicitud.youtube, 
                        detallesolicitud.instagram
                        FROM 
                            solicitud
                            JOIN 
                                userprofile ON solicitud.id_userprofile = userprofile.id_userprofile
                            JOIN 
                                detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                            JOIN
                                rol r ON userprofile.id_rol = r.id_rol
                            JOIN
                                jornada j ON detallesolicitud.id_jornada = j.id_jornada
                        WHERE 
                            detallesolicitud.id_tiposolicitud = 10 AND 
                            solicitud.id_estado = 3 AND solicitud.id_solicitud = '$id_solicitud';
                            "; 
            
            $result = mysqli_query($conn, $query);
            
            // Verificar si se encontraron resultados
            if (mysqli_num_rows($result) > 0) {
                while($registro = mysqli_fetch_array($result)) {
                    $jTableResult['msj'] = "Instructor Creado con Exito.";
                    $jTableResult['rstl'] = "1";
                    $jTableResult['tarjeta'] .= "
                    
                    
                <div class='row'>
                    <div class='col-sm-5'>
                        <ul class='navbar-nav'>
                            <div class='container'>
                            <div class='card'>
                                <div class='front'>
                                    
                                    
                                    <a href='perfil.php'>
                                        <center><img src='' alt='' width='100' height='100' class='profile-photo'>
                                        </center> </a>
                                    <p class='heading'> ". $registro["nombre"] . "". $registro["nombre_dos"] . "". $registro["apellido"] . " </p>
                                    <p class='follow'>". $registro["nombre_jornada"] . "
                                    </p></div>
                                    <div class='back'>
                                    <p class='heading'>". $registro["nombre_rol"] . "</p>
                                    
                                    <a href='../../archivos/vista/enviarmensaje.php'>
                                        <center><img src='' alt='' width='100' height='100' class='profile-photo'>
                                        </center> </a>
                                    <div class='icons'>
                                        
                                

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                    <button type='button' class='create-button' id='CrearInstru' data-id='" . $registro['id_solicitud'] . "'>Subir</button>
                </div>
                        
                        
                    ";
                }
            } else {
                mysqli_rollback($conn);
                $jTableResult['msj'] = "Error al Crear el Instructor.";
                $jTableResult['rstl'] = "0";
            }
            print json_encode($jTableResult);
    break;
    case 'CrearInstru':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $id_solicitud = $_POST['id_solicitud'];
        $query = "UPDATE solicitud s
            JOIN userprofile up ON up.id_userprofile = s.id_userprofile
            SET s.fecha_respuesta = NOW(),
                up.id_rol = '2',
                s.id_estado ='4'
            WHERE s.id_solicitud = '$id_solicitud'";

    
        $result = mysqli_query($conn, $query);
    
        // Verificar si la consulta fue exitosa
        if ($result) {
            // Verificar si se encontraron resultados
            if (mysqli_affected_rows($conn) > 0) {
                $jTableResult['msj'] = "Instructor Creado con Exito.";
                $jTableResult['rstl'] = "1";
            } else {
                mysqli_rollback($conn);
                $jTableResult['msj'] = "Error al Crear el Instructor.";
                $jTableResult['rstl'] = "0";
            }
        } else {
            // Manejar el error de la consulta
            $jTableResult['msj'] = "Error en la consulta: " . mysqli_error($conn);
            $jTableResult['rstl'] = "0";
        }
    
        print json_encode($jTableResult);
    break;
    case 'ListarEcompetencia':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListEc'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
        $query = "SELECT 
            td.nombre AS nom_doc,
            r.nombre AS nom_rol,
            s.id_solicitud,
            s.id_estado, 
            u.nombre,
            u.nombre_dos,
            u.apellido,
            u.numeroiden, 
            u.id_rol,
            d.nombre_dpto AS nom_dpto, 
            m_municipio.nombre_municipio AS nom_muni, 
            p.nombre_poblado AS nom_vereda, 
            u.nombre_dos,
            u.apellido, 
            ts.nombre AS Nombre_Solicitud, 
            ds.id_tiposolicitud,
            ds.descripcion
            FROM 
                solicitud s
            LEFT JOIN  
                userprofile u ON s.id_userprofile = u.id_userprofile
            LEFT JOIN   
                detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
            LEFT JOIN  
                departamentos d ON u.cod_dpto = d.cod_dpto
            LEFT JOIN  
                municipios m_municipio ON u.cod_municipio = m_municipio.cod_municipio
            LEFT JOIN  
                poblados p ON u.cod_poblado = p.cod_poblado
            LEFT JOIN   
                tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
            LEFT JOIN   
                tipodocumento td ON u.id_doc = td.id_doc
            LEFT JOIN   
                rol r ON u.id_rol = r.id_rol
            WHERE 
                s.id_solicitud = '$id_solicitud'
        ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['ListEc'] .= "
                    <div class='form-container'>
                        <h1>Datos Usuario</h1><br>
                        <h4 class='label-identifier'>Nombre Usuario</h4>
                        <label class='data-field'>" . $registro['nombre'] . " " . $registro['nombre_dos'] . " " . $registro['apellido'] . "</label><br>
                        <h4 class='label-identifier'>Tipo Documento</h4><br>
                        <label class='data-field'>" . $registro['nom_doc'] . "</label><br>
                        <h4 class='label-identifier'>Numero Documento</h4><br>
                        <label>" . $registro['numeroiden'] . "</label><br>
                        <br>
                        <h4 class='label-identifier'>Rol Usuario</h4>
                            <label class='data-field'>" . $registro['nom_rol'] . "</label>
                            <hr>
                            <h3 class='label-identifier'>Asignacion</h3>
                            <hr>
                            <h6 class='label-identifier'>Detalle Asignacion</h6>
                            <textarea id='detalle_respuesta' name='detalles'></textarea>
                            <h6 class='label-identifier'>Responsable</h6>
                            <select id='id_responsable'></select>
                            <div class='course-buttons'>
                                <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                                <button type='button' class='create-button' id='btnGuardarCambios2' data-id='" . $registro['id_solicitud'] . "'>Asignar</button>
                            </div>
                            <hr>
                            <h3 class='label-identifier'>Responder</h3>
                            <hr>
                            <h6 class='label-identifier'>Detalle Respuesta</h6>
                            <textarea id='detalle_respuesta' name='detalles'></textarea><br/>
                            <button id='btnAceptarSoli' class='create-button' data-id='" . $registro['id_solicitud'] . "'>Dar Respuesta</button>
                    </div>";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case 'asignacion_Listar_Ec':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListEc'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
        $query = "SELECT 
            td.nombre AS nom_doc,
            r.nombre AS nom_rol,
            s.id_solicitud,
            s.id_estado, 
            u.nombre,
            u.nombre_dos,
            u.apellido,
            u.numeroiden, 
            u.id_rol,
            d.nombre_dpto AS nom_dpto, 
            m_municipio.nombre_municipio AS nom_muni, 
            p.nombre_poblado AS nom_vereda, 
            u.nombre_dos,
            u.apellido, 
            ts.nombre AS Nombre_Solicitud, 
            ds.id_tiposolicitud,
            ds.descripcion
            FROM 
                solicitud s
            LEFT JOIN  
                userprofile u ON s.id_userprofile = u.id_userprofile
            LEFT JOIN   
                detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
            LEFT JOIN  
                departamentos d ON u.cod_dpto = d.cod_dpto
            LEFT JOIN  
                municipios m_municipio ON u.cod_municipio = m_municipio.cod_municipio
            LEFT JOIN  
                poblados p ON u.cod_poblado = p.cod_poblado
            LEFT JOIN   
                tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
            LEFT JOIN   
                tipodocumento td ON u.id_doc = td.id_doc
            LEFT JOIN   
                rol r ON u.id_rol = r.id_rol
            WHERE 
                s.id_solicitud = '$id_solicitud'
        ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['ListEc'] .= "
                    <div class='form-container'>
                        <h1>Datos Usuario</h1><br>
                        <h4 class='label-identifier'>Nombre Usuario</h4>
                        <label class='data-field'>" . $registro['nombre'] . " " . $registro['nombre_dos'] . " " . $registro['apellido'] . "</label><br>
                        <h4 class='label-identifier'>Tipo Documento</h4><br>
                        <label class='data-field'>" . $registro['nom_doc'] . "</label><br>
                        <h4 class='label-identifier'>Numero Documento</h4><br>
                        <label>" . $registro['numeroiden'] . "</label><br>
                        <br>
                        <h4 class='label-identifier'>Rol Usuario</h4>
                            <label class='data-field'>" . $registro['nom_rol'] . "</label>
                            <hr>
                            <h3 class='label-identifier'>Responder</h3>
                            <h6 class='label-identifier'>Detalle Respuesta</h6>
                            <textarea id='detalle_respuesta' name='detalles'></textarea><br/>
                            <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                            <button id='btnAceptarSoli' class='create-button' data-id='" . $registro['id_solicitud'] . "'>Dar Respuesta</button>
                    </div>";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;
    case 'asignacion_Listar_Ra':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
        $jTableResult['ListRa'] = "";
        $id_solicitud = mysqli_real_escape_string($conn, $_POST['id_solicitud']);
        $query = "SELECT 
            td.nombre AS nom_doc,
            r.nombre AS nom_rol,
            s.id_solicitud,
            s.id_estado, 
            u.nombre,
            u.nombre_dos,
            u.apellido,
            u.numeroiden, 
            u.id_rol,
            d.nombre_dpto AS nom_dpto, 
            m_municipio.nombre_municipio AS nom_muni, 
            p.nombre_poblado AS nom_vereda, 
            u.nombre_dos,
            u.apellido, 
            ts.nombre AS Nombre_Solicitud, 
            ds.id_tiposolicitud,
            ds.descripcion
            FROM 
                solicitud s
            LEFT JOIN  
                userprofile u ON s.id_userprofile = u.id_userprofile
            LEFT JOIN   
                detallesolicitud ds ON s.id_detallesolicitud = ds.id_detallesolicitud
            LEFT JOIN  
                departamentos d ON u.cod_dpto = d.cod_dpto
            LEFT JOIN  
                municipios m_municipio ON u.cod_municipio = m_municipio.cod_municipio
            LEFT JOIN  
                poblados p ON u.cod_poblado = p.cod_poblado
            LEFT JOIN   
                tiposolicitud ts ON ds.id_tiposolicitud = ts.id_tiposolicitud
            LEFT JOIN   
                tipodocumento td ON u.id_doc = td.id_doc
            LEFT JOIN   
                rol r ON u.id_rol = r.id_rol
            WHERE 
                s.id_solicitud = '$id_solicitud'
        ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($registro = mysqli_fetch_array($result)) {
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Exitoso";
                $jTableResult['ListRa'] .= "
                    <div class='form-container'>
                        <h1>Datos Usuario</h1><br>
                        <h4 class='label-identifier'>Nombre Usuario</h4>
                        <label class='data-field'>" . $registro['nombre'] . " " . $registro['nombre_dos'] . " " . $registro['apellido'] . "</label><br>
                        <h4 class='label-identifier'>Tipo Documento</h4><br>
                        <label class='data-field'>" . $registro['nom_doc'] . "</label><br>
                        <h4 class='label-identifier'>Numero Documento</h4><br>
                        <label>" . $registro['numeroiden'] . "</label><br>
                        <br>
                        <h4 class='label-identifier'>Rol Usuario</h4>
                            <label class='data-field'>" . $registro['nom_rol'] . "</label>
                            <hr>
                            <h3 class='label-identifier'>Responder</h3>
                            <h6 class='label-identifier'>Detalle Respuesta</h6>
                            <textarea id='detalle_respuesta' name='detalles'></textarea><br/>
                            <button type='button' class='close-button' data-bs-dismiss='modal'>Cerrar</button>
                            <button id='btnAceptarSoli' class='create-button' data-id='" . $registro['id_solicitud'] . "'>Dar Respuesta</button>
                    </div>";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al obtener los datos.";
        }
        echo json_encode($jTableResult);
    break;

}
mysqli_close($conn);
?>