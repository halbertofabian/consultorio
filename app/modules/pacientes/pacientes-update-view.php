<?php
ComponentesControlador::getBreadCrumb('pacientes', 'Pacientes', 'Editar paciente');
$pte_id = $rutas[2];
?>

<style>
    input[readonly] {
        background-color: #f8f9fa;
        /* Color gris por defecto de Bootstrap */
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar paciente</h4>
                <form id="formActualizarPaciente">
                    <div class="row g-3">
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_nombres" class="form-label"><?= OBL ?> Nombre(s)</label>
                            <input type="hidden" name="pte_id" id="pte_id">
                            <input type="text" class="form-control text-uppercase generar-curp" name="pte_nombres" id="pte_nombres" placeholder="" required/>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_ap_paterno" class="form-label"><?= OBL ?> Apellido paterno</label>
                            <input type="text" class="form-control text-uppercase generar-curp" name="pte_ap_paterno" id="pte_ap_paterno" placeholder="" required/>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_ap_materno" class="form-label"><?= OBL ?> Apellido materno</label>
                            <input type="text" class="form-control text-uppercase generar-curp" name="pte_ap_materno" id="pte_ap_materno" placeholder="" required/>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_fecha_nacimiento" class="form-label"><?= OBL ?> Fecha de nacimiento</label>
                            <input type="date" class="form-control generar-curp" name="pte_fecha_nacimiento" id="pte_fecha_nacimiento" placeholder="" required/>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_edad" class="form-label"><?= OBL ?> Edad</label>
                            <input type="text" class="form-control" name="pte_edad" id="pte_edad" placeholder="" required/>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="" class="form-label">Sexo</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pte_sexo" id="masculino" value="Masculino">
                                <label class="form-check-label" for="masculino">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pte_sexo" id="femenino" value="Femenino">
                                <label class="form-check-label" for="femenino">Femenino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pte_sexo" id="otro" value="Otro">
                                <label class="form-check-label" for="otro">Otro</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_pais_nacimiento" class="form-label">País de nacimiento</label>
                            <select class="form-select" name="pte_pais_nacimiento" id="pte_pais_nacimiento">
                                <option value="">-Seleccionar-</option>
                                <?php
                                $paises = ComponentesControlador::getPaises();
                                foreach ($paises as $pais) : ?>
                                    <option value="<?= $pais ?>"><?= $pais ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_estado_nacimiento" class="form-label">Estado de nacimiento</label>
                            <select class="form-select generar-curp" name="pte_estado_nacimiento" id="pte_estado_nacimiento">
                                <option value="">-Seleccionar-</option>
                                <?php
                                $estados = ComponentesControlador::getEstados();
                                foreach ($estados as $estado) : ?>
                                    <option value="<?= $estado ?>"><?= $estado ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_nacionalidad" class="form-label">Nacionalidad</label>
                            <select class="form-select" name="pte_nacionalidad" id="pte_nacionalidad">
                                <option value="">-Seleccionar-</option>
                                <?php
                                $nacionalidades = ComponentesControlador::getNacionalidad();
                                foreach ($nacionalidades as $nacionalidad) : ?>
                                    <option value="<?= $nacionalidad ?>"><?= $nacionalidad ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control text-uppercase" name="pte_rfc" id="pte_rfc" placeholder="" />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_curp" class="form-label">CURP</label>
                            <input type="text" class="form-control text-uppercase" name="pte_curp" id="pte_curp" placeholder="" />
                        </div>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-xl-12 col-md-6 col-12">
                            <label for="pte_codigo_postal">Código postal</label>
                            <input type="text" name="pte_codigo_postal" id="pte_codigo_postal" class="form-control w-lg-25" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted"> <a class="float-right" target="_blank" href="https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/Descarga.aspx">No sé mi código</a> </small>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_estado">Estado</label>
                            <input type="text" name="pte_estado" id="pte_estado" class="form-control" placeholder="" readonly>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_delegacion_municipio">Delegación / Municipio </label>
                            <input type="text" name="pte_delegacion_municipio" id="pte_delegacion_municipio" class="form-control" placeholder="" readonly>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_colonia">Colonia / Asentamiento</label>
                            <select class="form-control select2" name="pte_colonia" id="pte_colonia">
                                <option value="">Selecciona tu Colonia</option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_calle">Calle </label>
                            <input type="text" name="pte_calle" id="pte_calle" class="form-control" placeholder="">
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_no_exterior">Nº exterior </label>
                            <input type="text" name="pte_no_exterior" id="pte_no_exterior" class="form-control" placeholder="">
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_no_interior">Nº interior / Depto </label>
                            <input type="text" name="pte_no_interior" id="pte_no_interior" class="form-control" placeholder="Opcional">
                        </div>

                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_telefono_fijo" class="form-label">Telefono fijo</label>
                            <input type="number" class="form-control" name="pte_telefono_fijo" id="pte_telefono_fijo" aria-describedby="helpId" placeholder="" />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_telefono_celular" class="form-label">Telefono celular</label>
                            <input type="number" class="form-control" name="pte_telefono_celular" id="pte_telefono_celular" aria-describedby="helpId" placeholder="" />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_correo" class="form-label">Correo electronico</label>
                            <input type="email" class="form-control" name="pte_correo" id="pte_correo" placeholder="" />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_tipo_sangre" class="form-label">Tipo de sangre</label>
                            <select class="form-select" name="pte_tipo_sangre" id="pte_tipo_sangre">
                                <option value="">-Seleccionar-</option>
                                <?php
                                $tipo_sangre = ComponentesControlador::getTiposSangre();
                                foreach ($tipo_sangre as $key => $tipo) : ?>
                                    <option value="<?= $key ?>"><?= $key ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_estado_civil" class="form-label">Estado civil</label>
                            <select class="form-select" name="pte_estado_civil" id="pte_estado_civil">
                                <option value="">-Seleccionar-</option>
                                <?php
                                $estado_civil = ComponentesControlador::getEstadosCiviles();
                                foreach ($estado_civil as $estado) : ?>
                                    <option value="<?= $estado ?>"><?= $estado ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_imss" class="form-label">IMSS</label>
                            <input type="text" class="form-control" name="pte_imss" id="pte_imss" placeholder="" />
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_alergias" class="form-label">Alergias</label>
                            <input type="text" class="form-control" name="pte_alergias" id="pte_alergias" placeholder="" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-end">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        cargarDatos();
    })

    function cargarDatos() {
        $.ajax({
            type: 'GET',
            url: '<?= HTTP_HOST ?>' + 'api/v1/pacientes/get?pte_id=<?= $pte_id ?>',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $("#pte_id").val(res.pte_id);
                $("#pte_nombres").val(res.pte_nombres);
                $("#pte_ap_paterno").val(res.pte_ap_paterno);
                $("#pte_ap_materno").val(res.pte_ap_materno);
                $("#pte_fecha_nacimiento").val(res.pte_fecha_nacimiento);
                $("#pte_fecha_nacimiento").change();

                $("input[name='pte_sexo'][value='" + res.pte_sexo + "']").prop('checked', true);
                $("#pte_pais_nacimiento").val(res.pte_pais_nacimiento);
                $("#pte_estado_nacimiento").val(res.pte_estado_nacimiento);
                $("#pte_nacionalidad").val(res.pte_nacionalidad);
                $("#pte_rfc").val(res.pte_rfc);
                $("#pte_curp").val(res.pte_curp);
                $("#pte_codigo_postal").val(res.pte_codigo_postal);
                $("#pte_estado").val(res.pte_estado);
                $("#pte_delegacion_municipio").val(res.pte_delegacion_municipio);
                if (res.pte_codigo_postal !== null && res.pte_codigo_postal != "") {
                    $("#pte_codigo_postal").change();
                    setTimeout(() => {
                        $("#pte_colonia").val(res.pte_colonia);
                    }, 1000);
                }
                $("#pte_calle").val(res.pte_calle);
                $("#pte_no_exterior").val(res.pte_no_exterior);
                $("#pte_no_interior").val(res.pte_no_interior);
                $("#pte_telefono_fijo").val(res.pte_telefono_fijo);
                $("#pte_telefono_celular").val(res.pte_telefono_celular);
                $("#pte_correo").val(res.pte_correo);
                $("#pte_tipo_sangre").val(res.pte_tipo_sangre);
                $("#pte_estado_civil").val(res.pte_estado_civil);
                $("#pte_imss").val(res.pte_imss);
                $("#pte_alergias").val(res.pte_alergias);
            }
        });
    }

    $('#pte_fecha_nacimiento').change(function() {
        var fechaNacimiento = new Date($(this).val());
        var hoy = new Date();
        var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        var mes = hoy.getMonth() - fechaNacimiento.getMonth();

        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
            edad--;
        }

        $('#pte_edad').val(edad + ' años');
    });

    $("#pte_codigo_postal").on("change", function() {
        var codigo = $(this).val();
        if (codigo == "") {
            return;
        }
        $('#pte_colonia option').remove();
        $.ajax({
            type: "GET",
            url: 'https://app.tallercontrol.com/api/public/codigos_postales/codigo/' + codigo,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res)
                res.forEach(element => {
                    $("#pte_estado").val(element.cp_estado);
                    $("#pte_delegacion_municipio").val(element.cp_municipio);
                    $("#pte_colonia").append(`<option value="${element.cp_asentamiento}">${element.cp_asentamiento}</option>`);
                });

            }
        });
    });

    $('.generar-curp').change(function() {
        var nombre = $('#pte_ap_paterno').val() + ' ' + $('#pte_ap_materno').val() + ' ' + $('#pte_nombres').val();
        var datos = new FormData();
        datos.append('nombre', nombre.replace(/\s+/g, " "));
        datos.append('fecha_nacimiento', $('#pte_fecha_nacimiento').val());
        datos.append('sexo', $("input[name='pte_sexo']:checked").val());
        datos.append('estado', $('#pte_estado_nacimiento').val());
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/pacientes/get-curp',
            data: datos,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res);
                $("#pte_rfc").val(res.rfc);
                $("#pte_curp").val(res.curp);
            }
        });
    });

    $('#formActualizarPaciente').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/pacientes/update',
            data: datos,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    swal({
                        title: '¡Bien!',
                        text: res.mensaje,
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = '<?= HTTP_HOST ?>' + 'pacientes/list';
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>