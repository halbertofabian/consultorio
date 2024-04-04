<?php
ComponentesControlador::getBreadCrumb('pacientes', 'Pacientes', 'Lista de pacientes');
?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista</h4>
                <table class="table table-bordered fs-10 mb-0 w-100" id="datatable_pacientes">
                    <thead class="bg-200">
                        <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">FECHA NACIMIENTO</th>
                            <th scope="col">SEXO</th>
                            <th scope="col">CURP</th>
                            <th scope="col">FECHA REGISTRO</th>
                            <th scope="col">USUARIO REGISTRO</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Body -->
<div class="modal fade" id="mdlAgregarUltrasonido" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-dialog-scrollable">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Agregar ultrasonido
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formGuardarUltrasonidos">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <h6>Paciente: <span id="paciente"></span></h6>
                        </div>
                        <div class="col-xl-6 col-12">
                            <label for="uts_fecha" class="form-label"><?= OBL ?> Fecha</label>
                            <input type="hidden" name="uts_pte_id" id="uts_pte_id">
                            <input type="date" class="form-control" name="uts_fecha" id="uts_fecha" placeholder="" required />
                        </div>
                        <div class="col-xl-6 col-12">
                            <label for="uts_hora" class="form-label"><?= OBL ?> Hora</label>
                            <input type="time" class="form-control" name="uts_hora" id="uts_hora" placeholder="" required />
                        </div>
                        <div class="col-12">
                            <label for="uts_motivo" class="form-label"><?= OBL ?> Motivo</label>
                            <textarea class="form-control tinymce text-uppercase" name="uts_motivo" id="uts_motivo" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="uts_conclusion" class="form-label">Conclusión</label>
                            <textarea class="form-control tinymce text-uppercase" name="uts_conclusion" id="uts_conclusion" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        listarPacientes();
    })

    function listarPacientes() {
        datatable_pacientes = $('#datatable_pacientes').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'ajax': {
                'url': '<?= HTTP_HOST ?>' + 'api/v1/pacientes/list',
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
                    'data': 'pte_nombres'
                },
                {
                    'data': 'pte_fecha_nacimiento'
                },
                {
                    'data': 'pte_sexo'
                },
                {
                    'data': 'pte_curp'
                },
                {
                    'data': 'pte_fecha_registro'
                },
                {
                    'data': 'pte_usuario_registro'
                },
                {
                    'data': 'acciones'
                },
            ],
            'initComplete': function(settings, json) {
                // Esta función se llama después de que se han cargado y dibujado los datos iniciales
                $('#datatable_pacientes tbody tr').addClass('btn-reveal-trigger');
            },
            'drawCallback': function(settings) {
                // Esta función se llama cada vez que se redibuja la tabla
                $('#datatable_pacientes tbody tr').addClass('btn-reveal-trigger');
            }
            
        });
    }

    $(document).on('click', '.btnEliminarPaciente', function() {
        var pte_id = $(this).attr('pte_id');
        swal({
            title: '¿Esta seguro de eliminar este paciente?',
            text: 'Esta accion no es reversible',
            icon: 'warning',
            buttons: ['No', 'Si, eliminar paciente'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append('pte_id', pte_id);
                $.ajax({
                    type: 'POST',
                    url: '<?= HTTP_HOST ?>' + 'api/v1/pacientes/delete',
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

    $(document).on('click', '.btnAgregarUltrasonido', function() {
        var pte_id = $(this).attr('pte_id');
        var pte_nombre = $(this).attr('pte_nombre');
        $("#paciente").text(pte_nombre);
        $("#uts_pte_id").val(pte_id);
        $("#mdlAgregarUltrasonido").modal('show');
    });

    $('#formGuardarUltrasonidos').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/create',
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
                        location.href = '<?= HTTP_HOST ?>' + 'ultrasonidos/list';
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>