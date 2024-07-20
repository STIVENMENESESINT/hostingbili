$(document).on("click", "#publicar_noti", function (event) {
    event.preventDefault();

    if ($("#titulo").val() === "") {
        alert('Debe ingresar el Titulo');
        $("#titulo").focus();
    } else {
        if ($("#imagen").val() === "") {
            alert('Debe ingresar la Imagen');
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
                                alert(data.ms);
                                location.reload();
                            } else {
                                alert(data.ms);
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
                if ($("#nombre").val() === "") {
                    alert('Debe Digitar un Nombre de Curso ');
                    $("#nombre").focus();
                } else {
                        confirm("¿Está seguro de Ofertar este Curso de " + $("#nombre").val() + "?");
                        var formData = new FormData();
                        formData.append("action", "registroCursoNew");
                        formData.append("nombre", $("#nombre").val());
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
                                    alert(data.msj);
                                    location.reload();
                                } else {
                                    alert(data.msj);
                                }
                            }
                        });
                    }
                }
            }
    });
 
// ALERTAS SM
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
                alert(data.msj);
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
                            alert(data.ms);
                            location.reload();
                        } else {
                            alert(data.ms);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        }
        else{
            alert(data.ms)
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
                    <label for="id_descripcion" class="form-label">(PREGUNTAR) Fecha Fin Noticia?</label>
                    <input class="form-control" type="date" id="fecha_fin" name="fecha_fin">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="publicar_noti">Publicar</button>
                    <a type="button" class="btn btn-sm btn-outline-danger" href="" role="button">Cancelar</a>
                </div>
            `;
            break;

        case "2":
            tipo_soliDiv.innerHTML = `
                <div class="mb-3">
                    <label for="id_descripcion" class="form-label">Fecha Fin Evento</label>
                         <div class="modal-body" style="color:#228B22;">
                                <form class="form-horizontal" method="POST" action="proceso.php">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="titulo" placeholder="Titulo del Evento">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Color</label>
                                        <div class="col-sm-5">
                                            <select name="color" class="form-control" id="color">
                                                <option value="">Selecione</option>
                                                <option style="color:#FFD700;" value="#FFD700">Amarillo
                                                </option>
                                                <option style="color:#0071c5;" value="#0071c5">Azul
                                                    Turquesa</option>
                                                <option style="color:#FF4500;" value="#FF4500">Naranja
                                                </option>
                                                <option style="color:#8B4513;" value="#8B4513">Marron
                                                </option>
                                                <option style="color:#1C1C1C;" value="#1C1C1C">Negro
                                                </option>
                                                <option style="color:#436EEE;" value="#436EEE">Azul Real
                                                </option>
                                                <option style="color:#A020F0;" value="#A020F0">Purpura
                                                </option>
                                                <option style="color:#40E0D0;" value="#40E0D0">Turquesa
                                                </option>
                                                <option style="color:#228B22;" value="#228B22">Verde
                                                </option>
                                                <option style="color:#8B0000;" value="#8B0000">Rojo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Fecha
                                            Inicial</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="inicio" id="start"
                                                onKeyPress="DataHora(event, this)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Fecha
                                            Final</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="fin" id="end"
                                                onKeyPress="DataHora(event, this)">
                                        </div>
                                    </div>
                                   
                            </form>
                        </div>
                </div>
                <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           
                        </div>
                    </div>
                </div>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="publicar_noti">Publicar</button>
                    <a type="button" class="btn btn-sm btn-outline-danger" href="" role="button">Cancelar</a>
                </div>
            `;
            break;

        case "3":
            tipo_soliDiv.innerHTML = `
            <hr>
            <div class="form-container">
                <div class='course-data-container'>
                    <h2>DATOS DE CURSO</h2>
                    <div class='course-data-field'>
                        <label class="modal-title">Nombre curso</label><br>
                        <input class="col-form-label" type='text' id='nombre' />
                    </div>
                    <div class='course-data-field'>
                        <label class="modal-title">Fecha inicio</label><br>
                        <input class="col-form-label" type='date' id='fecha_inicio' />
                    </div>
                    <div class='course-data-field'>
                        <label class="modal-title">Fecha cierre</label><br>
                        <input class="col-form-label" type='date' id='fecha_cierre' />
                    </div>
                    <div class='course-data-field'>
                        <label class="modal-title">Horas de curso</label><br>
                        <input class="col-form-label" type='number' id='horas' value='0' />
                    </div>
                    <div class='course-data-field'>
                        <label class="modal-title">Modalidad</label><br>
                        <select class="form-control modal-textbox" id='id_modalidad'></select>
                    </div>
                    <div class='course-data-field'>
                        <label class="modal-title">Jornada</label><br>
                        <select class="form-control modal-textbox" id='id_jornada'></select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="id_descripcion" class="modal-title">Fecha Fin Evento</label><br>
                    <input class="col-form-label" type="date" id="id_fecha_mostrada" name="fecha_inicio">
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
