<main class="main" id="top">
    <div class="container" data-layout="container">
        <?php include_once 'app/components/navbar.php'; ?>
        <div class="content">
            <?php include_once 'app/components/topbar.php'; ?>

            <?php
            $routes = [
                'users' => 'app/modules/users/users.php',
                'home' => 'app/modules/app/home-view.php',
                '404' => 'app/modules/app/404-view.php',
                // Agrega más rutas y archivos según sea necesario
            ];
            // Aquí irá todo el contenido
            if (isset($_GET['ruta'])) {
                $rutas = explode('/', $_GET['ruta']);
                // Verificar si la ruta solicitada está en el arreglo de rutas definido
                if (array_key_exists($rutas[0], $routes)) {
                    // Incluir el archivo correspondiente a la ruta solicitada
                    include_once $routes[$rutas[0]];
                } else {
                    // Mostrar un error 404 si la ruta no está definida en el arreglo
                    include_once $routes['404'];
                }
            } else {
                include_once $routes['home'];
            }
            ?>
            <?php include_once 'app/components/footer.php'; ?>
        </div>
    </div>
</main>