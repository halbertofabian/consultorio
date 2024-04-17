<?php
ComponentesControlador::getBreadCrumb('pacientes', 'Pacientes', 'Historia clínica');
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
                        <h4 class="card-title">Historia clínica para <?= ComponentesControlador::obtenerNombrePaciente(base64_decode($pte_id)) ?></h4>
                    </div>
                    <div class="col-md-6 col-12 btnPdfHistorial d-none">
                        <button type="button" class="btn btn-dark float-end btnMostrarPdfHistorial">
                            <i class="fa fa-file-pdf"></i> PDF
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="formGuardarHistoriaClinica" class="row g-3">
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Nombre del profesional de salud que presenta:</label>
                        <input type="hidden" name="hcl_id" id="hcl_id">
                        <input type="hidden" name="hcl_pte_id" id="hcl_pte_id" value="<?= base64_decode($pte_id) ?>">
                        <input type="hidden" name="hcl_usr_id" id="hcl_usr_id" value="<?= $_SESSION['usr']['usr_id'] ?>">
                        <input type="text" class="form-control" name="" id="" value="<?= $_SESSION['usr']['usr_nombre'] ?>" readonly />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="hcl_fecha_valoracion" class="form-label">Fecha valoración:</label>
                        <input type="date" class="form-control" name="hcl_fecha_valoracion" id="hcl_fecha_valoracion" />
                    </div>
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>I. Datos de identificación del paciente</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_no_identificacion" class="form-label">Número de identificación ECHO:</label>
                        <input type="text" class="form-control" name="pte_no_identificacion" id="pte_no_identificacion" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" name="pte_fecha_nacimiento" id="pte_fecha_nacimiento" value="<?= $pte['pte_fecha_nacimiento'] ?>" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_edad" class="form-label">Edad</label>
                        <input type="text" class="form-control" name="pte_edad" id="pte_edad" value="<?= $pte['pte_edad'] ?>" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="" class="form-label">Entidad de nacimiento</label>
                        <select class="form-select generar-curp selectpicker" name="pte_estado_nacimiento" id="pte_estado_nacimiento">
                            <option value="">-Seleccionar-</option>
                            <?php
                            $estados = ComponentesControlador::getEstados();
                            foreach ($estados as $estado) : ?>
                                <option value="<?= $estado ?>"><?= $estado ?></option>
                            <?php endforeach; ?>
                        </select>

                        <script>
                            var pte_estado_nacimiento = '<?= $pte['pte_estado_nacimiento'] ?>';
                            $("#pte_estado_nacimiento").val(pte_estado_nacimiento).trigger('change');
                        </script>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_estado_civil" class="form-label">Estado civil</label>
                        <select class="form-select" name="pte_estado_civil" id="pte_estado_civil">
                            <option value="">-Seleccionar-</option>
                            <?php
                            $estado_civil = ComponentesControlador::getEstadosCiviles();
                            foreach ($estado_civil as $estado) : ?>
                                <option value="<?= $estado ?>"><?= $estado ?></option>
                            <?php endforeach; ?>
                        </select>

                        <script>
                            var pte_estado_civil = '<?= $pte['pte_estado_civil'] ?>';
                            $("#pte_estado_civil").val(pte_estado_civil).trigger('change');
                        </script>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_escolaridad" class="form-label">Escolaridad</label>
                        <input type="text" class="form-control" name="pte_escolaridad" id="pte_escolaridad" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ocupacion" class="form-label">Ocupación</label>
                        <input type="text" class="form-control" name="pte_ocupacion" id="pte_ocupacion" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_derechohabiencia" class="form-label">Derechohabiencia</label>
                        <input type="text" class="form-control" name="pte_derechohabiencia" id="pte_derechohabiencia" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_caso" class="form-label">Caso nuevo o seguimiento</label>
                        <select class="form-select" name="pte_caso" id="pte_caso">
                            <option value="">-Seleccionar-</option>
                            <option value="Nuevo">Nuevo</option>
                            <option value="Seguimiento">Seguimiento</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_religion" class="form-label">Religión</label>
                        <input type="text" class="form-control" name="pte_religion" id="pte_religion" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_indigena" class="form-label">¿Pertenece a algun pueblo indígena?</label>
                        <select class="form-select" name="pte_indigena" id="pte_indigena">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_lengua_indigena" class="form-label">¿Habla lengua indígena?</label>
                        <select class="form-select" name="pte_lengua_indigena" id="pte_lengua_indigena">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_lengua" class="form-label">¿Cual lengua indígena habla?</label>
                        <input type="text" class="form-control" name="pte_lengua" id="pte_lengua" />
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>II. Antecedentes Heredofamiliares</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_diabetes" class="form-label">Diabetes, ¿Quien?</label>
                        <input type="text" class="form-control" name="pte_diabetes" id="pte_diabetes" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_nefropatas" class="form-label">Nefropatas, ¿Quien?</label>
                        <input type="text" class="form-control" name="pte_nefropatas" id="pte_nefropatas" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_hipertension" class="form-label">Hipertensión Arterial, ¿Quién?</label>
                        <input type="text" class="form-control" name="pte_hipertension" id="pte_hipertension" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_malformaciones" class="form-label">Malformaciones</label>
                        <input type="text" class="form-control" name="pte_malformaciones" id="pte_malformaciones" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_cancer" class="form-label">Cáncer, ¿Quién? y tipo</label>
                        <input type="text" class="form-control" name="pte_cancer" id="pte_cancer" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_cardiopatas" class="form-label">Cardiopatas, ¿Quién?</label>
                        <input type="text" class="form-control" name="pte_cardiopatas" id="pte_cardiopatas" />
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>III. Antecedentes Personales No Patológicos</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_tabaquismo" class="form-label">Tabaquismo</label>
                        <select class="form-select" name="pte_tabaquismo" id="pte_tabaquismo">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_tabaquismo_cantidad" class="form-label">¿Cuántos por día?</label>
                        <input type="text" class="form-control" name="pte_tabaquismo_cantidad" id="pte_tabaquismo_cantidad" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_tabaquismo_tiempo" class="form-label">Años de consumo o exposición</label>
                        <input type="text" class="form-control" name="pte_tabaquismo_tiempo" id="pte_tabaquismo_tiempo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_tabaquismo_ant" class="form-label">Exfumador</label>
                        <select class="form-select" name="pte_tabaquismo_ant" id="pte_tabaquismo_ant">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_tabaquismo_pasivo" class="form-label">Fumador pasivo</label>
                        <select class="form-select" name="pte_tabaquismo_pasivo" id="pte_tabaquismo_pasivo">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 col-12">
                        <label for="pte_alcoholismo" class="form-label">Alcohol</label>
                        <select class="form-select" name="pte_alcoholismo" id="pte_alcoholismo">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_alcoholismo_cantidad" class="form-label">¿Cuántos mls por semana?</label>
                        <input type="text" class="form-control" name="pte_alcoholismo_cantidad" id="pte_alcoholismo_cantidad" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_alcoholismo_tiempo" class="form-label">Años de consumo</label>
                        <input type="text" class="form-control" name="pte_alcoholismo_tiempo" id="pte_alcoholismo_tiempo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_alcoholismo_ant" class="form-label">Ex - alcohólico y/o Ocasional</label>
                        <select class="form-select" name="pte_alcoholismo_ant" id="pte_alcoholismo_ant">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_alergias" class="form-label">Alergias</label>
                        <input type="text" class="form-control" name="pte_alergias" id="pte_alergias" value="<?= $pte['pte_alergias'] ?>" />
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
                        <script>
                            var pte_tipo_sangre = '<?= $pte['pte_tipo_sangre'] ?>';
                            $("#pte_tipo_sangre").val(pte_tipo_sangre).trigger('change');
                        </script>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_servicios_basicos" class="form-label">Vivienda con Servicios Básicos</label>
                        <select class="form-select" name="pte_servicios_basicos" id="pte_servicios_basicos">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_farmacodependencia" class="form-label">Farmacodependencia</label>
                        <select class="form-select" name="pte_farmacodependencia" id="pte_farmacodependencia">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_farmacodependencia_tiempo" class="form-label">Años de consumo</label>
                        <input type="text" class="form-control" name="pte_farmacodependencia_tiempo" id="pte_farmacodependencia_tiempo" />
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>IV. Antecedentes Ginecoobstétricos</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_menarca" class="form-label">Menarca</label>
                        <input type="text" class="form-control" name="pte_menarca" id="pte_menarca" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ciclos_regulares" class="form-label">Ciclos Regulares</label>
                        <select class="form-select" name="pte_ciclos_regulares" id="pte_ciclos_regulares">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ritmo" class="form-label">Ritmo</label>
                        <input type="text" class="form-control" name="pte_ritmo" id="pte_ritmo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_ultima_menstruacion" class="form-label">Fecha ultima menstruación</label>
                        <input type="date" class="form-control" name="pte_ultima_menstruacion" id="pte_ultima_menstruacion" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_polimenorrea" class="form-label">Polimenorrea</label>
                        <select class="form-select" name="pte_polimenorrea" id="pte_polimenorrea">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_hipermenorrea" class="form-label">Hipermenorrea</label>
                        <select class="form-select" name="pte_hipermenorrea" id="pte_hipermenorrea">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_dismenorrea" class="form-label">Dismenorrea</label>
                        <select class="form-select" name="pte_dismenorrea" id="pte_dismenorrea">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_incapacitante" class="form-label">Incapacitante</label>
                        <select class="form-select" name="pte_incapacitante" id="pte_incapacitante">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_IVSA" class="form-label">IVSA</label>
                        <input type="text" class="form-control" name="pte_IVSA" id="pte_IVSA" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_no_parejas" class="form-label">No. Parejas Sexuales</label>
                        <input type="text" class="form-control" name="pte_no_parejas" id="pte_no_parejas" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_fecha_citologia" class="form-label"> Fecha de Ultima Citología (PAP)</label>
                        <input type="date" class="form-control" name="pte_fecha_citologia" id="pte_fecha_citologia" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_resultado" class="form-label">Resultado</label>
                        <input type="text" class="form-control" name="pte_resultado" id="pte_resultado" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_planificacion_actual" class="form-label">Método de Planificación Actual</label>
                        <input type="text" class="form-control" name="pte_planificacion_actual" id="pte_planificacion_actual" />
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>V. Antecedentes Personales Patológicos</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_enfermedades_infancia" class="form-label">Enfermedades de la Infancia</label>
                        <input type="text" class="form-control" name="pte_enfermedades_infancia" id="pte_enfermedades_infancia" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_secuelas" class="form-label">Secuelas</label>
                        <input type="text" class="form-control" name="pte_secuelas" id="pte_secuelas" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_hospitalizacion" class="form-label">Hospitalizaciones Previas, Si No, Especificar</label>
                        <input type="text" class="form-control" name="pte_hospitalizacion" id="pte_hospitalizacion" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_antecedentes_quirurgicos" class="form-label">Antecedentes Quirúrgicos, Si No, Especificar</label>
                        <input type="text" class="form-control" name="pte_antecedentes_quirurgicos" id="pte_antecedentes_quirurgicos" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_transfusiones_previas" class="form-label">Transfusiones Previas, Si No, Especificar</label>
                        <input type="text" class="form-control" name="pte_transfusiones_previas" id="pte_transfusiones_previas" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_fracturas" class="form-label">Fracturas, Si No, Especificar</label>
                        <input type="text" class="form-control" name="pte_fracturas" id="pte_fracturas" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_traumatismo" class="form-label">Traumatismo, Si No, Especificar</label>
                        <input type="text" class="form-control" name="pte_traumatismo" id="pte_traumatismo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_otra_enfermedad" class="form-label">Otra Enfermedad, Si No, Especificar</label>
                        <input type="text" class="form-control" name="pte_otra_enfermedad" id="pte_otra_enfermedad" />
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>VI. Motivo de Ingreso</strong>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <textarea class="form-control" name="pte_motivo_ingreso" id="pte_motivo_ingreso" rows="3"></textarea>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>VII. Principio y Evolución del Padecimiento Actual</strong>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <textarea class="form-control" name="pte_padecimiento_actual" id="pte_padecimiento_actual" rows="3"></textarea>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>VIII. Interrogatorio por Aparatos y Sistemas</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_respiratorio" class="form-label">Respiratorio /Cardiovascular:</label>
                        <input type="text" class="form-control" name="pte_respiratorio" id="pte_respiratorio" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_digestivo" class="form-label">Digestivo:</label>
                        <input type="text" class="form-control" name="pte_digestivo" id="pte_digestivo" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_endocrino" class="form-label">Endocrino:</label>
                        <input type="text" class="form-control" name="pte_endocrino" id="pte_endocrino" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_musculo_esqueletico" class="form-label">Musculo-Esquelético:</label>
                        <input type="text" class="form-control" name="pte_musculo_esqueletico" id="pte_musculo_esqueletico" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_genito_urinario" class="form-label">Genito-Urinario:</label>
                        <input type="text" class="form-control" name="pte_genito_urinario" id="pte_genito_urinario" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_hematopoyético" class="form-label">Hematopoyético - Linfático:</label>
                        <input type="text" class="form-control" name="pte_hematopoyético" id="pte_hematopoyético" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_piel_anexos" class="form-label">Piel y Anexos:</label>
                        <input type="text" class="form-control" name="pte_piel_anexos" id="pte_piel_anexos" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_neurologico" class="form-label">Neurológico y Psiquiátrico:</label>
                        <input type="text" class="form-control" name="pte_neurologico" id="pte_neurologico" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_medicamentos_actuales" class="form-label">Medicamentos Actuales</label>
                        <input type="hidden" name="pte_medicamentos" id="pte_medicamentos">
                        <select class="form-select" name="pte_medicamentos_actuales" id="pte_medicamentos_actuales">
                            <option value="">-Seleccionar-</option>
                            <option value="S">Si</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center" colspan="8">
                                            MEDICAMENTOS <br>
                                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#mdlAgregarMedicamentos">
                                                Agregar
                                            </button>

                                        </th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Nombre comercial</th>
                                        <th scope="col">Principio activo</th>
                                        <th scope="col">Presentación(mg,UI)</th>
                                        <th scope="col">Dosis(mg)</th>
                                        <th scope="col">Vía</th>
                                        <th scope="col">Frecuencia</th>
                                        <th scope="col">Fecha, última administración</th>
                                        <th scope="col">Hora de última administración</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_medicamentos">

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>IX. Ficha Clínica</strong>
                        </div>
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_ta" class="form-label">TA.:</label>
                        <input type="text" class="form-control" name="pte_ta" id="pte_ta" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_pulso" class="form-label">FC/Pulso:</label>
                        <input type="text" class="form-control" name="pte_pulso" id="pte_pulso" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_fr" class="form-label">FR:</label>
                        <input type="text" class="form-control" name="pte_fr" id="pte_fr" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_temp" class="form-label">Temp:</label>
                        <input type="text" class="form-control" name="pte_temp" id="pte_temp" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_peso" class="form-label">Peso:</label>
                        <input type="text" class="form-control" name="pte_peso" id="pte_peso" />
                    </div>
                    <div class="col-md-2 col-12">
                        <label for="pte_talla" class="form-label">Talla:</label>
                        <input type="text" class="form-control" name="pte_talla" id="pte_talla" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_habitus_exterior" class="form-label">Habitus Exterior:</label>
                        <input type="text" class="form-control" name="pte_habitus_exterior" id="pte_habitus_exterior" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_piel_anexos2" class="form-label">Piel y Anexos:</label>
                        <input type="text" class="form-control" name="pte_piel_anexos2" id="pte_piel_anexos2" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_cabeza_cuello" class="form-label">Cabeza y Cuello:</label>
                        <input type="text" class="form-control" name="pte_cabeza_cuello" id="pte_cabeza_cuello" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_torax" class="form-label">Tórax:</label>
                        <input type="text" class="form-control" name="pte_torax" id="pte_torax" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_abdomen" class="form-label">Abdomen:</label>
                        <input type="text" class="form-control" name="pte_abdomen" id="pte_abdomen" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_genitales" class="form-label">Genitales:</label>
                        <input type="text" class="form-control" name="pte_genitales" id="pte_genitales" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_extremidades" class="form-label">Extremidades:</label>
                        <input type="text" class="form-control" name="pte_extremidades" id="pte_extremidades" />
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_sistema_nervioso" class="form-label">Sistema Nervioso:</label>
                        <input type="text" class="form-control" name="pte_sistema_nervioso" id="pte_sistema_nervioso" />
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>X. Estudio de Imagen/ Exámenes de Laboratorio Previos a su Ingreso</strong>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <textarea class="form-control" name="pte_examenes_laboratorio" id="pte_examenes_laboratorio" rows="3"></textarea>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>XI. Análisis, Integración y Terapéutica</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_probables_diagnosticos" class="form-label">Probables Diagnósticos:</label>
                        <textarea class="form-control" name="pte_probables_diagnosticos" id="pte_probables_diagnosticos" rows="3"></textarea>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_plan_estudio" class="form-label">Plan de Estudio:</label>
                        <textarea class="form-control" name="pte_plan_estudio" id="pte_plan_estudio" rows="3"></textarea>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="pte_terapeutica_inicial" class="form-label">Terapéutica Inicial:</label>
                        <textarea class="form-control" name="pte_terapeutica_inicial" id="pte_terapeutica_inicial" rows="3"></textarea>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>XII. Observaciones y/o Comentarios Finales</strong>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <textarea class="form-control" name="pte_comentarios_finales" id="pte_comentarios_finales" rows="3"></textarea>
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


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="mdlAgregarMedicamentos" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Agregar medicamento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarMedicamento" class="row g-3">
                    <div class="col-12">
                        <label for="" class="form-label">Nombre comercial</label>
                        <input type="text" class="form-control" name="nombre_comercial" id="" required />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Principio activo</label>
                        <input type="text" class="form-control" name="principio_activo" id="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Presentación(mg,UI)</label>
                        <input type="text" class="form-control" name="presentacion" id="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Dosis(mg)</label>
                        <input type="text" class="form-control" name="dosis" id="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Via</label>
                        <input type="text" class="form-control" name="via" id="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Frecuencia</label>
                        <input type="text" class="form-control" name="frecuencia" id="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Fecha última administración</label>
                        <input type="date" class="form-control" name="fecha_administracion" id="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Hora última administración</label>
                        <input type="time" class="form-control" name="hora_administracion" id="" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
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
            url: '<?= HTTP_HOST ?>' + 'api/v1/historial/get?hcl_pte_id=<?= $pte_id ?>',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                if (res) {
                    $("#hcl_id").val(res.hcl_id);
                    $("#hcl_fecha_valoracion").val(res.hcl_fecha_valoracion);

                    var hcl_pte_identificacion = JSON.parse(res.hcl_pte_identificacion);
                    $("#pte_no_identificacion").val(hcl_pte_identificacion.pte_no_identificacion);
                    $("#pte_fecha_nacimiento").val(hcl_pte_identificacion.pte_fecha_nacimiento);
                    $("#pte_edad").val(hcl_pte_identificacion.pte_edad);
                    $("#pte_estado_nacimiento").val(hcl_pte_identificacion.pte_estado_nacimiento).trigger('change');
                    $("#pte_estado_civil").val(hcl_pte_identificacion.pte_estado_civil);
                    $("#pte_escolaridad").val(hcl_pte_identificacion.pte_escolaridad);
                    $("#pte_ocupacion").val(hcl_pte_identificacion.pte_ocupacion);
                    $("#pte_derechohabiencia").val(hcl_pte_identificacion.pte_derechohabiencia);
                    $("#pte_caso").val(hcl_pte_identificacion.pte_caso);
                    $("#pte_religion").val(hcl_pte_identificacion.pte_religion);
                    $("#pte_indigena").val(hcl_pte_identificacion.pte_indigena);
                    $("#pte_lengua_indigena").val(hcl_pte_identificacion.pte_lengua_indigena);
                    $("#pte_lengua").val(hcl_pte_identificacion.pte_lengua);

                    var hcl_ant_heredofamiliares = JSON.parse(res.hcl_ant_heredofamiliares);
                    $("#pte_diabetes").val(hcl_ant_heredofamiliares.pte_diabetes);
                    $("#pte_nefropatas").val(hcl_ant_heredofamiliares.pte_nefropatas);
                    $("#pte_hipertension").val(hcl_ant_heredofamiliares.pte_hipertension);
                    $("#pte_malformaciones").val(hcl_ant_heredofamiliares.pte_malformaciones);
                    $("#pte_cancer").val(hcl_ant_heredofamiliares.pte_cancer);
                    $("#pte_cardiopatas").val(hcl_ant_heredofamiliares.pte_cardiopatas);

                    var hcl_ant_pers_no_patologicos = JSON.parse(res.hcl_ant_pers_no_patologicos);
                    $("#pte_tabaquismo").val(hcl_ant_pers_no_patologicos.pte_tabaquismo);
                    $("#pte_tabaquismo_cantidad").val(hcl_ant_pers_no_patologicos.pte_tabaquismo_cantidad);
                    $("#pte_tabaquismo_tiempo").val(hcl_ant_pers_no_patologicos.pte_tabaquismo_tiempo);
                    $("#pte_tabaquismo_ant").val(hcl_ant_pers_no_patologicos.pte_tabaquismo_ant);
                    $("#pte_tabaquismo_pasivo").val(hcl_ant_pers_no_patologicos.pte_tabaquismo_pasivo);
                    $("#pte_alcoholismo").val(hcl_ant_pers_no_patologicos.pte_alcoholismo);
                    $("#pte_alcoholismo_cantidad").val(hcl_ant_pers_no_patologicos.pte_alcoholismo_cantidad);
                    $("#pte_alcoholismo_tiempo").val(hcl_ant_pers_no_patologicos.pte_alcoholismo_tiempo);
                    $("#pte_alcoholismo_ant").val(hcl_ant_pers_no_patologicos.pte_alcoholismo_ant);
                    $("#pte_alergias").val(hcl_ant_pers_no_patologicos.pte_alergias);
                    $("#pte_tipo_sangre").val(hcl_ant_pers_no_patologicos.pte_tipo_sangre);
                    $("#pte_servicios_basicos").val(hcl_ant_pers_no_patologicos.pte_servicios_basicos);
                    $("#pte_farmacodependencia").val(hcl_ant_pers_no_patologicos.pte_farmacodependencia);
                    $("#pte_farmacodependencia_tiempo").val(hcl_ant_pers_no_patologicos.pte_farmacodependencia_tiempo);

                    var hcl_ant_ginecoobstétricos = JSON.parse(res.hcl_ant_ginecoobstétricos);
                    $("#pte_menarca").val(hcl_ant_ginecoobstétricos.pte_menarca);
                    $("#pte_ciclos_regulares").val(hcl_ant_ginecoobstétricos.pte_ciclos_regulares);
                    $("#pte_ritmo").val(hcl_ant_ginecoobstétricos.pte_ritmo);
                    $("#pte_ultima_menstruacion").val(hcl_ant_ginecoobstétricos.pte_ultima_menstruacion);
                    $("#pte_hipermenorrea").val(hcl_ant_ginecoobstétricos.pte_hipermenorrea);
                    $("#pte_dismenorrea").val(hcl_ant_ginecoobstétricos.pte_dismenorrea);
                    $("#pte_incapacitante").val(hcl_ant_ginecoobstétricos.pte_incapacitante);
                    $("#pte_IVSA").val(hcl_ant_ginecoobstétricos.pte_IVSA);
                    $("#pte_no_parejas").val(hcl_ant_ginecoobstétricos.pte_no_parejas);
                    $("#pte_fecha_citologia").val(hcl_ant_ginecoobstétricos.pte_fecha_citologia);
                    $("#pte_resultado").val(hcl_ant_ginecoobstétricos.pte_resultado);
                    $("#pte_planificacion_actual").val(hcl_ant_ginecoobstétricos.pte_planificacion_actual);

                    var hcl_ant_pers_patologicos = JSON.parse(res.hcl_ant_pers_patologicos);
                    $("#pte_enfermedades_infancia").val(hcl_ant_pers_patologicos.pte_enfermedades_infancia);
                    $("#pte_secuelas").val(hcl_ant_pers_patologicos.pte_secuelas);
                    $("#pte_hospitalizacion").val(hcl_ant_pers_patologicos.pte_hospitalizacion);
                    $("#pte_antecedentes_quirurgicos").val(hcl_ant_pers_patologicos.pte_antecedentes_quirurgicos);
                    $("#pte_transfusiones_previas").val(hcl_ant_pers_patologicos.pte_transfusiones_previas);
                    $("#pte_fracturas").val(hcl_ant_pers_patologicos.pte_fracturas);
                    $("#pte_traumatismo").val(hcl_ant_pers_patologicos.pte_traumatismo);
                    $("#pte_otra_enfermedad").val(hcl_ant_pers_patologicos.pte_otra_enfermedad);

                    $("#pte_motivo_ingreso").val(res.hcl_motivo_ingreso);
                    $("#pte_padecimiento_actual").val(res.hcl_prin_evol_pad_actual);

                    var hcl_int_apar_sis = JSON.parse(res.hcl_int_apar_sis);
                    $("#pte_respiratorio").val(hcl_int_apar_sis.pte_respiratorio);
                    $("#pte_digestivo").val(hcl_int_apar_sis.pte_digestivo);
                    $("#pte_endocrino").val(hcl_int_apar_sis.pte_endocrino);
                    $("#pte_musculo_esqueletico").val(hcl_int_apar_sis.pte_musculo_esqueletico);
                    $("#pte_genito_urinario").val(hcl_int_apar_sis.pte_genito_urinario);
                    $("#pte_hematopoyético").val(hcl_int_apar_sis.pte_hematopoyético);
                    $("#pte_piel_anexos").val(hcl_int_apar_sis.pte_piel_anexos);
                    $("#pte_neurologico").val(hcl_int_apar_sis.pte_neurologico);
                    $("#pte_medicamentos_actuales").val(hcl_int_apar_sis.pte_medicamentos_actuales);
                    $("#pte_medicamentos").val(hcl_int_apar_sis.pte_medicamentos);

                    var hcl_ficha_clinica = JSON.parse(res.hcl_ficha_clinica);
                    $("#pte_ta").val(hcl_ficha_clinica.pte_ta);
                    $("#pte_pulso").val(hcl_ficha_clinica.pte_pulso);
                    $("#pte_fr").val(hcl_ficha_clinica.pte_fr);
                    $("#pte_temp").val(hcl_ficha_clinica.pte_temp);
                    $("#pte_peso").val(hcl_ficha_clinica.pte_peso);
                    $("#pte_talla").val(hcl_ficha_clinica.pte_talla);
                    $("#pte_habitus_exterior").val(hcl_ficha_clinica.pte_habitus_exterior);
                    $("#pte_piel_anexos2").val(hcl_ficha_clinica.pte_piel_anexos2);
                    $("#pte_cabeza_cuello").val(hcl_ficha_clinica.pte_cabeza_cuello);
                    $("#pte_torax").val(hcl_ficha_clinica.pte_torax);
                    $("#pte_abdomen").val(hcl_ficha_clinica.pte_abdomen);
                    $("#pte_genitales").val(hcl_ficha_clinica.pte_genitales);
                    $("#pte_extremidades").val(hcl_ficha_clinica.pte_extremidades);
                    $("#pte_sistema_nervioso").val(hcl_ficha_clinica.pte_sistema_nervioso);

                    $("#pte_examenes_laboratorio").val(res.hcl_eiepli);

                    var hcl_ait = JSON.parse(res.hcl_ait);
                    $("#pte_probables_diagnosticos").val(hcl_ait.pte_probables_diagnosticos);
                    $("#pte_plan_estudio").val(hcl_ait.pte_plan_estudio);
                    $("#pte_terapeutica_inicial").val(hcl_ait.pte_terapeutica_inicial);

                    $("#pte_comentarios_finales").val(res.hcl_observaciones);


                    $("#btnGuardarHistorial").text('Actualizar');
                    $(".btnPdfHistorial").removeClass('d-none');

                    mostrarMedicamentos();

                }
            }
        });
    }
    $('#formGuardarHistoriaClinica').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        datos.append('btnGuardarHistoriaClinica', true);
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/historial/create',
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

    $('#formAgregarMedicamento').on('submit', function(e) {
        e.preventDefault();
        var datos = $(this).serializeArray();
        var pte_medicamentos = $("#pte_medicamentos").val();
        var nuevoMedicamento = {
            'nombre_comercial': '',
            'principio_activo': '',
            'presentacion': '',
            'dosis': '',
            'via': '',
            'frecuencia': '',
            'fecha_administracion': '',
            'hora_administracion': ''
        };

        // Asignar los valores correspondientes al nuevo medicamento
        datos.forEach(function(item) {
            nuevoMedicamento[item.name] = item.value;
        });

        var array_medicamentos = [];
        if (pte_medicamentos !== "") {
            array_medicamentos = JSON.parse(pte_medicamentos);
        }
        array_medicamentos.push(nuevoMedicamento);
        $("#pte_medicamentos").val(JSON.stringify(array_medicamentos));
        $('#formAgregarMedicamento')[0].reset();
        $("#mdlAgregarMedicamentos").modal('hide');

        mostrarMedicamentos();
    });

    function mostrarMedicamentos(){
        var tbody_medicamentos = "";
        var pte_medicamentos = $("#pte_medicamentos").val();
        if(pte_medicamentos !== ""){
            var datos = JSON.parse(pte_medicamentos);
            datos.forEach(md => {
                tbody_medicamentos += `
                    <tr>
                        <td>${md.nombre_comercial}</td>
                        <td>${md.principio_activo}</td>
                        <td>${md.presentacion}</td>
                        <td>${md.dosis}</td>
                        <td>${md.via}</td>
                        <td>${md.frecuencia}</td>
                        <td>${md.fecha_administracion}</td>
                        <td>${md.hora_administracion}</td>
                    </tr>
                `;
            });

            $("#tbody_medicamentos").html(tbody_medicamentos);
        }
    }
</script>