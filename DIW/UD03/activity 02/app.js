const AUDIO_PLAYER = document.querySelector("audio");
const INDEX = document.querySelectorAll(".portada");

INDEX[0].addEventListener("click", (e) => {
  AUDIO_PLAYER.src= "./music/STRH1.mp3";
});

INDEX[1].addEventListener("click", (e) => {
  AUDIO_PLAYER.src = "./music/STRH2.mp3";
});
