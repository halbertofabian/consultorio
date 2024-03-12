<?php
// ComponentesControlador::getBreadCrumb('consultorios', 'Consultorios', 'Nuevo consultorio');
$ctr = ConsultoriosModelo::mdlMostrarConsultoriosByTenantId($_SESSION['usr']['tenantid']);
$ctr_id = ($ctr) ? base64_encode($ctr['ctr_id']) : "";
?>
<style>
    input[readonly] {
        background-color: #f8f9fa;
        /* Color gris por defecto de Bootstrap */
    }
</style>
<div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Datos del consultorio</h4>
                <form id="formDatosCtr" class="row g-3">
                    <input type="hidden" name="ctr_id" class="ctr_id">
                    <div class="col-12">
                        <label for="">Logotipo</label>
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-4xl">
                                <img class="ctr_logo img-thumbnail" src="" alt="LOGO" />
                            </div>
                            <div class="ms-2 w-100"><input type="file" class="form-control" name="ctr_logo" id="ctr_logo"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="ctr_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="ctr_nombre" id="ctr_nombre" aria-describedby="helpId" placeholder="" required />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="ctr_telefono_fijo" class="form-label">Telefono fijo</label>
                        <input type="number" class="form-control" name="ctr_telefono_fijo" id="ctr_telefono_fijo" aria-describedby="helpId" placeholder="" />
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="ctr_telefono_celular" class="form-label">Telefono celular</label>
                        <input type="number" class="form-control" name="ctr_telefono_celular" id="ctr_telefono_celular" aria-describedby="helpId" placeholder="" />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-end">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dirección</h4>
                <form id="formDireccionCtr">
                    <div class="row g-3">
                        <div class="form-group col-md-12">
                            <label for="ctr_codigo_postal">Código postal</label>
                            <input type="hidden" name="ctr_id" class="ctr_id">
                            <input type="text" name="ctr_codigo_postal" id="ctr_codigo_postal" class="form-control" placeholder="" aria-describedby="helpId" required>
                            <small id="helpId" class="text-muted"> <a class="float-right" target="_blank" href="https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/Descarga.aspx">No sé mi código</a> </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctr_estado">Estado</label>
                            <input type="text" name="ctr_estado" id="ctr_estado" class="form-control" placeholder="" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctr_delegacion_municipio">Delegación / Municipio </label>
                            <input type="text" name="ctr_delegacion_municipio" id="ctr_delegacion_municipio" class="form-control" placeholder="" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctr_colonia">Colonia / Asentamiento</label>
                            <select class="form-control select2" name="ctr_colonia" id="ctr_colonia" required>
                                <option value="">Selecciona tu Colonia</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctr_calle">Calle </label>
                            <input type="text" name="ctr_calle" id="ctr_calle" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctr_no_exterior">Nº exterior </label>
                            <input type="text" name="ctr_no_exterior" id="ctr_no_exterior" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctr_no_interior">Nº interior / Depto </label>
                            <input type="text" name="ctr_no_interior" id="ctr_no_interior" class="form-control" placeholder="Opcional">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ctr_entre_calle_1">Entre calle 1 </label>
                            <input type="text" name="ctr_entre_calle_1" id="ctr_entre_calle_1" class="form-control" placeholder="Opcional">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ctr_entre_calle_2">Entre calle 2 </label>
                            <input type="text" name="ctr_entre_calle_2" id="ctr_entre_calle_2" class="form-control" placeholder="Opcional">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary float-end" value="Guardar">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        cargarDatos();
    })

    function cargarDatos() {
        $.ajax({
            type: 'GET',
            url: '<?= HTTP_HOST ?>' + 'api/v1/consultorios/get?ctr_id=<?= $ctr_id ?>',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $(".ctr_id").val(res.ctr_id);
                $(".ctr_logo").attr('src', res.ctr_logo);
                $("#ctr_nombre").val(res.ctr_nombre);
                $("#ctr_telefono_fijo").val(res.ctr_telefono_fijo);
                $("#ctr_telefono_celular").val(res.ctr_telefono_celular);

                //Direccion

                $("#ctr_codigo_postal").val(res.ctr_codigo_postal);
                $("#ctr_estado").val(res.ctr_estado);
                $("#ctr_delegacion_municipio").val(res.ctr_delegacion_municipio);

                if (res.ctr_codigo_postal !== null && res.ctr_codigo_postal != "") {
                    $("#ctr_codigo_postal").change();
                    setTimeout(() => {
                        $("#ctr_colonia").val(res.ctr_colonia);
                    }, 1000);
                }

                $("#ctr_calle").val(res.ctr_calle);
                $("#ctr_no_exterior").val(res.ctr_no_exterior);
                $("#ctr_no_interior").val(res.ctr_no_interior);
                $("#ctr_entre_calle_1").val(res.ctr_entre_calle_1);
                $("#ctr_entre_calle_2").val(res.ctr_entre_calle_2);

            }
        });
    }
    $("#ctr_codigo_postal").on("change", function() {
        var codigo = $(this).val();
        if (codigo == "") {
            return;
        }
        $('#ctr_colonia option').remove();
        $.ajax({
            type: "GET",
            url: 'https://app.tallercontrol.com/api/public/codigos_postales/codigo/' + codigo,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res)
                res.forEach(element => {
                    $("#ctr_estado").val(element.cp_estado);
                    $("#ctr_delegacion_municipio").val(element.cp_municipio);
                    $("#ctr_colonia").append(`<option value="${element.cp_asentamiento}">${element.cp_asentamiento}</option>`);
                });

            }
        });
    });

    $('#ctr_logo').on('change', function() {
        var archivo = $(this).val();
        var extensiones = archivo.substring(archivo.lastIndexOf("."));
        if (extensiones != ".jpeg" && extensiones != ".jpg" && extensiones != ".png" && extensiones != ".webp" && extensiones != ".svg") {
            toastr.error("El archivo de tipo <strong>" + extensiones + "</strong> no es válido", 'ERROR')
            $(this).val("");
        } else {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.ctr_logo').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        }
    });

    $('#formDatosCtr').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/consultorios/datos',
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
                        // $(".ctr_id").val(res.ctr_id);
                        window.location.reload();
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });


    $('#formDireccionCtr').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/consultorios/direccion',
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
                        // $(".ctr_id").val(res.ctr_id);
                        window.location.reload();
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>