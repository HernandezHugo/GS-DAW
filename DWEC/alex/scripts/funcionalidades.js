//pasa los segundos a un formato legible para el espectador humano
function display_seconds(seconds) {
    let horas = 0;
    let minutos = 0;
    let segundos = seconds;
    if (segundos / 60 >= 1) {
      if (segundos / 3600 >= 1) {
        horas = Math.floor(segundos / 3600);
        minutos = Math.floor(
          (segundos / 3600 - Math.floor(segundos / 3600)) * 60
        );
        segundos = segundos - (horas * 3600 + minutos * 60);
        if (horas < 10) horas = "0" + horas;
        if (minutos < 10) minutos = "0" + minutos;
        if (segundos < 10) segundos = "0" + segundos;
        return horas + ":" + minutos + ":" + segundos;
      } else {
        minutos = Math.floor(segundos / 60);
        segundos = segundos - minutos * 60;
      }
      if (minutos < 10) minutos = "0" + minutos;
      if (segundos < 10) segundos = "0" + segundos;
      return minutos + ":" + segundos;
    }
    if (segundos < 10) segundos = "0" + segundos;
    return segundos;
  }
  
  //crea lista a partir de array
  function crear_lista(array) {
    document.write("<ul id=lista></ul>");
    for (i = 0; i < array.length; i++) {
      let elemento = document.createElement("li");
      elemento.innerHTML = array[i];
      document.getElementById("lista").appendChild(elemento);
    }
  }
  
  //añade a lista por id a partir de array
  function crear_lista(array,id) {
    let lista=document.getElementById(id);
    for (let i = 0; i < array.length; i++) {
      let elemento = document.createElement("li");
      elemento.innerHTML =array[i];
      lista.appendChild(elemento);
    }
  }
  
  
  //crea lista a partir de array y devuelve la lista
  function crear_lista2(array) {
    let lista = document.createElement("ul");
    for (i = 0; i < array.length; i++) {
      let elemento = document.createElement("li");
      elemento.innerHTML = array[i];
      lista.appendChild(elemento);
    }
    return lista;
  }
  
  //devuelve string ordenado de mayor a menor
  function ordenar_string(texto) {
    let ijausbfs = [];
    let texto_ordenado = Array.from(texto);
    for (let i = 0; i < texto_ordenado.length; i++) {
      let aux = texto_ordenado[i];
      for (let j = i; j < texto_ordenado.length; j++) {
        if (texto_ordenado[j] > texto_ordenado[i]) {
          texto_ordenado[i] = texto_ordenado[j];
          texto_ordenado[j] = aux;
          aux = texto_ordenado[i];
        }
      }
    }
  
    return texto_ordenado.join("");
  }
  
  //devuelve string en orden inverso
  function invertir(texto) {
    let contrario = "";
    for (let i = texto.length - 1; i >= 0; i--) {
      contrario = contrario + texto[i];
    }
    return contrario;
  }
  
  //devuelve factorial de numero
  function factorial(numero) {
    let resultado = 1;
    for (let index = 1; index <= numero; index++) {
      resultado = resultado * index;
    }
    return resultado;
  }
  