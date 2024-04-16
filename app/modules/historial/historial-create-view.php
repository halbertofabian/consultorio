<?php
ComponentesControlador::getBreadCrumb('historial', 'Historial', 'Historia clínica');
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
            <div class="card-body">
                <h4 class="card-title">Historia clínica para <?= ComponentesControlador::obtenerNombrePaciente(base64_decode($pte_id)) ?></h4>
                <form id="formGuardarHistoriaClinica" class="row g-3">
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Nombre del profesional de salud que presenta:</label>
                        <input type="text" class="form-control" name="" id="" value="<?= $_SESSION['usr']['usr_nombre'] ?>" readonly />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="" class="form-label">Fecha valoración:</label>
                        <input type="date" class="form-control" name="" id="" value="<?= date('Y-m-d') ?>" readonly />
                    </div>
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <strong>I. Datos de identificación del paciente</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <label for="" class="form-label">Número de identificación ECHO:</label>
                        <input type="text" class="form-control" name="" id="" />
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
                        <label for="pte_tabaquismo_ant" class="form-label">Fumador pasivo</label>
                        <select class="form-select" name="pte_tabaquismo_ant" id="pte_tabaquismo_ant">
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
                </form>
            </div>
        </div>
    </div>
</div>