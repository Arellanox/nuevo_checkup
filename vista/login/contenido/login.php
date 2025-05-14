<?php include "../../../core/festividades/welcome.php";?>

<div class="row justify-content-center max-height">
  <div class="col-lg-6 d-none d-lg-block login-image max-height shadow-login">
    <!-- <div class=""></div> -->
  </div>
  <div class="col-md-10 col-lg-6 max-height">
    <form id="formIniciarSesion" class="p-4 max-height d-flex justify-content-center align-items-center">
      <div class="col-10">
        <div class="form-group text-center">
          <h1 class="text-black">Bienvenido de nuevo</h1>
          <p>Inicie su sesión aquí.</p>
          <br>
        </div>
        <div class="container px-3">
          <div class="mx-sm-10 pb-3 form-floating">
            <input type="text" class="input-form form-control" placeholder="Usuario" name="user">
            <label for="user">Usuario</label>
          </div>
          <div class="mx-sm-10 pb-3 form-floating">
            <input type="password" class="input-form form-control" placeholder="Contraseña" name="pass">
            <label for="pass">Contraseña</label>
          </div>
        </div>
        <!-- <a href="#" id="cambiar-contraseña">¿No te acuerdas de la contraseña?</a> -->
        <!-- <a href="#" id="formulario">¿Necesitas un usaurio?</a> -->
        <div class="d-flex justify-content-center" style="margin:20px">
          <button type="submit" class="btn btn-confirmar" id="">Iniciar sesión</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
    const images = [
        'https://bimo-lab.com/nuevo_checkup/archivos/sistema/ilustraciones/recuadro_1.jpg',
        'https://bimo-lab.com/nuevo_checkup/archivos/sistema/ilustraciones/recuadro_2.jpg',
        'https://bimo-lab.com/nuevo_checkup/archivos/sistema/ilustraciones/recuadro_3.jpg'
    ];

    const randomImage = images[Math.floor(Math.random() * images.length)];
    document.querySelector('.login-image').style.backgroundImage = 'url(' + randomImage + ')';
</script>

<style>
  .login-image {
    /* background-image: url('https://bimo-lab.com/nuevo_checkup/archivos/sistema/ilustraciones/recuadro_2.jpg'); */
    /* Reemplaza con la ruta de tu imagen */
    height: 100vh;
    /* Ajusta la altura al 100% de la ventana gráfica */
    background-position: center;
    /* Centra la imagen en el contenedor */
    background-repeat: no-repeat;
    /* Evita que la imagen se repita */
    background-size: cover;
    /* Asegura que la imagen cubra completamente el área sin perder sus proporciones */
  }

  html,
  #body-controlador,
  .max-height {
    height: 100%;
  }

  #body-js {
    height: calc(100vh - 105px);
  }

  .shadow-login {
    box-shadow: 0 0rem 8px 2.5px rgb(33 37 41 / 68%) !important;
  }
</style>