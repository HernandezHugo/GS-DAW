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

let primeraFem = [
  "Alavés",
  "Alhama",
  "Atlético Fem",
  "Barcelona Fem",
  "Tenerife",
  "Levante Fem",
  "Madrid CFF",
  "Betis Fem",
  "R. Madrid Fem",
  "R. Sociedad Fem",
  "Sevilla Fem",
  "Huelva Fem",
  "Valencia Fem",
  "Villarreal Fem",
];

let jornadaM = [];
let jornadaF = [];
let resultsM = [];
let resultsF = [];
let quinielaResultsM = [];
let quinielaResultsF = [];

function makeMatches(newArray, array) {
  let teams = array;

  //Make new "jornada" randomizing teams arrays
  while (teams.length != 0) {
    newArray.push(teams.splice(teams.length * Math.random(), 1));
  }
}

function makeList(array, id) {
  let list = document.getElementById(id);

  //Make a list of Matches
  if (list != null) {
    list.innerHTML = "";
    for (let i = 0; i < array.length; i++) {
      let li = document.createElement("li");
      li.textContent = array[i] + " VS " + array[i + 1];
      list.appendChild(li);
      i++;
    }
  }
}

//creates the results of each match
function makeResults(results, jornada) {
  while (results.length < jornada.length) {
    results.push(Math.floor(Math.random() * 5));
  }
}

//stores who won each match
function storeQuinielaResults(quiniela, array) {
  for (let i = 0; i < array.length; i++) {
    if (array[i] > array[i + 1]) quiniela.push("0");
    else if (array[i] == array[i + 1]) quiniela.push("1");
    else if (array[i] < array[i + 1]) quiniela.push("2");
    i++;
  }
}

//stores jornada on localStorage
function storeJornada() {
  let jornada = {
    masc: jornadaM,
    fem: jornadaF,
    resultsMasc: resultsM,
    resultsFem: resultsF,
    qResultsMasc: quinielaResultsM,
    qResultsFem: quinielaResultsF,
  };
  localStorage.setItem("jornada", JSON.stringify(jornada));
}

let btn_gen_jornada = document.querySelector("#gen_jornada");

let btn_show_matches_m = document.querySelector("#show_matches_m");
let btn_show_res_m = document.querySelector("#show_res_m");

let btn_show_matches_f = document.querySelector("#show_matches_f");
let btn_show_res_f = document.querySelector("#show_res_f");

//generates a jornada
if (btn_gen_jornada != null) {
  btn_gen_jornada.addEventListener("click", (e) => {
    makeMatches(jornadaM, primeraMasc);
    makeMatches(jornadaF, primeraFem);
    makeResults(resultsM, jornadaM);
    makeResults(resultsF, jornadaF);
    storeQuinielaResults(quinielaResultsM, resultsM);
    storeQuinielaResults(quinielaResultsF, resultsF);
    storeJornada();
  });
}

//prints a list of matches (males)
if (btn_show_matches_m != null) {
  btn_show_matches_m.addEventListener("click", (e) => {
    let jornadaM = JSON.parse(localStorage.getItem("jornada")).masc;
    makeList(jornadaM, "masc_list");
  });
}

//prints results of the matches (male)
if (btn_show_res_m != null) {
  btn_show_res_m.addEventListener("click", (e) => {
    let resultsM = JSON.parse(localStorage.getItem("jornada")).resultsMasc;
    makeList(resultsM, "results_masc_list");
  });
}
//prints a list of matches (females)
if (btn_show_matches_f != null) {
  btn_show_matches_f.addEventListener("click", (e) => {
    let jornadaF = JSON.parse(localStorage.getItem("jornada")).fem;
    makeList(jornadaF, "fem_list");
  });
}

//prints results of the matches (female)
if (btn_show_res_f != null) {
  btn_show_res_f.addEventListener("click", (e) => {
    let resultsF = JSON.parse(localStorage.getItem("jornada")).resultsFem;
    makeList(resultsF, "results_fem_list");
  });
}

let rows = document.querySelectorAll(".tbRow");
let btnVerify = document.querySelector("#verify");

function createQuiniela() {
  let gamesM = JSON.parse(localStorage.getItem("jornada")).masc;
  let gamesF = JSON.parse(localStorage.getItem("jornada")).fem;
  //indexes of each match (female)
  let femIndexes = [0, 2, 4, 6, 8, 10, 12];
  let maxFemTeams = 4;

  //add matches to quiniela (males)
  let j = 0;
  for (let i = 0; i < gamesM.length; i++) {
    rows[j].innerHTML += "<td>" + gamesM[i] + " VS " + gamesM[i + 1] + "</td>";
    addRadioButtons(rows[j], j);
    i++;
    j++;
  }

  //add matches to quiniela (females)
  femIndexes.sort();
  for (let i = 0; i < maxFemTeams; i++) {
    rows[j].innerHTML +=
      "<td>" +
      gamesF[femIndexes[i]] +
      " VS " +
      gamesF[femIndexes[i] + 1] +
      "</td>";
    addRadioButtons(rows[j], j);
    j++;
  }
}

function addRadioButtons(row, id) {
  let fragment = document.createDocumentFragment();
  let maxRadioBtn = 3;

  for (let i = 0; i < maxRadioBtn; i++) {
    let newTd = document.createElement("td");
    let radioBtn = document.createElement("input");

    radioBtn.setAttribute("type", "radio");
    radioBtn.setAttribute("name", id);
    radioBtn.setAttribute("value", i);

    newTd.appendChild(radioBtn);
    fragment.appendChild(newTd);
  }
  row.appendChild(fragment);
}

if (rows != null) createQuiniela();

if (btnVerify != null)
  btnVerify.addEventListener("click", (e) => {
    e.preventDefault();
    let radioButtons = [...document.querySelectorAll("input[type=radio]")];
    let myQuiniela = [];

    while (radioButtons.length != 0) myQuiniela.push(radioButtons.splice(0, 3));

    myQuiniela.forEach((element) => {
      for (let i = 0; i < element.length; i++) {
        if (element[i].checked == true)
          console.log("nivel " + element[i].name + " - " + i);
      }
    });

    console.log(myQuiniela);
  });
