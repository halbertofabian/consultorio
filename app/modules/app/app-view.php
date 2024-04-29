<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php 
include_once 'app/components/head.php'; 

if (isset($_GET['tokenAut']) && $_GET['tokenAut']) {
    $usr = UsuariosModelo::mdlMostrarUsuarioByTokenAut($_GET['tokenAut']);
    if($usr){
        LoginController::ctrIngresoUsuarioNuevo($usr);
        die();
    }else{
        echo '<script>

            window.location = "' . HTTP_HOST . '";

        </script>';
    }
}
?>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <?php
    if (!isset($_SESSION['usr'])) {
        // header('Location:' . URL_SOFTMOR);
        // header('Location: ' . HTTP_HOST);
        include_once 'app/modules/app/login.php';
        die();
    } else {
        include_once 'app/components/main.php';
    }
    ?>

    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    <?php 
    include_once 'app/components/offcanvas.php'; 
    include_once 'app/components/scripts-globales.php'; 
    ?>
</body>

</html>