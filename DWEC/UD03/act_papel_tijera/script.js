const hands = ["Papel", "Piedra", "Tijeras", "Lagarto", "Spock"];
let myHand;
let iaHand;
let wins = 0;
let loses = 0;
let draw = 0;
let name_player = prompt('Tu nombre:');

let play = document.getElementById("play");
let display = document.querySelector(".display");

function findIAHand() {
  let pos = Math.floor(Math.random() * hands.length);
  return hands[pos];
}

function findHand() {
  let txt = prompt('Elige una mano: Piedra, Papel, Tijera, Lagarto o Spock.');
  txt = txt.trim().split(" ");
  for (let i = 0; i < txt.length; i++) {
    for (let j = 0; j < hands.length; j++) {
      if (txt[i].includes(hands[j])) return hands[j];
    }
  }
}

function getResult() {
  if (myHand == iaHand) return "empatado";
  switch (myHand) {
    case "Piedra":
      if ((myHand && iaHand == "Tijeras") || (myHand && iaHand == "Lagarto"))
        return "ganado";
      else
        return "perdido";
      break;
    case "Papel":
      if ((myHand && iaHand == "Piedra") || (myHand && iaHand == "Spock"))
        return "ganado";
      else
        return "perdido";
      break;
    case "Tijeras":
      if ((myHand && iaHand == "Papel") || (myHand && iaHand == "Lagarto"))
        return "ganado";
      else
        return "perdido";
      break;
    case "Lagarto":
      if ((myHand && iaHand == "Papel") || (myHand && iaHand == "Spock"))
        return "ganado";
      else
        return "perdido";
      break;
    case "Spock":
      if ((myHand && iaHand == "Papel") || (myHand && iaHand == "Lagarto"))
        return "ganado";
      else
        return "perdido";
      break;
    default:
      break;
  }
}

function printResult(myHand, iaHand, result) {
  display.innerHTML +=
    "<p>"+ name_player + " has escogido " +
    myHand +
    " y la maquina escogio " +
    iaHand +
    " , has " +
    result +
    " la ronda!</p>";

  display.innerHTML +=
    "<p>Resultado: victorias - " +
    wins +
    " derrotas - " +
    loses +
    " empates - " +
    draw +
    "</p>";
}

play.addEventListener("click", (e) => {
  myHand = findHand();
  iaHand = findIAHand();
  result = getResult();
  if ((result == "ganado")) wins += 1;
  if ((result == "perdido")) loses += 1;
  if ((result == "empatado")) draw += 1;

  printResult(myHand, iaHand, result);
});
