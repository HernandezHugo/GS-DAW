$.fn.countChars = function (i) {
  $(this).keyup(() => {
    $("span").eq(i).text($(this).val().length)
  });
};

$("textarea").each((index, element) => {
  $(element).countChars(index);
});
