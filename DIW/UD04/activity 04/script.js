$(".drop").droppable({
  drop: function (event, ui) {
    let count = $(this).find("span").text();
    if ($(ui.draggable).data("dropped") !== true) count = +count + 1;
    $(this).find("span").text(count);
    $(ui.draggable).data("dropped", true);
  },
  out: function (event, ui) {
    let count = $(this).find("span").text();
    if ($(ui.draggable).data("dropped") !== false) count = +count - 1;
    $(this).find("span").text(count);
    $(ui.draggable).data("dropped", false);
  },
});

$(".d-green").droppable({
  accept: ".green",
});
$(".d-red").droppable({
  accept: ".red",
});

function createPostIt(color, num) {
  $(document.createElement("div"))
    .attr({
      class: "post " + color,
    })
    .append(
      $(document.createElement("div"))
        .attr({
          class: "menu",
        })
        .append(
          $(document.createElement("input")).attr({
            type: "text",
          }),
          $(document.createElement("button"))
            .attr({
              class: "minimize",
            })
            .text("_"),
          $(document.createElement("button"))
            .attr({
              class: "close",
            })
            .text("X")
        )
    )
    .append(
      $(document.createElement("textarea")).attr({
        cols: 15,
        rows: 6,
      })
    )
    .data("prop", { dropped: false, id: num + 1 })
    .draggable()
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
    })
    .appendTo("#" + color);
}

function countPosts(color) {
  return $("." + color).length;
}

$(".add-green").on({
  click: function () {
    createPostIt("green", countPosts("green"));
  },
});
$(".add-red").on({
  click: function () {
    createPostIt("red", countPosts("red"));
  },
});

/*to continue*/ 
$(".minimize").on({
  click: function () {
    createPostIt("red");
  },
});
$(".close").on({
  click: function () {
    createPostIt("red");
  },
});
