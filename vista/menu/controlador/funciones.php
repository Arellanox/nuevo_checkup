<script type="text/javascript">


//Para el campo de preregistro
function deshabilitarVacunaExtra(vacuna, div){
  if(vacuna!="OTRA"){
    $("#"+div).fadeOut(400);
  }else{
    $("#"+div).fadeIn(400);
  }
}


// Notifiació  movil
if (window.innerWidth <= 768) {
  position = 'top';
}else{
  position = 'top-start';
}

const Toast = Swal.mixin({
  toast: true,
  position: position,
  showConfirmButton: false,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
</script>
