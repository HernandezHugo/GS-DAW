let xmlhttp = new XMLHttpRequest();
let url = "webs.txt";

xmlhttp.onreadystatechange = () => {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    let llistatWebs = JSON.parse(xmlhttp.responseText);
    getWebs(llistatWebs);
  }
};

xmlhttp.open("GET", url, true);
xmlhttp.send();

function getWebs(arr) {
  let out = "";
  for (let i = 0; i < arr.length; i++) {
    out += '<a href="' + arr[i].url + '">' + arr[i].display + "</a><br>";
  }
  document.getElementById("webs").innerHTML = out;
}
