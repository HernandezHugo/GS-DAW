var perro = {
  raza: "Podenco",
  peso: 12,
  altura: 58,
  color: "negro",
};

function suma(a, b) {
  return a + b;
}

function resta(a, b) {
  return a - b;
}

function factor(a, b) {
  return a * b;
}

function division(a, b) {
  return a / b;
}

var s = suma(3, 3);
s = suma(s, 3);
var textSuma = "El valor de s será ahora : " + s;
console.log(textSuma);

var r = resta(3, 3);
r = resta(r, 3);
var textResta = "El valor de r será ahora : " + r;
console.log(textResta);

var f = factor(3, 3);
f = factor(f, 3);
var textFactor = "El valor de f será ahora : " + f;
console.log(textFactor);

var d = division(3, 3);
d = division(d, 3);
var textDivision = "El valor de d será ahora : " + d;
console.log(textDivision);


console.log(typeof(perro));

