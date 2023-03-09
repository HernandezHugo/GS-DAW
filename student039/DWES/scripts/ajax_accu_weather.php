<?php

$url = $_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/scripts/save_accu_weather.php';
?>
<script>
  window.addEventListener("load", actionWeather())

  function actionWeather() {
    let URL = "http://dataservice.accuweather.com/currentconditions/v1/";

    let key = "XCDMFUeWVFh1hjgZSqPqsGzAHPG1VH38";
    let locationkey = "305482";

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("documento de tiempo adquirido");
        saveWeather(this.responseText);
      }
    };
    xhr.open("GET", URL + locationkey + "?apikey=" + key, true);
    xhr.send();
  }

  function saveWeather(res) {

    let URL = '<?php echo $url; ?>'
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("documento de tiempo enviado");
      }
    };
    xhr.open("GET", URL + res, true);
    xhr.send();
  }
</script>