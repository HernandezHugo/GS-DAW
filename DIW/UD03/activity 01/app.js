const C = document.getElementById("myCanvas");
const Y = 350;
const X = 150;
const SALES = [
  {
    product: "Basketballs",
    units: 150,
  },
  {
    product: "Baseballs",
    units: 125,
  },
  {
    product: "Footballs",
    units: 300,
  },
];
let ctx = C.getContext("2d");

function lines() {
  ctx.lineWidth = 1;
  ctx.moveTo(X, 50);
  ctx.lineTo(X, Y);
  ctx.lineTo(500, Y);
  ctx.stroke();
}

function arrows() {
  ctx.lineWidth = 1;
  ctx.moveTo(X, 50);
  ctx.lineTo(145, 55);
  ctx.moveTo(X, 50);
  ctx.lineTo(155, 55);
  ctx.stroke();

  ctx.moveTo(500, Y);
  ctx.lineTo(495, Y - 5);
  ctx.moveTo(500, Y);
  ctx.lineTo(495, Y + 5);
  ctx.stroke();
}

function texts() {
  ctx.font = "14px Arial";
  ctx.fillText("Units Sold", 80, 180);
  ctx.fillText("(In 100s)", 85, 200);
  ctx.fillText("Basketballs", X + 25, Y + 20);
  ctx.fillText("Baseballs", X + 140, Y + 20);
  ctx.fillText("Footballs", X + 255, Y + 20);
  ctx.fillText("Products", X + 150, Y + 50);
}

function gradients_basket() {
  let grd = ctx.createLinearGradient(X + 30, Y, X + 90, Y);
  grd.addColorStop(0, "red");
  grd.addColorStop(1, "white");

  ctx.fillStyle = grd;
  ctx.fillRect(X + 30, Y, 60, -SALES[0].units);
}

function gradients_baseball() {
  let grd = ctx.createLinearGradient(X + 140, Y, X + 230, Y);
  grd.addColorStop(0, "blue");
  grd.addColorStop(1, "white");

  ctx.fillStyle = grd;
  ctx.fillRect(X + 140, Y, 60, -SALES[1].units);
}

function gradients_football() {
  let grd = ctx.createLinearGradient(X + 255, Y, X + 310, Y);
  grd.addColorStop(0, "orange");
  grd.addColorStop(1, "white");

  ctx.fillStyle = grd;
  ctx.fillRect(X + 255, Y, 60, -SALES[2].units);
}

lines();
arrows();
texts();
gradients_basket();
gradients_baseball();
gradients_football();
