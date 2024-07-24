<?php
ob_start();
ini_set('memory_limit', '256M'); // Ajusta el límite de memoria a 256MB, puedes ajustarlo según sea necesario
require_once(__DIR__ . '/../../config.php');
if (isset($_GET['hclp_id'])) {
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

    $hclp = HistorialModelo::mdlMostrarHistorialPerinatalById($_GET['hclp_id']);
    $usr = UsuariosModelo::mdlMostrarUsuariosById($hclp['hclp_usr_id']);
    $ctr = ConsultoriosModelo::mdlMostrarConsultoriosById($usr['usr_ctr_id']);

    // $logo = !empty($ctr['ctr_logo']) ? $ctr['ctr_logo'] : "";

    $logo = ComponentesControlador::reducir_resolucion_imagen(HTTP_HOST . "app/assets/logos/logo-medicina.png", 0.5); // Reducir a la mitad

    // $logo = HTTP_HOST . "app/assets/logos/logo-medicina.png";


    $consultorio = $ctr['ctr_nombre'];
    $direccion = $ctr['ctr_calle'] . ' ' . $ctr['ctr_no_exterior'] . ', ' . $ctr['ctr_delegacion_municipio'] . ', ' . $ctr['ctr_estado'];

    $usr_nombre = ComponentesControlador::obtenerNombreUsuario($hclp['hclp_usr_id']);

    //datos
    $hclp_ant_heredofamiliares = json_decode($hclp['hclp_ant_heredofamiliares'], true);
    $hclp_ant_pareja = json_decode($hclp['hclp_ant_pareja'], true);
    $hclp_ant_pers_no_patologicos = json_decode($hclp['hclp_ant_pers_no_patologicos'], true);
    $hclp_ant_pers_patologicos = json_decode($hclp['hclp_ant_pers_patologicos'], true);
    $hclp_ant_gineco_obstetricos = json_decode($hclp['hclp_ant_gineco_obstetricos'], true);
    $hclp_embarazo_actual = json_decode($hclp['hclp_embarazo_actual'], true);

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
        <tr style="font-weight: bold; text-align: center">
            <td colspan="2">HISTORIA CLÍNICA PERINATAL</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Medico realiza:</strong> $usr_nombre <br>
                <strong>Motivo delenvio:</strong> $hclp[hclp_motivo]
            </td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">I. Antecedentes heredofamiliares </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Hermotipo:</strong> $hclp_ant_heredofamiliares[pte_hemotipo] 
                <strong>Cgdm:</strong> $hclp_ant_heredofamiliares[pte_cgdm]
                <strong>Consanguineaos:</strong> $hclp_ant_heredofamiliares[pte_consanguineos] <br>
                <strong>Antecedente genéticos:</strong> $hclp_ant_heredofamiliares[pte_ant_geneticos] <br>
                <strong>A. familiar preclampsia:</strong> $hclp_ant_heredofamiliares[pte_fam_preclampsia]
            </td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">II. Antecedente pareja</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Nombre:</strong> $hclp_ant_pareja[pte_nombre] 
                <strong>Edad:</strong> $hclp_ant_pareja[pte_edad] <br>
                <strong>App:</strong> $hclp_ant_pareja[pte_app]
                <strong>A. genéticos y/o defectos:</strong> $hclp_ant_pareja[pte_ant_geneticos_defectos] <br>
                <strong>Comentarios:</strong> $hclp_ant_pareja[pte_ant_pareja_comentarios]
            </td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">III. Antecedentes personales no patológicos</td>
        </tr>
        <tr>
           <td colspan="2">
                <strong>Toxicomanias:</strong> $hclp_ant_pers_no_patologicos[pte_toxicomanias] 
                <strong>Farmacos:</strong> $hclp_ant_pers_no_patologicos[pte_farmacos] <br>
                <strong>Ocupación:</strong> $hclp_ant_pers_no_patologicos[pte_ocupacion] <br>
                <strong>Exposiciones:</strong> $hclp_ant_pers_no_patologicos[pte_exposiciones] <br>
                <strong>Comentarios:</strong> $hclp_ant_pers_no_patologicos[pte_ant_no_patologicos_comentarios]
            </td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">IV. Antecedentes personales patológicos</td>
        </tr>
        <tr>
           <td colspan="2">
                <strong>Crónico-degenerativo:</strong> $hclp_ant_pers_patologicos[pte_cronico_degenerativo] <br>
                <strong>Cirugias:</strong> $hclp_ant_pers_patologicos[pte_cirugias] <br>
                <strong>Antecedentes con hijo sx down:</strong> $hclp_ant_pers_patologicos[pte_ant_sx_down] <br>
                <strong>Comentarios:</strong> $hclp_ant_pers_patologicos[pte_ant_patologicos_comentarios]
            </td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">V. Antecedentes gineco-obstetricos</td>
        </tr>
        <tr>
           <td colspan="2">
                <strong>G:</strong> $hclp_ant_gineco_obstetricos[pte_g]
                <strong>P:</strong> $hclp_ant_gineco_obstetricos[pte_p]
                <strong>C:</strong> $hclp_ant_gineco_obstetricos[pte_c]
                <strong>A:</strong> $hclp_ant_gineco_obstetricos[pte_a]
                <strong>E:</strong> $hclp_ant_gineco_obstetricos[pte_e]
                <strong>M:</strong> $hclp_ant_gineco_obstetricos[pte_m] <br>
                <strong>FUM:</strong> $hclp_ant_gineco_obstetricos[pte_fum]
                <strong>SDG:</strong> $hclp_ant_gineco_obstetricos[pte_sdg]
                <strong>FPP:</strong> $hclp_ant_gineco_obstetricos[pte_fpp] <br>

                <strong>AÑO:</strong> $hclp_ant_gineco_obstetricos[pte_año]
                <strong>RESOLUCIÓN:</strong> $hclp_ant_gineco_obstetricos[pte_resolucion]
                <strong>SDG:</strong> $hclp_ant_gineco_obstetricos[pte_sdg2]
                <strong>SEXO:</strong> $hclp_ant_gineco_obstetricos[pte_sexo]
                <strong>PESO:</strong> $hclp_ant_gineco_obstetricos[pte_peso]
                <strong>SANO:</strong> $hclp_ant_gineco_obstetricos[pte_sano]
                <strong>COMPLICACIÓN:</strong> $hclp_ant_gineco_obstetricos[pte_complicacion]
                <strong>OBSERVACIÓN:</strong> $hclp_ant_gineco_obstetricos[pte_observacion]
            </td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">VI. Padecimiento actual</td>
        </tr>
        <tr>
            <td colspan="2">$hclp[hclp_pedecimiento_actual]</td>
        </tr>
        <tr style="background-color: #D5E5FA; font-weight: bold; ">
            <td colspan="2">VII. Embarazo actual</td>
        </tr>
        <tr>
           <td colspan="2">
                <strong>Logrado:</strong> $hclp_embarazo_actual[pte_logrado]
                <strong>Embarazo:</strong> $hclp_embarazo_actual[pte_embarazo]
                <strong>TA:</strong> $hclp_embarazo_actual[pte_ta]
                <strong>Peso:</strong> $hclp_embarazo_actual[pte_peso2]
                <strong>Talla:</strong> $hclp_embarazo_actual[pte_talla]
                <strong>IMC:</strong> $hclp_embarazo_actual[pte_imc]
                <strong>Raza:</strong> $hclp_embarazo_actual[pte_raza] <br>
                <strong>Donación ovulos:</strong> $hclp_embarazo_actual[pte_donacion_ovulos]
                <strong>Fecha nacimiento donador:</strong> $hclp_embarazo_actual[pte_fecha_nacimiento_donador]
                <strong>Edad donador:</strong> $hclp_embarazo_actual[pte_edad_donador]
            </td>
        </tr>
    </table>
   
EOF;

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);
    ob_end_clean();
    // $registro = str_replace(".", "", "prueba");
    $pdf->Output('Historia_clinica_perinatal_' . ComponentesControlador::obtenerNombrePaciente($hclp['hclp_pte_id']) . '.pdf', 'I');
}
