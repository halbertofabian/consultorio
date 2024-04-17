<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HistorialController
{
    public function create(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['hcl_pte_identificacion'] = json_encode(array(
            'pte_no_identificacion' => $data['pte_no_identificacion'],
            'pte_fecha_nacimiento' => $data['pte_fecha_nacimiento'],
            'pte_edad' => $data['pte_edad'],
            'pte_estado_nacimiento' => $data['pte_estado_nacimiento'],
            'pte_estado_civil' => $data['pte_estado_civil'],
            'pte_escolaridad' => $data['pte_escolaridad'],
            'pte_ocupacion' => $data['pte_ocupacion'],
            'pte_derechohabiencia' => $data['pte_derechohabiencia'],
            'pte_caso' => $data['pte_caso'],
            'pte_religion' => $data['pte_religion'],
            'pte_indigena' => $data['pte_indigena'],
            'pte_lengua_indigena' => $data['pte_lengua_indigena'],
            'pte_lengua' => $data['pte_lengua'],
        ), true);
        $data['hcl_ant_heredofamiliares'] = json_encode(array(
            'pte_diabetes' => $data['pte_diabetes'],
            'pte_nefropatas' => $data['pte_nefropatas'],
            'pte_hipertension' => $data['pte_hipertension'],
            'pte_malformaciones' => $data['pte_malformaciones'],
            'pte_cancer' => $data['pte_cancer'],
            'pte_cardiopatas' => $data['pte_cardiopatas'],
        ), true);
        $data['hcl_ant_pers_no_patologicos'] = json_encode(array(
            'pte_tabaquismo' => $data['pte_tabaquismo'],
            'pte_tabaquismo_cantidad' => $data['pte_tabaquismo_cantidad'],
            'pte_tabaquismo_tiempo' => $data['pte_tabaquismo_tiempo'],
            'pte_tabaquismo_ant' => $data['pte_tabaquismo_ant'],
            'pte_tabaquismo_pasivo' => $data['pte_tabaquismo_pasivo'],
            'pte_alcoholismo' => $data['pte_alcoholismo'],
            'pte_alcoholismo_cantidad' => $data['pte_alcoholismo_cantidad'],
            'pte_alcoholismo_tiempo' => $data['pte_alcoholismo_tiempo'],
            'pte_alcoholismo_ant' => $data['pte_alcoholismo_ant'],
            'pte_alergias' => $data['pte_alergias'],
            'pte_tipo_sangre' => $data['pte_tipo_sangre'],
            'pte_servicios_basicos' => $data['pte_servicios_basicos'],
            'pte_farmacodependencia' => $data['pte_farmacodependencia'],
            'pte_farmacodependencia_tiempo' => $data['pte_farmacodependencia_tiempo'],
        ), true);
        $data['hcl_ant_ginecoobstétricos'] = json_encode(array(
            'pte_menarca' => $data['pte_menarca'],
            'pte_ciclos_regulares' => $data['pte_ciclos_regulares'],
            'pte_ritmo' => $data['pte_ritmo'],
            'pte_ultima_menstruacion' => $data['pte_ultima_menstruacion'],
            'pte_polimenorrea' => $data['pte_polimenorrea'],
            'pte_hipermenorrea' => $data['pte_hipermenorrea'],
            'pte_dismenorrea' => $data['pte_dismenorrea'],
            'pte_incapacitante' => $data['pte_incapacitante'],
            'pte_IVSA' => $data['pte_IVSA'],
            'pte_no_parejas' => $data['pte_no_parejas'],
            'pte_fecha_citologia' => $data['pte_fecha_citologia'],
            'pte_resultado' => $data['pte_resultado'],
            'pte_planificacion_actual' => $data['pte_planificacion_actual'],
        ), true);
        $data['hcl_ant_pers_patologicos'] = json_encode(array(
            'pte_enfermedades_infancia' => $data['pte_enfermedades_infancia'],
            'pte_secuelas' => $data['pte_secuelas'],
            'pte_hospitalizacion' => $data['pte_hospitalizacion'],
            'pte_antecedentes_quirurgicos' => $data['pte_antecedentes_quirurgicos'],
            'pte_transfusiones_previas' => $data['pte_transfusiones_previas'],
            'pte_fracturas' => $data['pte_fracturas'],
            'pte_traumatismo' => $data['pte_traumatismo'],
            'pte_otra_enfermedad' => $data['pte_otra_enfermedad'],
        ), true);

        $data['hcl_motivo_ingreso'] = $data['pte_motivo_ingreso'];
        $data['hcl_prin_evol_pad_actual'] = $data['pte_padecimiento_actual'];

        $data['hcl_int_apar_sis'] = json_encode(array(
            'pte_respiratorio' => $data['pte_respiratorio'],
            'pte_digestivo' => $data['pte_digestivo'],
            'pte_endocrino' => $data['pte_endocrino'],
            'pte_musculo_esqueletico' => $data['pte_musculo_esqueletico'],
            'pte_genito_urinario' => $data['pte_genito_urinario'],
            'pte_hematopoyético' => $data['pte_hematopoyético'],
            'pte_piel_anexos' => $data['pte_piel_anexos'],
            'pte_neurologico' => $data['pte_neurologico'],
            'pte_medicamentos_actuales' => $data['pte_medicamentos_actuales'],
            'pte_medicamentos' => "",
        ), true);

        $data['hcl_ficha_clinica'] = json_encode(array(
            'pte_ta' => $data['pte_ta'],
            'pte_pulso' => $data['pte_pulso'],
            'pte_fr' => $data['pte_fr'],
            'pte_temp' => $data['pte_temp'],
            'pte_peso' => $data['pte_peso'],
            'pte_talla' => $data['pte_talla'],
            'pte_habitus_exterior' => $data['pte_habitus_exterior'],
            'pte_piel_anexos2' => $data['pte_piel_anexos2'],
            'pte_cabeza_cuello' => $data['pte_cabeza_cuello'],
            'pte_torax' => $data['pte_torax'],
            'pte_abdomen' => $data['pte_abdomen'],
            'pte_genitales' => $data['pte_genitales'],
            'pte_extremidades' => $data['pte_extremidades'],
            'pte_sistema_nervioso' => $data['pte_sistema_nervioso'],
        ), true);

        $data['hcl_eiepli'] = $data['pte_examenes_laboratorio'];

        $data['hcl_ait'] = json_encode(array(
            'pte_probables_diagnosticos' => $data['pte_probables_diagnosticos'],
            'pte_plan_estudio' => $data['pte_plan_estudio'],
            'pte_terapeutica_inicial' => $data['pte_terapeutica_inicial'],
        ), true);

        $data['hcl_observaciones'] = $data['pte_comentarios_finales'];
        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        if ($data['hcl_id'] == "") {
            $res = HistorialModelo::mdlGuardarHistorial($data);
        } else {
            $res = HistorialModelo::mdlActualizarHistorial($data);
        }
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'La historia clínica se guardo correctamente',
                'hcl_id' => $res
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }

    public function get(Request $request, Response $response, $args)
    {
        $queryParams = $request->getQueryParams();

        $hcl_pte_id = base64_decode($queryParams['hcl_pte_id']) ?? null;

        $hcl = HistorialModelo::mdlMostrarHistorialByPaciente($hcl_pte_id);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($hcl, true));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
