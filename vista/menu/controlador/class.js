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
  set selectID(id) {
    if (true) {
      this.select = id;
    }
  }

  get selectID() {
    return this.selectID;
  }
}

var Base64 = (function () {

  var ALPHA = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';

  var Base64 = function () {};

  var _encode = function (value) {

    if (typeof (value) !== 'number') {
      throw 'Value is not number!';
    }

    var result = '',
      mod;
    do {
      mod = value % 64;
      result = ALPHA.charAt(mod) + result;
      value = Math.floor(value / 64);
    } while (value > 0);

    return result;
  };

  var _decode = function (value) {

    var result = 0;
    for (var i = 0, len = value.length; i < len; i++) {
      result *= 64;
      result += ALPHA.indexOf(value[i]);
    }

    return result;
  };

  Base64.prototype = {
    constructor: Base64,
    encode: _encode,
    decode: _decode
  };

  return Base64;

})();