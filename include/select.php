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
    case 'crgrDepto':
        $jTableResult = array();                
        $jTableResult['listDepto']="";
        $jTableResult['listDepto']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT cod_dpto, nombre_dpto FROM departamentos";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listDepto'].="<option value='".$registro['cod_dpto']."'>".$registro['nombre_dpto']."</option>";
        }       
        print json_encode($jTableResult);
    break;
    case 'crgrTiposDoc':
        $jTableResult = array();                
        $jTableResult['lisTiposD']="";
        $jTableResult['lisTiposD']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_doc, nombre FROM tipodocumento";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['lisTiposD'].="<option value='".$registro['id_doc']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'CrgrTipoGenero':
        $jTableResult = array();                
        $jTableResult['lisTiposG']="";
        $jTableResult['lisTiposG']="<option value='0' selected >seleccione:.</option>";
        $query = "SELECT id_genero, nombre FROM genero ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado)) {
            // Agregar los radio buttons al resultado
            $jTableResult['lisTiposG'] .= "<option value='".$registro['id_genero']."'>".$registro['nombre']."</option>";
        }
        // Devolver el resultado como JSON
        print json_encode($jTableResult);
        break;
    case 'crgrMuni':
        $jTableResult = array();                
        $jTableResult['listMuni']="";
        $jTableResult['listMuni']="<option value='0' selected >seleccione.</option>";
        $query="SELECT cod_municipio, nombre_municipio FROM municipios WHERE cod_dpto='".$_POST['cod_dpto']."'";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listMuni'].="<option value='".$registro['cod_municipio']."'>".$registro['nombre_municipio']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'crgrPoblados':
        $jTableResult = array();                
        $jTableResult['listPoblado']="";
        $jTableResult['listPoblado']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT cod_poblado, nombre_poblado FROM poblados WHERE cod_municipio='".$_POST['cod_municipio']."'";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listPoblado'].="<option value='".$registro['cod_poblado']."'>".$registro['nombre_poblado']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'CrgrEmpresa':
        $jTableResult = array();                
        $jTableResult['listEmpresa']="";
        $jTableResult['listEmpresa']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_empresa, nombre FROM empresa ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listEmpresa'].="<option value='".$registro['id_empresa']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break; 
    case 'CrgrArea':
        $jTableResult = array();                
        $jTableResult['listArea']="";
        $jTableResult['listArea']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_area, nombre FROM area ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listArea'].="<option value='".$registro['id_area']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break; 
    case 'CrgrCompetencia':
        $jTableResult = array();                
        $jTableResult['listCmpt']="";
        $jTableResult['listCmpt']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_competencia, nombre FROM competencia ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listCmpt'].="<option value='".$registro['id_competencia']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break; 
    case 'CrgrRA':
        $jTableResult = array();                
        $jTableResult['listRa']="";
        $jTableResult['listRa']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_resultado_aprendizaje, nombre FROM resultadosaprendizaje WHERE id_competencia= '".$_POST['id_competencia']."' ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listRa'].="<option value='".$registro['id_resultado_aprendizaje']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break; 
    case 'CrgrTipoEmpresa':
        $jTableResult = array();                
        $jTableResult['listEmpresa']="";
        $jTableResult['listEmpresa']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT nombre, id_tipoempresa FROM tipoempresa ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listEmpresa'].="<option value='".$registro['id_tipoempresa']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'crgrSolicitante':
        $jTableResult = array();                
        $jTableResult['listSolicitante']="";
        $jTableResult['listSolicitante']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_userprofile, nombre, nombre_dos, apellido FROM userprofile WHERE id_empresa='".$_POST['id_empresa']."'";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listSolicitante'].="<option value='".$registro['id_userprofile']."'>".$registro['nombre']."".$registro['nombre_dos']."".$registro['apellido']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'crgrResponsable':
        $jTableResult = array();                
        $jTableResult['listResponsable']="";
        $jTableResult['listResponsable']="<option value='0' selected >seleccione:.</option>";
        $id_solicitud = $_POST['id_solicitud'];
        $query="SELECT  userprofile.id_userprofile, userprofile.nombre, userprofile.nombre_dos, userprofile.apellido 
        FROM userprofile 
        WHERE userprofile.id_rol = '2'; ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listResponsable'].="<option value='".$registro['id_userprofile']."'>".$registro['nombre']."".$registro['nombre_dos']."".$registro['apellido']."</option>";
        }
        print json_encode($jTableResult);
    break; 
    case 'crgrEstado':
        $jTableResult = array();                
        $jTableResult['listEstado']="";

        $query="SELECT id_estado, nombre FROM estado";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['listEstado'].="<option value='".$registro['id_estado']."'>".$registro['nombre']."</option>";
        }       
        print json_encode($jTableResult);
    break;
    case 'crgrTiposJornada':
        $jTableResult = array();                
        $jTableResult['lisTiposJ']="";
        $jTableResult['lisTiposJ']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_jornada, nombre FROM jornada";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['lisTiposJ'].="<option value='".$registro['id_jornada']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'crgrTiposModalidad':
        $jTableResult = array();                
        $jTableResult['lisTiposM']="";
        $jTableResult['lisTiposM']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_modalidad, nombre FROM modalidad";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['lisTiposM'].="<option value='".$registro['id_modalidad']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'crgrTiposNivelFormacion':
        $jTableResult = array();                
        $jTableResult['lisTiposNF']="";
        $jTableResult['lisTiposNF']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_nivel_formacion, nombre FROM nivelformacion";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['lisTiposNF'].="<option value='".$registro['id_nivel_formacion']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'crgrprogramaFormacion':
        $jTableResult = array();                
        $jTableResult['lisTiposPF']="";
        $jTableResult['lisTiposPF']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_programaformacion, nombre FROM programaformacion WHERE id_estado = 7";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['lisTiposPF'].="<option value='".$registro['id_programaformacion']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'Cgridioma':
        $jTableResult = array();                
        $jTableResult['idioma']="";
        $jTableResult['idioma']="<option value='0' selected >seleccione:.</option>";
        $query="SELECT id_idioma, nombre FROM idiomas";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['idioma'].="<option value='".$registro['id_idioma']."'>".$registro['nombre']."</option>";
        }
        print json_encode($jTableResult);
    break;
    case 'CgrSeccion':
        $jTableResult = array();                
        $jTableResult['seccion']="";
        $query="SELECT i.nombre AS nombre_idioma, s.nombre AS nombre_Seccion, s.descripcion FROM secciones s JOIN idiomas i ON s.id_idioma = i.id_idioma";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['seccion'].='
                            <div class="info-cards2">
                                <h2 class="subtitle2">'.$registro['nombre_Seccion'].'</h2>
                                <div class="info-card2">
                                    <div class="icon-circle2">
                                        <i class="fa-solid fa-comment"></i>
                                    </div>
                                    <h3>Descripcion de la Seccion</h3>
                                    <div class="description2">
                                        <p class="descripcion">'.$registro['descripcion'].'</p>
                                    </div>
                                </div>
                            </div>
                    <div class="divider"></div>';
        }
        print json_encode($jTableResult);
    break;
    case 'CgrLibros':
        $jTableResult = array();                
        $jTableResult['libro']="";
        $query="SELECT l.anio_publicacion,l.titulo, l.autor, l.archivo_pdf, l.descripcion_autor, l.prologo, s.nombre,l.archivo_pdf FROM libros l JOIN secciones s ON l.fk_seccion  = s.id_seccion";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['libro'].='
                            <div class="info-cards3">
                                <h2 class="subtitle3">'.$registro['titulo'].'</h2>
                                <div class="info-card3">
                                    <div class="icon-circle3">
                                        <i class="fa-solid fa-comment"></i>
                                    </div>
                                    <h3>Libro</h3>
                                    <embed src="../../include/'.$registro['archivo_pdf'].'" type="application/pdf" width="50%" height="200px" />
                                    <h3>Descripcion de la Seccion</h3>
                                    <div class="description3">
                                        <p class="descripcion">'.$registro['prologo'].'</p>
                                    </div>
                                </div>
                            </div>
                    <div class="divider"></div>';
        }
        print json_encode($jTableResult);
    break;
    case 'CgrSeccionL':
        $jTableResult = array();                
        $jTableResult['seccionL'] = '';
        $jTableResult['seccionL']="<option value='0' selected >seleccione:.</option>";
        $query = "SELECT id_seccion, nombre FROM secciones";
        $resultado = mysqli_query($conn, $query);
        while ($registro = mysqli_fetch_array($resultado)) {
            $jTableResult['seccionL'] .= '<option value="'.$registro['id_seccion'].'">'.$registro['nombre'].'</option>';
        }
        print json_encode($jTableResult);
    break;
    case 'crgrTipoCategoria':
        $jTableResult = array();                
        $jTableResult['lisTiposC']="";
        $query="SELECT id_categoria, nombre FROM categoria";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['lisTiposC'].="<option value='".$registro['id_categoria']."'>".$registro['nombre']."</option>";
        }       
        print json_encode($jTableResult);
    break;
    // REVISAR CAMILO EL ROL
    case 'crgrTipoRol2':
        $jTableResult = array();                
        $jTableResult['lisTiposR']="";
        $query="SELECT id_rol, nombre FROM rol";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado))
        {
            $jTableResult['lisTiposR'].="<option value='".$registro['id_rol']."'>".$registro['nombre']."</option>";
        }       
        print json_encode($jTableResult);
    break;
    case 'crgrTipoRol':
        $jTableResult = array();                
        $jTableResult['lisTiposR']="";
        $query = "SELECT id_rol, nombre FROM rol ";
        $resultado = mysqli_query($conn, $query);
        while($registro = mysqli_fetch_array($resultado)) {
            // Agregar los radio buttons al resultado
            $jTableResult['lisTiposR'] .= "<input type='radio' name='tipo_rol' value='" . $registro['id_rol'] . "'>" . $registro['nombre'] . "<br>";
        }
        // Devolver el resultado como JSON
        print json_encode($jTableResult);
    break;
    
}
mysqli_close($conn);
?>