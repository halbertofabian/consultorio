<?php
ob_start();
ini_set('memory_limit', '256M'); // Ajusta el límite de memoria a 256MB, puedes ajustarlo según sea necesario
require_once(__DIR__ . '/../../config.php');
if (isset($_GET['hcl_id'])) {
    require_once(__DIR__ . '/../../app/modules/app/componentescontrolador.php');
    require_once(__DIR__ . '/../../app/modules/historial/historialModelo.php');
    require_once(__DIR__ . '/../../app/modules/usuarios/usuariosModelo.php');
    require_once(__DIR__ . '/../../app/modules/consultorios/consultoriosModelo.php');
    require_once(__DIR__ . '/../libs/TCPDF/tcpdf.php');

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');



    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 8, '', true);

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage('P');

    $hcl = HistorialModelo::mdlMostrarHistorialById($_GET['hcl_id']);
    $usr = UsuariosModelo::mdlMostrarUsuariosById($hcl['hcl_usr_id']);
    $ctr = ConsultoriosModelo::mdlMostrarConsultoriosById($usr['usr_ctr_id']);

    // $logo = !empty($ctr['ctr_logo']) ? $ctr['ctr_logo'] : "";

    $logo = ComponentesControlador::reducir_resolucion_imagen(HTTP_HOST . "app/assets/logos/logo-medicina.png", 0.5); // Reducir a la mitad

    // $logo = HTTP_HOST . "app/assets/logos/logo-medicina.png";


    $consultorio = $ctr['ctr_nombre'];
    $direccion = $ctr['ctr_calle'] . ' ' . $ctr['ctr_no_exterior'] . ', ' . $ctr['ctr_delegacion_municipio'] . ', ' . $ctr['ctr_estado'];

    $usr_nombre = ComponentesControlador::obtenerNombreUsuario($hcl['hcl_usr_id']);

    //datos
    $hcl_pte_identificacion = json_decode($hcl['hcl_pte_identificacion'], true);
    $hcl_ant_heredofamiliares = json_decode($hcl['hcl_ant_heredofamiliares'], true);
    $hcl_ant_pers_no_patologicos = json_decode($hcl['hcl_ant_pers_no_patologicos'], true);
    $hcl_ant_ginecoobstétricos = json_decode($hcl['hcl_ant_ginecoobstétricos'], true);
    $hcl_ant_pers_patologicos = json_decode($hcl['hcl_ant_pers_patologicos'], true);
    $hcl_int_apar_sis = json_decode($hcl['hcl_int_apar_sis'], true);
    $hcl_ficha_clinica = json_decode($hcl['hcl_ficha_clinica'], true);
    $hcl_ait = json_decode($hcl['hcl_ait'], true);
    $hcl_observaciones = json_decode($hcl['hcl_observaciones'], true);

    $pte_medicamentos = $hcl_int_apar_sis['pte_medicamentos'];
    $tbody_medicamentos = "";
    if ($pte_medicamentos !== "") {
        $datos = json_decode($pte_medicamentos, true);

        foreach ($datos as $key => $md) {
            $tbody_medicamentos .= "
            <tr>
                <td>$md[nombre_comercial]</td>
                <td>$md[principio_activo]</td>
                <td>$md[presentacion]</td>
                <td>$md[dosis]</td>
                <td>$md[via]</td>
                <td>$md[frecuencia]</td>
                <td>$md[fecha_administracion]</td>
                <td>$md[hora_administracion]</td>
            </tr>
        ";
        }
    }


    //ENCABEZADO
    $header = <<<EOF
    <table cellspacing="0" cellpadding="3">
        <tr>
            <td style="text-align: left; border-bottom: 1px solid black">
                <img src="$logo" width="50px" />
            </td>
            <td style="text-align:right;border-bottom: 1px solid #000">
                    <strong>$consultorio</strong> <br>
                    $direccion<br>
                    <strong>Tel:</strong> $ctr[ctr_telefono_fijo] <br>
                    <strong>Tel:</strong> $ctr[ctr_telefono_celular] <br>
            </td>
        </tr><br>
        <tr>
            <td><strong>Nombre del profesional de salud que presenta:</strong> $usr_nombre</td>
            <td style="text-align: right;"><strong>Fecha valoración:</strong> $hcl[hcl_fecha_valoracion]</td>
        </tr><br>
        <tr style="font-weight: bold; text-align: center">
            <td colspan="2">HISTORIA CLÍNICA</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">I. Datos de identificación del paciente </td>
        </tr>
        <tr>
            <td><strong>Número de identificación ECHO:</strong> $hcl_pte_identificacion[pte_no_identificacion]</td>
            <td><strong>Fecha de nacimiento:</strong> $hcl_pte_identificacion[pte_fecha_nacimiento] <strong>Edad:</strong> $hcl_pte_identificacion[pte_edad]</td>
        </tr>
        <tr>
            <td><strong>Entidad de nacimiento:</strong> $hcl_pte_identificacion[pte_estado_nacimiento]</td>
            <td><strong>Estado civil:</strong> $hcl_pte_identificacion[pte_estado_civil]</td>
        </tr>
        <tr>
            <td><strong>Escolaridad:</strong> $hcl_pte_identificacion[pte_escolaridad]</td>
            <td><strong>Ocupación:</strong> $hcl_pte_identificacion[pte_ocupacion]</td>
        </tr>
        <tr>
            <td><strong>Derechohabiencia:</strong> $hcl_pte_identificacion[pte_derechohabiencia]</td>
            <td><strong>Caso nuevo o seguimiento:</strong> $hcl_pte_identificacion[pte_caso]</td>
        </tr>
        <tr>
            <td><strong>Religión:</strong> $hcl_pte_identificacion[pte_religion]</td>
            <td><strong>¿Pertenece a algun pueblo indígena?:</strong> $hcl_pte_identificacion[pte_indigena]</td>
        </tr>
        <tr>
            <td><strong>¿Habla lengua indígena?:</strong> $hcl_pte_identificacion[pte_lengua_indigena]</td>
            <td><strong>¿Cual lengua indígena habla?:</strong> $hcl_pte_identificacion[pte_lengua]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">II. Antecedentes Heredofamiliares</td>
        </tr>
        <tr>
            <td><strong>Diabetes, ¿Quien?:</strong> $hcl_ant_heredofamiliares[pte_diabetes]</td>
            <td><strong>Nefropatas, ¿Quien?:</strong> $hcl_ant_heredofamiliares[pte_nefropatas]</td>
        </tr>
        <tr>
            <td><strong>Hipertensión Arterial, ¿Quién?:</strong> $hcl_ant_heredofamiliares[pte_hipertension]</td>
            <td><strong>Malformaciones:</strong> $hcl_ant_heredofamiliares[pte_malformaciones]</td>
        </tr>
        <tr>
            <td><strong>Cáncer, ¿Quién? y tipo:</strong> $hcl_ant_heredofamiliares[pte_cancer]</td>
            <td><strong>Cardiopatas, ¿Quién?:</strong> $hcl_ant_heredofamiliares[pte_cardiopatas]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">III. Antecedentes Personales No Patológicos</td>
        </tr>
        <tr>
            <td><strong>Tabaquismo:</strong> $hcl_ant_pers_no_patologicos[pte_tabaquismo]</td>
            <td><strong>¿Cuántos por día?:</strong> $hcl_ant_pers_no_patologicos[pte_tabaquismo_cantidad]</td>
        </tr>
        <tr>
            <td><strong>Años de consumo o exposición:</strong> $hcl_ant_pers_no_patologicos[pte_tabaquismo_tiempo]</td>
            <td><strong>Exfumador:</strong> $hcl_ant_pers_no_patologicos[pte_tabaquismo_ant]</td>
        </tr>
        <tr>
            <td><strong>Fumador pasivo:</strong> $hcl_ant_pers_no_patologicos[pte_tabaquismo_pasivo]</td>
            <td><strong>Alcohol:</strong> $hcl_ant_pers_no_patologicos[pte_alcoholismo]</td>
        </tr>
        <tr>
            <td><strong>¿Cuántos mls por semana?:</strong> $hcl_ant_pers_no_patologicos[pte_alcoholismo_cantidad]</td>
            <td><strong>Años de consumo:</strong> $hcl_ant_pers_no_patologicos[pte_alcoholismo_tiempo]</td>
        </tr>
        <tr>
            <td><strong>Ex - alcohólico y/o Ocasional:</strong> $hcl_ant_pers_no_patologicos[pte_alcoholismo_ant]</td>
            <td><strong>Alergias:</strong> $hcl_ant_pers_no_patologicos[pte_alergias]</td>
        </tr>
        <tr>
            <td><strong>Tipo de sangre:</strong> $hcl_ant_pers_no_patologicos[pte_tipo_sangre]</td>
            <td><strong>Vivienda con Servicios Básicos:</strong> $hcl_ant_pers_no_patologicos[pte_servicios_basicos]</td>
        </tr>
        <tr>
            <td><strong>Farmacodependencia:</strong> $hcl_ant_pers_no_patologicos[pte_farmacodependencia]</td>
            <td><strong>Años de consumo:</strong> $hcl_ant_pers_no_patologicos[pte_farmacodependencia_tiempo]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">IV. Antecedentes Ginecoobstétricos</td>
        </tr>
        <tr>
            <td><strong>Menarca:</strong> $hcl_ant_ginecoobstétricos[pte_menarca]</td>
            <td><strong>Ciclos Regulares:</strong> $hcl_ant_ginecoobstétricos[pte_ciclos_regulares]</td>
        </tr>
        <tr>
            <td><strong>Ritmo:</strong> $hcl_ant_ginecoobstétricos[pte_ritmo]</td>
            <td><strong>Fecha ultima menstruación:</strong> $hcl_ant_ginecoobstétricos[pte_ultima_menstruacion]</td>
        </tr>
        <tr>
            <td><strong>Polimenorrea:</strong> $hcl_ant_ginecoobstétricos[pte_polimenorrea]</td>
            <td><strong>Hipermenorrea:</strong> $hcl_ant_ginecoobstétricos[pte_hipermenorrea]</td>
        </tr>
        <tr>
            <td><strong>Dismenorrea:</strong> $hcl_ant_ginecoobstétricos[pte_dismenorrea]</td>
            <td><strong>Incapacitante:</strong> $hcl_ant_ginecoobstétricos[pte_incapacitante]</td>
        </tr>
        <tr>
            <td><strong>IVSA:</strong> $hcl_ant_ginecoobstétricos[pte_IVSA]</td>
            <td><strong>No. Parejas Sexuales:</strong> $hcl_ant_ginecoobstétricos[pte_no_parejas]</td>
        </tr>
        <tr>
            <td><strong>Fecha de Ultima Citología (PAP):</strong> $hcl_ant_ginecoobstétricos[pte_fecha_citologia]</td>
            <td><strong>Resultado:</strong> $hcl_ant_ginecoobstétricos[pte_resultado]</td>
        </tr>
        <tr>
            <td><strong>Método de Planificación Actual:</strong> $hcl_ant_ginecoobstétricos[pte_planificacion_actual]</td>
            <td></td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">V. Antecedentes Personales Patológicos</td>
        </tr>
        <tr>
            <td><strong>Enfermedades de la Infancia:</strong> $hcl_ant_pers_patologicos[pte_enfermedades_infancia]</td>
            <td><strong>Secuelas:</strong> $hcl_ant_pers_patologicos[pte_secuelas]</td>
        </tr>
        <tr>
            <td><strong>Hospitalizaciones Previas, Si No, Especificar:</strong> $hcl_ant_pers_patologicos[pte_hospitalizacion]</td>
            <td><strong>Antecedentes Quirúrgicos, Si No, Especificar:</strong> $hcl_ant_pers_patologicos[pte_antecedentes_quirurgicos]</td>
        </tr>
        <tr>
            <td><strong>Transfusiones Previas, Si No, Especificar:</strong> $hcl_ant_pers_patologicos[pte_transfusiones_previas]</td>
            <td><strong>Fracturas, Si No, Especificar:</strong> $hcl_ant_pers_patologicos[pte_fracturas]</td>
        </tr>
        <tr>
            <td><strong>Traumatismo, Si No, Especificar:</strong> $hcl_ant_pers_patologicos[pte_traumatismo]</td>
            <td><strong>Otra Enfermedad, Si No, Especificar:</strong> $hcl_ant_pers_patologicos[pte_otra_enfermedad]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">VI. Motivo de Ingreso</td>
        </tr>
        <tr>
            <td colspan="2">$hcl[hcl_motivo_ingreso]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">VII. Principio y Evolución del Padecimiento Actual</td>
        </tr>
        <tr>
            <td colspan="2">$hcl[hcl_prin_evol_pad_actual]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">VIII. Interrogatorio por Aparatos y Sistemas</td>
        </tr>
        <tr>
            <td><strong>Respiratorio /Cardiovascular:</strong> $hcl_int_apar_sis[pte_respiratorio]</td>
            <td><strong>Digestivo:</strong> $hcl_int_apar_sis[pte_digestivo]</td>
        </tr>
        <tr>
            <td><strong>Endocrino:</strong> $hcl_int_apar_sis[pte_endocrino]</td>
            <td><strong>Musculo-Esquelético:</strong> $hcl_int_apar_sis[pte_musculo_esqueletico]</td>
        </tr>
        <tr>
            <td><strong>Genito-Urinario:</strong> $hcl_int_apar_sis[pte_genito_urinario]</td>
            <td><strong>Hematopoyético - Linfático:</strong> $hcl_int_apar_sis[pte_hematopoyético]</td>
        </tr>
        <tr>
            <td><strong>Piel y Anexos:</strong> $hcl_int_apar_sis[pte_piel_anexos]</td>
            <td><strong>Neurológico y Psiquiátrico:</strong> $hcl_int_apar_sis[pte_neurologico]</td>
        </tr>
        <tr>
            <td><strong>Medicamentos Actuales:</strong> $hcl_int_apar_sis[pte_medicamentos_actuales]</td>
            <td></td>
        </tr><br>
        <tr>
            <td colspan="2">
                <table border="1" cellspacing="0" cellpadding="1" style="text-align: center; width: 100%;">
                    <tr style="background-color: #D5E5FA; font-weight: bold; ">
                        <th colspan="8">MEDICAMENTOS</th>
                    </tr>
                    <tr style="background-color: #D5E5FA;">
                        <th>Nombre comercial</th>
                        <th>Principio activo</th>
                        <th>Presentación(mg,UI)</th>
                        <th>Dosis(mg)</th>
                        <th>Vía</th>
                        <th>Frecuencia</th>
                        <th>Fecha, última administración</th>
                        <th>Hora de última administración</th>
                    </tr>
                    $tbody_medicamentos
                </table>
            </td>
        </tr><br>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">IX. Ficha Clínica</td>
        </tr>
        <tr>
            <td colspan="2" style="word-wrap: break-word; overflow-wrap: break-word;"><strong>TA:</strong> $hcl_ficha_clinica[pte_ta] <strong>FC/Pulso:</strong> $hcl_ficha_clinica[pte_pulso] <strong>FR:</strong> $hcl_ficha_clinica[pte_fr] <strong>Temp:</strong> $hcl_ficha_clinica[pte_temp] <strong>Peso:</strong> $hcl_ficha_clinica[pte_peso] <strong>Talla:</strong> $hcl_ficha_clinica[pte_talla]</td>
        </tr>
        <tr>
            <td><strong>Habitus Exterior:</strong> $hcl_ficha_clinica[pte_habitus_exterior]</td>
            <td><strong>Piel y Anexos:</strong> $hcl_ficha_clinica[pte_piel_anexos2]</td>
        </tr>
        <tr>
            <td><strong>Cabeza y Cuello:</strong> $hcl_ficha_clinica[pte_cabeza_cuello]</td>
            <td><strong>Tórax:</strong> $hcl_ficha_clinica[pte_torax]</td>
        </tr>
        <tr>
            <td><strong>Abdomen:</strong> $hcl_ficha_clinica[pte_abdomen]</td>
            <td><strong>Genitales:</strong> $hcl_ficha_clinica[pte_genitales]</td>
        </tr>
        <tr>
            <td><strong>Extremidades:</strong> $hcl_ficha_clinica[pte_extremidades]</td>
            <td><strong>Sistema Nervioso:</strong> $hcl_ficha_clinica[pte_sistema_nervioso]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">X. Estudio de Imagen/ Exámenes de Laboratorio Previos a su Ingreso</td>
        </tr>
        <tr>
            <td colspan="2">$hcl[hcl_eiepli]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">XI. Análisis, Integración y Terapéutica</td>
        </tr>
        <tr>
            <td><strong>Probables Diagnósticos:</strong> $hcl_ait[pte_probables_diagnosticos]</td>
            <td><strong>Plan de Estudio:</strong> $hcl_ait[pte_plan_estudio]</td>
        </tr>
        <tr>
            <td><strong>Terapéutica Inicial:</strong> $hcl_ait[pte_terapeutica_inicial]</td>
            <td></td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">XII. Observaciones y/o Comentarios Finales</td>
        </tr>
        <tr>
            <td colspan="2">$hcl_observaciones[pte_comentarios_finales]</td>
        </tr>
        <tr>
            <td><strong>Condición:</strong> $hcl_observaciones[pte_condicion]</td>
            <td><strong>Pronóstico:</strong> $hcl_observaciones[pte_pronostico]</td>
        </tr>
    </table>
   
EOF;

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);
    ob_end_clean();
    // $registro = str_replace(".", "", "prueba");
    $pdf->Output('Historia clinica ' . ComponentesControlador::obtenerNombrePaciente($hcl['hcl_pte_id']) . '.pdf', 'I');
}
