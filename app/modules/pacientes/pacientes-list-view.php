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
</script>