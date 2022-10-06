let caja = document.getElementById("caja");

let limite = 25;

//Creciente
for (let i = 0; i < limite; i++) {
  let asteriscos = "";
  let espacioHTML = "";
  for (let j = 0; j < limite - i - 1; j++) {
    espacioHTML += "&nbsp&nbsp";
  }
  caja.innerHTML += espacioHTML;
  for (let k = 1; k <= 2 * i + 1; k++) {
    if (k == 1 || k == 2 * i + 1) {
      asteriscos += "*";
    } else {
      asteriscos += "&nbsp&nbsp";
    }
  }
  caja.innerHTML += asteriscos + "<br>";
}

//Decreciente
for (let i = limite - 2; i >= 0; i--) {
  let asteriscos = "";
  let espacioHTML = "";

  for (let j = 0; j < limite - i - 1; j++) {
    espacioHTML += "&nbsp&nbsp";
  }
  caja.innerHTML += espacioHTML;
  for (let k = 1; k <= 2 * i + 1; k++) {
    if (k == 1 || k == 2 * i + 1) {
      asteriscos += "*";
    } else {
      asteriscos += "&nbsp&nbsp";
    }
  }
  caja.innerHTML += asteriscos + "<br>";
}

console.log(caja);
