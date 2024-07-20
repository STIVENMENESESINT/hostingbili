<?php
$varDateTime = date("Y-m-d H:i:s");
?>

<!DOCTYPE html>
<html>
<head>
    <?php
        include_once('archivos/vista/cabecera.php');
    ?>
    <script type='text/javascript' src="herramientas/js/index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="herramientas/css/index.css">
</head>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Inicio de Sesión
            </h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label> Identificación: </label>
                <div class="input-with-icon">
                    <i class="fas fa-id-card identificacion-icon"></i>
                    <input type="text" class="form-control" id="numeroiden" name="numeroiden"
                        title='Ingrese solo números' placeholder="123456789" style='cursor:pointer;'
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>
            <div class="form-group">
                <label> Correo: </label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope correo-icon"></i>
                    <input type="email" class="form-control" id="correo" name="correo" title='' placeholder=" usuario@soysena.edu.co" style='cursor:pointer;'>
                </div>
            </div>
            <div class="form-group">
                <label> Clave: </label>
                <div class="input-with-icon">
                    <i class="fas fa-lock clave-icon"></i>
                    <input type="password" class="form-control" id="clave" name="clave" title='' placeholder="********" style='cursor:pointer;'>
                </div>
            </div>
            <div class="form-group form-check form-switch">
                <input class="form-check-input" type="checkbox" id="exampleSwitch">
                <label class="form-check-label" for="exampleSwitch">Recordar clave</label>
            </div>
            <div class="card-footer" style="background-color: #c8e6c9;">
                <button type="button" id="btnEntrar" name="btnEntrar" class="btn btn-success w-100 d-block mx-auto mb-3">
                    Ingresar
                </button>
                <span class="no-account">¿No tiene una cuenta?</span>
                <span id="registerLink" class="register-link" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#registroUsuario">Regístrate ahora</span>
                <a href="#" id='linkOlvideClave' class="btn btn-link olvide-clave-link" data-bs-toggle="modal" data-bs-target="#RestablecerContraseña">¿Olvidó su contraseña?</a>
                <p id="footerText" class="footer-text">© SENA Centro Agropecuario Regional Cauca </p>
            </div>
        </div>
    </div>
    </center>
</body>

</section>
<div class="modal fade" id="registroUsuario">
    <div class="modal-dialog modal-sl modal-dialog-scrollable">
        <div class="modal-content">
            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Usuario </h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="addNewForm" id="addNewForm" value="yes" onclick="FormEmpresa()">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Empresa </h5>
                </div>
            </div>
            <body>
                <!-- Cuerpo del diálogo -->
                <div class="modal-body">
                    <!-- FORMULARIO DE EMPRESA -->
                    <div id="formEmpresa" style="display: none;">
                        <div class="form-container">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre de la Empresa</label>
                                <input type="text" id="nombre_empresa" name="nombre" class="form-input" >
                            </div>
                            <div class="form-group">
                                <label for="nit" class="form-label">NIT</label>
                                <input type="text" id="numeroiden_empresa" name="numeroiden_empresa" class="form-input" >
                            </div>
                            <div class="form-group">
                                <label  class="form-label">Contacto Empresa</label>
                                <input type="tel" id="telefono_empresa"  class="form-input" >
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" id="correo_empresa" name="correo_empresa" class="form-input" >
                            </div>
                            <hr>
                            <!-- REPRESENTANTE LEGAL -->
                            <div class="form-group">
                                <h3 for="representante" class="form-label"> <strong>Representante Legal</strong></h3>
                            </div>
                            <!-- Nombres y Apellidos -->
                            <div class="form-group">
                                <label for="nameusu" class="form-label">Primer Nombre:</label>
                                <input type="text" class="form-input" id="nameusu_rep" name="nameusu" title="Primer Nombre" style="cursor:pointer;">
                            </div>
                            <div class="form-group">
                                <label for="nombre_dos" class="form-label">Segundo Nombre:</label>
                                <input type="text" class="form-input" id="nombre_dos_rep" name="nombre_dos" title="Segundo Nombre">
                            </div>
                            <div class="form-group">
                                <label for="apellidoUsu" class="form-label">Primer Apellido:</label>
                                <input type="text" class="form-input" id="apellidoUsu_rep" name="apellidoUsu" title="Primer Apellido">
                            </div>
                            <div class="form-group">
                                <label for="apellidoUsu_dos" class="form-label">Segundo Apellido:</label>
                                <input type="text" class="form-input" id="apellidoUsu_dos_rep" name="apellidoUsu_dos" title="Segundo Apellido">
                            </div>
                            <div class="form-group">
                                <label for="id_tpdoc" class="form-label">Tipo de Documento:</label>
                                <select class="form-input" id="id_tpdoc_rep" name="id_tpdoc" title="Tipo de Documento"></select>
                            </div>

                            <!-- Número de Documento -->
                            <div class="form-group">
                                <label for="numeroiden_registro" class="form-label">Número Documento:</label>
                                <input type="text" class="form-input" id="numeroiden_registro_rep" name="numeroiden_registro" title="" style="cursor:pointer;" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                            </div>
                            <div class="form-group">
                                <label for="id_genero" class="form-label">Sexo:</label>
                                <select class="form-input" id="id_genero_rep" name="id_genero"></select>
                            </div>
                            <div class="form-group">
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" class="form-input" id="celular_rep" name="celular" placeholder="Celular" title="Teléfono móvil">
                            </div>
                            <div class="form-group">
                                <label for="correo_registro" class="form-label">Correo Electrónico:</label>
                                <input type="text" class="form-input" id="correo_registro_rep" name="correo_registro" placeholder="Correo Electrónico" title="@example.com">
                            </div>
                            <!-- Clave-->
                            <div class="form-group">
                                <label for="clave_registro" class="form-label">Clave:</label>
                                <input type="password" class="form-input" id="clave_registro_rep" name="clave" title="Clave">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-button form-button-submit" id='btnGuardarEmpresa'
                                name='btnGuardar'>Registrar</button>
                                <button type="reset" class="form-button form-button-reset" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    <!-- FORMULARIO USUARIOS -->
                    <div id="formRegisUsu">
                    <div class="form-group">
                                <label for="nameusu" class="form-label">Primer Nombre:</label>
                                <input type="text" class="form-input" id="nameusu" name="nameusu" title="Primer Nombre" style="cursor:pointer;">
                            </div>

                            <div class="form-group">
                                <label for="nombre_dos" class="form-label">Segundo Nombre:</label>
                                <input type="text" class="form-input" id="nombre_dos" name="nombre_dos" title="Segundo Nombre">
                            </div>

                            <div class="form-group">
                                <label for="apellidoUsu" class="form-label">Primer Apellido:</label>
                                <input type="text" class="form-input" id="apellidoUsu" name="apellidoUsu" title="Primer Apellido">
                            </div>

                            <div class="form-group">
                                <label for="apellidoUsu_dos" class="form-label">Segundo Apellido:</label>
                                <input type="text" class="form-input" id="apellidoUsu_dos" name="apellidoUsu_dos" title="Segundo Apellido">
                            </div>
                            <div class="form-group">
                                <label for="id_tpdoc" class="form-label">Tipo de Documento:</label>
                                <select class="form-input" id="id_tpdoc" name="id_tpdoc" title="Tipo de Documento"></select>
                            </div>

                            <!-- Número de Documento -->
                            <div class="form-group">
                                <label for="numeroiden_registro" class="form-label">Número Documento:</label>
                                <input type="text" class="form-input" id="numeroiden_registro" name="numeroiden_registro" title="" style="cursor:pointer;" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                            </div>
                            <div class="form-group">
                                <label  class="form-label">Sexo:</label>
                                <select class="form-input" id="id_genero" name="id_genero"></select>
                            </div>
                            <div class="form-group">
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" class="form-input" id="celular" name="celular" placeholder="Celular" title="Teléfono móvil">
                            </div>
                            <div class="form-group">
                                <label for="correo_registro" class="form-label">Correo Electrónico:</label>
                                <input type="text" class="form-input" id="correo_registro" name="correo_registro" placeholder="Correo Electrónico" title="@example.com">
                            </div>
                            <!-- Departamento, Municipio y Poblado -->
                            <div class="form-group">
                                <label for="cod_dpto" class="form-label">Departamento:</label>
                                <select class="form-input" id="cod_dpto" name="cod_dpto" title="Departamento" style="cursor:pointer;"></select>
                            </div>

                            <div class="form-group">
                                <label for="cod_municipio" class="form-label">Municipio:</label>
                                <select class="form-input" id="cod_municipio" name="cod_municipio" title="Municipio" style="cursor:pointer;"></select>
                            </div>

                            <div class="form-group">
                                <label for="cod_poblado" class="form-label">Poblado:</label>
                                <select class="form-input" id="cod_poblado" name="cod_poblado" title="Poblado" style="cursor:pointer;"></select>
                            </div>
                            <div class="form-group">
                                <label for="clave_registro" class="form-label">Clave:</label>
                                <input type="password" class="form-input" id="clave_registro_rep" name="clave" title="Clave">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-button form-button-submit" id="btnGuardar" name="btnGuardar">Registrar</button>
                                <button type="reset" class="form-button form-button-reset" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>


<!-- Restablecer contraseña -->
<div class="modal fade" id="RestablecerContraseña">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restablecer contraseña</h5> 
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label> Identificación: </label>
                    <div class="input-with-icon">
                        <i class="fas fa-id-card identificacion-icon"></i>
                        <input type="text" class="form-control" id="numeroiden" name="numeroiden"
                            title='Ingrese solo números' placeholder="123456789" style='cursor:pointer;'
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </div>
                <div class="form-group">
                    <label> Correo: </label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope correo-icon"></i>
                        <input type="email" class="form-control" id="correo" name="correo" title=''
                            placeholder="usuario@soysena.edu.co" style='cursor:pointer;'>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id='btnRecordar'
                    name='btnRecordar'>Recordar</button> <!-- Botón de recordar contraseña -->
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id='btnCancelar'
                    name='btnCancelar'>Cancelar</button> <!-- Botón de cancelar -->
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
</script> <!-- Script de Bootstrap -->



</body>

</html>