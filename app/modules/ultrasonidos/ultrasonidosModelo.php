<?php
require_once(__DIR__ . '/../app/conexion.php');

class UltrasonidosModelo
{
    public static function mdlGuardarUltrasonidos($uts)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_ultrasonidos_uts (uts_pte_id, uts_fecha, uts_motivo, uts_conclusion, tenantid) VALUES(?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $uts['uts_pte_id']);
            $pps->bindValue(2, $uts['uts_fecha']);
            $pps->bindValue(3, $uts['uts_motivo']);
            $pps->bindValue(4, $uts['uts_conclusion']);
            $pps->bindValue(5, $uts['tenantid']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarUltrasonidos($uts)
    {
        try {
            //code...
            $sql = "UPDATE tbl_ultrasonidos_uts SET uts_fecha = ?, uts_motivo = ?, uts_conclusion = ? WHERE uts_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $uts['uts_fecha']);
            $pps->bindValue(2, $uts['uts_motivo']);
            $pps->bindValue(3, $uts['uts_conclusion']);
            $pps->bindValue(4, $uts['uts_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }



    public static function mdlMostrarUltrasonidos($tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_ultrasonidos_uts WHERE tenantid = ? AND uts_estado_borrado = 1 ORDER BY uts_id DESC";
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

    public static function mdlMostrarUltrasonidosById($uts_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_ultrasonidos_uts WHERE uts_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $uts_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarUltrasonidosByFechas($uts_fecha, $tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_ultrasonidos_uts 
            WHERE 
                (uts_fecha = '$uts_fecha')
                AND uts_estado_borrado = 1 AND tenantid = ?
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

    public static function mdlEliminarUltrasonidos($uts_id)
    {
        try {
            //code...
            $sql = "UPDATE tbl_ultrasonidos_uts SET uts_estado_borrado = 0 WHERE uts_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $uts_id);
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
