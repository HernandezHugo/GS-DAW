function useRegex(input) {
  let regex = /[0-9]+/i;
  return regex.test(input);
}
$("button").click((e) => {
  e.preventDefault();
  let result;
  useRegex($("#num_1").val()) && useRegex($("#num_2").val())
    ? (result = +$("#num_1").val() + +$("#num_2").val())
    : (result = "Both inputs have to be a number.");
  $("body").append("<p>" + result + "</p>");

  $("#num_1").val('');
  $("#num_2").val('');
});
