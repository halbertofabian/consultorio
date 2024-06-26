<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>GestionalMedic</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= HTTP_HOST ?>app/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= HTTP_HOST ?>app/assets/img/isotipo_gestional_medic.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= HTTP_HOST ?>app/assets/img/isotipo_gestional_medic.svg">
    <link rel="shortcut icon" type="image/x-icon" href="<?= HTTP_HOST ?>app/assets/img/isotipo_gestional_medic.svg">
    <link rel="manifest" href="<?= HTTP_HOST ?>app/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?= HTTP_HOST ?>app/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="<?= HTTP_HOST ?>app/assets/js/config.js"></script>
    <script src="<?= HTTP_HOST ?>app/vendors/simplebar/simplebar.min.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="<?= HTTP_HOST ?>app/assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="<?= HTTP_HOST ?>app/assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="<?= HTTP_HOST ?>app/assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <link href="<?= HTTP_HOST ?>app/assets/css/toastr.min.css" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/assets/css/intro.css" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/vendors/fullcalendar/main.min.css" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/vendors/select2/select2.min.css" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css" rel="stylesheet">


    <link href="<?= HTTP_HOST ?>app/vendors/datatables.net-bs5/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="<?= HTTP_HOST ?>app/vendors/datatables.net-responsive/dataTablesResponsive.min.css" rel="stylesheet">

    <script src="<?= HTTP_HOST ?>app/vendors/jquery/jquery.min.js"></script>
    <script src="<?= HTTP_HOST ?>app/assets/js/toastr.min.js"></script>

    <script>
        // var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        // if (!isRTL) {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
        // }

        var navbarStyle = localStorage.getItem('navbarStyle');
        if (navbarStyle !== 'vibrant') {
            localStorage.setItem('navbarStyle', 'vibrant');
        }
    </script>

    <!-- 
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script> -->
</head>