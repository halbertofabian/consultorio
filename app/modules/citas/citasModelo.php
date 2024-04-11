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
            $sql = "UPDATE tbl_citas_cts SET cts_ctr_id = ?, cts_usr_id = ?,
            cts_fecha_inicio = ?, cts_fecha_fin = ?, cts_usuario_registro = ?, cts_descripcion = ? WHERE cts_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts['cts_ctr_id']);
            $pps->bindValue(2, $cts['cts_usr_id']);
            $pps->bindValue(3, $cts['cts_fecha_inicio']);
            $pps->bindValue(4, $cts['cts_fecha_fin']);
            $pps->bindValue(5, $cts['cts_usuario_registro']);
            $pps->bindValue(6, $cts['cts_descripcion']);
            $pps->bindValue(7, $cts['cts_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }



    public static function mdlMostrarCitas($tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_citas_cts WHERE tenantid = ? AND cts_estado IN ('Pendiente', 'Asistió') ORDER BY cts_id DESC";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $tenantid);
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
            $sql = "SELECT * FROM tbl_citas_cts WHERE cts_id = ?";
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

    public static function mdlMostrarCitasByFechas($cts_fecha_inicio, $cts_fecha_fin, $cts_ctr_id, $cts_usr_id, $tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_citas_cts 
            WHERE 
                (cts_fecha_inicio < '$cts_fecha_fin' AND cts_fecha_fin > '$cts_fecha_inicio')
                AND cts_estado = 'Pendiente' AND cts_ctr_id = ? AND cts_usr_id = ? AND tenantid = ?
            ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts_ctr_id);
            $pps->bindValue(2, $cts_usr_id);
            $pps->bindValue(3, $tenantid);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualuzarEstadoCitas($cts_estado, $cts_id)
    {
        try {
            //code...
            $sql = "UPDATE tbl_citas_cts SET cts_estado = ? WHERE cts_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $cts_estado);
            $pps->bindValue(2, $cts_id);
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
