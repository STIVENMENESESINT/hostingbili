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
    case 'instructorCreado':
        $jTableResult = array();
        $jTableResult['rstl'] = "";
        $jTableResult['msj'] = "";
        $jTableResult['tarjeta'] = "";
        
        $query = "SELECT 
                    solicitud.id_estado AS estado, 
                    userprofile.nombre, 
                    userprofile.id_rol,
                    userprofile.nombre_dos, 
                    userprofile.apellido, 
                    r.nombre AS nombre_rol,
                    a.nombre AS nombre_area,
                    detallesolicitud.id_jornada AS jornada, 
                    detallesolicitud.id_tiposolicitud AS tiposoli, 
                    detallesolicitud.twitter AS twitter, 
                    detallesolicitud.facebook AS facebook, 
                    detallesolicitud.youtube AS youtube, 
                    detallesolicitud.instagram AS instagram
                    FROM 
                        solicitud
                    JOIN 
                        userprofile ON solicitud.id_userprofile = userprofile.id_userprofile
                    JOIN 
                        detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                    JOIN 
                        estado ON solicitud.id_estado = estado.id_estado
                    JOIN 
                        tiposolicitud ON detallesolicitud.id_tiposolicitud = tiposolicitud.id_tiposolicitud
                    JOIN
                        rol r ON userprofile.id_rol = r.id_rol
                    JOIN 
                        area a ON userprofile.id_area = a.id_area
                    WHERE 
                        detallesolicitud.id_tiposolicitud = 10 AND 
                        solicitud.id_estado = 4 AND
                        userprofile.id_rol = '2'
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
                                    <p class='follow'>". $registro["nombre_area"] . "
                                    </p></div>
                                    <div class='back'>
                                    <p class='heading'>LICENCIADA EN LENGUAS MODERNAS</p>
                                    
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
                
                    
                    
                ";
            }
        } else {
            mysqli_rollback($conn);
            $jTableResult['msj'] = "Error al Crear el Instructor.";
            $jTableResult['rstl'] = "0";
        }
        print json_encode($jTableResult);
    break;
}

mysqli_close($conn);
?>