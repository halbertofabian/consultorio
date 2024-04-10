<?php
ComponentesControlador::getBreadCrumb('citas', 'Citas', 'Lista de citas');
?>

<style>
    .fc-event {
        cursor: pointer;
    }
</style>

<div class="card overflow-hidden">
    <div class="card-header">
        <div class="row gx-0 align-items-center">
            <div class="col d-flex justify-content-end order-md-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tiempo
                    </button>
                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="dropdown-item btnCalendario active" data-fc-view="dayGridMonth" href="javascript:void(0)">Mes</a>
                        <a class="dropdown-item btnCalendario" data-fc-view="timeGridWeek" href="javascript:void(0)">Semana</a>
                        <a class="dropdown-item btnCalendario" data-fc-view="timeGridDay" href="javascript:void(0)">Día</a>
                        <a class="dropdown-item btnCalendario" data-fc-view="listWeek" href="javascript:void(0)">Lista</a>
                        <a class="dropdown-item btnCalendario" data-fc-view="listYear" href="javascript:void(0)">Año</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-3 scrollbar">
        <div class="calendar-outline" id="appCalendar"></div>
    </div>
</div>

<div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventoModalLabel">Detalles de la cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex mt-3">
                    <span class="fa-stack ms-n1 me-3">
                        <i class="fas fa-circle fa-stack-2x text-200"></i>
                        <i class="fas fa-user fa-stack-1x text-primary"></i>
                    </span>

                    <div class="flex-1">
                        <h6>Paciente</h6>
                        <p class="mb-1" id="eventoTitulo">

                        </p>
                        <p class="mb-1" id="consultorio">

                        </p>
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <span class="fa-stack ms-n1 me-3">
                        <i class="fas fa-circle fa-stack-2x text-200"></i>
                        <i class="fas fa-align-left fa-stack-1x text-primary"></i>
                    </span>

                    <div class="flex-1">
                        <h6>Descripción</h6>
                        <p class="mb-1" id="descripcion">

                        </p>
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <span class="fa-stack ms-n1 me-3">
                        <i class="fas fa-circle fa-stack-2x text-200"></i>
                        <i class="fas fa-calendar fa-stack-1x text-primary"></i>
                    </span>

                    <div class="flex-1">
                        <h6>Fecha y hora</h6>
                        <p class="mb-1">
                            <span id="eventoInicio"></span><br>
                            <span id="eventoFin"></span><br>
                            <span class="badge rounded-pill" id="estado"></span>

                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Button group name">
                    <button type="button" class="btn btn-danger btn-sm btn-attr btnCancelarCita statusPendiente">
                        <i class="fa fa-times"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-light btn-sm btn-attr btnReagendarConsulta statusPendiente">
                        <i class="fa fa-calendar-alt"></i> Reagendar
                    </button>
                    <button type="button" class="btn btn-primary btn-sm btn-attr btnAgregarConsulta statusPendiente">
                        <i class="fa fa-notes-medical"></i> Consulta
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>

                <!-- <button type="button" class="btn btn-danger">Cancelar</button>
                <button type="button" class="btn btn-primary">Agregar a consulta</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> -->
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        listarCitas('dayGridMonth');
    });


    function listarCitas(tipo) {
        var datos = new FormData()
        // datos.append('cts_usr_id', '<?= $_SESSION['usr']['usr_id'] ?>');
        datos.append('tenantid', '<?= $_SESSION['usr']['tenantid'] ?>');
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/citas/list',
            data: datos,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res)
                var citas = res;
                var calendarEl = document.getElementById('appCalendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: tipo,
                    // headerToolbar: true,
                    locale: 'es',
                    events: citas,
                    eventClick: function(info) {
                        console.log(info.event);
                        $('.btn-attr').attr('cts_id', info.event.id);
                        $('.btn-attr').attr('cts_pte_id', info.event.extendedProps.cts_pte_id);
                        $('#eventoTitulo').text(info.event.title);
                        $('#eventoInicio').text('Inicio: ' + info.event.start.toLocaleString());
                        $('#eventoFin').text('Fin: ' + info.event.end.toLocaleString());
                        $('#consultorio').text(info.event.extendedProps.consultorio);
                        $('#descripcion').text(info.event.extendedProps.descripcion);
                        if (info.event.extendedProps.estado == 'Pendiente') {
                            $('#estado').addClass('bg-warning');
                            $('#estado').removeClass('bg-success');
                            $(".statusPendiente").removeClass('d-none');
                        } else if (info.event.extendedProps.estado == 'Asistió') {
                            $('#estado').addClass('bg-success');
                            $('#estado').removeClass('bg-warning');
                            $(".statusPendiente").addClass('d-none');
                        }
                        $('#estado').text(info.event.extendedProps.estado);
                        $('#eventoModal').modal('show');
                    }
                });

                setTimeout(() => {
                    calendar.render();
                }, 500);
            }
        });
    }

    $(document).on('click', '.btnCalendario', function() {
        $('.btnCalendario').removeClass('active');
        $(this).addClass('active');
        var data = $(this).attr('data-fc-view');
        listarCitas(data);
    });

    $(document).on('click', '.btnAgregarConsulta', function() {
        var cts_id = $(this).attr('cts_id');
        var cts_pte_id = $(this).attr('cts_pte_id');
        swal({
            title: 'El estado de la cita cambiara al estado "Asistió "¿Deseas continuar?',
            text: 'Esta accion no es reversible',
            icon: 'warning',
            buttons: ['No', 'Si, continuar'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append('cts_id', cts_id);
                datos.append('cts_pte_id', cts_pte_id);
                datos.append('cts_estado', 'Asistió');
                $.ajax({
                    type: 'POST',
                    url: '<?= HTTP_HOST ?>' + 'api/v1/citas/cambiar-estado',
                    data: datos,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status) {
                            window.location.href = '<?= HTTP_HOST ?>' + 'consultas/create/' + btoa(cts_pte_id);
                        } else {
                            swal('Oops', res.mensaje, 'error');
                        }
                    }
                });
            } else {}
        });

    });

    $(document).on('click', '.btnCancelarCita', function() {
        var cts_id = $(this).attr('cts_id');
        var cts_pte_id = $(this).attr('cts_pte_id');
        swal({
            title: '¿Estas seguro de cancelar esta cita?',
            text: 'Esta accion no es reversible',
            icon: 'warning',
            buttons: ['No', 'Si, cancelar'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datos = new FormData();
                datos.append('cts_id', cts_id);
                datos.append('cts_pte_id', cts_pte_id);
                datos.append('cts_estado', 'Cancelada');
                $.ajax({
                    type: 'POST',
                    url: '<?= HTTP_HOST ?>' + 'api/v1/citas/cambiar-estado',
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
                                $('#eventoModal').modal('hide');
                                listarCitas('dayGridMonth');
                            });
                        } else {
                            swal('Oops', res.mensaje, 'error');
                        }
                    }
                });
            } else {}
        });

    });

    $(document).on('click', '.btnReagendarConsulta', function() {
        var cts_id = $(this).attr('cts_id');
        // var cts_pte_id = $(this).attr('cts_pte_id');

        window.location.href = '<?= HTTP_HOST ?>' + 'citas/update/' + btoa(cts_id);
    });
</script>