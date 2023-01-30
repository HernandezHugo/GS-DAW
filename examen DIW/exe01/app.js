let full = false;

$(document).on({
  keyup: function (e) {
    if (e.keycode == 13 && full) addToSelect();
  },
});

function resetInputs() {
  $("#name").val("");
  $("#email").val("");
}

function addToSelect() {
  if ($("#select").length == 0)
    $("#btn").after($("<select/>").attr("id", "select"));

  if (full)
    $("#select").append(
      $("<option/>").html(
        "Name: " + $("#name").val() + " Email: " + $("#email").val()
      )
    );
}

function checkEmpty(element) {
  let errormsg = "the field is empty";
  if ($("#" + element).val().length == 0) {
    full = false;
    $("#" + element).before(
      $("<p class='" + element + "_err'>" + errormsg + "</p>")
    );
  } else {
    full = true;
    $("." + element + "_err").remove();
  }
}

$("#btn").on({
  click: function (e) {
    e.preventDefault();
    addToSelect();
    resetInputs();
  },
});

$("input").focusout(function (e) {
  checkEmpty($(this).attr("id"));
});
