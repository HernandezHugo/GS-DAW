$("button").click((e) => {
  e.preventDefault();
  let result = +$("#num_1").val() + +$("#num_2").val();
  //console.log(typeof +$("#num_1").val());
  //console.log(typeof $("#num_1").val());
  //console.log(+$("#num_1").val() + +$("#num_2").val());
  $('body').append('<p>' + result + '</p>');
});
