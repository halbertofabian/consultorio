<?php
ComponentesControlador::getBreadCrumb('ultrasonidos', 'Ultrasonidos', 'Lista de ultrasonidos');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista</h4>
                <div class="table-responsive scrollbar">
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
</div>


<!-- Modal Body -->
<div class="modal fade" id="mdlAgregarUltrasonido" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Actualizar ultrasonido
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formActualizarUltrasonidos">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <h6>Paciente: <span id="paciente"></span></h6>
                        </div>
                        <div class="col-xl-6 col-12">
                            <label for="uts_fecha" class="form-label">Fecha</label>
                            <input type="hidden" name="uts_id" id="uts_id">
                            <input type="date" class="form-control" name="uts_fecha" id="uts_fecha" placeholder="" required />
                        </div>
                        <div class="col-xl-6 col-12">
                            <label for="uts_hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" name="uts_hora" id="uts_hora" placeholder="" required />
                        </div>
                        <div class="col-12">
                            <label for="uts_motivo" class="form-label">Motivo</label>
                            <textarea class="form-control text-uppercase" name="uts_motivo" id="uts_motivo" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="uts_conclusion" class="form-label">Conclusión</label>
                            <textarea class="form-control text-uppercase" name="uts_conclusion" id="uts_conclusion" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
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

    $(document).on('click', '.btnEditarUltrasonido', function() {
        var uts_id = $(this).attr('uts_id');
        var pte_nombre = $(this).attr('pte_nombre');
        $.ajax({
            type: 'GET',
            url: '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/get?uts_id=' + uts_id,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $("#paciente").text(pte_nombre);
                $("#uts_id").val(res.uts_id);
                var parts_fecha = res.uts_fecha.split(' ');
                var uts_fecha = parts_fecha[0];
                var uts_hora = parts_fecha[1];
                $("#uts_fecha").val(uts_fecha);
                $("#uts_hora").val(uts_hora);
                $("#uts_motivo").val(res.uts_motivo);
                $("#uts_conclusion").val(res.uts_conclusion);
                $("#mdlAgregarUltrasonido").modal('show');

            }
        });
    });

    $('#formActualizarUltrasonidos').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/update',
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
    });
</script>