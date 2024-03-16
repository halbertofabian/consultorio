<?php
require_once(__DIR__ . '/../app/conexion.php');

class UsuariosModelo
{
    public static function mdlGuardarUsuarios($usr)
    {
        try {
            //code...
            $sql = "INSERT INTO tbl_usuarios_usr (usr_nombre, usr_correo, usr_clave, usr_perfil, usr_foto, usr_fecha_registro, tenantid) VALUES(?,?,?,?,?,?,?)";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $usr['usr_nombre']);
            $pps->bindValue(2, $usr['usr_correo']);
            $pps->bindValue(3, $usr['usr_clave']);
            $pps->bindValue(4, $usr['usr_perfil']);
            $pps->bindValue(5, $usr['usr_foto']);
            $pps->bindValue(6, $usr['usr_fecha_registro']);
            $pps->bindValue(7, $usr['tenantid']);
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

    public static function mdlActualizarUsuarios($usr)
    {
        try {
            //code...
            $sql = "UPDATE tbl_usuarios_usr SET usr_nombre = ?, usr_correo = ?, usr_clave = ?, usr_perfil = ?, usr_foto = ? WHERE usr_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $usr['usr_nombre']);
            $pps->bindValue(2, $usr['usr_correo']);
            $pps->bindValue(3, $usr['usr_clave']);
            $pps->bindValue(4, $usr['usr_perfil']);
            $pps->bindValue(5, $usr['usr_foto']);
            $pps->bindValue(6, $usr['usr_id']);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlMostrarUsuarios($tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_usuarios_usr WHERE tenantid = ? AND usr_estado_borrado = 1 ORDER BY usr_id DESC";
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
    public static function mdlMostrarUsuariosById($usr_id)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_usuarios_usr WHERE usr_id = ? AND usr_estado_borrado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $usr_id);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            //throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarUsuarioByCorreo($usr_correo, $tenantid)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_usuarios_usr WHERE usr_correo = ? AND usr_estado_borrado = 1 AND tenantid = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $usr_correo);
            $pps->bindValue(2, $tenantid);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
            // return $pps->errorInfo();
        } catch (PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlMostrarUsuarioByCorreoLogin($usr_correo)
    {
        try {
            //code...
            $sql = "SELECT * FROM tbl_usuarios_usr WHERE usr_correo = ? AND usr_estado_borrado = 1";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $usr_correo);
            $pps->execute();
            return $pps->fetch(PDO::FETCH_ASSOC);
            // return $pps->errorInfo();
        } catch (PDOException $th) {
            throw $th;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlEliminarUsuarios($usr_id)
    {
        try {
            //code...
            $sql = "UPDATE tbl_usuarios_usr SET usr_estado_borrado = 0 WHERE usr_id = ?";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $usr_id);
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