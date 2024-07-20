<?php
require_once "../inc/session_start.php";
require_once "main.php";

/*== Almacenando datos ==*/
$codigo = limpiar_cadena($_POST['producto_codigo']);
$nombre = limpiar_cadena($_POST['producto_nombre']);
$stock = limpiar_cadena($_POST['producto_stock']);
$categoria = limpiar_cadena($_POST['producto_categoria']);

// Verificar si se recibió el valor del proveedor
$proveedor = isset($_POST['producto_proveedor']) ? limpiar_cadena($_POST['producto_proveedor']) : null;

// Verificar si se recibió el valor del precio de compra
$precio_compra = isset($_POST['producto_precio_compra']) ? limpiar_cadena($_POST['producto_precio_compra']) : null;

/*== Verificando campos obligatorios ==*/
if ($codigo == "" || $nombre == "" || $stock == "" || $categoria == "") {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
        </div>
    ';
    exit();
}

/*== Verificando integridad de los datos ==*/
if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El CODIGO de BARRAS no coincide con el formato solicitado
        </div>
    ';
    exit();
}

if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El NOMBRE no coincide con el formato solicitado
        </div>
    ';
    exit();
}

if(verificar_datos("[0-9]{1,25}",$stock)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El STOCK no coincide con el formato solicitado
        </div>
    ';
    exit();
}

/*== Verificando codigo ==*/
$check_codigo=conexion();
$check_codigo=$check_codigo->query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
if($check_codigo->rowCount()>0){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro
        </div>
    ';
    exit();
}
$check_codigo=null;

/*== Verificando nombre ==*/
$check_nombre=conexion();
$check_nombre=$check_nombre->query("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
if($check_nombre->rowCount()>0){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
        </div>
    ';
    exit();
}
$check_nombre=null;

/*== Verificando categoria ==*/
$check_categoria=conexion();
$check_categoria=$check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
if($check_categoria->rowCount()<=0){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            La categoría seleccionada no existe
        </div>
    ';
    exit();
}
$check_categoria=null;

/* Directorios de imágenes y archivos */
$img_dir='../img/producto/';
$file_dir='../files/producto/';

/*== Creando directorios si no existen ==*/
if (!file_exists($img_dir) && !mkdir($img_dir, 0777, true)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Error al crear el directorio de imagenes
        </div>
    ';
    exit();
}

if (!file_exists($file_dir) && !mkdir($file_dir, 0777, true)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Error al crear el directorio de archivos
        </div>
    ';
    exit();
}

/*== Comprobando si se ha seleccionado una imagen ==*/
if($_FILES['producto_foto']['name']!="" && $_FILES['producto_foto']['size']>0){
    /* Comprobando formato de las imagenes */
    if(mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/png"){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen que ha seleccionado es de un formato que no está permitido
            </div>
        ';
        exit();
    }

    /* Comprobando que la imagen no supere el peso permitido */
    if(($_FILES['producto_foto']['size']/1024)>3072){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen que ha seleccionado supera el límite de peso permitido
            </div>
        ';
        exit();
    }

    /* Extensión de las imagenes */
    switch(mime_content_type($_FILES['producto_foto']['tmp_name'])){
        case 'image/jpeg':
          $img_ext=".jpg";
        break;
        case 'image/png':
          $img_ext=".png";
        break;
    }

    /* Nombre de la imagen */
    $img_nombre=renombrar_fotos($nombre);

    /* Nombre final de la imagen */
    $foto=$img_nombre.$img_ext;

    /* Moviendo imagen al directorio */
    if(!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir.$foto)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
            </div>
        ';
        exit();
    }
}else{
    $foto="";
}

/*== Comprobando si se ha seleccionado un archivo ==*/
if($_FILES['producto_archivo']['name']!="" && $_FILES['producto_archivo']['size']>0){
    /* Comprobando formato de los archivos */
    $allowed_file_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if(!in_array(mime_content_type($_FILES['producto_archivo']['tmp_name']), $allowed_file_types)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El archivo que ha seleccionado es de un formato que no está permitido
            </div>
        ';
        exit();
    }

    /* Comprobando que el archivo no supere el peso permitido */
    if(($_FILES['producto_archivo']['size']/1024)>10240){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El archivo que ha seleccionado supera el límite de peso permitido
            </div>
        ';
        exit();
    }

    /* Extensión de los archivos */
    switch(mime_content_type($_FILES['producto_archivo']['tmp_name'])){
        case 'application/pdf':
          $file_ext=".pdf";
        break;
        case 'application/msword':
          $file_ext=".doc";
        break;
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
          $file_ext=".docx";
        break;
    }

    /* Nombre del archivo */
    $file_name=renombrar_fotos($nombre);

    /* Nombre final del archivo */
    $archivo=$file_name.$file_ext;

    /* Moviendo archivo al directorio */
    if(!move_uploaded_file($_FILES['producto_archivo']['tmp_name'], $file_dir.$archivo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No podemos subir el archivo al sistema en este momento, por favor intente nuevamente
            </div>
        ';
        exit();
    }
}else{
    $archivo="";
}

/*== Guardando datos ==*/
$guardar_producto=conexion();
$guardar_producto=$guardar_producto->prepare("INSERT INTO producto(producto_codigo,producto_nombre,producto_stock,producto_foto,producto_archivo,categoria_id,usuario_id) VALUES(:codigo,:nombre,:stock,:foto,:archivo,:categoria,:usuario)");

$marcadores=[
    ":codigo"=>$codigo,
    ":nombre"=>$nombre,
    ":stock"=>$stock,
    ":foto"=>$foto,
    ":archivo"=>$archivo,
    ":categoria"=>$categoria,
    ":usuario"=>$_SESSION['id']
];

$guardar_producto->execute($marcadores);

if($guardar_producto->rowCount()==1){
    echo '
        <div class="notification is-info is-light">
            <strong>¡LIBRO REGISTRADO!</strong><br>
            El Libro se registró con éxito
        </div>
    ';
}else{
    if(is_file($img_dir.$foto)){
        chmod($img_dir.$foto, 0777);
        unlink($img_dir.$foto);
    }
    if(is_file($file_dir.$archivo)){
        chmod($file_dir.$archivo, 0777);
        unlink($file_dir.$archivo);
    }

    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se pudo registrar el Libro, por favor intente nuevamente
        </div>
    ';
}
$guardar_producto=null;
?>
