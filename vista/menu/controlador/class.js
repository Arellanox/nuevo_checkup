class GuardarArreglo {
  array = new Array();
  constructor(array) {
    this.array = array
  }
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
}
