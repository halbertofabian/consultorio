<?php
require_once(__DIR__ . '/../app/conexion.php');

class PacientesModelo
{
    public static function mdlGuardarPacientes($pte)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_pacientes_pte (pte_nombres, pte_ap_paterno, pte_ap_materno, pte_fecha_nacimiento,
            pte_edad, pte_sexo, pte_pais_nacimiento, pte_estado_nacimiento, pte_nacionalidad, pte_rfc, pte_curp,
            pte_codigo_postal, pte_estado, pte_delegacion_municipio, pte_colonia, pte_calle, pte_no_exterior,
            pte_no_interior, pte_telefono_fijo, pte_telefono_celular, pte_correo, pte_tipo_sangre, pte_estado_civil,
            pte_imss, pte_alergias, pte_fecha_registro, pte_usuario_registro, tenantid) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pte['pte_nombres']);
            $pps->bindValue(2, $pte['pte_ap_paterno']);
            $pps->bindValue(3, $pte['pte_ap_materno']);
            $pps->bindValue(4, $pte['pte_fecha_nacimiento']);
            $pps->bindValue(5, $pte['pte_edad']);
            $pps->bindValue(6, $pte['pte_sexo']);
            $pps->bindValue(7, $pte['pte_pais_nacimiento']);
            $pps->bindValue(8, $pte['pte_estado_nacimiento']);
            $pps->bindValue(9, $pte['pte_nacionalidad']);
            $pps->bindValue(10, $pte['pte_rfc']);
            $pps->bindValue(11, $pte['pte_curp']);
            $pps->bindValue(12, $pte['pte_codigo_postal']);
            $pps->bindValue(13, $pte['pte_estado']);
            $pps->bindValue(14, $pte['pte_delegacion_municipio']);
            $pps->bindValue(15, $pte['pte_colonia']);
            $pps->bindValue(16, $pte['pte_calle']);
            $pps->bindValue(17, $pte['pte_no_exterior']);
            $pps->bindValue(18, $pte['pte_no_interior']);
            $pps->bindValue(19, $pte['pte_telefono_fijo']);
            $pps->bindValue(20, $pte['pte_telefono_celular']);
            $pps->bindValue(21, $pte['pte_correo']);
            $pps->bindValue(22, $pte['pte_tipo_sangre']);
            $pps->bindValue(23, $pte['pte_estado_civil']);
            $pps->bindValue(24, $pte['pte_imss']);
            $pps->bindValue(25, $pte['pte_alergias']);
            $pps->bindValue(26, $pte['pte_fecha_registro']);
            $pps->bindValue(27, $pte['pte_usuario_registro']);
            $pps->bindValue(28, $pte['tenantid']);
            $pps->execute();
            return $con->lastInsertId();
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlActualizarPacientes($pte)
    {
        try {
            //code...
            $sql = "UPDATE tbl_pacientes_pte SET pte_nombres = ?, pte_ap_paterno = ?, pte_ap_materno = ?, pte_fecha_nacimiento = ?,
            pte_edad = ?, pte_sexo = ?, pte_pais_nacimiento = ?, pte_estado_nacimiento = ?, pte_nacionalidad = ?, pte_rfc = ?, pte_curp = ?,
            pte_codigo_postal = ?, pte_estado = ?, pte_delegacion_municipio = ?, pte_colonia = ?, pte_calle = ?, pte_no_exterior = ?,
            pte_no_interior = ?, pte_telefono_fijo = ?, pte_telefono_celular = ?, pte_correo = ?, pte_tipo_sangre = ?, pte_estado_civil = ?,
            pte_imss = ?, pte_alergias = ?, pte_usuario_registro = ? WHERE pte_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pte['pte_nombres']);
            $pps->bindValue(2, $pte['pte_ap_paterno']);
            $pps->bindValue(3, $pte['pte_ap_materno']);
            $pps->bindValue(4, $pte['pte_fecha_nacimiento']);
            $pps->bindValue(5, $pte['pte_edad']);
            $pps->bindValue(6, $pte['pte_sexo']);
            $pps->bindValue(7, $pte['pte_pais_nacimiento']);
            $pps->bindValue(8, $pte['pte_estado_nacimiento']);
            $pps->bindValue(9, $pte['pte_nacionalidad']);
            $pps->bindValue(10, $pte['pte_rfc']);
            $pps->bindValue(11, $pte['pte_curp']);
            $pps->bindValue(12, $pte['pte_codigo_postal']);
            $pps->bindValue(13, $pte['pte_estado']);
            $pps->bindValue(14, $pte['pte_delegacion_municipio']);
            $pps->bindValue(15, $pte['pte_colonia']);
            $pps->bindValue(16, $pte['pte_calle']);
            $pps->bindValue(17, $pte['pte_no_exterior']);
            $pps->bindValue(18, $pte['pte_no_interior']);
            $pps->bindValue(19, $pte['pte_telefono_fijo']);
            $pps->bindValue(20, $pte['pte_telefono_celular']);
            $pps->bindValue(21, $pte['pte_correo']);
            $pps->bindValue(22, $pte['pte_tipo_sangre']);
            $pps->bindValue(23, $pte['pte_estado_civil']);
            $pps->bindValue(24, $pte['pte_imss']);
            $pps->bindValue(25, $pte['pte_alergias']);
            $pps->bindValue(26, $pte['pte_usuario_registro']);
            $pps->bindValue(27, $pte['pte_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }


    public static function mdlMostrarPacientes($tenantid)
    {
        try {
            //code...
            $sql = "SELECT pte.*, usr.usr_nombre FROM tbl_pacientes_pte pte JOIN tbl_usuarios_usr usr ON pte.pte_usuario_registro = usr.usr_id WHERE pte.tenantid = ? AND pte.pte_estado_borrado = 1 ORDER BY pte.pte_id DESC";
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

    public static function mdlMostrarPacientesById($pte_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_pacientes_pte WHERE pte_id = ? AND pte_estado_borrado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pte_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlEliminarPacientes($pte_id)
    {
        try {
            //code...
            $sql = "UPDATE tbl_pacientes_pte SET pte_estado_borrado = 0 WHERE pte_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $pte_id);
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
