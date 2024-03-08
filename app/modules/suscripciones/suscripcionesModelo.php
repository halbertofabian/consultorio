<?php
require(__DIR__ . '../../app/conexion.php');

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
}