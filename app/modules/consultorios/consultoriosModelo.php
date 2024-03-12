<?php
require_once(__DIR__ . '/../app/conexion.php');

class ConsultoriosModelo
{
    public static function mdlGuardarDatosConsultorios($ctr)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_consultorios_ctr (ctr_logo, ctr_nombre, ctr_telefono_fijo, ctr_telefono_celular, tenantid) VALUES(?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ctr['ctr_logo']);
            $pps->bindValue(2, $ctr['ctr_nombre']);
            $pps->bindValue(3, $ctr['ctr_telefono_fijo']);
            $pps->bindValue(4, $ctr['ctr_telefono_celular']);
            $pps->bindValue(5, $ctr['tenantid']);
            $pps->execute();
            return $con->lastInsertId();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarDatosConsultorios($ctr)
    {
        try {
            //code...
            $sql = "UPDATE tbl_consultorios_ctr SET ctr_logo = ?, ctr_nombre = ?, ctr_telefono_fijo = ?, ctr_telefono_celular = ? WHERE ctr_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ctr['ctr_logo']);
            $pps->bindValue(2, $ctr['ctr_nombre']);
            $pps->bindValue(3, $ctr['ctr_telefono_fijo']);
            $pps->bindValue(4, $ctr['ctr_telefono_celular']);
            $pps->bindValue(5, $ctr['ctr_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlGuardarDireccionConsultorios($ctr)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_consultorios_ctr (ctr_codigo_postal, ctr_estado, ctr_delegacion_municipio, ctr_colonia,
             ctr_calle, ctr_no_exterior, ctr_no_interior, ctr_entre_calle_1, ctr_entre_calle_2, tenantid) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ctr['ctr_codigo_postal']);
            $pps->bindValue(2, $ctr['ctr_estado']);
            $pps->bindValue(3, $ctr['ctr_delegacion_municipio']);
            $pps->bindValue(4, $ctr['ctr_colonia']);
            $pps->bindValue(5, $ctr['ctr_calle']);
            $pps->bindValue(6, $ctr['ctr_no_exterior']);
            $pps->bindValue(7, $ctr['ctr_no_interior']);
            $pps->bindValue(8, $ctr['ctr_entre_calle_1']);
            $pps->bindValue(9, $ctr['ctr_entre_calle_2']);
            $pps->bindValue(10, $ctr['tenantid']);
            $pps->execute();
            return $con->lastInsertId();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarDireccionConsultorios($ctr)
    {
        try {
            //code...
            $sql = "UPDATE tbl_consultorios_ctr SET ctr_codigo_postal = ?, ctr_estado = ?, ctr_delegacion_municipio = ?, ctr_colonia = ?,
             ctr_calle = ?, ctr_no_exterior = ?, ctr_no_interior = ?, ctr_entre_calle_1 = ?, ctr_entre_calle_2 = ? WHERE ctr_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ctr['ctr_codigo_postal']);
            $pps->bindValue(2, $ctr['ctr_estado']);
            $pps->bindValue(3, $ctr['ctr_delegacion_municipio']);
            $pps->bindValue(4, $ctr['ctr_colonia']);
            $pps->bindValue(5, $ctr['ctr_calle']);
            $pps->bindValue(6, $ctr['ctr_no_exterior']);
            $pps->bindValue(7, $ctr['ctr_no_interior']);
            $pps->bindValue(8, $ctr['ctr_entre_calle_1']);
            $pps->bindValue(9, $ctr['ctr_entre_calle_2']);
            $pps->bindValue(10, $ctr['ctr_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
            // return $pps->errorInfo();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarConsultorios()
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_consultorios_ctr WHERE scs_estado = 1 ORDER BY scs_id DESC";
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
    public static function mdlMostrarConsultoriosById($ctr_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_consultorios_ctr WHERE ctr_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $ctr_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarConsultoriosByTenantId($tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_consultorios_ctr WHERE tenantid = ?";
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
}
