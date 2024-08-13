
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
                <div id="formEmpresa">
                                 <div class="form-container">
                                     <div class="form-group">
                                         <label for="nombre" class="form-label">Empresa</label>
                                         <input type="text" id="nombre_empresa" name="nombre" class="form-input"
                                             placeholder="Nombre de la empresa">
                                     </div>
                                     <div class="form-group">
                                         <label for="nit" class="form-label">NIT</label>
                                         <input type="text" id="numeroiden_empresa" name="numeroiden_empresa"
                                             class="form-input" placeholder="123456789">
                                     </div>
                                     <div class="form-group">
                                         <label class="form-label">Contacto Empresa</label>
                                         <input type="tel" id="telefono_empresa" class="form-input"
                                             placeholder="empresa@gmail.com">
                                     </div>
                                     <div class="form-group">
                                         <label for="email" class="form-label">Correo Electrónico</label>
                                         <input type="email" id="correo_empresa" name="correo_empresa"
                                             class="form-input" placeholder="usuario@gmail.com">
                                     </div>
                                     <hr>
                                     <!-- REPRESENTANTE LEGAL -->
                                     <div class="form-group">
                                         <h3 class="form-label"><strong>Representante Legal</strong></h3>
                                     </div>
                                     <!-- Nombres y Apellidos -->
                                     <div class="form-group">
                                         <label for="nameusu" class="form-label">Primer Nombre:</label>
                                         <input type="text" class="form-input" id="nameusu_rep" name="nameusu"
                                             title="Primer Nombre" style="cursor:pointer;">
                                     </div>
                                     <div class="form-group">
                                         <label for="nombre_dos" class="form-label">Segundo Nombre:</label>
                                         <input type="text" class="form-input" id="nombre_dos_rep" name="nombre_dos"
                                             title="Segundo Nombre">
                                     </div>
                                     <div class="form-group">
                                         <label for="apellidoUsu" class="form-label">Primer Apellido:</label>
                                         <input type="text" class="form-input" id="apellidoUsu_rep" name="apellidoUsu"
                                             title="Primer Apellido">
                                     </div>
                                     <div class="form-group">
                                         <label for="apellidoUsu_dos" class="form-label">Segundo Apellido:</label>
                                         <input type="text" class="form-input" id="apellidoUsu_dos_rep"
                                             name="apellidoUsu_dos" title="Segundo Apellido">
                                     </div>
                                     <div class="form-group">
                                         <label for="id_tpdoc" class="form-label">Tipo de Documento:</label>
                                         <select class="form-input" id="id_tpdoc_rep" name="id_tpdoc"
                                             title="Tipo de Documento"></select>
                                     </div>
                                     <!-- Número de Documento -->
                                     <div class="form-group">
                                         <label for="numeroiden_registro" class="form-label">Número Documento:</label>
                                         <input type="text" class="form-input" id="numeroiden_registro_rep"
                                             name="numeroiden_registro" title="" style="cursor:pointer;"
                                             onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                             placeholder="123456789">
                                     </div>
                                     <div class="form-group">
                                         <label for="id_genero" class="form-label">Sexo:</label>
                                         <select class="form-input" id="id_genero_rep" name="id_genero"></select>
                                     </div>
                                     <div class="form-group">
                                         <label for="celular" class="form-label">Celular:</label>
                                         <input type="text" class="form-input" id="celular_rep" name="celular"
                                             placeholder="Celular" title="Teléfono móvil"
                                             placeholder="+1 (555) 123-4567">
                                     </div>
                                     <div class="form-group">
                                         <label for="correo_registro" class="form-label">Correo Electrónico:</label>
                                         <input type="text" class="form-input" id="correo_registro_rep"
                                             name="correo_registro" placeholder="Correo Electrónico"
                                             title="@example.com">
                                     </div>
                                     <!-- Clave-->
                                     <div class="form-group">
                                         <label for="clave_registro" class="form-label">Clave:</label>
                                         <input type="password" class="form-input" id="clave_registro_rep" name="clave"
                                             title="Clave">
                                     </div>
                                     <div class="modal-footer">
                                         <button type="submit" class="create-button"
                                             id='btnGuardarEmpresa' name='btnGuardar'>Registrar</button>
                                         <button type="reset" class="close-button"
                                             data-bs-dismiss="modal">Cancelar</button>
                                     </div>
                                 </div>
                             </div>


            </div>

        </div>
    </div>


</body>
<!-- MODAL CAMBIO CONTRASEÑA -->


</html>

