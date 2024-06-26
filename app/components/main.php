<main class="main" id="top">
    <div class="container" data-layout="container">
        <?php include_once 'app/components/navbar.php'; ?>
        <div class="content">
            <?php include_once 'app/components/topbar.php'; ?>

            <?php
            $routes = [
                'home' => 'app/modules/app/home-view.php',
                '404' => 'app/modules/app/404-view.php',
                'renovacion' => 'app/modules/app/renovacion-view.php',

                
                'usuarios' => 'app/modules/usuarios/usuarios.php',
                'suscripciones' => 'app/modules/suscripciones/suscripciones.php',
                'consultorios' => 'app/modules/consultorios/consultorios.php',
                'pacientes' => 'app/modules/pacientes/pacientes.php',
                'consultas' => 'app/modules/consultas/consultas.php',
                'citas' => 'app/modules/citas/citas.php',
                'ultrasonidos' => 'app/modules/ultrasonidos/ultrasonidos.php',
                'historial' => 'app/modules/historial/historial.php',
                'login' => 'app/modules/login/login.php',
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
            <?php 
            include_once 'app/components/footer.php'; ?>
        </div>
    </div>
</main>