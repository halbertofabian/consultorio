<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php include_once 'app/components/head.php'; ?>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <?php
    if (!isset($_SESSION['usr'])) {
        // header('Location:' . URL_SOFTMOR);
        // header('Location: ' . HTTP_HOST);
        include 'app/modules/app/login.php';
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