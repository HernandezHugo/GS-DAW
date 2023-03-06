<html>

<head>

<body onload="actionWeather()">
</body>
<script>
  function actionWeather() {
    let URL = "http://dataservice.accuweather.com/currentconditions/v1/";

    let key = "XCDMFUeWVFh1hjgZSqPqsGzAHPG1VH38"
    let locationkey = "305482"

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("documento de tiempo adquirido");
        saveWeather(this.responseText)
      }
    };
    xhr.open("GET", URL + locationkey + "?apikey=" + key, true);
    xhr.send();

  }

  function saveWeather(res) {

    let xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("documento de tiempo enviado");
        console.log(res);
      }
    };
    xhr.open("GET", "./pruebaGET.php?q=" + res, true)
    xhr.send()
  }
</script>
</head>

</html>