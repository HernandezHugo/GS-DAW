$.fn.countChars = function () {
   $(this).each(() => {
    elem = $(this)
    elem.change(e => {
        console.log($(this).text.length);
    })
   })
}

$(".area").countChars();

$(".area").KeyUp(e => {
    console.log(e);
    console.log($(this).text());
});
