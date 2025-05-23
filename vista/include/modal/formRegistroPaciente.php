<div class="col-12 col-lg-4">
    <label for="nombre" class="form-label">Nombre(s)</label>
    <input type="text" name="nombre" value="" class="form-control input-form" required>
</div>
<div class="col-6 col-lg-4">
    <label for="paterno" class="form-label">Apellido paterno</label>
    <input type="text" name="paterno" value="" class="form-control input-form">
</div>
<div class="col-6 col-lg-4">
    <label for="materno" class="form-label">Apellido materno</label>
    <input type="text" name="materno" value="" class="form-control input-form">
</div>
<div class="col-6 col-lg-3">
    <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
    <input type="date" class="form-control input-form" name="nacimiento" placeholder="" required onchange="$(`#edad-form-agregar`).val(calcularEdad2(this.value)['numero'])
                                                $(`#span_formEdad`).html(calcularEdad2(this.value)['tipo'])">
</div>
<div class="col-6 col-lg-2">
    <label for="edad" class="form-label">Edad</label>
    <div class="input-group">
        <input type="number" disabled class="form-control input-form edadPacienteRegistro" id="edad-form-agregar" step="0.01" name="edad" placeholder="" min="0" max="150" required>
        <span class="input-span" id="span_formEdad">años</span>
    </div>
</div>
<div class="col-7 col-lg-4">
    <label for="curp" class="form-label">CURP</label>
    <input type="text" class="form-control input-form" name="curp" placeholder="" required id="curp-registro-infor">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="checkCurpPasaporte">
        <label class="form-check-label" for="checkCurpPasaporte">
            Soy extranjero
        </label>
    </div>
    <!-- pattern="[A-Za-z]{4}[0-9]{6}[HMhm]{1}[A-Za-z]{5}[0-9]{2}" -->
</div>
<div class="col-5 col-lg-3">
    <label for="celular" class="form-label">Teléfono</label>
    <input type="number" class="form-control input-form" name="celular" placeholder="">
    <!-- pattern="[0-9]{10}" -->
</div>

<div class="col-6 col-lg-4">
    <label for="correo" class="form-label">Correo electronico</label>
    <input type="email" class="form-control input-form" name="correo" placeholder="Primer Correo" required data-bs-toggle="tooltip" data-bs-placement="top" title="Se requiere un correo para envio de resultados">
    <input type="email" class="form-control input-form" name="correo_2" placeholder="Segundo Correo" data-bs-toggle="tooltip" data-bs-placement="top" title="Se requiere un correo para envio de resultados">
</div>


<div class="col-6 col-lg-2">
    <label for="postal" class="form-label">Código postal</label>
    <input type="number" class="form-control input-form" name="postal" placeholder="">
    <!-- pattern="[0-9]{5}" -->
</div>
<div class="col-6 col-lg-3">
    <label for="estado" class="form-label">Estado</label>
    <input type="text" class="form-control input-form" name="estado" placeholder="">
</div>
<div class="col-6 col-lg-3">
    <label for="municipio" class="form-label">Municipio</label>
    <input type="text" class="form-control input-form" name="municipio" placeholder="">
</div>
<div class="col-6 col-lg-4">
    <label for="colonia" class="form-label">Colonia</label>
    <input type="text" class="form-control input-form" name="colonia" placeholder="">
</div>
<div class="col-6 col-lg-4">
    <label for="exterior" class="form-label">No. Exterior</label>
    <div class="input-group">
        <span class="input-span">No.</span>
        <input type="text" class="form-control input-form" name="exterior" placeholder="">
    </div>
</div>
<div class="col-6 col-lg-4">
    <label for="interior" class="form-label">No. Interior</label>
    <div class="input-group">
        <span class="input-span">No.</span>
        <input type="text" class="form-control input-form" name="interior" placeholder="">
    </div>
</div>
<div class="col-6">
    <label for="calle" class="form-label">Calle</label>
    <input type="text" class="form-control input-form" name="calle" placeholder="">
</div>

<div class="col-6 col-lg-3">
    <label for="nacionalidad" class="form-label">Nacionalidad</label>
    <input type="text" class="form-control input-form" name="nacionalidad" placeholder="">
</div>
<div class="col-6 col-lg-3">
    <label for="pasaporte" class="form-label">Pasaporte</label>
    <input type="text" class="form-control input-form" name="pasaporte" placeholder="" id="pasaporte-registro"> <!-- Requerido si no tiene curp -->
</div>
<div class="col-6 col-lg-3">
    <label for="rfc" class="form-label">RFC</label>
    <input type="text" class="form-control input-form" name="rfc" placeholder="">
</div>
<div class="col-12 col-lg-6" style="margin-top: 30px;margin-bottom: 15px;">
    <div class="container">
        <div class="row" style="zoom:110%;">
            <div class="col-md-auto">
                <label for="">Género: </label>
            </div>
            <div class="col">
                <input type="radio" id="mascuCues" name="genero" value="MASCULINO" required>
                <label for="mascuCues">Masculino</label>
            </div>
            <div class="col">
                <input type="radio" id="FemeCues" name="genero" value="FEMENINO" required>
                <label for="FemeCues">Femenino</label>
            </div>
        </div>
    </div>
</div>

<div class="col-12 pt-2" id="communicationOptions">
    <div class="row mt-2 justify-content-center ">
        <p class="fs-6 text-center pb-2">Preferencia de entrega de resultados</p>
        <div class="col-auto mb-3 form-check fs-4 mx-3">
            <input type="checkbox" class="form-check-input input-impreso-check" id="impreso" name="medios" value="1">
            <label class="form-check-label" for="impreso" style="color: #1a8bbc">
                <i class="fas fa-print"></i> Impreso
            </label>
        </div>
        <div class="col-auto mb-3 form-check fs-4 mx-3">
            <input type="checkbox" class="form-check-input input-whatsapp-check" id="whatsapp" name="medios" value="2">
            <label class="form-check-label" for="whatsapp" style="color: #1ABC9C">
                <i class="fab fa-whatsapp"></i> Whatsapp
            </label>
        </div>
        <div class="col-auto mb-3 form-check fs-4 mx-3">
            <input type="checkbox" class="form-check-input input-correo-check" id="correo" name="medios" value="3">
            <label class="form-check-label" for="correo" style="color: #c35f3d">
                <i class="fas fa-envelope"></i> Correo
            </label>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="row w-full justify-content-center items-center" id="contenido-procedencia">

    </div>
</div>