let caja = document.getElementById("caja");

let limite = 5;

//Creciente
for (let i = 0; i < limite; i++) {
  let asterisco = "";
  let espacioHTML = "";

  for (let j = 0; j < limite - i - 1; j++) {
    espacioHTML += "&nbsp&nbsp";
  }
  for (let k = 1; k <= 2 * i + 1; k++) {
    asterisco += "*";
  }
  caja.innerHTML = caja.innerHTML + espacioHTML + asterisco + "<br>";
}

//Decreciente
for (let i = limite - 2; i >= 0; i--) {
  let asterisco = "";
  let espacioHTML = "";

  for (let j = 0; j < limite - i - 1; j++) {
    espacioHTML += "&nbsp&nbsp";
  }
  for (let k = 1; k <= 2 * i + 1; k++) {
    asterisco += "*";
  }
  caja.innerHTML = caja.innerHTML + espacioHTML + asterisco + "<br>";
}

console.log(caja);
