<?php
require_once(__DIR__ . '/../app/conexion.php');

class ConsultasModelo
{
    public static function mdlGuardarConsultas($cta)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_consultas_cta (cta_usr_id, cta_ctr_id, cta_pte_id, cta_subjetivo,
            cta_objetivo, cta_analisis, cta_plan, cta_fecha, tenantid) VALUES(?,?,?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cta['cta_usr_id']);
            $pps->bindValue(2, $cta['cta_ctr_id']);
            $pps->bindValue(3, $cta['cta_pte_id']);
            $pps->bindValue(4, $cta['cta_subjetivo']);
            $pps->bindValue(5, $cta['cta_objetivo']);
            $pps->bindValue(6, $cta['cta_analisis']);
            $pps->bindValue(7, $cta['cta_plan']);
            $pps->bindValue(8, $cta['cta_fecha']);
            $pps->bindValue(9, $cta['tenantid']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarConsultas($cta)
    {
        try {
            //code...
            $sql = "UPDATE tbl_consultas_cta SET cta_subjetivo = ?, cta_objetivo = ?, cta_analisis = ?, cta_plan = ?, cta_fecha = ? WHERE cta_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cta['cta_subjetivo']);
            $pps->bindValue(2, $cta['cta_objetivo']);
            $pps->bindValue(3, $cta['cta_analisis']);
            $pps->bindValue(4, $cta['cta_plan']);
            $pps->bindValue(5, $cta['cta_fecha']);
            $pps->bindValue(6, $cta['cta_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }



    public static function mdlMostrarConsultas($tenantid, $cta_usr_id, $cta_ctr_id)
    {
        try {
            //code...
            $sql = "SELECT cta.*, pte.pte_nombres, pte.pte_ap_paterno, pte.pte_ap_materno, pte.pte_edad FROM tbl_consultas_cta cta JOIN tbl_pacientes_pte pte ON cta.cta_pte_id = pte.pte_id WHERE cta.tenantid = ? AND cta.cta_usr_id = ? AND cta.cta_ctr_id = ? AND cta.cta_estado_borrado = 1 ORDER BY cta.cta_id DESC";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $tenantid);
            $pps->bindValue(2, $cta_usr_id);
            $pps->bindValue(3, $cta_ctr_id);
            $pps->execute();
            return $pps->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarConsultasById($cta_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_consultas_cta WHERE cta_id = ? AND cta_estado_borrado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cta_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlEliminarConsultas($cta_id)
    {
        try {
            //code...
            $sql = "UPDATE tbl_consultas_cta SET cta_estado_borrado = 0 WHERE cta_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cta_id);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
}
