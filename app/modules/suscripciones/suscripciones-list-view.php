<?php
ComponentesControlador::getBreadCrumb('suscripciones', 'Suscripciones', 'Lista de suscriptores');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista</h4>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered fs-10 mb-0 w-100" id="datatable_suscripciones">
                        <thead class="bg-200">
                            <tr>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">CORREO</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        listarSuscripciones();
    })

    function listarSuscripciones() {
        datatable_suscripciones = $('#datatable_suscripciones').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'ajax': {
                'url': '<?= HTTP_HOST ?>' + 'api/v1/suscripciones/list',
                'method': 'POST', //usamos el metodo POST
                'data': {
                    // ctr_ruta: $('#ctr_ruta').val(),
                    // cra_status: cra_status
                }, //enviamos opcion 4 para que haga un SELECT
                'dataSrc': ''
            },
            'bDestroy': true,
            'ordering': false,
            order: false,
            'columns': [{
                    'data': 'scs_nombre'
                },
                {
                    'data': 'scs_correo'
                },
                {
                    'data': 'scs_telefono'
                },
                {
                    'data': 'scs_acciones'
                },
            ],
            'initComplete': function(settings, json) {
                // Esta función se llama después de que se han cargado y dibujado los datos iniciales
                $('#datatable_suscripciones tbody tr').addClass('btn-reveal-trigger');
            },
            'drawCallback': function(settings) {
                // Esta función se llama cada vez que se redibuja la tabla
                $('#datatable_suscripciones tbody tr').addClass('btn-reveal-trigger');
            }
        });
    }
</script>