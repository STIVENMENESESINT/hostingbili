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
		case 'confirmar':
			$jTableResult = array();
			$jTableResult['validacion']="";
			$jTableResult['estado']="";
				$query= " 	SELECT correo, numeroiden, clave   
							FROM   userprofile
							WHERE  correo ='".$_POST['correo']."'
							AND numeroiden ='".$_POST['numeroiden']."'
							AND    clave = '".$_POST['clave']."' "; 
							$regis = mysqli_query($conn, $query);
							$numero = mysqli_num_rows($regis);
							if($numero==0)
								{
									$jTableResult['validacion']="no";  
								}
							else
								{	
									$jTableResult['validacion']="si";
									$query="SELECT id_userprofile, id_estado, nombre, apellido, id_rol, correo, numeroiden, clave
											FROM userprofile
											WHERE  correo ='".$_POST['correo']."' 
											AND    numeroiden = '".$_POST['numeroiden']."' 
											AND    clave = '".$_POST['clave']."'";
									$arreglo = mysqli_query($conn, $query);
									while($result=mysqli_fetch_array($arreglo)){
										if($result['id_estado']=='1'){
												$jTableResult['estado']="A";
												$_SESSION['usuLog']=$result['nombre']." ".$result['apellido'];
												$_SESSION['id_userprofile']=$result['id_userprofile'];
												$_SESSION['id_rol']=$result['id_rol'];
												$_SESSION['correo']=$result['correo'];
												// $jTableResult['nombreRol']=$result['?'];													
											}
										else
											{
												$jTableResult['estado']="I";
											}	
									}
								}
					// echo "<pre>";
					// print_r($_SESSION['usuLog']);					
					// echo "</pre>";		
					// echo "<pre>";
					// print_r($_SESSION['idUsuario']);
					// echo "</pre>";					
					// exit();
			print json_encode($jTableResult);
		break;
		case 'registroUsuNew': 
			$jTableResult = array();
			$jTableResult['rstl']="";
			$jTableResult['msj']="";
				$query="INSERT INTO userprofile SET
						id_doc='".$_POST['id_tpdoc']."', 
						numeroiden ='".$_POST['numeroiden_registro']."', 
						clave ='".$_POST['clave_registro']."', 
						nombre ='".$_POST['nameusu']."', 
						nombre_dos ='".$_POST['nombre_dos']."', 
						fecha_registro = NOW(),
						id_estado = 1,
						id_rol = 5,
						id_genero = '".$_POST['id_genero']."',
						celular = '".$_POST['celular']."',
						correo ='".$_POST['correo_registro']."',
						apellido ='".$_POST['apellidoUsu']."', 
						apellido_dos ='".$_POST['apellidoUsu_dos']."',
						cod_dpto ='".$_POST['cod_dpto']."', 
						cod_municipio='".$_POST['cod_municipio']."', 
						cod_poblado='".$_POST['cod_poblado']."';";
				if($result= mysqli_query($conn,$query)){
						mysqli_commit($conn);
						
						$jTableResult['msj']= "Registro guardado con exito.";
						$jTableResult['rstl']= "1"; }
				else{
						mysqli_rollback($conn);
						$jTableResult['msj']= "Error al guardar.";				
						$jTableResult['rstl']= "0";  }
			print json_encode($jTableResult);
		break;
		case 'registroUsuNewE': 
			$jTableResult = array();
			$jTableResult['rstl']="";
			$jTableResult['msj']="";
			$query = "SELECT MAX(id_empresa) as lastId FROM empresa;";
			if ($arreglo=mysqli_query($conn,$query)){
				while($result=mysqli_fetch_array($arreglo)){
					$varid=$result['lastId'];
					$query="INSERT INTO userprofile SET
						id_doc='".$_POST['id_tpdoc']."', 
						numeroiden ='".$_POST['numeroiden_registro']."', 
						clave ='".$_POST['clave_registro']."', 
						nombre ='".$_POST['nameusu']."', 
						nombre_dos ='".$_POST['nombre_dos']."', 
						fecha_registro = NOW(),
						id_estado = 1,
						id_rol = 4,
						id_empresa = '".$varid."' ,
						id_genero = '".$_POST['id_genero']."',
						celular = '".$_POST['celular']."',
						correo ='".$_POST['correo_registro']."',
						apellido ='".$_POST['apellidoUsu']."', 
						apellido_dos ='".$_POST['apellidoUsu_dos']."';";
				if($result= mysqli_query($conn,$query)){
						mysqli_commit($conn);
						
						$jTableResult['msj']= "Registro guardado con exito.";
						$jTableResult['rstl']= "1"; }
				else{
						mysqli_rollback($conn);
						$jTableResult['msj']= "Error al guardar.";				
						$jTableResult['rstl']= "0";  }
				}
			}
				
			print json_encode($jTableResult);
		break;
		case 'registroEmpNew': 
			$jTableResult = array();
			$jTableResult['rstl']="";
			$jTableResult['msj']="";
				$query="INSERT INTO empresa SET 
						nombre='".$_POST['nombre_empresa']."', 
						Nit ='".$_POST['numeroiden_empresa']."', 
						telefono ='".$_POST['telefono_empresa']."', 
						correo ='".$_POST['correo_empresa']."',
						id_tipodoc = 3;";
				if($result= mysqli_query($conn,$query)){
						mysqli_commit($conn);
						
						$jTableResult['msj']= "Registro guardado con exito.";
						$jTableResult['rstl']= "1"; }
				else{
						mysqli_rollback($conn);
						$jTableResult['msj']= "Error al guardar.";				
						$jTableResult['rstl']= "0";  }
			print json_encode($jTableResult);
		break;

		









		








		case 'actualizarusuario':
			
			$jTableResult = array(); 
			$jTableResult['rstl'] = "";
			$jTableResult['msj'] = "";
		
			// Verificar si todas las claves necesarias están definidas en $_POST
			$requiredKeys = ['nombre', 'nombre_dos', 'clave', 'estadoUsu', 'apellido', 'apellido_dos', 'numeroDocumento', 'correoUsu', 'celular', 'cod_dpto', 'cod_municipio', 'cod_poblado', 'id_doc', 'direccion', 'fechaNacimientoUsu', 'correo_sena'];
			$allKeysExist = true;
		
			foreach ($requiredKeys as $key) {
				if (!array_key_exists($key, $_POST)) {
					$allKeysExist = false;
					break;
				}
			}
		
			if ($allKeysExist) {
				// Asignar valores de $_POST a variables
				$nombre = $_POST['nombre']; 
				$id_doc = $_POST['id_doc']; 
				$nombre_dos = $_POST['nombre_dos'];
				$clave = $_POST['clave'];
				$apellido = $_POST['apellido'];
				$estadoUsu = $_POST['estadoUsu'];
				$apellido_dos = $_POST['apellido_dos'];
				$numeroDocumento = $_POST['numeroDocumento'];
				$correoUsu = $_POST['correoUsu'];
				$celular = $_POST['celular'];
				$cod_dpto = $_POST['cod_dpto'];
				$cod_municipio = $_POST['cod_municipio'];
				$cod_poblado = $_POST['cod_poblado'];
				$direccion = $_POST['direccion'];
				$fechaNacimientoUsu = $_POST['fechaNacimientoUsu'];
				$correo_sena = $_POST['correo_sena'];
		
				// Consulta SQL para actualizar el perfil del usuario
				$query = "UPDATE userprofile SET 
					nombre = '" . $nombre . "',
					nombre_dos = '" . $nombre_dos . "',
					apellido = '" . $apellido . "',
					id_doc = '" . $id_doc . "',
					numeroiden = '" . $numeroDocumento . "',
					correo = '" . $correoUsu . "',
					clave = '" . $clave . "',
					id_estado = '" . $estadoUsu . "',
					apellido_dos = '" . $apellido_dos . "',
					celular = '" . $celular . "',
					cod_dpto = '" . $cod_dpto . "',
					cod_municipio = '" . $cod_municipio . "',
					cod_poblado = '" . $cod_poblado . "',
					direccion = '" . $direccion . "',
					fechaNacimientoUsu = '" . $fechaNacimientoUsu . "',
					correo_sena = '" . $correo_sena . "'
					WHERE id_userprofile = '" . $_SESSION['id_userprofile'] . "'";
		
				// Ejecutar la consulta y verificar el resultado
				if (mysqli_query($conn, $query)) {
					mysqli_commit($conn);
					$jTableResult['msj'] = "Registro actualizado con éxito.";
					$jTableResult['rstl'] = "1";
				} else {
					mysqli_rollback($conn);
					$jTableResult['msj'] = "Error al actualizar el registro: " . mysqli_error($conn);
					$jTableResult['rstl'] = "0";
				}
			} else {
				// Si faltan claves requeridas, maneja el error
				$jTableResult['msj'] = "Error: Campos del formulario incompletos.";
				$jTableResult['rstl'] = "0";
			}
		
			// Devuelve el resultado como JSON
			echo json_encode($jTableResult);


		case 'salir':	
			$jTableResult = array();
				unset($_SESSION['usuLog']);
				unset($_SESSION['id_userprofile']);
				unset($_SESSION['id_rol']);
				unset($_SESSION['correo']);
				session_destroy();						
			print json_encode($jTableResult);
		break;

	










		case 'PublicarNoticia': 
			$jTableResult = array();
			$jTableResult['rstl']="";
			$jTableResult['msj']="";
				$query="INSERT INTO detallesolicitud SET
						
						
						id_tiposolicitud = 4,
					
						titulo = '".$_POST['titulo']."',
						
						id_imagen = '".$_POST['id_imagen']."',
						fecha_inicio = '".$_POST['id_fecha_inicio']."',
						fecha_fin = '".$_POST['id_fecha_fin']."',
						url = '".$_POST['id_url']."',
						
						
						descripcion = '".$_POST['descripcion']."';";
						
				if($result= mysqli_query($conn,$query)){
						mysqli_commit($conn);
						$jTableResult['msj']= "Registro guardado con exito.";
						$jTableResult['rstl']= "1"; }
				else{
						mysqli_rollback($conn);
						$jTableResult['msj']= "Error al guardar.";				
						$jTableResult['rstl']= "0";  }
			print json_encode($jTableResult);
		break;









		case 'PublicarNoticia': 
			$jTableResult = array();
			$jTableResult['rstl']="";
			$jTableResult['msj']="";
				$query="INSERT INTO detallesolicitud SET
						
						
						id_tiposolicitud = 4,
					
						titulo = '".$_POST['titulo']."',
						
						id_imagen = '".$_POST['id_imagen']."',
						fecha_inicio = '".$_POST['id_fecha_inicio']."',
						fecha_fin = '".$_POST['id_fecha_fin']."',
						url = '".$_POST['id_url']."',
						
						
						descripcion = '".$_POST['descripcion']."';";
						
				if($result= mysqli_query($conn,$query)){
						mysqli_commit($conn);
						$jTableResult['msj']= "Registro guardado con exito.";
						$jTableResult['rstl']= "1"; }
				else{
						mysqli_rollback($conn);
						$jTableResult['msj']= "Error al guardar.";				
						$jTableResult['rstl']= "0";  }
			print json_encode($jTableResult);
		break;






// Restablecer contraseña
		case 'RestablecerContraseña':
			$jTableResult = array();
			$jTableResult['rstl'] = "";
			$jTableResult['msj'] = "";
			if (!isset($_POST['numeroiden']) || !isset($_POST['correo'])) {
				$jTableResult['msj'] = "Todos los campos son obligatorios.";
				$jTableResult['rstl'] = "0";
				print json_encode($jTableResult);
				exit;
			}
			$identificacion = $_POST['numeroiden'];
			$correo = $_POST['correo'];
			enviarCorreo($correo, "Su nueva contraseña es: " . $nueva_contraseña); 
			$jTableResult['msj'] = "Se ha enviado un correo electrónico con instrucciones para restablecer la contraseña.";
			$jTableResult['rstl'] = "1";
			print json_encode($jTableResult);
			exit;
			break;	
		function generarClave($longitud = 8) {
			$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$longitud_caracteres = strlen($caracteres);
			$clave = '';
			for ($i = 0; $i < $longitud; $i++) {
				$clave .= $caracteres[rand(0, $longitud_caracteres - 1)];
			}
			return $clave;
		}
		function enviarCorreo($correo, $mensaje) {
		}





	}

mysqli_close($conn);