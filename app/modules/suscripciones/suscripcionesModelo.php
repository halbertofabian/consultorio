<?php
require_once(__DIR__ . '/../app/conexion.php');

class SuscripcionesModelo
{
    public static function mdlGuardarSuscripciones($scs)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_suscripciones_scs (scs_correo, scs_telefono, scs_nombre, tenantid) VALUES(?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $scs['scs_correo']);
            $pps->bindValue(2, $scs['scs_telefono']);
            $pps->bindValue(3, $scs['scs_nombre']);
            $pps->bindValue(4, $scs['tenantid']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarSuscripciones($scs)
    {
        try {
            //code...
            $sql = "UPDATE tbl_suscripciones_scs SET scs_correo = ?, scs_telefono = ?, scs_nombre = ? WHERE scs_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $scs['scs_correo']);
            $pps->bindValue(2, $scs['scs_telefono']);
            $pps->bindValue(3, $scs['scs_nombre']);
            $pps->bindValue(4, $scs['scs_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarSuscriptores()
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_suscripciones_scs WHERE scs_estado = 1 ORDER BY scs_id DESC";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);

            $pps->execute();
            return $pps->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarSuscriptoresById($scs_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_suscripciones_scs WHERE scs_id = ? AND scs_estado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $scs_id);
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
