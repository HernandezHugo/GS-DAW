const form = document.getElementById("form");
const nombreusuario = document.getElementById("nombreusuario");
const email = document.getElementById("email");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");

//funciones que funcionan
function show_error(input, mensaje) {
  const formcontrol = input.parentElement;
  formcontrol.className = "form-control error";
  const label = formcontrol.querySelector("label");
  const small = formcontrol.querySelector("small");
  small.innerText = label.innerText + " " + mensaje;
}

function show_correct(input) {
  const formcontrol = input.parentElement;
  formcontrol.className = "form-control correcto";
}

function validar_mail(email) {
  const re = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
  return re.test(String(email).toLocaleLowerCase());
}

//ebentos jehje
form.addEventListener("submit", function (e) {
  e.preventDefault();

  if (nombreusuario.value === "") {
    show_error(nombreusuario, "pon tu nombre leÃ±e");
  } else {
    show_correct(nombreusuario);
  }

  if (email.value === "") {
    show_error(email, "pon tu email leÃ±e");
  } else if (!validar_mail(email.value)) {
    show_error(email, "invalido");
  } else {
    show_correct(email);
  }

  if (password.value === "") {
    show_error(password, "pon tu contraseÃ±a leÃ±e");
  } else {
    show_correct(password);
  }
  
  if (password2.value === "") {
    show_error(password2, "pon tu contraseÃ±a leÃ±e");
  } else {
    show_correct(password2);
  }
});