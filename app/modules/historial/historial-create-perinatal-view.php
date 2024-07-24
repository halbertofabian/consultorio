<?php
ComponentesControlador::getBreadCrumb('pacientes', 'Pacientes', 'Historia clínica perinatal');
$pte_id = $rutas[2];
$pte = PacientesModelo::mdlMostrarPacientesById(base64_decode($pte_id));
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
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h4 class="card-title">Historia clínica perinatal para <?= ComponentesControlador::obtenerNombrePaciente(base64_decode($pte_id)) ?></h4>
                    </div>
                    <div class="col-md-6 col-12 btnPdfHistorial d-none">
                        <button type="button" class="btn btn-dark float-end btnMostrarPdfHistorial">
                            <i class="fa fa-file-pdf"></i> PDF
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="formGuardarHistoriaClinicaPerinatal" class="row g-3">
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Medico realiza:</label>
                        <input type="hidden" name="hclp_id" id="hclp_id">
                        <input type="hidden" name="hclp_pte_id" id="hclp_pte_id" value="<?= base64_decode($pte_id) ?>">
                        <input type="hidden" name="hclp_usr_id" id="hclp_usr_id" value="<?= $_SESSION['usr']['usr_id'] ?>">
                        <input type="text" class="form-control" name="" id="" value="<?= $_SESSION['usr']['usr_nombre'] ?>" readonly />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="hclp_fecha_valoracion" class="form-label"><?= OBL ?> Fecha:</label>
                        <input type="date" class="form-control" name="hclp_fecha_valoracion" id="hclp_fecha_valoracion" required/>
                    </div>
                    <div class="col-12">
                        <label for="hclp_motivo" class="form-label"><?= OBL ?> Motivo del envio</label>
                        <textarea class="form-control" name="hclp_motivo" id="hclp_motivo" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>I. ANTECEDENTES HEREDOFAMILIARES</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_hemotipo" class="form-label">Hemotipo:</label>
                        <input type="text" class="form-control" name="pte_hemotipo" id="pte_hemotipo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_cgdm" class="form-label">Cgdm:</label>
                        <input type="text" class="form-control" name="pte_cgdm" id="pte_cgdm" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_consanguineos" class="form-label">Consanguineos:</label>
                        <input type="text" class="form-control" name="pte_consanguineos" id="pte_consanguineos" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ant_geneticos" class="form-label">Antecedentes geneticos:</label>
                        <input type="text" class="form-control" name="pte_ant_geneticos" id="pte_ant_geneticos" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_fam_preclampsia" class="form-label">Familiar preclampsia:</label>
                        <input type="text" class="form-control" name="pte_fam_preclampsia" id="pte_fam_preclampsia" />
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>II. ANTECENDENTES PAREJA</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="pte_nombre" id="pte_nombre" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_edad" class="form-label">Edad:</label>
                        <input type="text" class="form-control" name="pte_edad" id="pte_edad" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_app" class="form-label">App:</label>
                        <input type="text" class="form-control" name="pte_app" id="pte_app" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ant_geneticos_defectos" class="form-label">A. geneticos y/o defectos:</label>
                        <input type="text" class="form-control" name="pte_ant_geneticos_defectos" id="pte_ant_geneticos_defectos" />
                    </div>
                    <div class="col-12">
                        <label for="pte_ant_pareja_comentarios" class="form-label">Comentarios:</label>
                        <textarea class="form-control" name="pte_ant_pareja_comentarios" id="pte_ant_pareja_comentarios" rows="3"></textarea>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>III. Antecedentes Personales No Patológicos</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_toxicomanias" class="form-label">Toxicomanias:</label>
                        <input type="text" class="form-control" name="pte_toxicomanias" id="pte_toxicomanias" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_farmacos" class="form-label">Farmacos:</label>
                        <input type="text" class="form-control" name="pte_farmacos" id="pte_farmacos" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ocupacion" class="form-label">Ocupación:</label>
                        <input type="text" class="form-control" name="pte_ocupacion" id="pte_ocupacion" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_exposiciones" class="form-label">Exposiciones:</label>
                        <input type="text" class="form-control" name="pte_exposiciones" id="pte_exposiciones" />
                    </div>
                    <div class="col-12">
                        <label for="pte_ant_no_patologicos_comentarios" class="form-label">Comentarios:</label>
                        <textarea class="form-control" name="pte_ant_no_patologicos_comentarios" id="pte_ant_no_patologicos_comentarios" rows="3"></textarea>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>IV. Antecedentes personales patológicos</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_cronico_degenerativo" class="form-label">Crónico-degenerativo:</label>
                        <input type="text" class="form-control" name="pte_cronico_degenerativo" id="pte_cronico_degenerativo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_cirugias" class="form-label">Cirugías:</label>
                        <input type="text" class="form-control" name="pte_cirugias" id="pte_cirugias" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ant_sx_down" class="form-label">Antecedentes de hijo con Sx down:</label>
                        <input type="text" class="form-control" name="pte_ant_sx_down" id="pte_ant_sx_down" />
                    </div>
                    <div class="col-12">
                        <label for="pte_ant_patologicos_comentarios" class="form-label">Comentarios:</label>
                        <textarea class="form-control" name="pte_ant_patologicos_comentarios" id="pte_ant_patologicos_comentarios" rows="3"></textarea>
                    </div>

                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>V. Antecedentes gineco-obstetricos</strong>
                        </div>
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_g" class="form-label">G:</label>
                        <input type="text" class="form-control" name="pte_g" id="pte_g" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_p" class="form-label">P:</label>
                        <input type="text" class="form-control" name="pte_p" id="pte_p" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_c" class="form-label">C:</label>
                        <input type="text" class="form-control" name="pte_c" id="pte_c" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_a" class="form-label">A:</label>
                        <input type="text" class="form-control" name="pte_a" id="pte_a" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_e" class="form-label">E:</label>
                        <input type="text" class="form-control" name="pte_e" id="pte_e" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_m" class="form-label">M:</label>
                        <input type="text" class="form-control" name="pte_m" id="pte_m" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_fum" class="form-label">FUM:</label>
                        <input type="text" class="form-control" name="pte_fum" id="pte_fum" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_sdg" class="form-label">SDG:</label>
                        <input type="text" class="form-control" name="pte_sdg" id="pte_sdg" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_fpp" class="form-label">FPP:</label>
                        <input type="text" class="form-control" name="pte_fpp" id="pte_fpp" />
                    </div>
                    <!-- ////////////////// -->
                    <div class="col-12"></div>
                    <div class="col-md-3 col-12">
                        <label for="pte_año" class="form-label">Año:</label>
                        <input type="text" class="form-control" name="pte_año" id="pte_año" />
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="pte_resolucion" class="form-label">Resolución:</label>
                        <input type="text" class="form-control" name="pte_resolucion" id="pte_resolucion" />
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="pte_sdg2" class="form-label">SDG:</label>
                        <input type="text" class="form-control" name="pte_sdg2" id="pte_sdg2" />
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="pte_sexo" class="form-label">Sexo:</label>
                        <input type="text" class="form-control" name="pte_sexo" id="pte_sexo" />
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="pte_peso" class="form-label">Peso:</label>
                        <input type="text" class="form-control" name="pte_peso" id="pte_peso" />
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="pte_sano" class="form-label">Sano:</label>
                        <input type="text" class="form-control" name="pte_sano" id="pte_sano" />
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="pte_complicacion" class="form-label">Complicación:</label>
                        <input type="text" class="form-control" name="pte_complicacion" id="pte_complicacion" />
                    </div>
                    <div class="col-md-3 col-12">
                        <label for="pte_observacion" class="form-label">Observación:</label>
                        <input type="text" class="form-control" name="pte_observacion" id="pte_observacion" />
                    </div>

                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>VI. Padecimiento actual</strong>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <textarea class="form-control" name="pte_padecimiento_actual" id="pte_padecimiento_actual" rows="3"></textarea>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>VII. Embarazo actual</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_logrado" class="form-label">Logrado:</label>
                        <input type="text" class="form-control" name="pte_logrado" id="pte_logrado" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_embarazo" class="form-label">Embarazo:</label>
                        <input type="text" class="form-control" name="pte_embarazo" id="pte_embarazo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ta" class="form-label">TA:</label>
                        <input type="text" class="form-control" name="pte_ta" id="pte_ta" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_peso2" class="form-label">Peso:</label>
                        <input type="text" class="form-control" name="pte_peso2" id="pte_peso2" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_talla" class="form-label">Talla:</label>
                        <input type="text" class="form-control" name="pte_talla" id="pte_talla" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_imc" class="form-label">IMC:</label>
                        <input type="text" class="form-control" name="pte_imc" id="pte_imc" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_raza" class="form-label">Raza:</label>
                        <input type="text" class="form-control" name="pte_raza" id="pte_raza" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_donacion_ovulos" class="form-label">Donación ovulos:</label>
                        <input type="text" class="form-control" name="pte_donacion_ovulos" id="pte_donacion_ovulos" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_fecha_nacimiento_donador" class="form-label">Fecha nacimiento donador:</label>
                        <input type="date" class="form-control" name="pte_fecha_nacimiento_donador" id="pte_fecha_nacimiento_donador" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_edad_donador" class="form-label">Edad donador:</label>
                        <input type="text" class="form-control" name="pte_edad_donador" id="pte_edad_donador" />
                    </div>
                    <div class="col-md-12 col-12">
                        <button type="submit" class="btn btn-primary float-end" id="btnGuardarHistorial">
                            Guardar
                        </button>
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
            url: '<?= HTTP_HOST ?>' + 'api/v1/historial-perinetal/get?hclp_pte_id=<?= $pte_id ?>',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                if (res) {
                    console.log(res)
                    $("#hclp_id").val(res.hclp_id);
                    $("#hclp_fecha_valoracion").val(res.hclp_fecha_valoracion);
                    $("#hclp_motivo").val(res.hclp_motivo);

                    var hclp_ant_heredofamiliares = JSON.parse(res.hclp_ant_heredofamiliares);
                    $("#pte_hemotipo").val(hclp_ant_heredofamiliares.pte_hemotipo);
                    $("#pte_cgdm").val(hclp_ant_heredofamiliares.pte_cgdm);
                    $("#pte_consanguineos").val(hclp_ant_heredofamiliares.pte_consanguineos);
                    $("#pte_ant_geneticos").val(hclp_ant_heredofamiliares.pte_ant_geneticos);
                    $("#pte_fam_preclampsia").val(hclp_ant_heredofamiliares.pte_fam_preclampsia);

                    var hclp_ant_pareja = JSON.parse(res.hclp_ant_pareja);
                    $("#pte_nombre").val(hclp_ant_pareja.pte_nombre);
                    $("#pte_edad").val(hclp_ant_pareja.pte_edad);
                    $("#pte_app").val(hclp_ant_pareja.pte_app);
                    $("#pte_ant_geneticos_defectos").val(hclp_ant_pareja.pte_ant_geneticos_defectos);
                    $("#pte_ant_pareja_comentarios").val(hclp_ant_pareja.pte_ant_pareja_comentarios);

                    var hclp_ant_pers_no_patologicos = JSON.parse(res.hclp_ant_pers_no_patologicos);
                    $("#pte_toxicomanias").val(hclp_ant_pers_no_patologicos.pte_toxicomanias);
                    $("#pte_farmacos").val(hclp_ant_pers_no_patologicos.pte_farmacos);
                    $("#pte_ocupacion").val(hclp_ant_pers_no_patologicos.pte_ocupacion);
                    $("#pte_exposiciones").val(hclp_ant_pers_no_patologicos.pte_exposiciones);
                    $("#pte_ant_no_patologicos_comentarios").val(hclp_ant_pers_no_patologicos.pte_ant_no_patologicos_comentarios);

                    var hclp_ant_pers_patologicos = JSON.parse(res.hclp_ant_pers_patologicos);
                    $("#pte_cronico_degenerativo").val(hclp_ant_pers_patologicos.pte_cronico_degenerativo);
                    $("#pte_cirugias").val(hclp_ant_pers_patologicos.pte_cirugias);
                    $("#pte_ant_sx_down").val(hclp_ant_pers_patologicos.pte_ant_sx_down);
                    $("#pte_ant_patologicos_comentarios").val(hclp_ant_pers_patologicos.pte_ant_patologicos_comentarios);

                    var hclp_ant_gineco_obstetricos = JSON.parse(res.hclp_ant_gineco_obstetricos);
                    $("#pte_g").val(hclp_ant_gineco_obstetricos.pte_g);
                    $("#pte_p").val(hclp_ant_gineco_obstetricos.pte_p);
                    $("#pte_c").val(hclp_ant_gineco_obstetricos.pte_c);
                    $("#pte_a").val(hclp_ant_gineco_obstetricos.pte_a);
                    $("#pte_e").val(hclp_ant_gineco_obstetricos.pte_e);
                    $("#pte_m").val(hclp_ant_gineco_obstetricos.pte_m);
                    $("#pte_fum").val(hclp_ant_gineco_obstetricos.pte_fum);
                    $("#pte_sdg").val(hclp_ant_gineco_obstetricos.pte_sdg);
                    $("#pte_fpp").val(hclp_ant_gineco_obstetricos.pte_fpp);
                    $("#pte_año").val(hclp_ant_gineco_obstetricos.pte_año);
                    $("#pte_resolucion").val(hclp_ant_gineco_obstetricos.pte_resolucion);
                    $("#pte_sdg2").val(hclp_ant_gineco_obstetricos.pte_sdg2);
                    $("#pte_sexo").val(hclp_ant_gineco_obstetricos.pte_sexo);
                    $("#pte_peso").val(hclp_ant_gineco_obstetricos.pte_peso);
                    $("#pte_sano").val(hclp_ant_gineco_obstetricos.pte_sano);
                    $("#pte_complicacion").val(hclp_ant_gineco_obstetricos.pte_complicacion);
                    $("#pte_observacion").val(hclp_ant_gineco_obstetricos.pte_observacion);

                    $("#pte_padecimiento_actual").val(res.hclp_pedecimiento_actual);

                    var hclp_embarazo_actual = JSON.parse(res.hclp_embarazo_actual);
                    $("#pte_logrado").val(hclp_embarazo_actual.pte_logrado);
                    $("#pte_embarazo").val(hclp_embarazo_actual.pte_embarazo);
                    $("#pte_ta").val(hclp_embarazo_actual.pte_ta);
                    $("#pte_peso2").val(hclp_embarazo_actual.pte_peso2);
                    $("#pte_talla").val(hclp_embarazo_actual.pte_talla);
                    $("#pte_imc").val(hclp_embarazo_actual.pte_imc);
                    $("#pte_raza").val(hclp_embarazo_actual.pte_raza);
                    $("#pte_donacion_ovulos").val(hclp_embarazo_actual.pte_donacion_ovulos);
                    $("#pte_fecha_nacimiento_donador").val(hclp_embarazo_actual.pte_fecha_nacimiento_donador);
                    $("#pte_edad_donador").val(hclp_embarazo_actual.pte_edad_donador);

                    
                    $("#btnGuardarHistorial").text('Actualizar');
                    $(".btnPdfHistorial").removeClass('d-none');


                }
            }
        });
    }
    $('#formGuardarHistoriaClinicaPerinatal').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        datos.append('btnGuardarHistoriaClinica', true);
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/historial/create/perinatal',
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
                        location.reload();
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });


    $(document).on('click', '.btnMostrarPdfHistorial', function() {
        var hclp_id = $("#hclp_id").val();
        window.open('<?= HTTP_HOST ?>' + `app/report/reporte-historial-perinatal.php?hclp_id=${hclp_id}`, '_blank');
    });
</script>