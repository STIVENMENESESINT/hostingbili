<?php
    // Incluir archivo de configuración de conexión a la base de datos
    include_once('../../include/conex.php');
    // Establecer el tipo de contenido a HTML con el charset especificado en la configuración
    header('Content-Type: text/html; charset=UTF-8');
    // Iniciar sesión con el nombre de sesión configurado
    session_name('nombre_de_sesion'); // Cambia 'nombre_de_sesion' por el nombre de sesión adecuado
    session_start();
    // Verificar si hay una sesión activa con el id_userprofile
    if (isset($_SESSION['id_userprofile'])) {
        // Verificar si se recibió el parámetro del ID de la noticia
        if (isset($_GET['id_noticia'])) {
            // Obtener el ID de la noticia desde los parámetros GET
            $id_noticia = $_GET['id_noticia'];

            // Consultar la base de datos para obtener los detalles de la noticia
            $query = "SELECT * FROM detallesolicitud WHERE id = ?";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $id_noticia);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $noticia = $result->fetch_assoc();
                    // Mostrar los detalles de la noticia
                    $titulo = $noticia['titulo'];
                    $descripcion = $noticia['descripcion'];
                    $imagen = $noticia['imagen'];
                    $fecha_inicio = $noticia['fecha_inicio'];
                    $fecha_fin = $noticia['fecha_fin'];
                    ?>
                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <?php include_once('cabecera.php'); ?>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Detalles de Noticia - <?php echo $titulo; ?></title>
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                    </head>
                    <body>
                        <div class="container mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><?php echo $titulo; ?></h5>
                                </div>
                                <div class="card-body">
                                    <img src="<?php echo $imagen; ?>" class="img-fluid mb-3" alt="Imagen de la Noticia">
                                    <p><strong>Descripción:</strong> <?php echo $descripcion; ?></p>
                                    <p><strong>Fecha de Inicio:</strong> <?php echo $fecha_inicio; ?></p>
                                    <p><strong>Fecha de Fin:</strong> <?php echo $fecha_fin; ?></p>
                                    <a href="listardesdepaneldeadministrador.php" class="btn btn-primary">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>
                    <?php
                } else {
                    // No se encontró la noticia
                    echo "No se encontró la noticia con el ID proporcionado.";
                }

                $stmt->close();
            } else {
                // Error al preparar la consulta
                echo "Error al preparar la consulta: " . $conn->error;
            }
        } else {
            // No se recibió el ID de la noticia
            echo "No se recibió el ID de la noticia.";
        }
    } else {
        // No hay sesión activa, redirigir al usuario a la página de inicio de sesión
        header("Location: ../../index.php");
    }
?>
