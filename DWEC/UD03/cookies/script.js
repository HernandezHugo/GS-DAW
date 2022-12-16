const MILOCALSTORAGE = document.querySelector("#miLocalStorage");
const BTN_CREAR = document.querySelector(".btn-crear");
const BTN_MOSTRAR = document.querySelector(".btn-mostrar");
const BTN_ELIMINAR = document.querySelector(".btn-eliminar");

function creaLocalStorage() {
  localStorage.setItem("usuario", "IDK");
  localStorage.setItem("password", "1234");
}

function mostrarLocalStorage() {
  //MILOCALSTORAGE.innerHTML = localStorage.getItem("usuario");
  for (let i = 0; i < localStorage.length; i++) {
    const element = localStorage.getItem(localStorage.key(i));
    MILOCALSTORAGE.innerHTML += element;
  }
}

function eliminaLocalStorage() {
  localStorage.removeItem("usuario");
}

BTN_CREAR.addEventListener("click", (e) => {
  creaLocalStorage();
});
BTN_MOSTRAR.addEventListener("click", (e) => {
  mostrarLocalStorage();
});
BTN_ELIMINAR.addEventListener("click", (e) => {
  eliminaLocalStorage();
});
