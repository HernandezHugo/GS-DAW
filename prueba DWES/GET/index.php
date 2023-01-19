<html>

<head>
  <script>
    function showHint(str) {
      if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        let URL = "http://dataservice.accuweather.com/locations/v1/cities/geoposition/search";
        //let URL = "gethint.php";
        let key = "XCDMFUeWVFh1hjgZSqPqsGzAHPG1VH38"
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
        xhr.open("GET", URL + "?apikey=" + key + "&q=" + str, true);
        xhr.send();
      }
    }
  </script>
</head>

<body>
  <p><b>Start typing a name in the input field below:</b></p>
  <form action="">
    <!-- <input type="date" min="2023-01-19"> -->
    <label for="fname">First name:</label>
    <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)" />
  </form>
  <p>Suggestions: <span id="txtHint"></span></p>
</body>

</html>