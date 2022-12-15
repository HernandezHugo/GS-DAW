let lives = 7;
const btnSend = document.getElementById("send");
const keyboard = document.getElementById("keyboard");
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
const DISPLAY = document.getElementById("display");
const DISPLAY_HANGEDMAN = document.getElementById("hangedman");

const displayWordHidden = (word) => {
  for (let i = 1; i <= word.length; i++) {
    DISPLAY.innerText += "-";
  }
};

window.onload = () => {
  displayWordHidden(MYWORD);
};

const getChar = () => {
  return document.querySelector("input").value;
};

const checkWin = () => {
  return DISPLAY.innerText === MYWORD;
};

const getIndexes = (word, char) => {
  let indexes = [];
  for (let i = 0; i < word.length; i++) {
    if (word[i] === char) indexes.push(i);
  }
  return indexes;
};

const replaceDisplay = (char, indexes) => {
  let chars = DISPLAY.innerText.split("");
  for (let i = 0; i < indexes.length; i++) {
    chars[indexes[i]] = char;
  }
  DISPLAY.innerText = chars.join("");
};

const printHangedMan = () => {
  if (lives > 0) {
    lives -= 1;
    DISPLAY_HANGEDMAN.innerHTML += "<p>" + HANGEDMAN[lives] + "</p>";
  }
};

const finishGame = () => {
  const reloadButton = document.createElement("button");
  reloadButton.classList.add("btn");
  reloadButton.innerText = "Jugar de nuevo";
  keyboard.appendChild(reloadButton);

  btnSend.disabled = true;

  reloadButton.addEventListener("click", (e) => {
    window.location.reload();
  });
};

btnSend.addEventListener("click", (e) => {
  e.preventDefault();

  let indexes = getIndexes(MYWORD, getChar());

  indexes.length !== 0 ? replaceDisplay(getChar(), indexes) : printHangedMan();

  if (lives === 0 || checkWin()) finishGame();
});

console.log(MYWORD);
