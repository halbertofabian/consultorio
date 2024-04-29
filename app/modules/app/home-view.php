<h5>Bienvenido (@)</h5>

<script>
    $(document).ready(function() {
        // localStorage.removeItem('intro1');
        if ('<?= $_SESSION['scs']['scs_intro'] ?>' == 0) {
            startIntro();
        }
    });

    function startIntro() {
        var intro = introJs();
        intro.setOptions({
            steps: [{
                    intro: "¡Bienvenido a GestionalMedic!"
                },
                {
                    element: document.querySelector('#step1'),
                    intro: "En el lado izquierdo, encontrarás un menú que contiene los diferentes módulos disponibles.",
                    position: 'right'
                },
                {
                    element: document.querySelector('#step2'),
                    intro: "En la esquina superior derecha, encontrarás la imagen o foto del usuario logueado. Al hacer clic en esta imagen, se abrirá un menú de opciones.",
                    position: 'left'
                },
                {
                    element: document.querySelector('#step3'),
                    intro: "En el menú de opciones, encontrarás el perfil del usuario, los ajustes para el consultorio (disponible solo para perfiles de Doctor) y la opción para cerrar sesión.",
                    position: 'left'
                },
                {
                    element: document.querySelector('#step4'),
                    intro: "En el lado derecho, verás un botón flotante. Al hacer clic en él, se abrirán opciones para configurar el estilo de nuestro sistema.",
                    position: 'left'
                }
            ],
            nextLabel: 'Siguiente',
            prevLabel: 'Atrás',
            doneLabel: 'Hecho',
            exitOnEsc: false,
            exitOnOverlayClick: false,
            exitOnClose: false
        });

        intro.start();

        intro.onbeforechange(function() {
            var currentStep = intro._currentStep;
            if (currentStep == 2) { // El índice numérico del primer paso es 0
                // Abre el dropdown al hacer clic en el avatar
                $('#step2').click();
            }
        });
        intro.onbeforeexit(function() {
            $('#step2').click();
            terminarIntro();
            // localStorage.setItem('intro1', 'true');
            // return confirm("¿Esta seguro de temrinar con la intro?");
        });
    }

    function terminarIntro() {
        var datos = new FormData()
        datos.append('scs_id', '<?= $_SESSION['scs']['scs_id'] ?>');
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/suscripciones/update/intro',
            data: datos,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    swal({
                        title: '¡Bien!',
                        text: res.mensaje,
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
                    });
                }
            }
        });
    }
</script>