<?php
ComponentesControlador::getBreadCrumb('ultrasonidos', 'Ultrasonidos', 'Lista de ultrasonidos');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista</h4>
                <table class="table table-bordered fs-10 mb-0 w-100" id="datatable_ultrasonidos">
                    <thead class="bg-200">
                        <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">MOTIVO</th>
                            <th scope="col">CONCLUSIÓN</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        listarUltrasonidos();
    })

    function listarUltrasonidos() {
        datatable_ultrasonidos = $('#datatable_ultrasonidos').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'ajax': {
                'url': '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/list',
                'method': 'POST', //usamos el metodo POST
                'data': {
                    tenantid: '<?= $_SESSION['usr']['tenantid'] ?>',
                    // cra_status: cra_status
                }, //enviamos opcion 4 para que haga un SELECT
                'dataSrc': ''
            },
            'bDestroy': true,
            'ordering': false,
            order: false,
            'columns': [{
                    'data': 'uts_pte_id'
                },
                {
                    'data': 'uts_fecha'
                },
                {
                    'data': 'uts_motivo'
                },
                {
                    'data': 'uts_conclusion'
                },
                {
                    'data': 'acciones'
                },
            ],
            'initComplete': function(settings, json) {
                // Esta función se llama después de que se han cargado y dibujado los datos iniciales
                $('#datatable_ultrasonidos tbody tr').addClass('btn-reveal-trigger');
            },
            'drawCallback': function(settings) {
                // Esta función se llama cada vez que se redibuja la tabla
                $('#datatable_ultrasonidos tbody tr').addClass('btn-reveal-trigger');
            }
        });
    }

    $(document).on('click', '.btnEliminarUltrasonido', function() {
        var uts_id = $(this).attr('uts_id');
        swal({
            title: '¿Esta seguro de eliminar este ultrasonido agendado?',
            text: 'Esta accion no es reversible',
            icon: 'warning',
            buttons: ['No', 'Si, eliminar'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append('uts_id', uts_id);
                $.ajax({
                    type: 'POST',
                    url: '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/delete',
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
                        } else {
                            swal('Oops', res.mensaje, 'error');
                        }
                    }
                });
            } else {}
        });
    });
</script>