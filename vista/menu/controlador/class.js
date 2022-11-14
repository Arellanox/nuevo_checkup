class GuardarArreglo {
  array = new Array();
  selectID;
  constructor(array) {
    this.array = array
  }
  //Guarda el arreglo
  get array() {
    return this.array;
  }
  set array(newArray) {
      // newName = newName.trim();
      // console.log(newArray)
      if (Array.isArray(newArray)) {
        this.array = newArray;
      }
  }

  //Guarda el seleccionado
  set selectID(id){
    if (true) {
      this.select = id;
    }
  }

  get selectID() {
    return this.selectID;
  }
}
