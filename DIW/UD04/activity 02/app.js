let result;
let msg;
let errors = [];

function checkInput_1() {
  return !isNaN($("#num_1").val()) && $("#num_1").val().length > 0
    ? true
    : false;
}

function checkInput_2() {
  return !isNaN($("#num_2").val()) && $("#num_2").val().length > 0
    ? true
    : false;
}

function checkErrors(checkInput_1, checkInput_2) {
  errors = [];
  msg = "";
  if (checkInput_1 && checkInput_2) msg = "Result: ";
  else errors.push("Both inputs must contain a number");

  if (checkInput_1 == false) errors.push("Input 1 has to contain just numbers");
  if (checkInput_2 == false) errors.push("Input 2 has to contain just numbers");
}

function sumInputs() {
  if (errors.length != 0) result = +$("#num_1").val() + +$("#num_2").val();
}

function bindingElements(element) {
  element.on({
    mouseover: (e) => {
      $(element).css({
        fontSize: "1.25em",
        margin: "0.7em 2em",
        padding: "0.5em",
        boxShadow: "1px 2px 4px black",
      });
    },
    mouseout: (e) => {
      $(element).css({
        fontSize: "1.2em",
        margin: "1em 2em",
        padding: "0.3em",
        boxShadow: "0px 0px 0px",
      });
    },
  });
}

function printErrors(fragment) {
  for (let i = 0; i < errors.length; i++) {
    let p = $(document.createElement("p"));
    p.addClass("errormsg");
    p.text(errors[i]);
    fragment.append(p);
    bindingElements(p);
  }
}

function printInfo(fragment) {
  let p = $(document.createElement("p"));
  p.addClass("infomsg");
  p.text(msg + result);
  bindingElements(p);
  fragment.append(p);
}

function printMessage() {
  $("#msgs").html("");
  let fragment = $(document.createDocumentFragment());

  if (errors.length != 0) printErrors(fragment);
  else printInfo(fragment);

  $("#msgs").append(fragment);
}

function emptyInputs() {
  if (errors.length == 0) {
    $("#num_1").val("");
    $("#num_2").val("");
  }
}

$("button").click((e) => {
  e.preventDefault();
  checkErrors(checkInput_1(), checkInput_2());
  sumInputs();
  printMessage();
  emptyInputs();
});

$("#num_1, #num_2").on("keydown", (e) => {
  if (e.keyCode == 13) {
    checkErrors(checkInput_1(), checkInput_2());
    sumInputs();
    printMessage();
    emptyInputs();
  }
});
