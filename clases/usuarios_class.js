

class Usuario{

  constructor(id){
    $.ajax({
      url: "../../../api/usuarios_api.php",
      type: "POST",
      data:{id:this.id, api: 3},
      success: function(data) {
        data = jQuery.parseJSON(data);
        console.log(data);
      }
    })
    this.id = id;
  }

  get id(){ return this._id; }
  set id(value){
    if (Number.isInterger(value)) { return "Esta ID no es númerica"; }
    this._id = value
  }

}
