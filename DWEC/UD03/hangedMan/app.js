let lives = 7;
let history = [];

const btnSend = document.getElementById("send");
const keyboard = document.getElementById("keyboard");
const DISPLAY = document.getElementById("display");
const DISPLAY_HANGEDMAN = document.getElementById("hangedman");

const SCORE = document.getElementById("score");
const COUNTDOWN = document.getElementById("countdown");
const TIMER = document.getElementById("timer");

const HANGEDMAN = [
  "/\\",
  ".|",
  ".| &nbsp;  &nbsp;  &nbsp; \t/\\",
  ".| &nbsp;  &nbsp;  &nbsp; -|-",
  ".| &nbsp;  &nbsp;  &nbsp; O",
  ".| &nbsp;  &nbsp;  &nbsp;  &nbsp; |",
  ".|-------|",
];

const PALABRAS = [
  "leopardo",
  "puma",
  "gato",
  "mono",
  "perro",
  "avestruz",
  "capibara",
  "sapo",
  "ballena",
  "colibri",
  "caballo",
  "pelicano",
  "cerdo",
  "ciervo",
  "mapache",
  "panda",
  "girafa",
  "elefante",
  "rata",
  "cobaya",
  "hamster",
  "huron",
  "suricato",
  "cebra",
  "leon",
  "medusa",
  "delfin",
  "orca",
  "foca",
  "oca",
  "ganso",
  "pato",
];

const MYWORD = PALABRAS[Math.floor(Math.random() * PALABRAS.length)];

//print "-" on screen
const displayWordHidden = (word) => {
  for (let i = 1; i <= word.length; i++) {
    DISPLAY.innerText += "-";
  }
};

//get char from input
const getChar = () => {
  return document.querySelector("input").value;
};

//check if the word guessed is correct
const checkWin = () => {
  return DISPLAY.innerText === MYWORD;
};

//get indexes of the char that we are guessing
const getIndexes = (word, char) => {
  let indexes = [];
  for (let i = 0; i < word.length; i++) {
    if (word[i] === char) indexes.push(i);
  }
  return indexes;
};

//replace when your guess is correct
const replaceDisplay = (char, indexes) => {
  let chars = DISPLAY.innerText.split("");
  for (let i = 0; i < indexes.length; i++) {
    SCORE.innerHTML = +SCORE.innerHTML + 20;
    chars[indexes[i]] = char;
  }
  DISPLAY.innerText = chars.join("");
};

//print Hangedman
const printHangedMan = () => {
  if (lives > 0) {
    lives -= 1;
    SCORE.innerHTML = +SCORE.innerHTML - 5;
    DISPLAY_HANGEDMAN.innerHTML += "<p>" + HANGEDMAN[lives] + "</p>";
  }
};

//save history on localStorage
const createLocalStorage = () => {
  const data = {
    keyword: MYWORD,
    timer: TIMER.innerText + " sec",
    score: SCORE.innerText + " points",
  };

  //if localStorage is not empty we get history
  if (localStorage.length != 0)
    history = JSON.parse(localStorage.getItem("game"));

  //push data into history and store it on localStorage
  history.push(data);
  localStorage.setItem("game", JSON.stringify(history));
};

//stop timers and see the final result of the game
const finishGame = () => {
  const reloadButton = document.createElement("button");
  reloadButton.classList.add("btn");
  reloadButton.innerText = "Jugar de nuevo";
  keyboard.appendChild(reloadButton);
  crono = clearInterval(crono);
  counter = clearInterval(counter);

  createLocalStorage();

  btnSend.disabled = true;

  reloadButton.addEventListener("click", (e) => {
    window.location.reload();
  });
};

btnSend.addEventListener("click", (e) => {
  e.preventDefault();

  let indexes = getIndexes(MYWORD, getChar());

  //if bad guessing/no indexes, hangedman is printing
  //otherwise, chars are replace
  indexes.length !== 0 ? replaceDisplay(getChar(), indexes) : printHangedMan();
  //reset countdown when we guess
  initialize_counter();
  if (lives === 0 || checkWin()) finishGame();
});

let myDate = new Date();
let myDate_counter = new Date();

//initialize display
function initialize_crono() {
  myDate.setHours(0, 0, 0, 0);
  TIMER.innerHTML = "00:00";
}
//initialize display_counter
function initialize_counter() {
  myDate_counter.setHours(0, 0, 10, 0);
  COUNTDOWN.innerHTML = "10.000";
}

//initialize displays and timers
window.onload = () => {
  displayWordHidden(MYWORD);
  initialize_crono();
  initialize_counter();
  crono = setInterval(crono, 1000);
  counter = setInterval(counter, 5);
};

function crono() {
  let min = myDate.getMinutes();
  let sec = myDate.getSeconds();

  sec += 1;
  if (sec == 60) {
    sec = 0;
    myDate.setMinutes((min += 1));
  }

  // format
  if (min < 10) min = "0" + min;
  if (sec < 10) sec = "0" + sec;

  myDate.setSeconds(sec);
  TIMER.innerHTML = min + ":" + sec;
}

function counter() {
  let sec = myDate_counter.getSeconds();
  let ms = myDate_counter.getMilliseconds();

  if (ms == 0) {
    ms = 995;
    myDate_counter.setSeconds(sec - 1);
  }
  ms -= 5;
  // format
  if (sec < 10) sec = "0" + sec;
  if (ms < 100) ms = "0" + ms;
  if (ms < 10) ms = "0" + ms;

  myDate_counter.setMilliseconds(ms);
  COUNTDOWN.innerHTML = sec + "." + ms;

  if (COUNTDOWN.innerHTML == "00.000" && lives > 0) {
    SCORE.innerHTML = +SCORE.innerHTML - 5;
    initialize_counter();
    lives -= 1;
  }
}
COUNTDOWN.addEventListener("change", (e) => {
  if (COUNTDOWN.innerText === "08.000") {
  }
});
console.log(MYWORD);
