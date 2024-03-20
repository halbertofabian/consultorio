<?php
ComponentesControlador::getBreadCrumb('consultas', 'Consultas', 'Lista de consultas');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista</h4>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered fs-10 mb-0 w-100" id="datatable_consultas">
                        <thead class="bg-200">
                            <tr>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">EDAD</th>
                                <th scope="col">FECHA CONSULTA</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Body -->
<div class="modal fade" id="mdlVerConsulta" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Consulta médica: Evaluación y tratamiento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-xl-12 col-md-12 col-12">
                        <label for="cta_subjetivo" class="form-label"><strong>Subjetivo</strong></label>
                        <main id="cta_subjetivo"></main>
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <label for="cta_objetivo" class="form-label"><strong>Objetivo</strong></label>
                        <main id="cta_objetivo"></main>
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <label for="cta_analisis" class="form-label"><strong>Analisis</strong></label>
                        <main id="cta_analisis"></main>
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <label for="cta_plan" class="form-label"><strong>Plan</strong></label>
                        <main id="cta_plan"></main>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cerrar
                </button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        listarConsultas();
    })

    function listarConsultas() {
        datatable_consultas = $('#datatable_consultas').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'ajax': {
                'url': '<?= HTTP_HOST ?>' + 'api/v1/consultas/list',
                'method': 'POST', //usamos el metodo POST
                'data': {
                    cta_ctr_id: '<?= $_SESSION['scl']['ctr_id'] ?>',
                    tenantid: '<?= $_SESSION['usr']['tenantid'] ?>',
                    // cra_status: cra_status
                }, //enviamos opcion 4 para que haga un SELECT
                'dataSrc': ''
            },
            'bDestroy': true,
            'ordering': false,
            order: false,
            'columns': [{
                    'data': 'pte_nombres'
                },
                {
                    'data': 'pte_edad'
                },
                {
                    'data': 'cta_fecha'
                },
                {
                    'data': 'acciones'
                },
            ],
            'initComplete': function(settings, json) {
                // Esta función se llama después de que se han cargado y dibujado los datos iniciales
                $('#datatable_consultas tbody tr').addClass('btn-reveal-trigger');
            },
            'drawCallback': function(settings) {
                // Esta función se llama cada vez que se redibuja la tabla
                $('#datatable_consultas tbody tr').addClass('btn-reveal-trigger');
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