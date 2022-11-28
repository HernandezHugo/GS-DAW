const comprueba = document.getElementById("alla");
const aqui = document.getElementById("aqui");
const mensaje = document.getElementById("mensaje");

comprueba.addEventListener("click", (e) => {
  mensaje.innerHTML = "";
  let x = aqui.value;

  try {
    if (x == "") throw "Esta vacio";
    if (isNaN(x)) throw "No es un numero";
    if (x < 5) throw "No es suficiente";
    if (x > 10) throw "Te pasaste wey";
  } catch (error) {
    mensaje.innerHTML = error;
  }
});
