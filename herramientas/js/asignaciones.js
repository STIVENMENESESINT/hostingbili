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
$(document).ready(function(){  
    $.post("../../include/select.php", {
        action: 'crgrResponsable',
        id_solicitud: idSolicitud 
    },
    function(data) {
        $("#id_responsable").html(data.listResponsable);
        },
        'json'
        ).fail(function(xhr, status, error) {
            console.error(error);
    });
});
$(document).on("click", "#btn_pf", function () {
    var idSolicitud = $(this).data('id');
    console.log("ID de la solicitud: " + idSolicitud);
    $.post("../../include/cntrlSoli.php", {
        action: 'ListarSolicitud_pf',
        id_solicitud: idSolicitud
    }, function(data) {
        if (data.rst == '1') {
            $("#form_pf").html(data.ListPf);
            AsignacionesCargar(idSolicitud);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.ms
            });
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
            cargarMetadatos();

            $(document).on("click", "#btn_curso", function() {
                console.log("ID de la solicitud: " + idSolicitud);
                
                if ($("#ficha").val() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la ficha del curso'
                    });
                    $("#ficha").focus();
                } else {
                        // Confirmación antes de crear el curso
                        var confirmacion = confirm("Esta seguro de Crear este Curso de " + $("#nombre_programa").val());
                        if (confirmacion) {
                            var formData = new FormData();
                            formData.append("action", "registroCursoNew");
                            // Agregar otros campos al FormData
                            formData.append("fecha_inicio", $("#fecha_inicio").val());
                            formData.append("nombre_programa", $("#nombre_programa").val());
                            formData.append("fecha_cierre", $("#fecha_cierre").val());
                            formData.append("modalidad", $("#id_modalidad_label").text().trim()); // Modalidad desde el label
                            formData.append("nivel_formacion", $("#nivel_formacion_label").text().trim()); // Nivel de formación desde el label
                            formData.append("tipo_formacion", $("#tipo_formacion_label").text().trim()); // Tipo de formación desde el label
                            formData.append("horas_curso", $("#horas_curso_label").text().trim()); // Horas del curso desde el label
                            formData.append("titulo", $("#titulo1").val());
                            formData.append("ficha", $("#ficha").val());
                            formData.append("descripcion", $("#descripcion_Publi").val());
                            formData.append("fecha_mostrada", $("#id_fecha_mostrada").val());
                            formData.append("imagen", $("#imagen")[0].files[0]);
                            formData.append("fecha_fin", $("#id_fecha_fin").val());
                            formData.append("url", $("#id_url").val());
                            formData.append("id_solicitud", idSolicitud); // Agregar id_solicitud al formData

                            // Enviar el formulario con AJAX
                            $.ajax({
                                url: "../../include/cntrlSoli.php",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: 'json',
                                success: function(data) {
                                    if (data.rstl == "1") {
                                        Swal.fire({
                                            icon: 'success',
                                            title: '¡Éxito!',
                                            text: data.msj,
                                            showConfirmButton: false,
                                            timer: 1500 // Tiempo en milisegundos (1.5 segundos)
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: data.msj
                                        });
                                    }
                                }
                            });
                        }
                    }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.ms
            });
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
$(document).on("click", "#btn_LEc", function() {
    var idSolicitud = $(this).data('id');
    $.post("../../include/cntrlSoli.php", {
        action: 'asignacion_Listar_Ec',
        id_solicitud: idSolicitud
    }, function(data) {
        if (data.rst == "1") {
            $("#form_Ec").html(data.ListEc);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.ms
            });
            
        }
    }, 'json');
});
$(document).on("click", "#btn_LRa", function() {
    var idSolicitud = $(this).data('id');
    $.post("../../include/cntrlSoli.php", {
        action: 'asignacion_Listar_Ra',
        id_solicitud: idSolicitud
    }, function(data) {
        if (data.rst == "1") {
            $("#form_Ra").html(data.ListRa);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.ms
            });
            
        }
    }, 'json');
});
$(document).on("click", "#modalCancel", function() {
    var idSolicitud = $(this).data('id');
    console.log("ID de la solicitud: " + idSolicitud);
    $.post("../../include/cntrlSoli.php", {
        action: 'Cancel',
        id_solicitud: idSolicitud
    }, function(data) {
        if (data.rst == '1') {
            $("#cancel").html(data.cancel);
            $('#btnCancelarSoli').on("click", function() {
                if ($("#Denegacion").val()==""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe Digitar Mensaje de Confirmacion Para su Cancelacion...'
                    });
                    focus('#Denegacion');
                }else{
                    
                        var idSolicitud = $(this).data('id');
                        console.log("ID de la solicitud a cancelar: " + idSolicitud);
                        $.post("../../include/cntrlSoli.php", {
                            action: 'denegarSolicitud',
                            id_solicitud: idSolicitud
                        }, function(data) {
                            if (data.rstl == "1") {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: data.msj,
                                    showConfirmButton: false,
                                    timer: 1500 // Tiempo en milisegundos (1.5 segundos)
                                }).then(() => {
                                    location.reload();
                                }); // Recargar la página para ver los cambios
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.msj
                                });
                            }
                        }, 'json');
                }
            });
        } else {
            alert(data.ms);
        }
    }, 'json');
});