let primeraMasc = [
  "Almería",
  "Athletic Club",
  "Atlético de Madrid",
  "FC Barcelona",
  "Real Betis",
  "Cádiz",
  "Celta de Vigo",
  "Elche",
  "Espanyol",
  "Getafe",
  "Girona",
  "Real Mallorca",
  "Osasuna",
  "Rayo Vallecano",
  "Real Madrid",
  "Real Sociedad",
  "Sevilla",
  "Valencia",
  "Valladolid",
  "Villarreal",
];
let segonaFem = [
  "Alavés",
  "Alhama",
  "Atlético Fem",
  " Barcelona Fem",
  "Tenerife",
  "Levante Fem",
  " Madrid CFF",
  "Betis Fem",
  "R. Madrid Fem",
  "R. Sociedad Fem",
  "Sevilla Fem",
  "Huelva Fem",
  "Valencia Fem",
  "Villarreal Fem",
];
let jornadas_masc = [];
let jornadas_fem = [];
function jornadas() {
  //muestro el titulo Primera Masculina
  document.getElementById("primera_masculina").style = "display:inline";
  //ejecuto un bucle hasta haber vaciado el array
  while (primeraMasc.length != 0) {
    //creo un div y un array que contendra 2 strings del array
    let machos = [];
    //uso concateno mi array con el que me devuelve el metodo splice de un indice aleatorio(2veces)
    machos = machos.concat(
      primeraMasc.splice(Math.floor(Math.random() * primeraMasc.length), 1)
    );
    machos = machos.concat(
      primeraMasc.splice(Math.floor(Math.random() * primeraMasc.length), 1)
    );
    //creo un parrafo al que añado el contenido de mi array
    let parrafo = document.createElement("p");
    parrafo.innerHTML = machos[0] + " vs " + machos[1];
    //añado el parrafo al contenedor y el contenedor a una secion de la pagina jornadas
    document.getElementById("masc").appendChild(parrafo);
    jornadas_masc.push(machos);
  }
  //document.getElementById("primera_femenina").style = "display:block";
  //creo un h3 que añado a jornadas
  let x = document.createElement("h3");
  x.innerHTML = "Primera Femenina";
  document.getElementById("fem").appendChild(x);

  //repito el mismo bucle de antes para las jornadas femeninas
  while (segonaFem.length != 0) {
    let feminas = [];
    feminas = feminas.concat(
      segonaFem.splice(Math.floor(Math.random() * segonaFem.length), 1)
    );
    feminas = feminas.concat(
      segonaFem.splice(Math.floor(Math.random() * segonaFem.length), 1)
    );
    let parrafo = document.createElement("p");
    parrafo.innerHTML = feminas[0] + " vs " + feminas[1];
    document.getElementById("fem").appendChild(parrafo);
    jornadas_fem.push(feminas);
  }
}
function generar_quiniela() {}
window.addEventListener("load", (e) => {
  //creo una lista de equipos al cargar la pagina
  crear_lista(primeraMasc, "machos");
  crear_lista(segonaFem, "feminas");
  window.addEventListener("click", (e) => {
    if (e.target.innerHTML == "Generar jornadas") {
      jornadas();
      e.target.innerHTML = "Generar  jornadas";
      document.getElementById("quiniela").innerHTML = "Ver quinielas";
    }
    if (e.target.innerHTML == "Borrar jornadas") {
      window.location.reload();
      /* [...document.querySelectorAll("#masc,#fem")].map((element) =>
          [...element.childNodes].map((hijo) =>
            hijo.tagName !== "h3" ? hijo.remove() : ""
          )
        ); */
    }
    if (
      e.target.innerHTML == "Ver quinielas" ||
      e.target.innerHTML == "Travessa"
    ) {
      generar_quiniela();
    }
  });
});
