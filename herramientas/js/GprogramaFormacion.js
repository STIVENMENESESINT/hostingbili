$(document).ready(function(){ 
    $.post("../../include/cntrlGprogramaFormacion.php", {
        action: 'MisPf_sin'
    }, function(data) {
        if (data.rs === "1") {
            $("#sin_contenido").html(
                `<h1 class="text-center my-4">Tus Programa de Formacion en Curso</h1>` +
                data.tabla
            );
        } else {
            // mirar actualizar perfil
            $("#sin_contenido").html(`
                <h4>No hay Solicitudes Pendientes</h4>
            `);
        }
    }, 'json');
});
$(document).on("click", "#btn_ListPf", function () { 
    var idSolicitud = $(this).data('id');
    $.post("../../include/cntrlGprogramaFormacion.php", {
        action: 'Listar_pf',
        id_solicitud: idSolicitud

    }, function(data) {
        if (data.rst === "1") {
            $("#List_Gestion").html(
                data.ListPf
            );
        } else {
            alert("Error")
        }
    }, 'json');
});
$(document).on("click", "#create", function () { 
    // Crear una nueva sección de formulario
    var newFormSection = `
        <div class="form-section">
            <h6>Nombre Completo</h6>
            <input type='text'><br>
            <h6>Numero de identificacion</h6>
            <input type='number'>
            <h6>Correo Electronico</h6>
            <input type='text'><br>
            <hr>
        </div>
    `;
    // Añadir la nueva sección de formulario al contenedor
    $('#form_container').append(newFormSection);
});