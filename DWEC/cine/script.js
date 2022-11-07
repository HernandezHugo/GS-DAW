const CONTENIDOR = document.querySelector(".contenidor");
const CONTADOR = document.querySelector("#contador");
const TOTAL = document.querySelector("#total");
const SEIENTS = document.querySelectorAll(".fila .seient:not(.ocupat)");
const PELICULA_SELECT = document.querySelector("#pelicula");
let preu_ticket = +PELICULA_SELECT.value;

ompleUI();

//Actualitza els totals
function actualitzaSeleccioSeients() {
  const SEIENTSSELECCIONATS = document.querySelectorAll(
    ".fila .seient.seleccionat"
  );
  const CONTADORSEIENTSSELECCIONATS = SEIENTSSELECCIONATS.length;
  const SEIENTSINDEX = [...SEIENTSSELECCIONATS].map((seient) =>
    [...SEIENTS].indexOf(seient)
  );

  localStorage.setItem("seientsSeleccionats", JSON.stringify(SEIENTSINDEX));

  CONTADOR.innerText = CONTADORSEIENTSSELECCIONATS;
  TOTAL.innerText = CONTADORSEIENTSSELECCIONATS * preu_ticket;
}

//Guarda a LocalStorage l'index i el preu de la pelicula seleccionada
function guardaInfoPelicula(indexPelicula, preuPelicula) {
  localStorage.setItem("indexPeliculaSeleccionada", indexPelicula);
  localStorage.setItem("preuPeliculaSeleccionada", preuPelicula);
}

//Recupera info del LocalStorage i omple la UI
function ompleUI() {
  const SEIENTSSELECCIONATS = JSON.parse(
    localStorage.getItem("seientsSeleccionats")
  );

  if (SEIENTSSELECCIONATS !== null && SEIENTSSELECCIONATS.length > 0) {
    SEIENTS.forEach((seient, index) => {
      if (SEIENTSSELECCIONATS.indexOf(index) > -1) {
        seient.classList.add("seleccionat");
      }
    });
  }

  const INDEXPELICULASELECCIONADA = localStorage.getItem(
    "indexPeliculaSeleccionada"
  );

  if (INDEXPELICULASELECCIONADA !== null) {
    PELICULA_SELECT.selectedIndex = INDEXPELICULASELECCIONADA;
  }

  const PREUPELICULASELECCIONADA = localStorage.getItem(
    "preuPeliculaSeleccionada"
  );
  if (PREUPELICULASELECCIONADA !== null) {
    preu_ticket.innerText = +INDEXPELICULASELECCIONADA;
  }
}

/* EVENTOS */
CONTENIDOR.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("seient") &&
    !e.target.classList.contains("ocupat")
  ) {
    e.target.classList.toggle("seleccionat");
    actualitzaSeleccioSeients();
  }
});

PELICULA_SELECT.addEventListener("change", (e) => {
  preu_ticket = +e.target.value;

  guardaInfoPelicula(e.target.selectedIndex, e.target.value);
  actualitzaSeleccioSeients();
});
actualitzaSeleccioSeients();
