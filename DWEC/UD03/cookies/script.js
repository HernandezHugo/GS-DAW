const miLocalStorage = document.querySelector("#miLocalStorage");
const btn_crear = document.querySelector(".btn-crear");
const btn_mostrar = document.querySelector(".btn-mostrar");
const btn_eliminar = document.querySelector(".btn-eliminar");

function creaLocalStorage() {
  localStorage.setItem("usuario", "IDK");
  localStorage.setItem("password", "1234");
}

function mostrarLocalStorage() {
  //miLocalStorage.innerHTML = localStorage.getItem("usuario");
  for (let i = 0; i < localStorage.length; i++) {
    const element = localStorage.getItem(localStorage.key(i));
    miLocalStorage.innerHTML += element;
  }
}

function eliminaLocalStorage() {
  localStorage.removeItem("usuario");
}

btn_crear.addEventListener("click", (e) => {
  creaLocalStorage();
});
btn_mostrar.addEventListener("click", (e) => {
  mostrarLocalStorage();
});
btn_eliminar.addEventListener("click", (e) => {
  eliminaLocalStorage();
});
