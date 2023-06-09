<div class="" style="width: 100%">
  <div class="profile-card-4"><img src="<?php echo $_SESSION['AVATAR']; ?>" class="img img-responsive">
    <div class="profile-content">
      <div class="profile-name text-center"> <?php echo "$_SESSION[nombre] $_SESSION[apellidos]"; ?>
        <p><?php echo "$_SESSION[cargo_descripcion]"; ?></p>
      </div>
      <div class="profile-description text-center">Hola, ¡buen día! :)</div>
      <div class="profile-description text-center">
        <a href="<?php echo $_SESSION['newsletter']['button_usuario']['url'] ?>" target="_blank" class="a-hover"><i class="bi bi-newspaper"></i> <?php echo $_SESSION['newsletter']['button_usuario']['tittle_button'] ?></a>
      </div>

      <div class="row" style="padding-right: 5%; padding-left: 5%;">
        <a href="#LogOut" class="dropdown-a"><i class="bi bi-box-arrow-up"></i> Cerrar Sesión</a>
      </div>
    </div>
  </div>
</div>