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
            <div class="col-auto d-flex justify-content-end order-md-1">
                <button class="btn icon-item icon-item-sm shadow-none p-0 me-1 ms-md-2" type="button" data-event="prev" data-bs-toggle="tooltip" title="Previous"><span class="fas fa-arrow-left"></span></button>
                <button class="btn icon-item icon-item-sm shadow-none p-0 me-1 me-lg-2" type="button" data-event="next" data-bs-toggle="tooltip" title="Next"><span class="fas fa-arrow-right"></span></button>
            </div>
            <div class="col-auto col-md-auto order-md-2">
                <h4 class="mb-0 fs-9 fs-sm-8 fs-lg-7 calendar-title"></h4>
            </div>
            <div class="col col-md-auto d-flex justify-content-end order-md-3">
                <button class="btn btn-falcon-primary btn-sm" type="button" data-event="today">Today</button>
            </div>
            <div class="col-md-auto d-md-none">
                <hr />
            </div>
            <!-- <div class="col-auto d-flex order-md-0">
                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addEventModal"> <span class="fas fa-plus me-2"></span>Add Schedule</button>
            </div> -->
            <div class="col d-flex justify-content-end order-md-2">
                <div class="dropdown font-sans-serif me-md-2">
                    <button class="btn btn-falcon-default text-600 btn-sm dropdown-toggle dropdown-caret-none" type="button" id="email-filter" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span data-view-title="data-view-title">Month View</span><span class="fas fa-sort ms-2 fs-10"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="email-filter"><a class="active dropdown-item d-flex justify-content-between" href="#!" data-fc-view="dayGridMonth">Month View<span class="icon-check"><span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span></span></a><a class="dropdown-item d-flex justify-content-between" href="#!" data-fc-view="timeGridWeek">Week View<span class="icon-check"><span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span></span></a><a class="dropdown-item d-flex justify-content-between" href="#!" data-fc-view="timeGridDay">Day View<span class="icon-check"><span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span></span></a><a class="dropdown-item d-flex justify-content-between" href="#!" data-fc-view="listWeek">List View<span class="icon-check"><span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span></span></a><a class="dropdown-item d-flex justify-content-between" href="#!" data-fc-view="listYear">Year View<span class="icon-check"><span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span></span></a>
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
                        <i class="fas fa-calendar fa-stack-1x text-primary"></i>
                    </span>

                    <div class="flex-1">
                        <h6>Fecha y hora</h6>
                        <p class="mb-1">
                            <span id="eventoInicio"></span><br>
                            <span id="eventoFin"></span>

                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        listarCitas();

    });


    function listarCitas() {
        var datos = new FormData()
        datos.append('cts_usr_id', '<?= $_SESSION['usr']['usr_id'] ?>');
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
                    initialView: 'dayGridMonth',
                    headerToolbar: false,
                    locale: 'es',
                    events: citas,
                    eventClick: function(info) {
                        console.log(info.event);
                        $('#eventoTitulo').text(info.event.title);
                        $('#eventoInicio').text('Inicio: ' + info.event.start.toLocaleString());
                        $('#eventoFin').text('Fin: ' + info.event.end.toLocaleString());
                        $('#consultorio').text(info.event.extendedProps.consultorio);
                        $('#eventoModal').modal('show');
                    }
                });

                setTimeout(() => {
                    calendar.render();
                }, 500);
            }
        });
    }
</script>