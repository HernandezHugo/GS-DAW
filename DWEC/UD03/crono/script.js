let myDate = new Date();
let cronos;
let display = document.getElementById("display");
let display_lapse = document.getElementById("display_lapse");

let start = document.getElementById("start");
let stop = document.getElementById("stop");
let reset = document.getElementById("reset");
let lapse = document.getElementById("lapse");

let myDate_counter = new Date();
let counters;
let display_2 = document.getElementById("display_2");
let start_counter = document.getElementById("start_counter");
let stop_counter = document.getElementById("stop_counter");
let lapse_counter = document.getElementById("lapse_counter");
let display_lapse_counter = document.getElementById("display_lapse_counter");

//initialize display
function initialize_crono() {
  myDate.setHours(0, 0, 0, 0);
  display.innerHTML = "00:00:00";
}
//initialize display_counter
function initialize_counter() {
  myDate_counter.setHours(0, 1, 0, 0);
  display_2.innerHTML = "01:00.000";
}

//initialize displays
initialize_crono();
initialize_counter();

function crono() {
  let hour = myDate.getHours();
  let min = myDate.getMinutes();
  let sec = myDate.getSeconds();

  sec += 1;

  if (sec == 60) {
    sec = 0;
    myDate.setMinutes((min += 1));
  }
  if (min == 60) {
    min = 0;
    myDate.setHours((hour += 1));
  }
  // format
  if (hour < 10) hour = "0" + hour;
  if (min < 10) min = "0" + min;
  if (sec < 10) sec = "0" + sec;

  myDate.setSeconds(sec);

  display.innerHTML = hour + ":" + min + ":" + sec;
}

function counter() {
  let min = myDate_counter.getMinutes();
  let sec = myDate_counter.getSeconds();
  let ms = myDate_counter.getMilliseconds();

  if (ms == 0) {
    ms = 995;
    myDate_counter.setSeconds(sec - 1);
  }
  ms -= 5;

  // format
  if (min < 10) min = "0" + min;
  if (sec < 10) sec = "0" + sec;
  if (ms < 100) ms = "0" + ms;
  if (ms < 10) ms = "0" + ms;

  myDate_counter.setMilliseconds(ms);
  display_2.innerHTML = min + ":" + sec + "." + ms;
}

//interval just initiate the page
/* window.onload = function () {
        crono = setInterval(crono, 1000);
      }; */

start.addEventListener("click", (e) => {
  cronos = setInterval(crono, 1000);
  start.disabled = true;
  lapse.disabled = false;
  stop.disabled = false;
  reset.disabled = true;
});

stop.addEventListener("click", (e) => {
  clearInterval(cronos);
  start.disabled = false;
  lapse.disabled = true;
  stop.disabled = true;
  reset.disabled = false;
  start.innerHTML = "Continue";
});

reset.addEventListener("click", (e) => {
  initialize_crono();
  start.innerHTML = "Start";
  reset.disabled = true;
});

lapse.addEventListener("click", (e) => {
  let hour = myDate.getHours();
  let min = myDate.getMinutes();
  let sec = myDate.getSeconds();

  if (hour < 10) hour = "0" + hour;
  if (min < 10) min = "0" + min;
  if (sec < 10) sec = "0" + sec;

  display_lapse.innerHTML += "<p>" + hour + ":" + min + ":" + sec + "</p>";
});

start_counter.addEventListener("click", (e) => {
  counters = setInterval(counter, 5);
  start_counter.disabled = true;
  stop_counter.disabled = false;
  reset_counter.disabled = true;
  lapse_counter.disabled = false;
});

stop_counter.addEventListener("click", (e) => {
  clearInterval(counters);
  start_counter.disabled = false;
  stop_counter.disabled = true;
  reset_counter.disabled = false;
  lapse_counter.disabled = true;
});
reset_counter.addEventListener("click", (e) => {
  initialize_counter();
  reset_counter.disabled = true;
});

lapse_counter.addEventListener("click", (e) => {
  let min = myDate_counter.getMinutes();
  let sec = myDate_counter.getSeconds();
  let ms = myDate_counter.getMilliseconds();

  if (min < 10) min = "0" + min;
  if (sec < 10) sec = "0" + sec;
  if (ms < 100) ms = "0" + ms;
  if (ms < 10) ms = "0" + ms;

  display_lapse_counter.innerHTML +=
    "<p>" + min + ":" + sec + "." + ms + "</p>";
});
