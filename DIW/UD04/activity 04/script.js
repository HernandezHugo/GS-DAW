let count = 0;

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
      id: num,
    })
    .append(
      $(document.createElement("div"))
        .attr({
          class: "menu",
        })
        .append(
          $(document.createElement("input")).attr({
            type: "text",
            maxlength: 10,
          }),
          $(document.createElement("button"))
            .attr({
              class: "minimize",
            })
            .text("_")
            .on({
              click: function (e) {
                let text =
                  $("#" + num)
                    .find(".minimize")
                    .text() == "_"
                    ? "❏"
                    : "_";
                $("#" + num).toggleClass("minimizing");
                $("#" + num)
                  .find("textarea")
                  .toggle("fold", 500);
                $("#" + num)
                  .find(".minimize")
                  .text(text);
              },
            }),
          $(document.createElement("button"))
            .attr({
              class: "close",
            })
            .text("X")
            .on({
              click: function (e) {
                $(this)
                  .clone()
                  .text("Close post it")
                  .dialog({
                    modal: true,
                    buttons: [
                      {
                        text: "Delete",
                        click: function (e) {
                          $("#" + num).remove();
                          $(this).dialog("close");
                        },
                      },
                      {
                        text: "Close",
                        click: function (e) {
                          $(this).dialog("close");
                        },
                      },
                    ],
                  });
              },
            })
        )
    )
    .append(
      $(document.createElement("textarea")).attr({
        cols: 15,
        rows: 6,
        maxlength: 100,
      })
    )
    .data("dropped", false)
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

$(".add-green").on({
  click: function () {
    count += 1;
    createPostIt("green", count);
  },
});
$(".add-red").on({
  click: function () {
    count += 1;
    createPostIt("red", count);
  },
});
