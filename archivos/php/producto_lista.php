<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$campos = "producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_precio,producto.producto_stock,producto.producto_foto,producto.categoria_id,producto.usuario_id,categoria.categoria_id,categoria.categoria_nombre,usuario.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido,proveedor.proveedor_nombre,producto.producto_precio_compra";

if (isset($busqueda) && $busqueda != "") {

    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id LEFT JOIN proveedor ON producto.proveedor_id=proveedor.proveedor_id WHERE producto.producto_codigo LIKE '%$busqueda%' OR producto.producto_nombre LIKE '%$busqueda%' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

    $consulta_total = "SELECT COUNT(producto_id) FROM producto WHERE producto_codigo LIKE '%$busqueda%' OR producto_nombre LIKE '%$busqueda%'";

} elseif ($categoria_id > 0) {

    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id LEFT JOIN proveedor ON producto.proveedor_id=proveedor.proveedor_id WHERE producto.categoria_id='$categoria_id' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

    $consulta_total = "SELECT COUNT(producto_id) FROM producto WHERE categoria_id='$categoria_id'";

} else {

    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id LEFT JOIN proveedor ON producto.proveedor_id=proveedor.proveedor_id ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

    $consulta_total = "SELECT COUNT(producto_id) FROM producto";

}

// Consulta para obtener el total de productos en todas las categorías
$consulta_total_productos = "SELECT SUM(producto_stock) AS total_productos FROM producto";

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int)$total->fetchColumn();

$Npaginas = ceil($total / $registros);

// Obtener el total de productos en todas las categorías
$resultado_total_productos = $conexion->query($consulta_total_productos);
$total_productos = (int)$resultado_total_productos->fetchColumn();

// Calcular el valor total en existencia sumando el valor total en existencia de cada producto
$valor_total_inventario = 0;
foreach ($datos as $row) {
    $valor_total_inventario += $row['producto_precio'] * $row['producto_stock'];
}

if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $row) {
        $valor_total_existencia = $row['producto_precio'] * $row['producto_stock'];
        $tabla .= '
            <article class="media">
                <figure class="media-left">
                    <p class="image is-64x64">';
        if (is_file("./img/producto/" . $row['producto_foto'])) {
            $tabla .= '<img src="./img/producto/' . $row['producto_foto'] . '">';
        } else {
            $tabla .= '<img src="./img/producto.png">';
        }
        $tabla .= '</p>
                </figure>
                <div class="media-content">
                    <div class="content">
                      <p>
                        <strong>' . $contador . ' - ' . $row['producto_nombre'] . '</strong><br>
                        <strong>CODIGO:</strong> ' . $row['producto_codigo'] . ', <strong>PRECIO:</strong> $' . $row['producto_precio'] . ', <strong>STOCK:</strong> ' . $row['producto_stock'] . ', <strong>CATEGORIA:</strong> ' . $row['categoria_nombre'] . ', <strong>REGISTRADO POR:</strong> ' . $row['usuario_nombre'] . ' ' . $row['usuario_apellido'] . ', <strong>PROVEEDOR:</strong> ' . $row['proveedor_nombre'] . ', <strong>PRECIO DE COMPRA:</strong> $' . $row['producto_precio_compra'] . '<br>
                        <strong>Valor Total en Existencia:</strong> $' . $valor_total_existencia . '
                      </p>
                    </div>
                    <div class="has-text-right">
                        <a href="index.php?vista=product_img&product_id_up=' . $row['producto_id'] . '" class="button is-link is-rounded is-small">Imagen</a>
                        <a href="index.php?vista=product_update&product_id_up=' . $row['producto_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
                        <a href="' . $url . $pagina . '&product_id_del=' . $row['producto_id'] . '" class="button is-danger is-rounded is-small">Eliminar</a>
                    </div>
                </div>
            </article>
            <hr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    if ($total >= 1) {
        $tabla .= '
            <p class="has-text-centered" >
                <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                    Haga clic acá para recargar el listado
                </a>
            </p>
        ';
    } else {
        $tabla .= '
            <p class="has-text-centered" >No hay registros en el sistema</p>
        ';
    }
}

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando productos <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

// Agregar el valor total del inventario
$tabla .= '<p class="has-text-right">Valor total del inventario: $' . $valor_total_inventario . '</p>';

$conexion = null;
echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
?>


