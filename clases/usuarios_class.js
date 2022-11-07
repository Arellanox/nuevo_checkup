
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

}
