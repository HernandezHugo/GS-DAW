$.fn.countChars = function () {
  $(this).each((index) => {
    console.log(index + " " + $(this).val());
    console.log($(this).val());

  });
};

$(".area").keyup(()=>{
    countChars();
});
console.log($(".area")[0]);
