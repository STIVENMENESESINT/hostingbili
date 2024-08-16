
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('../../../archivos/vista/cabecera.php'); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario </title>
    <link rel="stylesheet" href="../../../herramientas/css/perfil.css">
    <link rel="stylesheet" href="../../../herramientas/css/style.css">
<link rel="stylesheet" type="text/css" href="../../../herramientas/css/layout.css">
<link rel="stylesheet" type="text/css" href="../../../herramientas/css/menu.css">


</head>
<body>
    <div class="layout">

        <!-- Contenido principal -->
        <div class="container layout__content">
            <div class="content__page">
                <script>
                    $(document).on("click", "#btnGuardarEmpresa", function() {
                        // Validación del campo nombre_empresa
                        if ($("#nombre_empresa").val() === "") {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Campo Vacío',
                                text: 'Debe ingresar el nombre de la empresa',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                $("#nombre_empresa").focus();
                            });
                            return; // Salir de la función si hay un error
                        }
                        
                        // Validación del campo numeroiden_empresa
                        var nit = $("#numeroiden_empresa").val();
                        if (nit === "0" || nit.length < 6) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Campo Inválido',
                                text: 'El NIT debe tener al menos 6 dígitos',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                $("#numeroiden_empresa").focus();
                            });
                            return; // Salir de la función si hay un error
                        }
                        
                        // Validación del campo correo_empresa
                        var email = $("#correo_empresa").val();
                        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(email)) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Correo Inválido',
                                text: 'Debe ingresar un correo electrónico válido',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                $("#correo_empresa").focus();
                            });
                            return; // Salir de la función si hay un error
                        }
                        
                        // Enviar datos si no hay errores
                        $.post("../../../include/ctrlIndex2.php", {
                            action: 'registroEmpNew',
                            nombre_empresa: $("#nombre_empresa").val(),
                            numeroiden_empresa: $("#numeroiden_empresa").val(),
                            telefono_empresa: $("#telefono_empresa").val(),
                            correo_empresa: $("#correo_empresa").val()
                        }, function(data) {
                            if (data.rstl === "1") {
                                // Validación del campo numeroiden_registro_rep
                                if ($("#numeroiden_registro_rep").val() === "") {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Campo Vacío',
                                        text: 'Debe ingresar su número de identificación',
                                        confirmButtonText: 'Ok'
                                    }).then(() => {
                                        $("#numeroiden_registro_rep").focus();
                                    });
                                    return; // Salir de la función si hay un error
                                }
                                
                                // Validación del campo id_tpdoc_rep
                                if ($("#id_tpdoc_rep").val() === "0") {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Campo Vacío',
                                        text: 'Debe seleccionar un tipo de documento',
                                        confirmButtonText: 'Ok'
                                    }).then(() => {
                                        $("#id_tpdoc_rep").focus();
                                    });
                                    return; // Salir de la función si hay un error
                                }
                                
                                // Validación de la clave_registro
                                var clave = $("#clave_registro_rep").val();
                                if (clave.length < 6 || !/\d/.test(clave)) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Clave Inválida',
                                        text: 'La clave debe tener al menos 6 caracteres y contener al menos un número',
                                        confirmButtonText: 'Ok'
                                    }).then(() => {
                                        $("#clave_registro_rep").focus();
                                    });
                                    return; // Salir de la función si hay un error
                                }
                                
                                // Enviar datos si no hay errores
                                $.post("../../../include/ctrlIndex2.php", {
                                    action: 'registroUsuNewE',
                                    id_tpdoc: $("#id_tpdoc_rep").val(),
                                    numeroiden_registro: $("#numeroiden_registro_rep").val(),
                                    nameusu: $("#nameusu_rep").val(),
                                    nombre_dos: $("#nombre_dos_rep").val(),
                                    apellidoUsu: $("#apellidoUsu_rep").val(),
                                    apellidoUsu_dos: $("#apellidoUsu_dos_rep").val(),
                                    correo_registro: $("#correo_registro_rep").val(),
                                    celular: $("#celular_rep").val(),
                                    id_genero: $("#id_genero_rep").val(),
                                    clave_registro: $("#clave_registro_rep").val()
                                }, function(data) {
                                    Swal.fire({
                                        icon: data.rstl === "1" ? 'success' : 'error',
                                        title: data.rstl === "1" ? 'Éxito' : 'Error',
                                        text: data.msj,
                                        confirmButtonText: 'Ok'
                                    });
                                }, 'json');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.msj,
                                    confirmButtonText: 'Ok'
                                });
                            }
                        }, 'json'); 
                    });
                    $(document).ready(function(){  
					$.post("../../../include/select.php", {
						action: 'CrgrTipoGenero' 
					},
					function(data) {
						$("#id_genero").html(data.lisTiposG);
						$("#id_genero_rep").html(data.lisTiposG);
						},
						'json'
						).fail(function(xhr, status, error) {
							console.error(error);
						});
					});
                    $(document).ready(function(){  
                        $.post("../../../include/select.php", {
                            action: 'crgrPoblacion' 
                        },
                        function(data) {
                            $("#cod_poblacion").html(data.listPoblacion);
                            },
                            'json'
                            ).fail(function(xhr, status, error) {
                                console.error(error);
                            });
                        });
                    $(document).ready(function(){  
                    $.post("../../../include/select.php", {
                        action: 'crgrDepto' 
                    },
                    function(data) {
                        $("#cod_dpto").html(data.listDepto);
                        },
                        'json'
                        ).fail(function(xhr, status, error) {
                            console.error(error);
                        });
                    });
                    $(document).ready(function(){  
                        $.post("../../../include/select.php", {
                            action: 'crgrTiposDoc' 
                        },
                        function(data) {
                            $("#id_tpdoc").html(data.lisTiposD);
                            $("#id_tpdoc_rep").html(data.lisTiposD);
                        },
                        'json'
                        ).fail(function(xhr, status, error) {
                            console.error(error);
                        });
                    });
                    
                    $(document).on("change", "#cod_dpto",
                    function (){
                            $.post("../../../include/select.php", {
                            action:'crgrMuni',
                            cod_dpto:$("#cod_dpto").val()
                            }, function(data){ 
                                $("#cod_municipio").html(data.listMuni);
                            }, 'json');	
                        });	
                    $(document).on("change", "#cod_municipio",function (){
                        $.post("../../../include/select.php", {
                        action:'crgrPoblados',
                        cod_municipio:$("#cod_municipio").val()
                        }, function(data){ 
                            $("#cod_poblado").html(data.listPoblado);
                        }, 'json');	
                    });	
                </script>
                <!-- Campos del formulario -->
                        <style>
                             .form-container {
                                 display: flex;
                                 flex-wrap: wrap;
                                 justify-content: space-between;

                             }

                             .form-group {
                                 flex: 1 1 46%;
                                 display: flex;
                                 flex-direction: column;
                                 padding: 7px;
                             }

                             .form-group-full {
                                 flex: 1 1 100%;
                             }

                             .modal-footer {
                                 display: flex;
                                 justify-content: center;
                                 gap: 10px;
                                 margin-top: 20px;
                                 width: 100%;
                             }

                             .modal-body {

                                 /* Increased padding for more space inside the card */
                                 max-width: 800px;
                                 /* Set a maximum width for the card */
                                 max-height: 90vh;
                                 /* Set a maximum height for the card */
                                 width: 100%;
                                 /* Make sure it takes the full available width */

                             }

                             .form-label {
                                 margin-bottom: 2px;
                             }

                             .form-input {
                                 padding: 6px;
                                 margin-bottom: -15px;
                                 border: 1px solid #ccc;
                                 border-radius: 4px;
                             }

                             .form-button {
                                 padding: 10px 20px;
                                 border: none;
                                 border-radius: 4px;
                                 cursor: pointer;
                             }

                             .btn-success {
                                 background-color: #28a745;
                                 color: white;
                             }

                             .form-button-reset {
                                 background-color: #dc3545;
                                 color: white;
                             }
                        </style>
                            


            </div>

        </div>
    </div>


</body>
<!-- MODAL CAMBIO CONTRASEÑA -->


</html>

