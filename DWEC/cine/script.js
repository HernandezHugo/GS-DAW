const CONTENIDOR = document.querySelector(".contenidor");
const CONTADOR = document.querySelector("#contador");
const TOTAL = document.querySelector("#total");
const SEIENTS = document.querySelectorAll(".fila .seient:not(.ocupat)");
const PELICULA_SELECT = document.querySelector("#pelicula");
let preu_ticket = +PELICULA_SELECT.value;

/* EVENTOS */
CONTENIDOR.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("seient") &&
    !e.target.classList.contains("ocupat")
  ) {
    e.target.classList.toggle("seleccionat");
  }
});
