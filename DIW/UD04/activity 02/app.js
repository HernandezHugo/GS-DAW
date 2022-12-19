let result;
let msg;
function useRegex(input) {
  let regex = /[0-9]+/i;
  return regex.test(input);
}

function checkInput_1() {
  return useRegex($("#num_1").val());
}

function checkInput_2() {
  return useRegex($("#num_2").val());
}

function chooseMsg(checkInput_1, checkInput_2) {
  if (checkInput_1 && checkInput_2) {
    msg = "Result: ";
    return true;
  } else if (checkInput_1) {
    msg = "Input 2 must be a number";
  } else if (checkInput_2) {
    msg = "Input 1 must be a number";
  } else {
    msg = "Both inputs have to be a number";
  }
  return false;
}

function sumInputs() {
  result = +$("#num_1").val() + +$("#num_2").val();
}
function printMessage(type) {
  let p;
  if ($("#msgs").children().length == 0) p = $("p");
  else p = $("#msgs").children([0]);

  if (!type) p.addClass("errormsg");
  else p.addClass("infomsg");

  p.text(result);
  $("#msgs").append(p);
}

function emptyInputs() {
  $("#num_1").val("");
  $("#num_2").val("");
}

$("button").click((e) => {
  e.preventDefault();
  type = chooseMsg(checkInput_1(), checkInput_2());
  printMessage(type);
  emptyInputs();
  sumInputs();
});
