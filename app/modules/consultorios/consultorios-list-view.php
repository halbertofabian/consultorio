<?php
ComponentesControlador::getBreadCrumb('consultorios', 'Consultorios', 'Lista de consultorios');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista</h4>
                <table class="table table-bordered fs-10 mb-0 w-100" id="datatable_consultorios">
                    <thead class="bg-200">
                        <tr>
                            <th scope="col">LOGO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">TELEFONO FIJO</th>
                            <th scope="col">TELEFONO CELULAR</th>
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
        listarConsultorios();
    })

    function listarConsultorios() {
        datatable_consultorios = $('#datatable_consultorios').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'ajax': {
                'url': '<?= HTTP_HOST ?>' + 'api/v1/consultorios/list',
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
                    'data': 'ctr_logo'
                },
                {
                    'data': 'ctr_nombre'
                },
                {
                    'data': 'ctr_telefono_fijo'
                },
                {
                    'data': 'ctr_telefono_celular'
                },
                {
                    'data': 'acciones'
                },
            ],
            'initComplete': function(settings, json) {
                // Esta función se llama después de que se han cargado y dibujado los datos iniciales
                $('#datatable_consultorios tbody tr').addClass('btn-reveal-trigger');
            },
            'drawCallback': function(settings) {
                // Esta función se llama cada vez que se redibuja la tabla
                $('#datatable_consultorios tbody tr').addClass('btn-reveal-trigger');
            }
        });
    }

    $(document).on('click', '.btnEliminarConsulta', function() {
        var cta_id = $(this).attr('cta_id');
        swal({
            title: '¿Esta seguro de eliminar esta consulta médica?',
            text: 'Esta accion no es reversible',
            icon: 'warning',
            buttons: ['No', 'Si, eliminar consulta'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append('cta_id', cta_id);
                $.ajax({
                    type: 'POST',
                    url: '<?= HTTP_HOST ?>' + 'api/v1/consultas/delete',
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

    $(document).on('click', '.btnVerConsulta', function() {
        var cta_id = $(this).attr('cta_id');
        $.ajax({
            type: 'GET',
            url: '<?= HTTP_HOST ?>' + 'api/v1/consultas/get?cta_id=' + btoa(cta_id),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $("#cta_subjetivo").html(res.cta_subjetivo);
                $("#cta_objetivo").html(res.cta_objetivo);
                $("#cta_analisis").html(res.cta_analisis);
                $("#cta_plan").html(res.cta_plan);
                $("#mdlVerConsulta").modal('show');
            }
        });
    });
</script>