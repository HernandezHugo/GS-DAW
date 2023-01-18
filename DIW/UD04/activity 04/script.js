$(".post")
  .data("dropped", false)
  .draggable({})
  .on({
    mouseenter: function () {
      $(this).css("cursor", "grab");
    },
    mousedown: function () {
      $(this).css("cursor", "grabbing");
    },
    mouseup: function () {
      $(this).css("cursor", "grab");
    },
  });

$(".drop").droppable({
  accept: ".post",
  drop: function (event, ui) {
    let count = $(this).find("span").text();
    $(this)
      .find("span")
      .text(+count + 1);
    $(ui.draggable).data("dropped", true);
  },
  out: function (event, ui) {
    let count = $(this).find("span").text();
    $(this)
      .find("span")
      .text(+count - 1);
    $(ui.draggable).data("dropped", false);
  },
});

$.fn.createPostIt = function () {
  $("<div><div/>", {
    class: "post",
  }).appendTo("posts");
};

$("add-green").on("click", createPostIt());
