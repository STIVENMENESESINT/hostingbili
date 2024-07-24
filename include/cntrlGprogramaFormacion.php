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
    case 'buscarPrograma':
        $jTableResult = array();
        $jTableResult['rstl']="";
        $jTableResult['msj']="";
        $jTableResult['listaUsu']='
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Identificacion</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Permisos</th>
                        </tr>
                    </thead>
                    <tbody>';
            $query="SELECT id_userprofile, nombre, nombre_dos, correo, apellido, numeroiden, id_estado FROM userprofile WHERE nombre ='".$_POST['dato_txt']."' OR
                        apellido = '".$_POST['dato_txt']."' OR correo = '".$_POST['dato_txt']."' OR numeroiden ='".$_POST['dato_txt']."' OR nombre_dos ='".$_POST['dato_txt']."'";
            $resultado = mysqli_query($conn, $query);
            $numero = mysqli_num_rows($resultado);
            if($numero==0){
                $jTableResult['listaUsu']="<thead><tr><th scope='col'>&nbsp;&nbsp&nbsp;&nbsp;No existen coincidencias.</th></tr></thead>";
                $jTableResult['msj']= "NO EXISTEN DATOS.";
                $jTableResult['rslt']= "0";						
            }else{
                while($registro = mysqli_fetch_array($resultado)){
                    $jTableResult['listaUsu'].="<tr>";
                    $jTableResult['listaUsu'].="
                                                <td>".$registro['id_userprofile']."</td>
                                                <td>".$registro['nombre']."</td>
                                                <td>".$registro['apellido']."</td>
                                                <td>".$registro['numeroiden']."</td>
                                                <td>".$registro['correo']."</td>
                                                <td>".$registro['id_estado']."</td>
                                                <td><button id='btn_permiso'type='button'class='btn btn-success' data-id='".$registro['id_userprofile']."' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Gestionar</button></td>
                                                ";
                    $jTableResult['listaUsu'].="</tr>";
                }
                $jTableResult['msj']= "";
                $jTableResult['rslt']= "1";						
            }
        print json_encode($jTableResult);
    break;
    case 'permisoUsuario':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $jTableResult['listaPermiso'] = "";
        $id_userprofile = mysqli_real_escape_string($conn, $_POST['id_userprofile']);
        
        $query = "SELECT 
                    up.id_userprofile, 
                    up.nombre AS nom_usuario, 
                    up.nombre_dos, 
                    up.correo, 
                    up.apellido, 
                    up.numeroiden, 
                    up.id_estado, 
                    up.id_rol, 
                    r.nombre AS nom_rol, 
                    e.nombre AS nom_estado, 
                    td.nombre AS nom_doc
                    FROM 
                        userprofile up
                    LEFT JOIN 
                        tipodocumento td ON up.id_doc = td.id_doc
                    LEFT JOIN 
                        rol r ON up.id_rol = r.id_rol
                    LEFT JOIN 
                        estado e ON up.id_estado = e.id_estado
                    WHERE 
                        up.id_userprofile = '$id_userprofile'";
        
        $resultado = mysqli_query($conn, $query);
    
        if (!$resultado) {
            $jTableResult['msj'] = "Error en la consulta SQL: " . mysqli_error($conn);
            $jTableResult['rstl'] = "0";
            print json_encode($jTableResult);
            break;
        }
        
        $numero = mysqli_num_rows($resultado);
        if ($numero == 0) {
            $jTableResult['msj'] = "NO EXISTEN DATOS.";
            $jTableResult['rstl'] = "0";
        } else {
            while ($registro = mysqli_fetch_array($resultado)) {
                $jTableResult['listaPermiso'] .= "
                    <h2>Datos Usuario</h2><br>
                    <h3>Imagen de perfil Usuario.</h3>
                    <h4>Nombre Usuario</h4>
                    <label>" . $registro['nom_usuario'] . " " . $registro['nombre_dos'] . " " . $registro['apellido'] . "</label><br>
                    <h4>Tipo Documento</h4><br>
                    <label>" . $registro['nom_doc'] . "</label><br>
                    <h4>Numero Documento</h4><br>
                    <label>" . $registro['numeroiden'] . "</label><br>
                    <hr><br>
                    <h2>Gestion Permisos</h2>
                    <h4>Estado Usuario</h4>
                    <select id='id_estado'>
                        <option value='" . $registro['id_estado'] . "'>" . $registro['nom_estado'] . "</option>
                    </select>
                    <h4>Rol Usuario</h4>
                    <select id='id_rol'>
                        <option value='" . $registro['id_rol'] . "'>" . $registro['nom_rol'] . "</option>
                    </select>";
            }
            $jTableResult['msj'] = "";
            $jTableResult['rstl'] = "1";
        }
    
        print json_encode($jTableResult);
    break;
    case 'GestionPermiso':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $jTableResult['listaPermiso'] = "";
        $id_userprofile = mysqli_real_escape_string($conn, $_POST['id_userprofile']);
        $id_estado = mysqli_real_escape_string($conn, $_POST['id_estado']);
        $id_rol = mysqli_real_escape_string($conn, $_POST['id_rol']);
        $query = "UPDATE userprofile 
                SET 
                    id_estado = '$id_estado',
                    id_rol = '$id_rol'
                WHERE 
                    id_userprofile = '$id_userprofile'";
        $resultado = mysqli_query($conn, $query);
        if (!$resultado) {
            $jTableResult['msj'] = "Error en la consulta SQL: " . mysqli_error($conn);
            $jTableResult['rstl'] = "0";
            print json_encode($jTableResult);
            break;
        } else {
            $jTableResult['msj'] = "Permisos Concedidos Exitosamente";
            $jTableResult['rstl'] = "1";
        }

    
        print json_encode($jTableResult);
    break;
    case 'MisPf_sin':
        $jTableResult = array();
        $jTableResult['rs'] = "";
        $jTableResult['Ms'] = "";
        $jTableResult['tabla'] = ""; 
    
        // Iniciar la construcción de la tabla
        $jTableResult['tabla'] .= '
        <div class="container">
                        <style>
                            .container{
                                position: absolute;
                                left: 8rem;
                            }
                        </style>
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>';
                            if ($_SESSION['id_rol'] == 3) {
                                $jTableResult['tabla'] .= '<th>Nombre Programa Formacion</th>
                                                            <th>Encargado</th>';
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
            $busqueda = "SELECT 
                            p.nombre,
                            p.ficha,
                            p.id_programaformacion,
                            u.nombre AS nombre_responsable,
                            u.apellido,
                            e.nombre AS nombre_estado,
                            p.ficha
                        FROM 
                            programaformacion p
                        LEFT JOIN 
                            userprofile u ON p.fk_responsable = u.id_userprofile
                        LEFT JOIN 
                            estado e ON p.id_estado = e.id_estado
                        WHERE 
                            p.id_estado = 7";
            $result = mysqli_query($conn, $busqueda);
            
            if (mysqli_num_rows($result) > 0) {
                $jTableResult['rs'] = "1";
                // Recorrer los resultados y construir la lista de opciones
                while($registro = mysqli_fetch_array($result)) {
                    $jTableResult['tabla'] .= "<tr>
                                                <td>" . $registro['id_programaformacion'] . "</td>
                                                <td>" . $registro['nombre'] . "</td>";
                                                    if ($_SESSION['id_rol'] == 3) {
                                                        $jTableResult['tabla'] .= "<td>" . $registro['nombre_responsable'] . "" . $registro['apellido'] . "</td>";
                                                    }
                                                    $jTableResult['tabla'] .= "<td>" . $registro['ficha'] . "</td>
                                                                                <td>" . $registro['nombre_estado'] . "</td>
                                                                                <td>";
                                                    if ($_SESSION['id_rol'] == 3) {
                                                        $jTableResult['tabla'] .= '
                                                                                    <button id="modalCancel" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelSolicitudModal" data-id="' . $registro['id_programaformacion'] . '">Denegar Soli</button>
                                                                                    <button  class="btn btn-success" id="btn_ListPf" data-bs-toggle="modal" data-bs-target="#AceptSolicitudModal" data-id="' . $registro['id_programaformacion'] . '" > Seguimiento</button>';
                                                    }
                    $jTableResult['tabla'] .= "</td></tr>";
                }
                $jTableResult['tabla'] .= "</tbody></table></div>"; // Cerrar la tabla y los elementos HTML
        }
        
        print json_encode($jTableResult);
    break;
    case 'Listar_pf':
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
                        <label> Nombre Programa de Formacion</label><br>
                        <label id='solicitante'>
                        " . $registro['nombre'] . "" . $registro['nombre_dos'] . "" . $registro['apellido'] . "</label>
                        <br>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Fecha inicio Programa</h6>
                                <h6 class='modal-title'>" . $registro['nom_vereda'] . "</h6>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Fecha Fin Programa</h6>
                                <h6 class='modal-title'>" . $registro['nom_vereda'] . "</h6>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Competencia</h6>
                                <h6 class='modal-title'>" . $registro['nom_vereda'] . "</h6>  <a href='programar.php'>programar</a>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Resultado de Aprendizaje</h6>
                                <h6 class='modal-title'>" . $registro['nom_vereda'] . "</h6>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Modalidad</h6>
                                <h6 class='modal-title'>" . $registro['nom_vereda'] . "</h6>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Numero Matriculados</h6>
                                <h6 class='modal-title'>" . $registro['nom_vereda'] . "</h6>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Descargar Matriculados</h6>
                                <h6 class='modal-title'>" . $registro['nom_vereda'] . "</h6>
                            </div>
                        </div>
                        <h5>Nombre Encargado</h5>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Numero de Documento</h6>
                                <h6 class='modal-title'>" . $registro['nom_dpto'] . "</h6>
                            </div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col-sm-12'>
                                <h6 class='modal-title'>Cargo en el Aplicativo</h6>
                                <h6 class='modal-title'>" . $registro['nom_muni'] . "</h6>
                            </div>
                        </div>
                        <br>
                        <label>Detalles</label>
                        <br>
                        <textarea id='detalles' name='detalles'>" . $registro['descripcion'] . "</textarea>
                        <br>
                        <hr>
                        <h3>Control de Desercion</h3>
                        <hr>
                        <div id='form_container'></div>
                        <h6>Nombre Completo</h6>
                        <input type='text'><br>
                        <h6>Numero de identificacion</h6>
                        <input type='number'>
                        <h6>Correo Electronico</h6>
                        <input type='text'><br>
                        <h6>Nuevo</h6>
                        <button class='create-button' id='create'> Agregar</button>
                        <button id='btnAceptarSoli' class='close-button' data-id='" . $registro['id_solicitud'] . "' >Desertar</button>
                        <hr>

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