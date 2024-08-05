$(document).on("click", "#publicar_noti", function (event) {
    if ($("#titulo").val() == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debe ingresar el Titulo'
        });
        $("#titulo").focus();
    } else {
        if ($("#imagen").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debe ingresar la Imagen'
            });
            $("#imagen").focus();
        } else {
            var formData = new FormData();
            formData.append("action", "guardarNoticia");
            formData.append("titulo", $("#titulo").val());
            formData.append("descripcion", $("#descripcion_local").val());
            formData.append("fecha_fin", $("#fecha_fin").val());
            formData.append("imagen", $("#imagen")[0].files[0]);
            formData.append("fecha_inicio", $("#id_fecha_mostrada").val());
            formData.append("id_url", $("#id_url").val());
            $.ajax({
                url: "../../include/cntrlNoti.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.rstl == "1") {
                        $.post("../../include/cntrlSoli.php", {
                            action: 'Solicitud'
                        }, function (data) {
                            if (data.rst == "1") {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: data.ms,
                                    showConfirmButton: false,
                                    timer: 1500 // Tiempo en milisegundos (1.5 segundos)
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.ms
                                });
                            }
                        }, 'json');
                    } else {
                        alert(data.msj);
                    }
                },
                dataType: 'json'
            });
        }
    }
});

$(document).on("click", "#publicar_noti2", function () {
        if ($("#titulo").val() == "") {
            alert('Debe ingresar Titulo a la Oferta');
            $("#titulo").focus();
        } else {
            if ($("#imagen").val() == "") {
                alert('Debe ingresar la Imagen');
                $("#imagen").focus();
            } else {
                if ($("#nombre").val() == "") {
                    alert('Debe Digitar un Nombre de Curso ');
                    $("#nombre").focus();
                } else {
                        confirm("¿Está seguro de Ofertar este Curso de " + $("#nombre").val() + "?");
                        var formData = new FormData();
                        formData.append("action", "registroCursoNew");
                        formData.append("nombre", $("#titulo").val());
                        formData.append("fecha_inicio", $("#fecha_inicio").val());
                        formData.append("fecha_cierre", $("#fecha_cierre").val());
                        formData.append("horas_curso", $("#horas").val());
                        formData.append("id_modalidad", $("#id_modalidad").val());
                        formData.append("id_jornada", $("#id_jornada").val());
                        formData.append("titulo", $("#titulo").val());
                        formData.append("descripcion", $("#descripcion").val());
                        formData.append("fecha_mostrada", $("#id_fecha_mostrada").val());
                        formData.append("imagen", $("#imagen")[0].files[0]);
                        formData.append("fecha_inicio", $("#fecha_inicio").val());
                        formData.append("fecha_fin", $("#id_fecha_fin").val());
                        formData.append("url", $("#id_url").val());
    
                        $.ajax({
                            url: "../../include/cntrlNoti.php",
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function (data) {
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
            }
    });
    $(document).on("click", "#hideRevista", function () {
        $("#revista").hide();
    });
$(document).on("click", "#showRevista", function () {
        $("#revista").show();
    });
$(document).ready(function() {
        $("#revista").hide();
    });
// ALERTAS SM
$(document).ready(function() {
    $("#noticiaForm").on("submit", function(event) {
        // Validación adicional con jQuery
        let valid = true;

        if ($("#titulo").val().trim() === "") {
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

        if ($("#imagen").val().trim() === "") {
            alert("La imagen es requerida.");
            valid = false;
        }

        return valid;
    });
});
// Noticia fin
$(document).ready(function(){  
    $.post("../../include/cntrlNoti.php", {
        action: 'noticiaCreado' 
    },
    function(data) {
        if(data.rstl=="1"){	
            $("#noticia_creada").html(data.noticia); } 
            else{	
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.msj
                });
            }
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
});
// aqui inicia el index

$(document).ready(function(){  
    $.post("include/cntrlNoti.php", {
        action: 'noticiaCreado2' 
    },
    function(data) {
        if(data.rstl=="1"){	
            $("#noticia_creada2").html(data.noticia); } 
            else{	
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.msj
                });
            }
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
});
$(document).on("click", "#MisSoliActivate", function () {
    $.post("../../include/select.php", {
        action: 'MisNoti' 
    },
    function(data) {
        if(data.rs=="1"){	
            $("#MisSoliForm").html(data.tabla); } 
            else{	
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.ms
                });
            }
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
});
$(document).ready(function(){  
    $.post("../../include/select.php", {
        action: 'crgrTipoCategoria' 
    },
    function(data) {
        $("#id_categoria").html(data.lisTiposC);
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
});
$(document).on("click", "#detalle_oferta", function () {  
    var idSolicitud = $(this).data('id');
    console.log("ID de la solicitud: " + idSolicitud);
    $.post("../../include/cntrlNoti.php", {
        action: 'ListarSolicitud_of' ,
        id_solicitud: idSolicitud
    },
    function(data) {
        if (data.rst=="1"){
            $("#formdetalle_oferta").html(data.Listof);
            $(document).on("click", "#ofertarme", function() {
                var formData = new FormData($('#postulacionForm')[0]);
                formData.append('action', 'Postular');
                formData.append('id_solicitud', idSolicitud);
                formData.append("detalle", $("#detalle").val());
                $.ajax({
                    url: "../../include/cntrlNoti.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.rst == '1') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: data.ms,
                                showConfirmButton: false,
                                timer: 1500 // Tiempo en milisegundos (1.5 segundos)
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.ms
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        }
        else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.ms
            });
        }
        
    },
    'json'
    ).fail(function(xhr, status, error) {
        console.error(error);
    });
});
function MostrarTipo_Categoria() {
    var select = document.getElementById("id_categoria");
    var tipo_soliDiv = document.getElementById("tipo_cate");
    tipo_soliDiv.innerHTML = "";
    var SelectipoSoli = select.value;
    switch (SelectipoSoli) {
        case "1":
            tipo_soliDiv.innerHTML = `
                <div class="mb-3">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="publicar_noti">Publicar</button>
                    <a type="button" class="btn btn-sm btn-outline-danger" href="" role="button">Cancelar</a>
                </div>
            `;
            break;

        case "3":
            tipo_soliDiv.innerHTML = `
            <style>
                .form-container {
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                    padding: 15px;
                    border: 1px solid #ced4da;
                    border-radius: 4px;
                    background-color: #f8f9fa;
                }

                .course-data-container {
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                }

                .course-data-field {
                    display: flex;
                    flex-direction: column;
                    gap: 5px;
                }

                .modal-title {
                    font-weight: bold;
                }

                .form-control, .col-form-label, .modal-textbox {
                    width: 100%;
                    padding: 8px;
                    border: 1px solid #ced4da;
                    border-radius: 4px;
                }

                .create-button, .close-button {
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    color: #fff;
                    cursor: pointer;
                    font-size: 16px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    margin-right: 10px;
                }

                .create-button {
                    background-color: #28a745;
                }

                .close-button {
                    background-color: #6c757d;
                }
            </style>

            <hr>
            <div class="form-container">
                <div class="course-data-container">
                    <h2>DATOS DE CURSO</h2>
                    <div class="course-data-field">
                        <label class="modal-title" for="nombre">Nombre curso</label>
                        <input class="form-control" type="text" id="nombre" />
                    </div>
                    <div class="course-data-field">
                        <label class="modal-title" for="fecha_inicio">Fecha inicio</label>
                        <input class="form-control" type="date" id="fecha_inicio" />
                    </div>
                    <div class="course-data-field">
                        <label class="modal-title" for="fecha_cierre">Fecha cierre</label>
                        <input class="form-control" type="date" id="fecha_cierre" />
                    </div>
                    <div class="course-data-field">
                        <label class="modal-title" for="id_modalidad">Modalidad</label>
                        <select class="form-control" id="id_modalidad"></select>
                    </div>
                    <div class="course-data-field">
                        <label class="modal-title" for="id_jornada">Jornada</label>
                        <select class="form-control" id="id_jornada"></select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="modal-title" for="id_fecha_mostrada">Fecha Fin Evento</label>
                    <input class="form-control" type="date" id="id_fecha_mostrada" name="fecha_inicio">
                </div>
                <div class="mb-3">
                    <a type="button" class="create-button" id="publicar_noti2">Publicar</a>
                    <a type="button" class="close-button" href="" role="button">Cancelar</a>
                </div>
            </div>

            `;
            cargarDatos();
            break;
        // Agrega más casos según sea necesario para otras categorías
    }
}

function cargarDatos(){
    $.post("../../include/select.php", {
        action: 'CrgrArea' 
    },
        function(data) {
            $("#id_area").html(data.listArea);
            },
            'json'
            ).fail(function(xhr, status, error) {
                console.error(error);
        }
    );
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
