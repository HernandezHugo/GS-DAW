<script>
  //window.addEventListener("load", actionWeather())
  window.addEventListener("load", checkInfoWeather())

  function checkInfoWeather() {
    let URL = './scripts/check_accu_weather.php';
    let xhr = new XMLHttpRequest();

    xhr.open("GET", URL, true);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        this.responseText === 'call AccuWeather' ?
          actionWeather() :
          printWeather(JSON.parse(this.responseText)[0]);
      }
    };

    xhr.send();
  }

  function actionWeather() {
    let URL = "http://dataservice.accuweather.com/currentconditions/v1/";

    let key = "XCDMFUeWVFh1hjgZSqPqsGzAHPG1VH38";
    let locationkey = "305482";

    let xhr = new XMLHttpRequest();

    xhr.open("GET", URL + locationkey + "?apikey=" + key, true);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        saveWeather(this.responseText);
        printWeather(JSON.parse(this.responseText)[0])
      }
    };

    xhr.send();
  }

  function saveWeather(res) {

    let URL = './scripts/save_accu_weather.php';
    let xhr = new XMLHttpRequest();

    xhr.open("GET", URL + '?q=' + res, true);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };

    xhr.send();
  }

  function printWeather(res) {

    let imgContainer = document.querySelector("#img_container")
    let img = document.createElement("img")
    let temp = document.createElement("p")

    img.setAttribute("src", './img-weather/' + res['WeatherIcon'] + '-s.png')

    temp.innerText = res["Temperature"]["Metric"]["UnitType"] + " " + res["Temperature"]["Metric"]["Unit"] + "º"
    temp.classList.add("temperature")

    imgContainer.appendChild(img)
    imgContainer.appendChild(temp)
  }
</script>