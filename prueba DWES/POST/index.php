<html>
  <head>
    <script>
      function showHint(str) {
        if (str.length == 0) {
          document.getElementById("txtHint").innerHTML = "";
          return;
        } else {
          var xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("txtHint").innerHTML = this.responseText;
            }
          };
          xhr.open("POST", "gethint.php", true);
          xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhr.send("q=" + str);
        }
      }
    </script>
  </head>
  <body>
    <p><b>Start typing a name in the input field below:</b></p>
    <form action="">
      <label for="fname">First name:</label>
      <input
        type="text"
        id="fname"
        name="fname"
        onkeyup="showHint(this.value)"
      />
    </form>
    <p>Suggestions: <span id="txtHint"></span></p>
  </body>
</html>
