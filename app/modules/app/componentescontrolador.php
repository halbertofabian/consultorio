<?php

require_once(__DIR__ . '/../pacientes/pacientesModelo.php');

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

    public static function getPaises()
    {
        return [
            "México",
            // Aquí puedes agregar más países según sea necesario
        ];
    }

    public static function getEstados()
    {
        return [
            "Aguascalientes",
            "Baja California",
            "Baja California Sur",
            "Campeche",
            "Chiapas",
            "Chihuahua",
            "Coahuila",
            "Colima",
            "Durango",
            "Guanajuato",
            "Guerrero",
            "Hidalgo",
            "Jalisco",
            "México",
            "Michoacán",
            "Morelos",
            "Nayarit",
            "Nuevo León",
            "Oaxaca",
            "Puebla",
            "Querétaro",
            "Quintana Roo",
            "San Luis Potosí",
            "Sinaloa",
            "Sonora",
            "Tabasco",
            "Tamaulipas",
            "Tlaxcala",
            "Veracruz",
            "Yucatán",
            "Zacatecas"
        ];
    }

    public static function getNacionalidad()
    {
        return [
            "Mexicana",
            // Aquí puedes agregar más países según sea necesario
        ];
    }

    public static function generarCURP($nombre, $fecha_nacimiento, $sexo, $estado)
    {
        $nombre_limpio = ComponentesControlador::quitarAcentos($nombre);
        $nombreCompleto = mb_strtoupper($nombre_limpio, 'UTF-8');

        $apellidos = explode(" ", $nombreCompleto);
        $primerApellido = $apellidos[0];
        $segundoApellido = $apellidos[1];
        $primerNombre = $apellidos[2];

        // Encontrar primera letra del primer apellido seguido de la primera vocal
        $primerVocal = "";
        for ($i = 1; $i < strlen($primerApellido); $i++) { // Empezar desde la segunda letra del apellido
            if (in_array($primerApellido[$i], ["A", "E", "I", "O", "U"]) && $primerApellido[$i] !== $primerApellido[0]) {
                $primerVocal = $primerApellido[$i];
                break;
            }
        }

        // Encontrar primera letra del apellido materno
        $primeraLetraApellidoMaterno = $segundoApellido[0];

        // Encontrar primera letra del primer nombre
        $primeraLetraPrimerNombre = $primerNombre[0];

        // Imprimir resultado

        $fecha = $fecha_nacimiento;
        $nuevaFecha = date("ymd", strtotime($fecha));

        $genero = $sexo; // Suponiendo que tienes esta información
        $genero = ($genero === "Masculino") ? "H" : "M";

        $entidadNacimiento = $estado;

        $entidades = ComponentesControlador::obtenerClavesEntidadesFederativas();
        $clave = $entidades[$entidadNacimiento];

        $consonantePrimerApellido = ComponentesControlador::obtenerConsonante($primerApellido, $primerApellido[0]);
        $consonanteSegundoApellido = ComponentesControlador::obtenerConsonante($segundoApellido, $segundoApellido[0]);
        $consonantePrimerNombre = ComponentesControlador::obtenerConsonante($primerNombre, $primerNombre[0]);

        $curp = $primerApellido[0] . $primerVocal . $primeraLetraApellidoMaterno . $primeraLetraPrimerNombre . $nuevaFecha . $genero . $clave . $consonantePrimerApellido . $consonanteSegundoApellido . $consonantePrimerNombre;
        return $curp;
    }

    public static function generarRFC($nombre, $fecha_nacimiento)
    {
        $nombre_limpio = ComponentesControlador::quitarAcentos($nombre);
        $nombreCompleto = mb_strtoupper($nombre_limpio, 'UTF-8');

        $apellidos = explode(" ", $nombreCompleto);
        $primerApellido = $apellidos[0];
        $segundoApellido = $apellidos[1];
        $primerNombre = $apellidos[2];

        // Encontrar primera letra del primer apellido seguido de la primera vocal
        $primerVocal = "";
        for ($i = 1; $i < strlen($primerApellido); $i++) { // Empezar desde la segunda letra del apellido
            if (in_array($primerApellido[$i], ["A", "E", "I", "O", "U"]) && $primerApellido[$i] !== $primerApellido[0]) {
                $primerVocal = $primerApellido[$i];
                break;
            }
        }

        // Encontrar primera letra del apellido materno
        $primeraLetraApellidoMaterno = $segundoApellido[0];

        // Encontrar primera letra del primer nombre
        $primeraLetraPrimerNombre = $primerNombre[0];

        // Imprimir resultado

        $fecha = $fecha_nacimiento;
        $nuevaFecha = date("ymd", strtotime($fecha));

        $rfc = $primerApellido[0] . $primerVocal . $primeraLetraApellidoMaterno . $primeraLetraPrimerNombre . $nuevaFecha;
        return $rfc;
    }

    public static function quitarAcentos($cadena)
    {
        $acentos = array(
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ñ' => 'x', 'Ñ' => 'X'
        );
        return strtr($cadena, $acentos);
    }

    public static function obtenerClavesEntidadesFederativas()
    {
        $claves = array(
            "Aguascalientes" => "AS",
            "Baja California" => "BC",
            "Baja California Sur" => "BS",
            "Campeche" => "CC",
            "Coahuila" => "CL",
            "Colima" => "CM",
            "Chiapas" => "CS",
            "Chihuahua" => "CH",
            "Ciudad de México" => "DF",
            "Durango" => "DG",
            "Guanajuato" => "GT",
            "Guerrero" => "GR",
            "Hidalgo" => "HG",
            "Jalisco" => "JC",
            "México" => "MC",
            "Michoacán" => "MN",
            "Morelos" => "MS",
            "Nayarit" => "NT",
            "Nuevo León" => "NL",
            "Oaxaca" => "OC",
            "Puebla" => "PL",
            "Querétaro" => "QT",
            "Quintana Roo" => "QR",
            "San Luis Potosí" => "SP",
            "Sinaloa" => "SL",
            "Sonora" => "SR",
            "Tabasco" => "TC",
            "Tamaulipas" => "TS",
            "Tlaxcala" => "TL",
            "Veracruz" => "VZ",
            "Yucatán" => "YN",
            "Zacatecas" => "ZS"
        );

        return $claves;
    }

    public static function obtenerConsonante($palabra, $excluir)
    {
        $vocales = ["A", "E", "I", "O", "U"];
        $consonante = "";
        for ($i = 0; $i < strlen($palabra); $i++) {
            if ($palabra[$i] != $excluir && !in_array($palabra[$i], $vocales)) {
                $consonante = $palabra[$i];
                break;
            }
        }
        return $consonante;
    }

    public static function getTiposSangre()
    {
        $tipos_sangre = array(
            'A+' => 'A positivo',
            'A-' => 'A negativo',
            'B+' => 'B positivo',
            'B-' => 'B negativo',
            'AB+' => 'AB positivo',
            'AB-' => 'AB negativo',
            'O+' => 'O positivo',
            'O-' => 'O negativo'
        );

        return $tipos_sangre;
    }

    public static function getEstadosCiviles()
    {
        $estados_civiles = array(
            'Soltero/a',
            'Casado/a',
            'Unión libre',
            'Divorciado/a',
            'Viudo/a'
        );

        return $estados_civiles;
    }

    public static function fechaCastellano($fecha)
    {
        $hora = date('h:i a', strtotime(substr($fecha, 10, 10)));
        $fecha = substr($fecha, 0, 10);

        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio . ' - ' . $hora;
    }

    public static function obtenerNombrePaciente($pte_id)
    {
        $pte = PacientesModelo::mdlMostrarPacientesById($pte_id);
        if ($pte) {
            return $pte['pte_nombres'] . ' ' . $pte['pte_ap_paterno'] . ' ' . $pte['pte_ap_materno'];
        } else {
            return "";
        }
    }
    public static function obtenerNombreConsultorio($ctr_id)
    {
        $ctr = ConsultoriosModelo::mdlMostrarConsultoriosById($ctr_id);
        if ($ctr) {
            return $ctr['ctr_nombre'];
        } else {
            return "";
        }
    }

    public static function obtenerNombreUsuario($usr_id)
    {
        $usr = UsuariosModelo::mdlMostrarUsuariosById($usr_id);
        if ($usr) {
            return $usr['usr_nombre'];
        } else {
            return "";
        }
    }

    public static function reducir_resolucion_imagen($ruta_imagen_original, $factor_reduccion)
    {
        // Cargar la imagen original
        $imagen = imagecreatefrompng($ruta_imagen_original);

        // Obtener las dimensiones originales de la imagen
        $ancho_original = imagesx($imagen);
        $alto_original = imagesy($imagen);

        // Calcular el nuevo tamaño deseado
        $nuevo_ancho = $ancho_original * $factor_reduccion;
        $nuevo_alto = $alto_original * $factor_reduccion;

        // Crear una nueva imagen transparente con el nuevo tamaño
        $nueva_imagen = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        $transparency = imagecolorallocatealpha($nueva_imagen, 0, 0, 0, 127);
        imagefill($nueva_imagen, 0, 0, $transparency);
        imagesavealpha($nueva_imagen, true);

        // Copiar la imagen original a la nueva imagen
        imagecopyresampled($nueva_imagen, $imagen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);

        // Guardar la nueva imagen en un archivo temporal
        $imagen_reducida = tempnam(sys_get_temp_dir(), 'logo_');
        imagepng($nueva_imagen, $imagen_reducida);

        // Liberar la memoria de las imágenes
        imagedestroy($imagen);
        imagedestroy($nueva_imagen);

        // Devolver la ruta de la imagen reducida
        return $imagen_reducida;
    }


    public static function verificarFechaVencimientoSuscripcion($scs_id)
    {
        $scs = SuscripcionesModelo::mdlMostrarSuscriptoresById($scs_id);
        // Convertir la fecha de vencimiento a un objeto DateTime
        if ($scs['scs_fecha_fin']) {
            $scs_fecha_fin = new DateTime($scs['scs_fecha_fin']);

            // Obtener la fecha actual
            $fechaActual = new DateTime();

            // Comparar la fecha de vencimiento con la fecha actual
            if ($scs_fecha_fin <= $fechaActual) {
                SuscripcionesModelo::mdlActualizarEstadoSuscripcion($scs['scs_id']);
            }
        }
    }
}
