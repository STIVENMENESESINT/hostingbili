$(document).ready(function(){ 
    $.post("../../include/cntrlSoli.php", {
        action: 'asignaciones'
    }, function(data) {
        if (data.rs === "1") {
            $("#tablecontenido").html(
                `<h1 class="text-center my-4">Tus Solicitudes Asignadas</h1>` +
                data.tabla
            );
        } else {
            // mirar actualizar perfil
            $("#tablecontenido").html(`
                <h4>No hay Solicitudes Asignadas</h4>
            `);
        }
    }, 'json');
});
$(document).on("click", "#btn_asign", function() {
    var idSolicitud = $(this).data('id');
    console.log("ID de la solicitud: " + idSolicitud);
    $.post("../../include/cntrlSoli.php", {
        action: 'Asignado_Crear',
        id_solicitud: idSolicitud
    }, function(data) {
        if (data.rst == '1') {
            $("#asignado").html(data.Asignform);
            cargarMetadatos()
            $(document).on("click", "#btn_curso",function (){
                console.log("ID de la solicitud: " + idSolicitud);
                if($("#ficha").val()==""){
                    alert('Debe ingresar la ficha del curso');
                    $("#ficha").focus();
                }
                else
                {
                    if($("#nombre").val()=="" ){
                        alert('Debe Digitar un Nombre de Curso');
                        $("#nombre").focus();
                    }
                    else
                    {
                        // seguir preguntando con otra caja de texto. 
                        // los demas lo hacen ustedes.
                        confirm("Esta seguro de Crear este Curso de" + $("#nombre"))
                        $.post("../../include/cntrlSoli.php", {
                        action:'registroCursoNew',
                        nombre:$("#nombre").val(),
                        fecha_inicio:$("#fecha_inicio").val(),
                        fecha_cierre:$("#fecha_cierre").val(),
                        ficha:$("#ficha").val(),
                        horas_curso:$("#horas").val(),
                        id_modalidad:$("#id_modalidad").val(),
                        id_jornada:$("#id_jornada").val(),
                        id_nivel_formacion:$("#id_nivel_formacion").val(),
                        matriculados:$("#matriculados").val(),
                        id_estado:$("#id_estado").val(),
                        id_solicitud: idSolicitud
                        }, function(data){
                            if(data.rstl=="1"){	alert(data.msj); location.reload();} else{	alert(data.msj); }
                        }, 'json');
                    }
                }
            });
        } else {
            alert(data.ms);
        }
    }, 'json');
});

function cargarMetadatos() {
    $.post("../../include/select.php", {
        action: 'crgrTiposJornada'
    },
    function(data) {
        $("#id_jornada").html(data.lisTiposJ);
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
    $.post("../../include/select.php", {
        action: 'crgrTiposNivelFormacion'
    },
    function(data) {
        $("#id_nivel_formacion").html(data.lisTiposNF);
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
    $.post("../../include/select.php", {
        action: 'crgrTiposModalidad'
    },
    function(data) {
        $("#id_modalidad").html(data.lisTiposM);
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
    $.post("../../include/select.php", {
        action: 'crgrEstado'
    }, function (data) {
        var opcionesEstado = data.listEstado;
        $("#id_estado").html(opcionesEstado);
    }, 'json').fail(function (xhr, status, error) {
        console.error(error);
    });
}