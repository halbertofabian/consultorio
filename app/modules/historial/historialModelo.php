<?php
require_once(__DIR__ . '/../app/conexion.php');

class HistorialModelo{
    public static function mdlGuardarHistorial($hcl)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_historial_clinico_hcl (hcl_pte_id, hcl_usr_id, hcl_fecha_valoracion, hcl_pte_identificacion,
            hcl_ant_heredofamiliares, hcl_ant_pers_no_patologicos, hcl_ant_ginecoobstétricos, hcl_ant_pers_patologicos,
            hcl_motivo_ingreso, hcl_prin_evol_pad_actual, hcl_int_apar_sis, hcl_ficha_clinica, hcl_eiepli, hcl_ait,
            hcl_observaciones, tenantid) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $hcl['hcl_pte_id']);
            $pps->bindValue(2, $hcl['hcl_usr_id']);
            $pps->bindValue(3, $hcl['hcl_fecha_valoracion']);
            $pps->bindValue(4, $hcl['hcl_pte_identificacion']);
            $pps->bindValue(5, $hcl['hcl_ant_heredofamiliares']);
            $pps->bindValue(6, $hcl['hcl_ant_pers_no_patologicos']);
            $pps->bindValue(7, $hcl['hcl_ant_ginecoobstétricos']);
            $pps->bindValue(8, $hcl['hcl_ant_pers_patologicos']);
            $pps->bindValue(9, $hcl['hcl_motivo_ingreso']);
            $pps->bindValue(10, $hcl['hcl_prin_evol_pad_actual']);
            $pps->bindValue(11, $hcl['hcl_int_apar_sis']);
            $pps->bindValue(12, $hcl['hcl_ficha_clinica']);
            $pps->bindValue(13, $hcl['hcl_eiepli']);
            $pps->bindValue(14, $hcl['hcl_ait']);
            $pps->bindValue(15, $hcl['hcl_observaciones']);
            $pps->bindValue(16, $hcl['tenantid']);
            $pps->execute();
            return $con->lastInsertId();
            // return $pps->errorInfo();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarHistorial($hcl)
    {
        try {
            //code...
            $sql = "UPDATE tbl_historial_clinico_hcl SET hcl_usr_id = ?, hcl_fecha_valoracion = ?, hcl_pte_identificacion = ?,
            hcl_ant_heredofamiliares = ?, hcl_ant_pers_no_patologicos = ?, hcl_ant_ginecoobstétricos = ?, hcl_ant_pers_patologicos = ?,
            hcl_motivo_ingreso = ?, hcl_prin_evol_pad_actual = ?, hcl_int_apar_sis = ?, hcl_ficha_clinica = ?, hcl_eiepli = ?, hcl_ait = ?,
            hcl_observaciones = ? WHERE hcl_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $hcl['hcl_usr_id']);
            $pps->bindValue(2, $hcl['hcl_fecha_valoracion']);
            $pps->bindValue(3, $hcl['hcl_pte_identificacion']);
            $pps->bindValue(4, $hcl['hcl_ant_heredofamiliares']);
            $pps->bindValue(5, $hcl['hcl_ant_pers_no_patologicos']);
            $pps->bindValue(6, $hcl['hcl_ant_ginecoobstétricos']);
            $pps->bindValue(7, $hcl['hcl_ant_pers_patologicos']);
            $pps->bindValue(8, $hcl['hcl_motivo_ingreso']);
            $pps->bindValue(9, $hcl['hcl_prin_evol_pad_actual']);
            $pps->bindValue(10, $hcl['hcl_int_apar_sis']);
            $pps->bindValue(11, $hcl['hcl_ficha_clinica']);
            $pps->bindValue(12, $hcl['hcl_eiepli']);
            $pps->bindValue(13, $hcl['hcl_ait']);
            $pps->bindValue(14, $hcl['hcl_observaciones']);
            $pps->bindValue(15, $hcl['hcl_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarHistorialByPaciente($hcl_pte_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_historial_clinico_hcl WHERE hcl_pte_id = ? AND hcl_estado_borrado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $hcl_pte_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarHistorialById($hcl_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_historial_clinico_hcl WHERE hcl_id = ? AND hcl_estado_borrado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $hcl_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
}