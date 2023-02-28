let a = new String();
let b = new Number();
let c = new Boolean();

let cadena = new String("Hola");
let cadena2 = "hola";

console.log(cadena);
console.log(cadena2);

let unCliente = {
  nombre: "Hernández",
  "direccion del cliente": "c/ Desconocida 123",
  "-++++--+-+-": "wtf",
  pagos: {
    tipo: "Visa",
    "numero de la tarjeta": 1234567890,
    "fecha de caducidad de la tarjeta": "nunca",
  },
};

muestraCamposYValores(unCliente);

function muestraCamposYValores(miObjeto) {
    for (campo in miObjeto) {
        if (typeof miObjeto[campo] == "object") {
            muestraCamposYValores(miObjeto[campo]);
        } else {
            console.log(campo + ": " + miObjeto[campo]);
        }
    }
}

let factura = {
  descripcion: "Factura de ejemplo",
  precio: 100.0,
  iva: 21.0,
  subtotal: () => this.precio,
  total: function () {
    return this.precio + (this.precio * this.iva) / 100;
  },
};

console.log(factura);
console.log(factura.precio);
console.log(factura.subtotal()); //undefined????
console.log(factura.total());