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
  return re.test(String(email).toLocaleLowerCase);
}

/* function obligatorio(input){
    if(input.value.trim()===""){
        show_error(input,"es obligatorio")
    }
} */
function obligatorio(input_array){
    input_array.forEach(element => {
        if(element.value.trim()===""){
            show_error(element,"es obligatorio")
        }else show_correct(element)
    });
}

//ebentos jehje
form.addEventListener("submit", function (e) {
  e.preventDefault();

  obligatorio([nombreusuario,email,password,password2]);

});