
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noticiaModal">
    Publicar Noticia
</button>

<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticiaModalLabel">Formulario de Publicación de Noticias</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="noticiaForm" method="post" enctype="multipart/form-data" action="procesar_formulario.php">
                    <div class="form-group">
                        <label for="id_nombre">Título de la Noticia:</label>
                        <input type="text" id="titulo" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_descripcion">Descripción:</label>
                        <textarea id="id_descripcion" name="descripcion" class="form-control" rows="4"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_fecha_mostrada">Fecha a Mostrar:</label>
                        <input type="date" id="id_fecha_mostrada" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_imagen">Adjuntar Imagen:</label>
                        <input type="file" id="id_imagen" name="Imagen" class="form-control-file" accept="image/*"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="id_fecha_inicio">Fecha de Inicio:</label>
                        <input type="datetime-local" id="id_fecha_inicio" name="fecha_inicio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="id_fecha_fin">Fecha de Fin:</label>
                        <input type="datetime-local" id="id_fecha_fin" name="fecha_fin" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="id_direccion">Url:</label>
                        <input type="text" id="id_url" name="direccion" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary" id="publicar_noti">Publicar Noticia</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#noticiaForm").on("submit", function(event) {
        // Validación adicional con jQuery
        let valid = true;

        if ($("#id_nombre").val().trim() === "") {
            alert("El título es requerido.");
            valid = false;
        }

        if ($("#id_descripcion").val().trim() === "") {
            alert("La descripción es requerida.");
            valid = false;
        }

        if ($("#id_fecha_mostrada").val().trim() === "") {
            alert("La fecha a mostrar es requerida.");
            valid = false;
        }

        if ($("#id_imagen").val().trim() === "") {
            alert("La imagen es requerida.");
            valid = false;
        }

        return valid;
    });
});
</script>