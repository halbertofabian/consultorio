<?php
require_once(__DIR__ . '/../app/conexion.php');

class CitasModelo
{
    public static function mdlGuardarCitas($cts)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_citas_cts (cts_pte_id, cts_ctr_id, cts_usr_id, cts_fecha,
            cts_fecha_inicio, cts_fecha_fin, cts_usuario_registro, cts_descripcion, tenantid) VALUES(?,?,?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts['cts_pte_id']);
            $pps->bindValue(2, $cts['cts_ctr_id']);
            $pps->bindValue(3, $cts['cts_usr_id']);
            $pps->bindValue(4, $cts['cts_fecha']);
            $pps->bindValue(5, $cts['cts_fecha_inicio']);
            $pps->bindValue(6, $cts['cts_fecha_fin']);
            $pps->bindValue(7, $cts['cts_usuario_registro']);
            $pps->bindValue(8, $cts['cts_descripcion']);
            $pps->bindValue(9, $cts['tenantid']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarCitas($cts)
    {
        try {
            //code...
            $sql = "UPDATE tbl_citas_cts SET cta_subjetivo = ?, cta_objetivo = ?, cta_analisis = ?, cta_plan = ?, cta_fecha = ? WHERE cta_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts['cta_subjetivo']);
            $pps->bindValue(2, $cts['cta_objetivo']);
            $pps->bindValue(3, $cts['cta_analisis']);
            $pps->bindValue(4, $cts['cta_plan']);
            $pps->bindValue(5, $cts['cta_fecha']);
            $pps->bindValue(6, $cts['cta_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }



    public static function mdlMostrarCitas($cts_usr_id, $tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_citas_cts cts WHERE cts.cts_usr_id = ? AND cts.tenantid = ? ORDER BY cts.cts_id DESC";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts_usr_id);
            $pps->bindValue(2, $tenantid);
            $pps->execute();
            return $pps->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarCitasById($cts_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_citas_cts WHERE cta_id = ? AND cta_estado_borrado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarCitasByFechas($cts_fecha_inicio, $cts_fecha_fin, $tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_citas_cts 
            WHERE 
                (cts_fecha_inicio < '$cts_fecha_fin' AND cts_fecha_fin > '$cts_fecha_inicio')
                AND cts_estado = 'Pendiente' AND tenantid = ?
            ";
    
    
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $tenantid);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlEliminarCitas($cts_id)
    {
        try {
            //code...
            $sql = "UPDATE tbl_citas_cts SET cta_estado_borrado = 0 WHERE cta_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts_id);
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
