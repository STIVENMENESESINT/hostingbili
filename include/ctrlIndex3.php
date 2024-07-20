
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


        
        case 'AgregarResultadoAprendizaje':
            $jTableResult = array();
            $jTableResult['rst'] = "";
            $jTableResult['ms'] = "";

            if (isset($_POST['nombre']) && isset($_POST['id_competencia'])) {
                $nombre = $conn->real_escape_string($_POST['nombre']);
                $id_competencia = $conn->real_escape_string($_POST['id_competencia']);

                // Verificar si el id_competencia existe en la tabla competencia
                $queryCheck = "SELECT * FROM competencia WHERE id_competencia = '$id_competencia'";
                $resultCheck = mysqli_query($conn, $queryCheck);

                if (mysqli_num_rows($resultCheck) > 0) {
                    $query = "INSERT INTO resultadosaprendizaje (nombre, id_competencia) VALUES ('$nombre', '$id_competencia')";

                    if ($result = mysqli_query($conn, $query)) {
                        mysqli_commit($conn);
                        $jTableResult['rst'] = "1";
                        $jTableResult['ms'] = "Resultado de aprendizaje agregado con éxito.";
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['ms'] = "Error al guardar el resultado de aprendizaje: " . mysqli_error($conn);
                        $jTableResult['rst'] = "0";
                    }
                } else {
                    $jTableResult['ms'] = "El id_competencia no existe.";
                    $jTableResult['rst'] = "0";
                }
            } else {
                $jTableResult['ms'] = "El nombre y la competencia del resultado de aprendizaje son obligatorios.";
                $jTableResult['rst'] = "0";
            }

            print json_encode($jTableResult);
            break;
       

            case 'EditarResultadoAprendizaje':
                $jTableResult = array();
                $jTableResult['rst'] = "";
                $jTableResult['ms'] = "";
            
                if (isset($_POST['id_resultado_aprendizaje'], $_POST['nombre'], $_POST['id_competencia'])) {
                    $id_resultado_aprendizaje = $conn->real_escape_string($_POST['id_resultado_aprendizaje']);
                    $nombre = $conn->real_escape_string($_POST['nombre']);
                    $id_competencia = $conn->real_escape_string($_POST['id_competencia']);
            
                    // Consulta para actualizar el resultado de aprendizaje
                    $query = "UPDATE resultadosaprendizaje SET nombre = '$nombre', id_competencia = '$id_competencia' 
                              WHERE id_resultado_aprendizaje = '$id_resultado_aprendizaje'";
            
                    if (mysqli_query($conn, $query)) {
                        mysqli_commit($conn);
                        $jTableResult['rst'] = "1";
                        $jTableResult['ms'] = "Resultado de aprendizaje actualizado con éxito.";
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['rst'] = "0";
                        $jTableResult['ms'] = "Error al actualizar el resultado de aprendizaje: " . mysqli_error($conn);
                    }
                } else {
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "Todos los campos son obligatorios.";
                }
            
                echo json_encode($jTableResult);
                break;
            



            case 'ListarResultadosAprendizaje':
                $jTableResult = array();
                $jTableResult['rst'] = "";
                $jTableResult['ms'] = "";
            
                $query = "SELECT ra.id_resultado_aprendizaje, ra.nombre, c.nombre AS nombre_competencia 
                        FROM resultadosaprendizaje ra
                        JOIN competencia c ON ra.id_competencia = c.id_competencia";
            
                $result = mysqli_query($conn, $query);
            
                if ($result) {
                    $resultados = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $resultados[] = $row;
                    }
                    $jTableResult['rst'] = "1";
                    $jTableResult['ms'] = "Resultados de aprendizaje obtenidos con éxito.";
                    $jTableResult['data'] = $resultados;
                } else {
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "Error al obtener los resultados de aprendizaje: " . mysqli_error($conn);
                }
            
                echo json_encode($jTableResult);
                break;
            
    case 'EliminarResultadoAprendizaje':
        $jTableResult = array();
        $jTableResult['rst'] = "";
        $jTableResult['ms'] = "";
    
        if (isset($_POST['id_resultado_aprendizaje'])) {
            $id_resultado_aprendizaje = $conn->real_escape_string($_POST['id_resultado_aprendizaje']);
    
            $query = "DELETE FROM resultadosaprendizaje WHERE id_resultado_aprendizaje = '$id_resultado_aprendizaje'";
    
            if (mysqli_query($conn, $query)) {
                mysqli_commit($conn);
                $jTableResult['rst'] = "1";
                $jTableResult['ms'] = "Resultado de aprendizaje eliminado con éxito.";
            } else {
                mysqli_rollback($conn);
                $jTableResult['rst'] = "0";
                $jTableResult['ms'] = "Error al eliminar el resultado de aprendizaje.";
            }
        } else {
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "ID del resultado de aprendizaje es obligatorio.";
        }
    
        echo json_encode($jTableResult);
        break;
    








        
        case 'AgregarCompetencia':
            $jTableResult = array();
            $jTableResult['rst'] = "";
            $jTableResult['ms'] = "";

            if (isset($_POST['nombre'])) {
                $nombre = $conn->real_escape_string($_POST['nombre']);

                $query = "INSERT INTO competencia (nombre) VALUES ('$nombre')";

                if ($result = mysqli_query($conn, $query)) {
                    mysqli_commit($conn);
                    $jTableResult['rst'] = "1";
                    $jTableResult['ms'] = "Competencia agregada con éxito.";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['ms'] = "Error al guardar la competencia.";
                    $jTableResult['rst'] = "0";
                }
            } else {
                $jTableResult['ms'] = "El nombre de la competencia es obligatorio.";
                $jTableResult['rst'] = "0";
            }

            print json_encode($jTableResult);
            break;

            case 'ListarCompetencias':
                $jTableResult = array();
                $jTableResult['records'] = array(); // Arreglo para almacenar los registros de competencias
                $jTableResult['rst'] = ""; // Inicializar el estado de la respuesta
                $jTableResult['ms'] = ""; // Inicializar el mensaje de la respuesta
            
                // Verificar si hay una sesión activa
                if (isset($_SESSION['id_userprofile'])) {
                    // Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
                    include_once('../../include/conex.php');
                    $conn = Conectarse(); // Función para conectarse a la base de datos
            
                    // Consulta para obtener todas las competencias
                    $query = "SELECT * FROM competencia";
                    $result = mysqli_query($conn, $query);
            
                    if ($result) {
                        // Iterar sobre los resultados y agregarlos al arreglo de registros
                        while ($row = mysqli_fetch_assoc($result)) {
                            $competencia = array(
                                'id' => $row['id_competencia'],
                                'nombre' => $row['nombre']
                            );
                            $jTableResult['records'][] = $competencia;
                        }
            
                        // Indicar éxito y enviar los datos en formato JSON
                        $jTableResult['rst'] = "1";
                        $jTableResult['ms'] = "Competencias listadas correctamente.";
                    } else {
                        // En caso de error en la consulta
                        $jTableResult['rst'] = "0";
                        $jTableResult['ms'] = "Error al obtener las competencias: " . mysqli_error($conn);
                    }
            
                    // Cerrar la conexión a la base de datos
                    mysqli_close($conn);
                } else {
                    // Si no hay una sesión activa, enviar error
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "Sesión no iniciada.";
                }
            
                // Enviar respuesta JSON al cliente
                echo json_encode($jTableResult);
                break;
            
            
             

        case 'EliminarCompetencia':
            $jTableResult = array();
            $jTableResult['rst'] = "";
            $jTableResult['ms'] = "";
        
            if (isset($_POST['id_competencia'])) {
                $id_competencia = $conn->real_escape_string($_POST['id_competencia']);
        
                $query = "DELETE FROM competencia WHERE id_competencia = '$id_competencia'";
        
                if (mysqli_query($conn, $query)) {
                    mysqli_commit($conn);
                    $jTableResult['rst'] = "1";
                    $jTableResult['ms'] = "Competencia eliminada con éxito.";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "Error al eliminar la competencia.";
                }
            } else {
                $jTableResult['rst'] = "0";
                $jTableResult['ms'] = "ID de la competencia es obligatorio.";
            }
        
            echo json_encode($jTableResult);
            break;
        



            case 'AgregarMCER':
                $jTableResult = array();
                $jTableResult['rst'] = "";
                $jTableResult['ms'] = "";
    
                if (isset($_POST['id_mcer']) && isset($_POST['nombre'])) {
                    $id_mcer = $conn->real_escape_string($_POST['id_mcer']);
                    $nombre = $conn->real_escape_string($_POST['nombre']);
    
                    $query = "INSERT INTO mcer (id_mcer, nombre) VALUES ('$id_mcer', '$nombre')";
    
                    if ($result = mysqli_query($conn, $query)) {
                        mysqli_commit($conn);
                        $jTableResult['rst'] = "1";
                        $jTableResult['ms'] = "MCER agregado con éxito.";
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['ms'] = "Error al guardar el MCER: " . mysqli_error($conn);
                        $jTableResult['rst'] = "0";
                    }
                } else {
                    $jTableResult['ms'] = "El ID y el nombre del MCER son obligatorios.";
                    $jTableResult['rst'] = "0";
                }
    
                print json_encode($jTableResult);
                break;





            case 'EditarMCER':
                $jTableResult = array();
                $jTableResult['rst'] = "";
                $jTableResult['ms'] = "";
            
                if (isset($_POST['id_mcer'], $_POST['descripcion'])) {
                    $id_mcer = $conn->real_escape_string($_POST['id_mcer']);
                    $descripcion = $conn->real_escape_string($_POST['descripcion']);
            
                    // Consulta para actualizar el MCER
                    $query = "UPDATE mcer SET descripcion = '$descripcion' WHERE id_mcer = '$id_mcer'";
            
                    if (mysqli_query($conn, $query)) {
                        mysqli_commit($conn);
                        $jTableResult['rst'] = "1";
                        $jTableResult['ms'] = "MCER actualizado con éxito.";
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['rst'] = "0";
                        $jTableResult['ms'] = "Error al actualizar el MCER: " . mysqli_error($conn);
                    }
                } else {
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "Todos los campos son obligatorios.";
                }
            
                echo json_encode($jTableResult);
                break;
            

            case 'EliminarMCER':
                $jTableResult = array();
                $jTableResult['rst'] = "";
                $jTableResult['ms'] = "";
            
                if (isset($_POST['id_mcer'])) {
                    $id_mcer = $conn->real_escape_string($_POST['id_mcer']);
            
                    $query = "DELETE FROM mcer WHERE id_mcer = '$id_mcer'";
            
                    if (mysqli_query($conn, $query)) {
                        mysqli_commit($conn);
                        $jTableResult['rst'] = "1";
                        $jTableResult['ms'] = "MCER eliminado con éxito.";
                    } else {
                        mysqli_rollback($conn);
                        $jTableResult['rst'] = "0";
                        $jTableResult['ms'] = "Error al eliminar el MCER.";
                    }
                } else {
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "ID del MCER es obligatorio.";
                }
            
                echo json_encode($jTableResult);
                break;
            




                case 'AgregarFicha':
                    $jTableResult = array();
                    $jTableResult['rst'] = "";
                    $jTableResult['ms'] = "";
        
                    if (isset($_POST['ficha']) && isset($_POST['id_programaformacion'])) {
                        $ficha = $conn->real_escape_string($_POST['ficha']);
                        $id_programaformacion = $conn->real_escape_string($_POST['id_programaformacion']);
        
                        // Verificar si el id_programaformacion existe en la tabla programaformacion
                        $query = "SELECT * FROM programaformacion WHERE id_programaformacion = '$id_programaformacion'";
                    
                                                            
                    
                        $resultCheck = mysqli_query($conn, $query);
        
                        if (mysqli_num_rows($resultCheck) > 0) {
                            $query = "INSERT INTO ficha (ficha, id_programaformacion) 
                                      VALUES ('$ficha', '$id_programaformacion')";
        
                            if ($result = mysqli_query($conn, $query)) {
                                mysqli_commit($conn);
                                $jTableResult['rst'] = "1";
                                $jTableResult['ms'] = "Ficha agregada con éxito.";
                            } else {
                                mysqli_rollback($conn);
                                $jTableResult['ms'] = "Error al guardar la ficha: " . mysqli_error($conn);
                                $jTableResult['rst'] = "0";
                            }
                        } else {
                            $jTableResult['ms'] = "El ID de programa de formación proporcionado no existe.";
                            $jTableResult['rst'] = "0";
                        }
                    } else {
                        $jTableResult['ms'] = "Todos los campos son obligatorios.";
                        $jTableResult['rst'] = "0";
                    }
        
                    print json_encode($jTableResult);
                    break;




                    case 'EditarFicha':
                        $jTableResult = array();
                        $jTableResult['rst'] = "";
                        $jTableResult['ms'] = "";
                    
                        if (isset($_POST['id_ficha'], $_POST['nombre'], $_POST['descripcion'])) {
                            $id_ficha = $conn->real_escape_string($_POST['id_ficha']);
                            $nombre = $conn->real_escape_string($_POST['nombre']);
                            $descripcion = $conn->real_escape_string($_POST['descripcion']);
                    
                            // Consulta para actualizar la ficha
                            $query = "UPDATE ficha SET nombre = '$nombre', descripcion = '$descripcion' WHERE id_ficha = '$id_ficha'";
                    
                            if (mysqli_query($conn, $query)) {
                                mysqli_commit($conn);
                                $jTableResult['rst'] = "1";
                                $jTableResult['ms'] = "Ficha actualizada con éxito.";
                            } else {
                                mysqli_rollback($conn);
                                $jTableResult['rst'] = "0";
                                $jTableResult['ms'] = "Error al actualizar la ficha: " . mysqli_error($conn);
                            }
                        } else {
                            $jTableResult['rst'] = "0";
                            $jTableResult['ms'] = "Todos los campos son obligatorios.";
                        }
                    
                        echo json_encode($jTableResult);
                        break;





            case 'EliminarFicha':
                    $jTableResult = array();
                    $jTableResult['rst'] = "";
                    $jTableResult['ms'] = "";
                
                    if (isset($_POST['id_ficha'])) {
                        $id_ficha = $conn->real_escape_string($_POST['id_ficha']);
                
                        $query = "DELETE FROM ficha WHERE id_ficha = '$id_ficha'";
                
                        if (mysqli_query($conn, $query)) {
                            mysqli_commit($conn);
                            $jTableResult['rst'] = "1";
                            $jTableResult['ms'] = "Ficha eliminada con éxito.";
                        } else {
                            mysqli_rollback($conn);
                            $jTableResult['rst'] = "0";
                            $jTableResult['ms'] = "Error al eliminar la ficha.";
                        }
                    } else {
                        $jTableResult['rst'] = "0";
                        $jTableResult['ms'] = "ID de la ficha es obligatorio.";
                    }
                
                    echo json_encode($jTableResult);
                    break;










                    case 'AgregarJornada':
                        $jTableResult = array();
                        $jTableResult['rst'] = "";
                        $jTableResult['ms'] = "";
            
                        if (isset($_POST['nombre'])) {
                            $nombre = $conn->real_escape_string($_POST['nombre']);
            
                            $query = "INSERT INTO jornada (nombre) VALUES ('$nombre')";
            
                            if ($result = mysqli_query($conn, $query)) {
                                mysqli_commit($conn);
                                $jTableResult['rst'] = "1";
                                $jTableResult['ms'] = "Jornada agregada con éxito.";
                            } else {
                                mysqli_rollback($conn);
                                $jTableResult['ms'] = "Error al guardar la jornada: " . mysqli_error($conn);
                                $jTableResult['rst'] = "0";
                            }
                        } else {
                            $jTableResult['ms'] = "El nombre de la jornada es obligatorio.";
                            $jTableResult['rst'] = "0";
                        }
            
                        print json_encode($jTableResult);
                        break;
            




                                                                
                    case 'EditarJornada':
                        $jTableResult = array();
                        $jTableResult['rstl'] = "";
                        $jTableResult['msj'] = "";
                    
                        // Verificar si todas las claves necesarias están definidas en $_POST
                        $requiredKeys = ['id_jornada', 'nombre_jornada'];
                        $allKeysExist = true;
                    
                        foreach ($requiredKeys as $key) {
                            if (!array_key_exists($key, $_POST)) {
                                $allKeysExist = false;
                                break;
                            }
                        }
                    
                        if ($allKeysExist) {
                            // Asignar valores de $_POST a variables
                            $id_jornada = $_POST['id_jornada'];
                            $nombre_jornada = $_POST['nombre_jornada'];
                    
                            // Consulta SQL para actualizar la jornada
                            $query = "UPDATE jornada SET nombre_jornada = '$nombre_jornada' WHERE id_jornada = '$id_jornada'";
                    
                            // Ejecutar la consulta y verificar el resultado
                            if (mysqli_query($conn, $query)) {
                                mysqli_commit($conn);
                                $jTableResult['msj'] = "Jornada actualizada con éxito.";
                                $jTableResult['rstl'] = "1";
                            } else {
                                mysqli_rollback($conn);
                                $jTableResult['msj'] = "Error al actualizar la jornada: " . mysqli_error($conn);
                                $jTableResult['rstl'] = "0";
                            }
                        } else {
                            // Si faltan claves requeridas, manejar el error
                            $jTableResult['msj'] = "Error: Campos del formulario incompletos.";
                            $jTableResult['rstl'] = "0";
                        }
                    
                        // Devuelve el resultado como JSON
                        echo json_encode($jTableResult);
                        break;
            
                
                    
                    case 'EliminarJornada':
                        $jTableResult = array();
                        $jTableResult['rst'] = "";
                        $jTableResult['ms'] = "";
                    
                        if (isset($_POST['id_jornada'])) {
                            $id_jornada = $conn->real_escape_string($_POST['id_jornada']);
                    
                            $query = "DELETE FROM jornada WHERE id_jornada = '$id_jornada'";
                    
                            if (mysqli_query($conn, $query)) {
                                mysqli_commit($conn);
                                $jTableResult['rst'] = "1";
                                $jTableResult['ms'] = "Jornada de formación eliminada con éxito.";
                            } else {
                                mysqli_rollback($conn);
                                $jTableResult['rst'] = "0";
                                $jTableResult['ms'] = "Error al eliminar la jornada de formación.";
                            }
                        } else {
                            $jTableResult['rst'] = "0";
                            $jTableResult['ms'] = "ID de la jornada de formación es obligatorio.";
                        }
                    
                        echo json_encode($jTableResult);
                        break;
                                    




                        case 'AgregarNivelFormacion':
                            $jTableResult = array();
                            $jTableResult['rst'] = "";
                            $jTableResult['ms'] = "";
                
                            if (isset($_POST['nombre'])) {
                                $nombre = $conn->real_escape_string($_POST['nombre']);
                
                                $query = "INSERT INTO nivelformacion (nombre) VALUES ('$nombre')";
                
                                if ($result = mysqli_query($conn, $query)) {
                                    mysqli_commit($conn);
                                    $jTableResult['rst'] = "1";
                                    $jTableResult['ms'] = "Nivel de formación agregado con éxito.";
                                } else {
                                    mysqli_rollback($conn);
                                    $jTableResult['ms'] = "Error al guardar el nivel de formación: " . mysqli_error($conn);
                                    $jTableResult['rst'] = "0";
                                }
                            } else {
                                $jTableResult['ms'] = "El nombre del nivel de formación es obligatorio.";
                                $jTableResult['rst'] = "0";
                            }
                
                            print json_encode($jTableResult);
                            break;

                            case 'EditarNivelFormacion':
                                $jTableResult = array();
                                $jTableResult['rst'] = "";
                                $jTableResult['ms'] = "";
                            
                                if (isset($_POST['id_nivel_formacion']) && isset($_POST['nombre'])) {
                                    $id_nivel_formacion = $conn->real_escape_string($_POST['id_nivel_formacion']);
                                    $nombre = $conn->real_escape_string($_POST['nombre']);
                            
                                    // Query para actualizar el nivel de formación
                                    $query = "UPDATE nivelformacion SET nombre = '$nombre' WHERE id_nivel_formacion = '$id_nivel_formacion'";
                            
                                    if ($result = mysqli_query($conn, $query)) {
                                        mysqli_commit($conn);
                                        $jTableResult['rst'] = "1";
                                        $jTableResult['ms'] = "Nivel de formación actualizado con éxito.";
                                    } else {
                                        mysqli_rollback($conn);
                                        $jTableResult['rst'] = "0";
                                        $jTableResult['ms'] = "Error al actualizar el nivel de formación: " . mysqli_error($conn);
                                    }
                                } else {
                                    $jTableResult['rst'] = "0";
                                    $jTableResult['ms'] = "ID del nivel de formación y nombre son obligatorios.";
                                }
                            
                                echo json_encode($jTableResult);
                                break;
                            

                        case 'EliminarNivel':
                            $jTableResult = array();
                            $jTableResult['rst'] = "";
                            $jTableResult['ms'] = "";
                        
                            if (isset($_POST['id_nivel_formacion'])) {
                                $id_nivel_formacion = $conn->real_escape_string($_POST['id_nivel_formacion']);
                        
                                $query = "DELETE FROM nivelformacion WHERE id_nivel_formacion = '$id_nivel_formacion'";
                        
                                if (mysqli_query($conn, $query)) {
                                    mysqli_commit($conn);
                                    $jTableResult['rst'] = "1";
                                    $jTableResult['ms'] = "Nivel de formación eliminado con éxito.";
                                } else {
                                    mysqli_rollback($conn);
                                    $jTableResult['rst'] = "0";
                                    $jTableResult['ms'] = "Error al eliminar el nivel de formación.";
                                }
                            } else {
                                $jTableResult['rst'] = "0";
                                $jTableResult['ms'] = "ID del nivel de formación es obligatorio.";
                            }
                        
                            echo json_encode($jTableResult);
                            break;




                            case 'AgregarModalidad':
                                $jTableResult = array();
                                $jTableResult['rst'] = "";
                                $jTableResult['ms'] = "";
                    
                                if (isset($_POST['nombre'])) {
                                    $nombre = $conn->real_escape_string($_POST['nombre']);
                    
                                    $query = "INSERT INTO modalidad (nombre) VALUES ('$nombre')";
                    
                                    if ($result = mysqli_query($conn, $query)) {
                                        mysqli_commit($conn);
                                        $jTableResult['rst'] = "1";
                                        $jTableResult['ms'] = "Modalidad agregada con éxito.";
                                    } else {
                                        mysqli_rollback($conn);
                                        $jTableResult['ms'] = "Error al guardar la modalidad: " . mysqli_error($conn);
                                        $jTableResult['rst'] = "0";
                                    }
                                } else {
                                    $jTableResult['ms'] = "El nombre de la modalidad es obligatorio.";
                                    $jTableResult['rst'] = "0";
                                }
                    
                                print json_encode($jTableResult);
                                break;
    
    
                                case 'EditarModalidad':
                                    $jTableResult = array();
                                    $jTableResult['rst'] = "";
                                    $jTableResult['ms'] = "";
                                
                                    if (isset($_POST['id_modalidad']) && isset($_POST['nombre'])) {
                                        $id_modalidad = $conn->real_escape_string($_POST['id_modalidad']);
                                        $nombre = $conn->real_escape_string($_POST['nombre']);
                                
                                        $query = "UPDATE modalidad SET nombre = '$nombre' WHERE id_modalidad = '$id_modalidad'";
                                
                                        if (mysqli_query($conn, $query)) {
                                            mysqli_commit($conn);
                                            $jTableResult['rst'] = "1";
                                            $jTableResult['ms'] = "Modalidad actualizada con éxito.";
                                        } else {
                                            mysqli_rollback($conn);
                                            $jTableResult['ms'] = "Error al actualizar la modalidad: " . mysqli_error($conn);
                                            $jTableResult['rst'] = "0";
                                        }
                                    } else {
                                        $jTableResult['ms'] = "Se requiere el ID y el nombre de la modalidad.";
                                        $jTableResult['rst'] = "0";
                                    }
                                
                                    echo json_encode($jTableResult);
                                    break;
                                
    

                                    case 'DetalleModalidad':
                                        $jTableResult = array();
                                        $jTableResult['rst'] = "";
                                        $jTableResult['ms'] = "";
                                    
                                        if (isset($_POST['id_modalidad'])) {
                                            $id_modalidad = $conn->real_escape_string($_POST['id_modalidad']);
                                    
                                            // Consulta para obtener los detalles de la modalidad
                                            $query = "SELECT * FROM modalidad WHERE id_modalidad = '$id_modalidad'";
                                            $result = mysqli_query($conn, $query);
                                    
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $modalidad = mysqli_fetch_assoc($result);
                                                $jTableResult['rst'] = "1";
                                                $jTableResult['modalidad'] = $modalidad;
                                            } else {
                                                $jTableResult['rst'] = "0";
                                                $jTableResult['ms'] = "Modalidad no encontrada.";
                                            }
                                        } else {
                                            $jTableResult['rst'] = "0";
                                            $jTableResult['ms'] = "ID de la modalidad es obligatorio.";
                                        }
                                    
                                        echo json_encode($jTableResult);
                                        break;
                                    
                            case 'EliminarModalidad':
                                $jTableResult = array();
                                $jTableResult['rst'] = "";
                                $jTableResult['ms'] = "";
                            
                                if (isset($_POST['id_modalidad'])) {
                                    $id_modalidad = $conn->real_escape_string($_POST['id_modalidad']);
                            
                                    $query = "DELETE FROM modalidad WHERE id_modalidad = '$id_modalidad'";
                            
                                    if (mysqli_query($conn, $query)) {
                                        mysqli_commit($conn);
                                        $jTableResult['rst'] = "1";
                                        $jTableResult['ms'] = "Modalidad eliminada con éxito.";
                                    } else {
                                        mysqli_rollback($conn);
                                        $jTableResult['rst'] = "0";
                                        $jTableResult['ms'] = "Error al eliminar la modalidad.";
                                    }
                                } else {
                                    $jTableResult['rst'] = "0";
                                    $jTableResult['ms'] = "ID de la modalidad es obligatorio.";
                                }
                            
                                echo json_encode($jTableResult);
                                break;




                                case 'AgregarEstado':
                                    $jTableResult = array();
                                    $jTableResult['rst'] = "";
                                    $jTableResult['ms'] = "";
                        
                                    if (isset($_POST['nombre']) && isset($_POST['fecha_suspe'])) {
                                        $nombre = $conn->real_escape_string($_POST['nombre']);
                                        $fecha_suspe = $conn->real_escape_string($_POST['fecha_suspe']);
                        
                                        $query = "INSERT INTO estado (nombre, fecha_suspe) VALUES ('$nombre', '$fecha_suspe')";
                        
                                        if ($result = mysqli_query($conn, $query)) {
                                            mysqli_commit($conn);
                                            $jTableResult['rst'] = "1";
                                            $jTableResult['ms'] = "Estado agregado con éxito.";
                                        } else {
                                            mysqli_rollback($conn);
                                            $jTableResult['ms'] = "Error al guardar el estado: " . mysqli_error($conn);
                                            $jTableResult['rst'] = "0";
                                        }
                                    } else {
                                        $jTableResult['ms'] = "El nombre del estado y la fecha de suspensión son obligatorios.";
                                        $jTableResult['rst'] = "0";
                                    }
                        
                                    print json_encode($jTableResult);
                                    break;



                                    case 'ActualizarEstado':
                                        $jTableResult = array();
                                        $jTableResult['rst'] = "";
                                        $jTableResult['ms'] = "";
                                    
                                        if (isset($_SESSION['id_userprofile'])) {
                                            // Verificar si se recibieron los parámetros necesarios por POST
                                            if (isset($_POST['id_estado'], $_POST['nombre'], $_POST['fecha_suspe'])) {
                                                $id_estado = $conn->real_escape_string($_POST['id_estado']);
                                                $nombre = $conn->real_escape_string($_POST['nombre']);
                                                $fecha_suspe = $conn->real_escape_string($_POST['fecha_suspe']);
                                    
                                                // Consulta para actualizar el estado
                                                $query = "UPDATE estado SET nombre = '$nombre', fecha_suspe = '$fecha_suspe' WHERE id_estado = '$id_estado'";
                                    
                                                if ($result = mysqli_query($conn, $query)) {
                                                    mysqli_commit($conn);
                                                    $jTableResult['rst'] = "1";
                                                    $jTableResult['ms'] = "Estado actualizado con éxito.";
                                                } else {
                                                    mysqli_rollback($conn);
                                                    $jTableResult['rst'] = "0";
                                                    $jTableResult['ms'] = "Error al actualizar el estado: " . mysqli_error($conn);
                                                }
                                            } else {
                                                // Si no se recibieron todos los parámetros necesarios por POST
                                                $jTableResult['rst'] = "0";
                                                $jTableResult['ms'] = "Todos los campos son obligatorios.";
                                            }
                                        } else {
                                            // Si no hay una sesión activa, enviar una respuesta indicando que no está autorizado
                                            $jTableResult['rst'] = "0";
                                            $jTableResult['ms'] = "No autorizado";
                                        }
                                    
                                        // Cerrar la conexión a la base de datos
                                        mysqli_close($conn);
                                    
                                        echo json_encode($jTableResult);
                                        break;
                                    


                                        case 'EliminarEstado':
                                            $jTableResult = array();
                                            $jTableResult['rst'] = "";
                                            $jTableResult['ms'] = "";
                                        
                                            if (isset($_POST['id_estado'])) {
                                                $id_estado = $conn->real_escape_string($_POST['id_estado']);
                                        
                                                $query = "DELETE FROM estado WHERE id_estado = '$id_estado'";
                                        
                                                if (mysqli_query($conn, $query)) {
                                                    mysqli_commit($conn);
                                                    $jTableResult['rst'] = "1";
                                                    $jTableResult['ms'] = "Estado eliminado con éxito.";
                                                } else {
                                                    mysqli_rollback($conn);
                                                    $jTableResult['rst'] = "0";
                                                    $jTableResult['ms'] = "Error al eliminar el estado.";
                                                }
                                            } else {
                                                $jTableResult['rst'] = "0";
                                                $jTableResult['ms'] = "ID del estado es obligatorio.";
                                            }
                                        
                                            echo json_encode($jTableResult);
                                            break;                           













                                    case 'EliminarCategoria':
                                        $jTableResult = array();
                                        $jTableResult['rst'] = "";
                                        $jTableResult['ms'] = "";
                                    
                                        if (isset($_POST['id_categoria'])) {
                                            $id_categoria = $conn->real_escape_string($_POST['id_categoria']);
                                    
                                            $query = "DELETE FROM categoria WHERE id_categoria = '$id_categoria'";
                                    
                                            if (mysqli_query($conn, $query)) {
                                                mysqli_commit($conn);
                                                $jTableResult['rst'] = "1";
                                                $jTableResult['ms'] = "Categoría eliminada con éxito.";
                                            } else {
                                                mysqli_rollback($conn);
                                                $jTableResult['rst'] = "0";
                                                $jTableResult['ms'] = "Error al eliminar la categoría.";
                                            }
                                        } else {
                                            $jTableResult['rst'] = "0";
                                            $jTableResult['ms'] = "ID de la categoría es obligatorio.";
                                        }
                                    
                                        echo json_encode($jTableResult);
                                        break;
                                              
                                        



                                        case 'AgregarGenero':
                                            $jTableResult = array();
                                            $jTableResult['rst'] = "";
                                            $jTableResult['ms'] = "";
                                
                                            if (isset($_POST['nombre'])) {
                                                $nombre = $conn->real_escape_string($_POST['nombre']);
                                
                                                $query = "INSERT INTO genero (nombre) VALUES ('$nombre')";
                                
                                                if ($result = mysqli_query($conn, $query)) {
                                                    mysqli_commit($conn);
                                                    $jTableResult['rst'] = "1";
                                                    $jTableResult['ms'] = "Género agregado con éxito.";
                                                } else {
                                                    mysqli_rollback($conn);
                                                    $jTableResult['ms'] = "Error al guardar el género: " . mysqli_error($conn);
                                                    $jTableResult['rst'] = "0";
                                                }
                                            } else {
                                                $jTableResult['ms'] = "El nombre del género es obligatorio.";
                                                $jTableResult['rst'] = "0";
                                            }
                                
                                            print json_encode($jTableResult);
                                            break;
        
                                            case 'EditarGenero':
                                                $jTableResult = array();
                                                $jTableResult['rst'] = "";
                                                $jTableResult['ms'] = "";
                                            
                                                if (isset($_POST['id_genero']) && isset($_POST['nombre'])) {
                                                    $id_genero = $conn->real_escape_string($_POST['id_genero']);
                                                    $nombre = $conn->real_escape_string($_POST['nombre']);
                                            
                                                    $query = "UPDATE genero SET nombre = '$nombre' WHERE id_genero = '$id_genero'";
                                            
                                                    if (mysqli_query($conn, $query)) {
                                                        mysqli_commit($conn);
                                                        $jTableResult['rst'] = "1";
                                                        $jTableResult['ms'] = "Género actualizado con éxito.";
                                                    } else {
                                                        mysqli_rollback($conn);
                                                        $jTableResult['rst'] = "0";
                                                        $jTableResult['ms'] = "Error al actualizar el género: " . mysqli_error($conn);
                                                    }
                                                } else {
                                                    $jTableResult['rst'] = "0";
                                                    $jTableResult['ms'] = "ID del género y nombre son obligatorios.";
                                                }
                                            
                                                echo json_encode($jTableResult);
                                                break;
                                            
                                        case 'EliminarGenero':
                                            $jTableResult = array();
                                            $jTableResult['rst'] = "";
                                            $jTableResult['ms'] = "";
                                        
                                            if (isset($_POST['id_genero'])) {
                                                $id_genero = $conn->real_escape_string($_POST['id_genero']);
                                        
                                                $query = "DELETE FROM genero WHERE id_genero = '$id_genero'";
                                        
                                                if (mysqli_query($conn, $query)) {
                                                    mysqli_commit($conn);
                                                    $jTableResult['rst'] = "1";
                                                    $jTableResult['ms'] = "Género eliminado con éxito.";
                                                } else {
                                                    mysqli_rollback($conn);
                                                    $jTableResult['rst'] = "0";
                                                    $jTableResult['ms'] = "Error al eliminar el género.";
                                                }
                                            } else {
                                                $jTableResult['rst'] = "0";
                                                $jTableResult['ms'] = "ID del género es obligatorio.";
                                            }
                                        
                                            echo json_encode($jTableResult);
                                            break;




                                            case 'AgregarTipoDocumento':
                                                $jTableResult = array();
                                                $jTableResult['rst'] = "";
                                                $jTableResult['ms'] = "";
                                    
                                                if (isset($_POST['nombre'])) {
                                                    $nombre = $conn->real_escape_string($_POST['nombre']);
                                    
                                                    $query = "INSERT INTO tipodocumento (nombre) VALUES ('$nombre')";
                                    
                                                    if ($result = mysqli_query($conn, $query)) {
                                                        mysqli_commit($conn);
                                                        $jTableResult['rst'] = "1";
                                                        $jTableResult['ms'] = "Tipo de documento agregado con éxito.";
                                                    } else {
                                                        mysqli_rollback($conn);
                                                        $jTableResult['ms'] = "Error al guardar el tipo de documento: " . mysqli_error($conn);
                                                        $jTableResult['rst'] = "0";
                                                    }
                                                } else {
                                                    $jTableResult['ms'] = "El nombre del tipo de documento es obligatorio.";
                                                    $jTableResult['rst'] = "0";
                                                }
                                    
                                                print json_encode($jTableResult);
                                                break;
                
                                                case 'DetalleTipoDocumento':
                                                    $jTableResult = array();
                                                    $jTableResult['rst'] = "";
                                                    $jTableResult['ms'] = "";
                                                
                                                    if (isset($_POST['id_doc'])) {
                                                        $id_doc = $conn->real_escape_string($_POST['id_doc']);
                                                
                                                        // Consulta para obtener los detalles del tipo de documento
                                                        $query = "SELECT * FROM tipodocumento WHERE id_doc = '$id_doc'";
                                                        $result = mysqli_query($conn, $query);
                                                
                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $jTableResult['rst'] = "1";
                                                            $jTableResult['nombre'] = $row['nombre']; // Aquí puedes incluir más campos si los necesitas
                                                        } else {
                                                            $jTableResult['ms'] = "No se encontró el tipo de documento.";
                                                            $jTableResult['rst'] = "0";
                                                        }
                                                    } else {
                                                        $jTableResult['ms'] = "ID del tipo de documento es obligatorio.";
                                                        $jTableResult['rst'] = "0";
                                                    }
                                                
                                                    echo json_encode($jTableResult);
                                                    break;
                                                
                                                    case 'ActualizarTipoDocumento':
                                                        $jTableResult = array();
                                                        $jTableResult['rst'] = "";
                                                        $jTableResult['ms'] = "";
                                                    
                                                        if (isset($_POST['id_doc']) && isset($_POST['nombre'])) {
                                                            $id_doc = $conn->real_escape_string($_POST['id_doc']);
                                                            $nombre = $conn->real_escape_string($_POST['nombre']);
                                                    
                                                            // Query para actualizar el tipo de documento
                                                            $query = "UPDATE tipodocumento SET nombre = '$nombre' WHERE id_doc = '$id_doc'";
                                                    
                                                            if (mysqli_query($conn, $query)) {
                                                                mysqli_commit($conn);
                                                                $jTableResult['rst'] = "1";
                                                                $jTableResult['ms'] = "Tipo de documento actualizado con éxito.";
                                                            } else {
                                                                mysqli_rollback($conn);
                                                                $jTableResult['rst'] = "0";
                                                                $jTableResult['ms'] = "Error al actualizar el tipo de documento: " . mysqli_error($conn);
                                                            }
                                                        } else {
                                                            $jTableResult['ms'] = "ID del tipo de documento y nombre son obligatorios.";
                                                            $jTableResult['rst'] = "0";
                                                        }
                                                    
                                                        echo json_encode($jTableResult);
                                                        break;
                                                    
                                            case 'EliminarTipoDocumento':
                                                $jTableResult = array();
                                                $jTableResult['rst'] = "";
                                                $jTableResult['ms'] = "";
                                            
                                                if (isset($_POST['id_doc'])) {
                                                    $id_doc = $conn->real_escape_string($_POST['id_doc']);
                                            
                                                    $query = "DELETE FROM tipodocumento WHERE id_doc = '$id_doc'";
                                            
                                                    if (mysqli_query($conn, $query)) {
                                                        mysqli_commit($conn);
                                                        $jTableResult['rst'] = "1";
                                                        $jTableResult['ms'] = "Tipo de documento eliminado con éxito.";
                                                    } else {
                                                        mysqli_rollback($conn);
                                                        $jTableResult['rst'] = "0";
                                                        $jTableResult['ms'] = "Error al eliminar el tipo de documento.";
                                                    }
                                                } else {
                                                    $jTableResult['rst'] = "0";
                                                    $jTableResult['ms'] = "ID del tipo de documento es obligatorio.";
                                                }
                                            
                                                echo json_encode($jTableResult);
                                                break;







                                                case 'EliminarRol':
                                                    $jTableResult = array();
                                                    $jTableResult['rst'] = "";
                                                    $jTableResult['ms'] = "";
                                                
                                                    if (isset($_POST['id_rol'])) {
                                                        $id_rol = $conn->real_escape_string($_POST['id_rol']);
                                                
                                                        $query = "DELETE FROM rol WHERE id_rol = '$id_rol'";
                                                
                                                        if (mysqli_query($conn, $query)) {
                                                            mysqli_commit($conn);
                                                            $jTableResult['rst'] = "1";
                                                            $jTableResult['ms'] = "Rol eliminado con éxito.";
                                                        } else {
                                                            mysqli_rollback($conn);
                                                            $jTableResult['rst'] = "0";
                                                            $jTableResult['ms'] = "Error al eliminar el rol.";
                                                        }
                                                    } else {
                                                        $jTableResult['rst'] = "0";
                                                        $jTableResult['ms'] = "ID del rol es obligatorio.";
                                                    }
                                                
                                                    echo json_encode($jTableResult);
                                                    break;
                                                                                                                                    



                                                    case 'EliminarPoblacion':
                                                        $jTableResult = array();
                                                        $jTableResult['rst'] = "";
                                                        $jTableResult['ms'] = "";
                                                    
                                                        if (isset($_POST['cod_poblado'])) {
                                                            $cod_poblado = $conn->real_escape_string($_POST['cod_poblado']);
                                                    
                                                            $query = "DELETE FROM poblados WHERE cod_poblado = '$cod_poblado'";
                                                    
                                                            if (mysqli_query($conn, $query)) {
                                                                mysqli_commit($conn);
                                                                $jTableResult['rst'] = "1";
                                                                $jTableResult['ms'] = "Población eliminada con éxito.";
                                                            } else {
                                                                mysqli_rollback($conn);
                                                                $jTableResult['rst'] = "0";
                                                                $jTableResult['ms'] = "Error al eliminar la población.";
                                                            }
                                                        } else {
                                                            $jTableResult['rst'] = "0";
                                                            $jTableResult['ms'] = "ID de la población es obligatorio.";
                                                        }
                                                    
                                                        echo json_encode($jTableResult);
                                                        break;
                                                    










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

                                                            


                                                        
                                                           



                                                                        case 'registroUsuario': 
                                                                            $jTableResult = array();
                                                                            $jTableResult['rstl']="";
                                                                            $jTableResult['msj']="";
                                                                                $query="INSERT INTO userprofile SET
                                                                                        fecha_nacimiento='".$_POST['fechaNacimientoUsu']."', 
                                                                                        id_doc='".$_POST['id_tpdoc']."', 
                                                                                        numeroiden ='".$_POST['numeroiden_registro']."', 
                                                                                        clave ='".$_POST['clave']."', 
                                                                                        nombre ='".$_POST['nombre']."', 
                                                                                        nombre_dos ='".$_POST['nombre_dos']."', 
                                                                                        direccion ='".$_POST['direccion']."',
                                                                                        fecha_registro = NOW(),
                                                                                        id_estado = 1,
                                                                                        id_rol = 5,
                                                                                        id_genero = '".$_POST['id_genero']."',
                                                                                        celular = '".$_POST['celular']."',
                                                                                        correo_sena ='".$_POST['correo_sena']."',
                                                                                        correo ='".$_POST['correo_registro']."',
                                                                                        apellido ='".$_POST['apellido']."', 
                                                                                        apellido_dos ='".$_POST['apellido_dos']."',
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
                                                                    



                                                                        case 'listarUsuarios':
                                                                            $jTableResult = array();
                                                                            $jTableResult['records'] = array();
                                                                        
                                                                            // Consulta SQL para obtener todos los usuarios
                                                                            $query = "SELECT * FROM userprofile";
                                                                        
                                                                            // Ejecutar la consulta
                                                                            $result = mysqli_query($conn, $query);
                                                                        
                                                                            if ($result) {
                                                                                // Recorrer los resultados y almacenar en un array para devolver como JSON
                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                    $usuario = array(
                                                                                        'id_userprofile' => $row['id_userprofile'],
                                                                                        'fecha_nacimiento' => $row['fecha_nacimiento'],
                                                                                        'id_doc' => $row['id_doc'],
                                                                                        'numeroiden' => $row['numeroiden'],
                                                                                        'nombre' => $row['nombre'],
                                                                                        'nombre_dos' => $row['nombre_dos'],
                                                                                        'direccion' => $row['direccion'],
                                                                                        'fecha_registro' => $row['fecha_registro'],
                                                                                        'id_estado' => $row['id_estado'],
                                                                                        'id_rol' => $row['id_rol'],
                                                                                        'id_genero' => $row['id_genero'],
                                                                                        'celular' => $row['celular'],
                                                                                        'correo_sena' => $row['correo_sena'],
                                                                                        'correo' => $row['correo'],
                                                                                        'apellido' => $row['apellido'],
                                                                                        'apellido_dos' => $row['apellido_dos'],
                                                                                        'cod_dpto' => $row['cod_dpto'],
                                                                                        'cod_municipio' => $row['cod_municipio'],
                                                                                        'cod_poblado' => $row['cod_poblado']
                                                                                    );
                                                                                    // Agregar el usuario al array de registros
                                                                                    $jTableResult['records'][] = $usuario;
                                                                                }
                                                                        
                                                                                // Establecer el resultado como exitoso
                                                                                $jTableResult['result'] = 'OK';
                                                                            } else {
                                                                                // Si hay un error en la consulta, manejarlo aquí
                                                                                $jTableResult['result'] = 'ERROR';
                                                                                $jTableResult['message'] = 'Error al listar usuarios: ' . mysqli_error($conn);
                                                                            }
                                                                        
                                                                            // Devolver el resultado como JSON
                                                                            echo json_encode($jTableResult);
                                                                            break;
                                                                        









                                                                        case 'actualizarusuario':
			
                                                                            $jTableResult = array(); 
                                                                            $jTableResult['rstl'] = "";
                                                                            $jTableResult['msj'] = "";
                                                                        
                                                                            // Verificar si todas las claves necesarias están definidas en $_POST
                                                                            $requiredKeys = ['nombre', 'nombre_dos', 'clave', 'estadoUsu', 'apellido', 'apellido_dos', 'numeroiden', 'correo', 'celular', 'cod_dpto', 'cod_municipio','id_rol', 'cod_poblado', 'id_doc', 'direccion', 'fecha_nacimiento', 'correo_sena'];
                                                                            $allKeysExist = true;
                                                                        
                                                                            foreach ($requiredKeys as $key) {
                                                                                if (!array_key_exists($key, $_POST)) {
                                                                                    
                                                                                //	echo "el que viene vacio =========================" . $key;  para verificar que dato viene vacio
                                                                                    
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


                                                                                $id_rol = $_POST['id_rol'];

                                                                                $estadoUsu = $_POST['estadoUsu'];
                                                                                $apellido_dos = $_POST['apellido_dos'];
                                                                                $numeroiden = $_POST['numeroiden'];
                                                                                $correo = $_POST['correo'];
                                                                                $celular = $_POST['celular'];
                                                                                $cod_dpto = $_POST['cod_dpto'];
                                                                
                                                                                $cod_municipio = $_POST['cod_municipio'];
                                                                                $cod_poblado = $_POST['cod_poblado'];
                                                                                $direccion = $_POST['direccion'];
                                                                                $fecha_nacimiento = $_POST['fecha_nacimiento'];
                                                                                $correo_sena = $_POST['correo_sena'];
                                                                        
                                                                                // Consulta SQL para actualizar el perfil del usuario
                                                                                $query = "UPDATE userprofile SET 
                                                                                    nombre = '" . $nombre . "',
                                                                                    nombre_dos = '" . $nombre_dos . "',
                                                                                    apellido = '" . $apellido . "',
                                                                                    id_doc = '" . $id_doc . "',
                                                                                    numeroiden = '" . $numeroiden . "',
                                                                                    correo = '" . $correo . "',
                                                                                    clave = '" . $clave . "',

                                                                                    id_rol = '" . $id_rol . "',

                                                                                    id_estado = '" . $estadoUsu . "',
                                                                                    apellido_dos = '" . $apellido_dos . "',
                                                                                    celular = '" . $celular . "',
                                                                                    cod_dpto = '" . $cod_dpto . "',
                                                                                    cod_municipio = '" . $cod_municipio . "',
                                                                                    cod_poblado = '" . $cod_poblado . "',
                                                                                    direccion = '" . $direccion . "',
                                                                                    fecha_nacimiento = '" . $fecha_nacimiento . "',
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
                                                                                $jTableResult['msj'] = "Error: Campos del formulario incompletos jesus andres.";
                                                                                $jTableResult['rstl'] = "0";
                                                                            }
                                                                        
                                                                            // Devuelve el resultado como JSON
                                                                            echo json_encode($jTableResult);
                                                                        break;



                                                                        
                                                                                case 'crgrRoles':
                                                                                    $jTableResult = array();
                                                                                    $jTableResult['listRoles'] = "";
                                                                                    $jTableResult['listRoles']="<option value='0' selected >seleccione:.</option>";
                                                                                    $query = "SELECT id_rol, nombre FROM rol";
                                                                                    $resultado = mysqli_query($conn, $query);
                                                                                    while ($registro = mysqli_fetch_array($resultado)) {
                                                                                        $jTableResult['listRoles'] .= "<option value='" . $registro['id_rol'] . "'>" . $registro['nombre'] . "</option>";
                                                                                    }
                                                                                    // Devolver el resultado como JSON
                                                                                    echo json_encode($jTableResult);
                                                                                    break;
                                                                

                                                                                                case 'AgregarRol':
                                                                                                    $jTableResult = array();
                                                                                                    $jTableResult['rst'] = "";
                                                                                                    $jTableResult['ms'] = "";
                                                                                        
                                                                                                    if (isset($_POST['nombre'])) {
                                                                                                        $nombre = $conn->real_escape_string($_POST['nombre']);
                                                                                        
                                                                                                        $query = "INSERT INTO rol (nombre) VALUES ('$nombre')";
                                                                                        
                                                                                                        if ($result = mysqli_query($conn, $query)) {
                                                                                                            mysqli_commit($conn);
                                                                                                            $jTableResult['rst'] = "1";
                                                                                                            $jTableResult['ms'] = "Rol agregado con éxito.";
                                                                                                        } else {
                                                                                                            mysqli_rollback($conn);
                                                                                                            $jTableResult['ms'] = "Error al guardar el rol: " . mysqli_error($conn);
                                                                                                            $jTableResult['rst'] = "0";
                                                                                                        }
                                                                                                    } else {
                                                                                                        $jTableResult['ms'] = "El nombre del rol es obligatorio.";
                                                                                                        $jTableResult['rst'] = "0";
                                                                                                    }
                                                                                        
                                                                                                    print json_encode($jTableResult);
                                                                                                    break;
                                                                
                                                                
                                                                
                                                                
                                                                                                    case 'EditarRol':
                                                                                                        $jTableResult = array();
                                                                                                        $jTableResult['rst'] = "";
                                                                                                        $jTableResult['ms'] = "";
                                                                                                    
                                                                                                        // Verificar si se recibieron los datos necesarios para editar el rol
                                                                                                        if (isset($_POST['id_rol']) && isset($_POST['nombre'])) {
                                                                                                            $id_rol = $conn->real_escape_string($_POST['id_rol']);
                                                                                                            $nombre = $conn->real_escape_string($_POST['nombre']);
                                                                                                    
                                                                                                            // Consulta SQL para actualizar el rol
                                                                                                            $query = "UPDATE rol SET nombre = '$nombre' WHERE id_rol = '$id_rol'";
                                                                                                    
                                                                                                            if ($result = mysqli_query($conn, $query)) {
                                                                                                                mysqli_commit($conn);
                                                                                                                $jTableResult['rst'] = "1";
                                                                                                                $jTableResult['ms'] = "Rol actualizado con éxito.";
                                                                                                            } else {
                                                                                                                mysqli_rollback($conn);
                                                                                                                $jTableResult['ms'] = "Error al actualizar el rol: " . mysqli_error($conn);
                                                                                                                $jTableResult['rst'] = "0";
                                                                                                            }
                                                                                                        } else {
                                                                                                            $jTableResult['ms'] = "Datos insuficientes para actualizar el rol.";
                                                                                                            $jTableResult['rst'] = "0";
                                                                                                        }
                                                                                                    
                                                                                                        print json_encode($jTableResult);
                                                                                                        break;
                                                                
                                                                
                                                                                                  
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                                                   
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                                                            case 'AgregarCategoria':
                                                                                                                $jTableResult = array();
                                                                                                                $jTableResult['rst'] = "";
                                                                                                                $jTableResult['ms'] = "";
                                                                                                    
                                                                                                                if (isset($_POST['nombre'])) {
                                                                                                                    $nombre = $conn->real_escape_string($_POST['nombre']);
                                                                                                    
                                                                                                                    $query = "INSERT INTO categoria (nombre) VALUES ('$nombre')";
                                                                                                    
                                                                                                                    if ($result = mysqli_query($conn, $query)) {
                                                                                                                        mysqli_commit($conn);
                                                                                                                        $jTableResult['rst'] = "1";
                                                                                                                        $jTableResult['ms'] = "Categoría agregada con éxito.";
                                                                                                                    } else {
                                                                                                                        mysqli_rollback($conn);
                                                                                                                        $jTableResult['ms'] = "Error al guardar la categoría: " . mysqli_error($conn);
                                                                                                                        $jTableResult['rst'] = "0";
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    $jTableResult['ms'] = "El nombre de la categoría es obligatorio.";
                                                                                                                    $jTableResult['rst'] = "0";
                                                                                                                }
                                                                                                    
                                                                                                                print json_encode($jTableResult);
                                                                                                                break;
                                                                
                                                                
                                                                
                                                                                                                case 'AgregarCalificacion':
                                                                                                                    $jTableResult = array();
                                                                                                                    $jTableResult['rst'] = "";
                                                                                                                    $jTableResult['ms'] = "";
                                                                                                        
                                                                                                                    if (isset($_POST['nombre']) && isset($_POST['user_id'])) {
                                                                                                                        $nombre = $conn->real_escape_string($_POST['nombre']);
                                                                                                                        $user_id = $conn->real_escape_string($_POST['user_id']);
                                                                                                        
                                                                                                                        // Verificar si el user_id existe en la tabla userprofile
                                                                                                                        $query = "SELECT * FROM userprofile WHERE id_userprofile = '$user_id'";
                                                                                                                        $resultCheck = mysqli_query($conn, $query);
                                                                                                        
                                                                                                                        if (mysqli_num_rows($resultCheck) > 0) {
                                                                                                                            $queryInsert = "INSERT INTO calificacion (nombre, user_id) 
                                                                                                                                            VALUES ('$nombre', '$user_id')";
                                                                                                        
                                                                                                                            if ($resultInsert = mysqli_query($conn, $queryInsert)) {
                                                                                                                                $jTableResult['rst'] = "1";
                                                                                                                                $jTableResult['ms'] = "Calificación agregada con éxito.";
                                                                                                                            } else {
                                                                                                                                $jTableResult['ms'] = "Error al guardar la calificación: " . mysqli_error($conn);
                                                                                                                                $jTableResult['rst'] = "0";
                                                                                                                            }
                                                                                                                        } else {
                                                                                                                            $jTableResult['ms'] = "El ID de usuario proporcionado no existe en la tabla 'userprofile'.";
                                                                                                                            $jTableResult['rst'] = "0";
                                                                                                                        }
                                                                                                                    } else {
                                                                                                                        $jTableResult['ms'] = "Todos los campos son obligatorios.";
                                                                                                                        $jTableResult['rst'] = "0";
                                                                                                                    }
                                                                                                        
                                                                                                                    print json_encode($jTableResult);
                                                                                                                    break;
                                                                
                                                                                   
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
        case 'AgregarProgramaFormacion':
            $jTableResult = array();
            $jTableResult['rst'] = "";
            $jTableResult['ms'] = "";
        
            // Verificar que se hayan recibido los datos del formulario
            if (isset($_POST['nombre'], $_POST['id_competencia'], $_POST['id_jornada'], $_POST['id_mcer'], $_POST['id_modalidad'], $_POST['id_nivel_formacion'])) {
                $nombre = $conn->real_escape_string($_POST['nombre']);
                $id_competencia = $conn->real_escape_string($_POST['id_competencia']);
                $id_jornada = $conn->real_escape_string($_POST['id_jornada']);
                $id_mcer = $conn->real_escape_string($_POST['id_mcer']);
                $id_modalidad = $conn->real_escape_string($_POST['id_modalidad']);
                $id_nivel_formacion = $conn->real_escape_string($_POST['id_nivel_formacion']);
        
                // Consulta SQL para insertar el programa de formación
                $query = "INSERT INTO programaformacion (nombre, id_competencia, id_jornada, id_mcer, id_modalidad, id_nivel_formacion) 
                          VALUES ('$nombre', '$id_competencia', '$id_jornada', '$id_mcer', '$id_modalidad', '$id_nivel_formacion')";
        
                if (mysqli_query($conn, $query)) {
                    mysqli_commit($conn);
                    $jTableResult['rst'] = "1";
                    $jTableResult['ms'] = "Programa de formación agregado con éxito.";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "Error al agregar el programa de formación: " . mysqli_error($conn);
                }
            } else {
                $jTableResult['rst'] = "0";
                $jTableResult['ms'] = "Todos los campos son obligatorios.";
            }
        
            echo json_encode($jTableResult);
            break;
        



        case 'EditarProgramaFormacion':
            $jTableResult = array();
            $jTableResult['rst'] = "";
            $jTableResult['ms'] = "";
        
            if (isset($_POST['id_programaformacion'], $_POST['nombre'], $_POST['id_competencia'], $_POST['id_jornada'], $_POST['id_mcer'], $_POST['id_modalidad'], $_POST['id_nivel_formacion'])) {
                $id_programaformacion = $conn->real_escape_string($_POST['id_programaformacion']);
                $nombre = $conn->real_escape_string($_POST['nombre']);
                $id_competencia = $conn->real_escape_string($_POST['id_competencia']);
                $id_jornada = $conn->real_escape_string($_POST['id_jornada']);
                $id_mcer = $conn->real_escape_string($_POST['id_mcer']);
                $id_modalidad = $conn->real_escape_string($_POST['id_modalidad']);
                $id_nivel_formacion = $conn->real_escape_string($_POST['id_nivel_formacion']);
        
                // Consulta para actualizar el programa de formación
                $query = "UPDATE programaformacion SET nombre = '$nombre', id_competencia = '$id_competencia', 
                          id_jornada = '$id_jornada', id_mcer = '$id_mcer', id_modalidad = '$id_modalidad', 
                          id_nivel_formacion = '$id_nivel_formacion' WHERE id_programaformacion = '$id_programaformacion'";
        
                if (mysqli_query($conn, $query)) {
                    mysqli_commit($conn);
                    $jTableResult['rst'] = "1";
                    $jTableResult['ms'] = "Programa de formación actualizado con éxito.";
                } else {
                    mysqli_rollback($conn);
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "Error al actualizar el programa de formación: " . mysqli_error($conn);
                }
            } else {
                $jTableResult['rst'] = "0";
                $jTableResult['ms'] = "Todos los campos son obligatorios.";
            }
        
            echo json_encode($jTableResult);
            break;
        






case 'EliminarProgramaFormacion':
    $jTableResult = array();
    $jTableResult['rst'] = "";
    $jTableResult['ms'] = "";

    if (isset($_POST['id_programaformacion'])) {
        $id_programaformacion = $conn->real_escape_string($_POST['id_programaformacion']);

        $query = "DELETE FROM programaformacion WHERE id_programaformacion = '$id_programaformacion'";

        if (mysqli_query($conn, $query)) {
            mysqli_commit($conn);
            $jTableResult['rst'] = "1";
            $jTableResult['ms'] = "Programa de formación eliminado con éxito.";
        } else {
            mysqli_rollback($conn);
            $jTableResult['rst'] = "0";
            $jTableResult['ms'] = "Error al eliminar el programa de formación.";
        }
    } else {
        $jTableResult['rst'] = "0";
        $jTableResult['ms'] = "ID del programa de formación es obligatorio.";
    }

    echo json_encode($jTableResult);
    break;





                case 'PublicarNoticiajesus':
            $jTableResult = array();
            $jTableResult['rst'] = "";
            $jTableResult['ms'] = "";

            $titulo = $_POST["titulo"] ?? null;
            $descripcion = $_POST["descripcion"] ?? null;
            $fecha_inicio = $_POST["fecha_inicio"] ?? null;
            $fecha_fin = $_POST["fecha_fin"] ?? null;
            $imagen = $_FILES["imagen"] ?? null;

            // Depuración: Verificar que se recibieron todos los datos
            error_log("Título: $titulo, Descripción: $descripcion, Fecha de inicio: $fecha_inicio, Fecha de fin: $fecha_fin, Imagen: " . print_r($imagen, true));

            if ($titulo && $descripcion && $fecha_inicio && $fecha_fin && $imagen) {
                $uploadDir = 'ruta/para/guardar/imagenes/';
                
                // Crear el directorio si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imagenRuta = $uploadDir . basename($imagen['name']);
                
                if (move_uploaded_file($imagen['tmp_name'], $imagenRuta)) {
                    $query = "INSERT INTO detallesolicitud (id_tiposolicitud, titulo, imagen, fecha_inicio, fecha_fin, descripcion)
                              VALUES (4, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);

                    if ($stmt) {
                        $stmt->bind_param("sssss", $titulo, $imagenRuta, $fecha_inicio, $fecha_fin, $descripcion);

                        if ($stmt->execute()) {
                            $conn->commit();
                            $jTableResult['rst'] = "1";
                            $jTableResult['ms'] = "Registro guardado con éxito.";
                        } else {
                            $conn->rollback();
                            $jTableResult['ms'] = "Error al guardar: " . $stmt->error;
                            $jTableResult['rst'] = "0";
                        }

                        $stmt->close();
                    } else {
                        $jTableResult['ms'] = "Error al preparar la consulta: " . $conn->error;
                        $jTableResult['rst'] = "0";
                    }
                } else {
                    $jTableResult['ms'] = "Error al subir la imagen.";
                    $jTableResult['rst'] = "0";
                }
            } else {
                $jTableResult['ms'] = "Faltan datos requeridos.";
                $jTableResult['rst'] = "0";
            }

            print json_encode($jTableResult);
            break;
    





            case 'EnviarFormulario':
                $jTableResult = array();
                $jTableResult['rst'] = "";
                $jTableResult['ms'] = "";                                                                                
                $mensaje = $_POST["mensaje"] ;
               // $archivo = $_FILES["archivo"] ;
                $rol = $_POST["rol"] ;
                // Depuración: Verificar que se recibieron todos los datos
                echo(" recordar cambiar el id del  mensaje: $mensaje"  );
    
                if ( $mensaje ) { 
                    $query = "INSERT INTO enviarmensaje (id_rol, mensaje, archivo, id_mensaje) VALUES ($rol,'$mensaje', null, 16)";
                   // $query = "INSERT INTO enviarmensaje (id_rol, mensaje, archivo, id_mensaje) VALUES (?,?,?,?)";
                    $stmt = $conn->prepare($query);

                    if ($stmt) {                                                                                      
                       // $stmt->bind_param("issii",1,$mensaje,null,7);
                        if ($stmt->execute()) {
                            $conn->commit();
                            $jTableResult['rst'] = "1";
                            $jTableResult['ms'] = "Registro guardado con éxito.";
                        } else {
                            $conn->rollback();
                            $jTableResult['ms'] = "Error al guardar: " . $stmt->error;
                            $jTableResult['rst'] = "0";
                        }                                                                  
                    $stmt->close();
                    } else {
                        $jTableResult['ms'] = "Error al preparar la consulta: " . $conn->error;
                        $jTableResult['rst'] = "0";
                    }
                    
                    //$uploadDir = 'ruta/para/guardar/imagenes/';
                    
                    // Crear el directorio si no existe
                    /*if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
    
                    $imagenRuta = $uploadDir . basename($imagen['name']); 
                    
                    if (move_uploaded_file($imagen['tmp_name'], $imagenRuta)) {
                        $query = "INSERT INTO enviarmensaje (mensaje, archivo, id_mensaje)
                                  VALUES ( ?, ?,6)";
                        $stmt = $conn->prepare($query);
    
                        if ($stmt) {
                            $stmt->bind_param("sssss", $mensaje, $archivo);
    
                            if ($stmt->execute()) {
                                $conn->commit();
                                $jTableResult['rst'] = "1";
                                $jTableResult['ms'] = "Registro guardado con éxito.";
                            } else {
                                $conn->rollback();
                                $jTableResult['ms'] = "Error al guardar: " . $stmt->error;
                                $jTableResult['rst'] = "0";
                            }
    
                            $stmt->close();
                        } else {
                            $jTableResult['ms'] = "Error al preparar la consulta: " . $conn->error;
                            $jTableResult['rst'] = "0";
                        }
                    } else {
                        $jTableResult['ms'] = "Error al subir la imagen.";
                        $jTableResult['rst'] = "0";
                    }*/ 




                } else {
                    $jTableResult['ms'] = "Faltan datos requeridos.";
                    $jTableResult['rst'] = "0";
                }
    
                print json_encode($jTableResult);
                break;










        
            case 'ListarMensajes':
                $jTableResult = array();
                
                $query = "SELECT id_mensaje, id_rol, mensaje, archivo FROM enviarmensaje";
                
                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    $jTableResult['rows'] = array();
                    while ($row = $result->fetch_assoc()) {
                        $jTableResult['rows'][] = $row;
                    }
                    $jTableResult['rst'] = "1";
                } else {
                    $jTableResult['rst'] = "0";
                    $jTableResult['ms'] = "No se encontraron registros.";
                }
                
                print json_encode($jTableResult);
                break;



                case 'ListarMensajesinstructor':
                    $jTableResult = array();
                    
                    // Consulta SQL modificada para filtrar por id_rol = 2
                    $query = "SELECT id_mensaje, id_rol, mensaje, archivo FROM enviarmensaje WHERE id_rol = 2";
                    
                    $result = $conn->query($query);
                    
                    if ($result->num_rows > 0) {
                        $jTableResult['rows'] = array();
                        while ($row = $result->fetch_assoc()) {
                            $jTableResult['rows'][] = $row;
                        }
                        $jTableResult['rst'] = "1";
                    } else {
                        $jTableResult['rst'] = "0";
                        $jTableResult['ms'] = "No se encontraron registros para el rol especificado.";
                    }
                    
                    // Devolver el resultado como JSON
                    print json_encode($jTableResult);
                    break;
                

                    case 'ListarMensajesaprendiz':
                        $jTableResult = array();
                        
                        // Consulta SQL modificada para filtrar por id_rol = 1
                        $query = "SELECT id_mensaje, id_rol, mensaje, archivo FROM enviarmensaje WHERE id_rol = 1";
                        
                        $result = $conn->query($query);
                        
                        if ($result->num_rows > 0) {
                            $jTableResult['rows'] = array();
                            while ($row = $result->fetch_assoc()) {
                                $jTableResult['rows'][] = $row;
                            }
                            $jTableResult['rst'] = "1";
                        } else {
                            $jTableResult['rst'] = "0";
                            $jTableResult['ms'] = "No se encontraron registros para el rol especificado.";
                        }
                        
                        // Devolver el resultado como JSON
                        print json_encode($jTableResult);
                        break;
                    

                        case 'ListarMensajesempresa':
                            $jTableResult = array();
                            
                            // Consulta SQL modificada para filtrar por id_rol = 4
                            $query = "SELECT id_mensaje, id_rol, mensaje, archivo FROM enviarmensaje WHERE id_rol = 4";
                            
                            $result = $conn->query($query);
                            
                            if ($result->num_rows > 0) {
                                $jTableResult['rows'] = array();
                                while ($row = $result->fetch_assoc()) {
                                    $jTableResult['rows'][] = $row;
                                }
                                $jTableResult['rst'] = "1";
                            } else {
                                $jTableResult['rst'] = "0";
                                $jTableResult['ms'] = "No se encontraron registros para el rol especificado.";
                            }
                            
                            // Devolver el resultado como JSON
                            print json_encode($jTableResult);
                            break;

                            case 'ListarMensajesusuariosinconfirmar':
                                $jTableResult = array();
                                
                                // Consulta SQL modificada para filtrar por id_rol = 5
                                $query = "SELECT id_mensaje, id_rol, mensaje, archivo FROM enviarmensaje WHERE id_rol = 5";
                                
                                $result = $conn->query($query);
                                
                                if ($result->num_rows > 0) {
                                    $jTableResult['rows'] = array();
                                    while ($row = $result->fetch_assoc()) {
                                        $jTableResult['rows'][] = $row;
                                    }
                                    $jTableResult['rst'] = "1";
                                } else {
                                    $jTableResult['rst'] = "0";
                                    $jTableResult['ms'] = "No se encontraron registros para el rol especificado.";
                                }
                                
                                // Devolver el resultado como JSON
                                print json_encode($jTableResult);
                                break;
                            
            case 'noticiaCreado':
                $jTableResult = array('rstl' => '', 'msj' => '', 'noticia' => '');
                $query = "SELECT imagen, titulo, fecha_inicio AS fecha_mostrada, descripcion 
                          FROM solicitud 
                          JOIN detallesolicitud ON solicitud.id_detallesolicitud = detallesolicitud.id_detallesolicitud
                          WHERE detallesolicitud.id_tiposolicitud = 4 AND solicitud.id_estado = 4";
        
                $result = $conn->query($query);
        
                if ($result->num_rows > 0) {
                    while ($registro = $result->fetch_assoc()) {
                        $jTableResult['msj'] = "Noticia Creada con Exito.";
                        $jTableResult['rstl'] = "1";
                        $jTableResult['noticia'] .= '
                        <div class="row blog-item px-3 pb-5">
                            <div class="col-md-5" id="foto">
                                <img src="' . $registro["imagen"] . '" class="img-fluid mb-4 mb-md-0" alt="Image">
                            </div>
                            <div class="col-md-7">
                                <h3 class="mt-md-4 px-md-3 mb-2 py-2 bg-white font-weight-bold">' . $registro["titulo"] . '</h3>
                                <div class="d-flex mb-3">
                                    <small class="mr-2 text-muted"><i class="fa fa-calendar-alt"></i>' . $registro["fecha_mostrada"] . '</small>
                                </div>
                                <p>' . $registro["descripcion"] . '</p>
                            </div>
                        </div>';
                    }
                } else {
                    $jTableResult['msj'] = "No hay noticias disponibles.";
                    $jTableResult['rstl'] = "0";
                }
        
                echo json_encode($jTableResult);
                break;



                                                                                                    case 'AgregarPoblacion':
                                                                                                        $jTableResult = array();
                                                                                                        $jTableResult['rst'] = "";
                                                                                                        $jTableResult['ms'] = "";
                                                                                                    
                                                                                                        // Verificar que el nombre de la población esté presente en los datos POST
                                                                                                        if (isset($_POST['nombre'])) {
                                                                                                            $nombre = $conn->real_escape_string($_POST['nombre']);
                                                                                                            
                                                                                                            // Insertar nueva población en la base de datos
                                                                                                            $query = "INSERT INTO poblacion (nombre_poblacion) VALUES ('$nombre')";
                                                                                                            
                                                                                                            if ($result = mysqli_query($conn, $query)) {
                                                                                                                mysqli_commit($conn);
                                                                                                                $jTableResult['rst'] = "1";
                                                                                                                $jTableResult['ms'] = "Población agregada con éxito.";
                                                                                                            } else {
                                                                                                                mysqli_rollback($conn);
                                                                                                                $jTableResult['ms'] = "Error al guardar la población: " . mysqli_error($conn);
                                                                                                                $jTableResult['rst'] = "0";
                                                                                                            }
                                                                                                        } else {
                                                                                                            $jTableResult['ms'] = "El nombre de la población es obligatorio.";
                                                                                                            $jTableResult['rst'] = "0";
                                                                                                        }
                                                                                                        break;
                                                                                                    
                                                                                                    
                                                                                                    // Agregar más casos según las acciones que puedan realizar sobre la tabla poblacion

	}
    
mysqli_close($conn);