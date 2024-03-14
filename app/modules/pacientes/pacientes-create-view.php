<?php
ComponentesControlador::getBreadCrumb('pacientes', 'Pacientes', 'Nuevo paciente');
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
                <h4 class="card-title">Nuevo paciente</h4>
                <form id="formGuardarPaciente">
                    <div class="row g-3">
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_nombres" class="form-label"><?= OBL ?> Nombre(s)</label>
                            <input type="text" class="form-control text-uppercase generar-curp" name="pte_nombres" id="pte_nombres" placeholder="" required required />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_ap_paterno" class="form-label"><?= OBL ?> Apellido paterno</label>
                            <input type="text" class="form-control text-uppercase generar-curp" name="pte_ap_paterno" id="pte_ap_paterno" placeholder="" required required />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_ap_materno" class="form-label"><?= OBL ?> Apellido materno</label>
                            <input type="text" class="form-control text-uppercase generar-curp" name="pte_ap_materno" id="pte_ap_materno" placeholder="" required />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_fecha_nacimiento" class="form-label"><?= OBL ?> Fecha de nacimiento</label>
                            <input type="date" class="form-control generar-curp" name="pte_fecha_nacimiento" id="pte_fecha_nacimiento" placeholder="" required />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_edad" class="form-label"><?= OBL ?> Edad</label>
                            <input type="text" class="form-control" name="pte_edad" id="pte_edad" placeholder="" required />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="" class="form-label"><?= OBL ?> Sexo</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pte_sexo" id="masculino" value="Masculino" required>
                                <label class="form-check-label" for="masculino">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pte_sexo" id="femenino" value="Femenino" required>
                                <label class="form-check-label" for="femenino">Femenino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pte_sexo" id="otro" value="Otro" required>
                                <label class="form-check-label" for="otro">Otro</label>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_pais_nacimiento" class="form-label"><?= OBL ?> País de nacimiento</label>
                            <select class="form-select" name="pte_pais_nacimiento" id="" required>
                                <option value="">-Seleccionar-</option>
                                <?php
                                $paises = ComponentesControlador::getPaises();
                                foreach ($paises as $pais) : ?>
                                    <option value="<?= $pais ?>"><?= $pais ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_estado_nacimiento" class="form-label"><?= OBL ?> Estado de nacimiento</label>
                            <select class="form-select generar-curp" name="pte_estado_nacimiento" id="pte_estado_nacimiento" required>
                                <option value="">-Seleccionar-</option>
                                <?php
                                $estados = ComponentesControlador::getEstados();
                                foreach ($estados as $estado) : ?>
                                    <option value="<?= $estado ?>"><?= $estado ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_nacionalidad" class="form-label"><?= OBL ?> Nacionalidad</label>
                            <select class="form-select" name="pte_nacionalidad" id="" required>
                                <option value="">-Seleccionar-</option>
                                <?php
                                $nacionalidades = ComponentesControlador::getNacionalidad();
                                foreach ($nacionalidades as $nacionalidad) : ?>
                                    <option value="<?= $nacionalidad ?>"><?= $nacionalidad ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_rfc" class="form-label"><?= OBL ?> RFC</label>
                            <input type="text" class="form-control text-uppercase" name="pte_rfc" id="pte_rfc" placeholder="" required />
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <label for="pte_curp" class="form-label"><?= OBL ?> CURP</label>
                            <input type="text" class="form-control text-uppercase" name="pte_curp" id="pte_curp" placeholder="" required />
                        </div>
                    </div>
                    <hr>
                    <div class="row g-3">
                        <div class="col-xl-12 col-md-6 col-12">
                            <label for="pte_codigo_postal">Código postal</label>
                            <input type="text" name="pte_codigo_postal" id="pte_codigo_postal" class="form-control w-lg-25" placeholder="" aria-describedby="helpId" required>
                            <small id="helpId" class="text-muted"> <a class="float-right" target="_blank" href="https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/Descarga.aspx">No sé mi código</a> </small>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_estado">Estado</label>
                            <input type="text" name="pte_estado" id="pte_estado" class="form-control" placeholder="" required readonly>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_delegacion_municipio">Delegación / Municipio </label>
                            <input type="text" name="pte_delegacion_municipio" id="pte_delegacion_municipio" class="form-control" placeholder="" required readonly>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_colonia">Colonia / Asentamiento</label>
                            <select class="form-control select2" name="pte_colonia" id="pte_colonia" required>
                                <option value="">Selecciona tu Colonia</option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_calle">Calle </label>
                            <input type="text" name="pte_calle" id="pte_calle" class="form-control" placeholder="" required>
                        </div>
                        <div class="col-xl-6 col-md-6 col-12">
                            <label for="pte_no_exterior">Nº exterior </label>
                            <input type="text" name="pte_no_exterior" id="pte_no_exterior" class="form-control" placeholder="" required>
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
                            <button type="submit" class="btn btn-primary float-end">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
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

    $('.generar-curp').change(function() {
        var nombre = $('#pte_ap_paterno').val() + ' ' + $('#pte_ap_materno').val() + ' ' + $('#pte_nombres').val();
        var datos = new FormData();
        datos.append('nombre', nombre.replace(/\s+/g, " ").toUpperCase());
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

                $("#pte_curp").val(res)
            }
        });
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

    $('#formGuardarPaciente').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/pacientes/create',
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
                        // $(".ctr_id").val(res.ctr_id);
                        if ('<?= $_SESSION['usr']['usr_perfil'] ?>' === 'Doctor') {
                            window.location.href = '<?= HTTP_HOST ?>' + 'consultas/create/' + btoa(res.pte_id);
                        } else {
                            window.location.href = '<?= HTTP_HOST ?>' + 'pacientes/list';
                        }
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>