<?php

class ComponentesControlador
{
    public static function getBreadCrumb($ruta, $modulo, $vista)
    {
        include 'app/components/breadcrumb.php';
    }

    public static function imageUpload($inputName)
    {
        $url_file = "";
        $error_message = "";

        if (!empty($_FILES[$inputName]["tmp_name"])) {
            // Ruta donde se guardará la imagen en el servidor
            $directorioDestino = DOCUMENT_ROOT . "upload/" . $_SESSION['usr']['tenantid'] . '/';
            $url_file = HTTP_HOST . "upload/" . $_SESSION['usr']['tenantid'] . '/';

            if (!file_exists($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            $imagen = $_FILES[$inputName];

            // Validar el tamaño de la imagen (en este ejemplo, máximo 5 MB)
            $maxSize = 5 * 500 * 500; // 5 MB en bytes
            // if ($imagen["size"] <= $maxSize) {
            // $imagenOriginal = imagecreatefromstring(file_get_contents($imagen["tmp_name"]));
            // $imagenRedimensionada = imagescale($imagenOriginal, 1024, 1024);
            // Obtener la extensión del archivo
            $extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);
            // Generar un nombre único para el archivo
            $nombreArchivo = uniqid() . '.' . $extension;
            // Ruta completa del archivo de destino
            $rutaDestino = $directorioDestino . $nombreArchivo;
            $url_file = $url_file . $nombreArchivo;

            // Mover el archivo subido al directorio de destino
            move_uploaded_file($imagen["tmp_name"], $rutaDestino);

            // imagejpeg($imagenRedimensionada, $rutaDestino);

            // imagedestroy($imagenOriginal);
            // imagedestroy($imagenRedimensionada);
            // } else {
            //     $error_message = 'El tamaño de la imagen ' . $imagen["name"] .' excede el límite permitido (5 MB).';
            // }
        }

        if (!empty($error_message)) {
            return array(
                'status' => false,
                'mensaje' => $error_message
            );
        }

        return $url_file;
    }
}
