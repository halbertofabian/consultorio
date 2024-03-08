<?php
ComponentesControlador::getBreadCrumb('usuarios', 'Usuarios', 'Lista de usuarios');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista</h4>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered fs-10 mb-0 w-100" id="datatable_usuarios">
                        <thead class="bg-200">
                            <tr>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">CORREO</th>
                                <th scope="col">PERFIL</th>
                                <th scope="col">FECHA</th>
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
        listarUsuarios();
    })

    function listarUsuarios() {
        datatable_usuarios = $('#datatable_usuarios').DataTable({
            // dom: 'Bfrtip',
            responsive: true,
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            'ajax': {
                'url': '<?= HTTP_HOST ?>' + 'api/v1/usuarios/list',
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
                    'data': 'usr_nombre'
                },
                {
                    'data': 'usr_correo'
                },
                {
                    'data': 'usr_perfil'
                },
                {
                    'data': 'usr_fecha_registro'
                },
                {
                    'data': 'acciones'
                },
            ],
            'initComplete': function(settings, json) {
                // Esta función se llama después de que se han cargado y dibujado los datos iniciales
                $('#datatable_usuarios tbody tr').addClass('btn-reveal-trigger');
            },
            'drawCallback': function(settings) {
                // Esta función se llama cada vez que se redibuja la tabla
                $('#datatable_usuarios tbody tr').addClass('btn-reveal-trigger');
            }
        });
    }

    $(document).on('click', '.btnEliminarUsuario', function() {
        var usr_id = $(this).attr('usr_id');
        swal({
            title: '¿Esta seguro de eliminar este usuario?',
            text: 'Esta accion no es reversible',
            icon: 'warning',
            buttons: ['No', 'Si, eliminar usuario'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append('usr_id', usr_id);
                $.ajax({
                    type: 'POST',
                    url: '<?= HTTP_HOST ?>' + 'api/v1/usuarios/delete',
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