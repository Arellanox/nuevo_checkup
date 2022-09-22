
class Usuarios{
  id;
  usuario;
  arreglo;

  constructor(values){
    // if (values != null) {
    //   this.id = values[0];
    //   this.usuario = values['USUARIO']
    // }
    // this.usuario = id;

    this.arreglo = values;
  }

  get arreglo(){ return this._usuario; }
  set arreglo(value){ this._usuario = value }

  // get id(){ return this._id; }
  // set id(value){
  //   if (Number.isInteger(value)) { return "Esta ID no es númerica"; }
  //   this._id = value
  // }
  //
  // get usuario(){ return this._usuario; }
  // set usuario(value){ this._usuario = value }

  insertDatos(){
    $.ajax({
      data: this.arreglo,
      url: "../../../api/usuarios_api.php",
      type: "POST",
      processData: false,
      contentType: false,
      success: function(data) {
        data = jQuery.parseJSON(data);
        // console.log(data);
        if (mensajeAjax(data)) {
          Toast.fire({
            icon: 'success',
            title: '¡Usuario actualizado!',
            timer: 2000
          });
          document.getElementById("formEditarUsuario").reset();
          $("#ModalEditarRegistroUsuario").modal('hide');
          tablaUsuarios.ajax.reload()
        }
      },
    });
  }

}
