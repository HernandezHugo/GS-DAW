const AUDIO_PLAYER = document.querySelector("audio");
const INDEX = document.querySelectorAll(".portada");
const PLAY = document.querySelector("[data-control='play']");
const STOP = document.querySelector("[data-control='stop']");
const PAUSE = document.querySelector("[data-control='pause']");
const REWIND = document.querySelector("[data-control='rewind']");
const FORWARD = document.querySelector("[data-control='forward']");

INDEX[0].addEventListener("click", (e) => {
  AUDIO_PLAYER.src = "./music/STRH1.mp3";
});

INDEX[1].addEventListener("click", (e) => {
  AUDIO_PLAYER.src = "./music/STRH2.mp3";
});

PLAY.addEventListener("click", (e) => {
  AUDIO_PLAYER.play();
});

STOP.addEventListener("click", (e) => {
  AUDIO_PLAYER.pause();
  AUDIO_PLAYER.currentTime = 0;
});

PAUSE.addEventListener("click", (e) => {
  AUDIO_PLAYER.pause();
});

REWIND.addEventListener("click", (e) => {
  AUDIO_PLAYER.currentTime -= 10;
});

FORWARD.addEventListener("click", (e) => {
  AUDIO_PLAYER.currentTime += 10;
});
