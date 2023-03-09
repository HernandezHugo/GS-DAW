<body style="">
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        
        <a href="/student039/dwes/index.php"><img class="navbar-brand" src="./img/logo_hotel_navbar.png" alt="logo Hotel"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="/student039/dwes/index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/student039/dwes/booking.php">Booking</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="/student039/dwes/#">About us</a>
        </li
        <li class="nav-item">
            <a class="nav-link" href="/student039/dwes/#">Contact</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="/student039/dwes/forms/form_login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/student039/dwes/forms/form_register.php">Register</a>
        </li>
</ul></div>        
      </div>
      
    </nav>
  </header><div id="carouselExampleAutoplaying" class="carousel slide portada" data-bs-ride="carousel">
  <div class="position-relative ">
    <div id="img_container" class="position-absolute weather">
    <img src="./img-weather/33-s.png"><p class="temperature">17 Cº</p></div>
  </div>
  <div class="carousel-inner ">
    <div class="carousel-item">
      <img src="./img/portada1_720.jpg" class="d-block w-100 opacity-50">
    </div>
    <div class="carousel-item">
      <img src="./img/portada2_720.jpg" class="d-block w-100 opacity-50">
    </div>
    <div class="carousel-item active">
      <img src="./img/portada3_720.jpg" class="d-block w-100 opacity-50">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<main class="container my-5">
  <div class="row">
    <div class="col">
      <section>
        <h2>Habitaciones</h2>
        <div class="row justify-content-center">
          <div class="card my-3" style="max-width: 800px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="./img/Serenity Suite.jpg" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Suites</h5>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
          </div>
          <div class="card my-3" style="max-width: 800px;">
            <div class="row g-0">
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Bungalows</h5>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
              </div>
              <div class="col-md-4">
                <img src="./img/Bungalow.jpg" class="img-fluid rounded-end" alt="...">
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <section>
        <h2>Servicios</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card">
              <img src="./img/restaurant.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Restaurant</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="./img/spa.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Spa</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <img src="./img/bar.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Bar</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Cookies</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    <p>We use cookies to make Hotelsito great. By using our site, you agree to our cookie policy.</p>
    <button name="settingCookie" type="submit" class="btn btn-outline-primary" data-bs-dismiss="offcanvas" aria-label="Close">Accept</button>
  </div>
</div>

<footer class="text-center text-white bg-secondary">
    <!-- Grid container -->
    <div class="container">
        <!-- Section: Links -->
        <section class="mt-5">
            <!-- Grid row-->
            <div class="row text-center d-flex justify-content-center pt-5">
                <!-- Grid column -->
                <div class="col-md-2">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!" class="text-white">About us</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!" class="text-white">Categories</a>
                    </h6>
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-md-2">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!" class="text-white">Contact</a>
                    </h6>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row-->
        </section>
        <!-- Section: Links -->

        <hr class="my-5">

        <!-- Section: Text -->
        <section class="mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                        distinctio earum repellat quaerat voluptatibus placeat nam,
                        commodi optio pariatur est quia magnam eum harum corrupti
                        dicta, aliquam sequi voluptate quas.
                    </p>
                </div>
            </div>
        </section>
        <!-- Section: Text -->

        <!-- Section: Social -->
        <section class="text-center mb-5">
            <a href="" class="text-white me-4">
                <i class="bi bi-facebook-f"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="bi bi-google"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="bi bi-linkedin"></i>
            </a>
            <a href="https://github.com/HernandezHugo/GS-DAW/tree/master/student039/DWES" class="text-white me-4">
                <i class="bi bi-github"></i>
            </a>
        </section>
        <!-- Section: Social -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2022 Copyright :
        <a class="text-white" href="https://github.com/HernandezHugo/GS-DAW/tree/master/student039/DWES">Hugo Hernandez</a>
    </div>
    <!-- Copyright -->
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  window.addEventListener("load", actionWeather())
  //window.addEventListener("load", callWeather())

  function callWeather() {
    let URL = './scripts/check_accu_weather.php'
    let xhr = new XMLHttpRequest();

    xhr.open("GET", URL + res, true);

    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("Can i call AccuWeather?");
        console.log(this.responseText);
      }
    };

    xhr.send();
  }

  function actionWeather() {
    let URL = "http://dataservice.accuweather.com/currentconditions/v1/";

    let key = "XCDMFUeWVFh1hjgZSqPqsGzAHPG1VH38";
    let locationkey = "305482";

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("documento de tiempo adquirido");
        saveWeather(this.responseText);
        printWeather(JSON.parse(this.responseText)[0])
      }
    };
    xhr.open("GET", URL + locationkey + "?apikey=" + key, true);
    xhr.send();
  }

  function saveWeather(res) {

    let URL = './scripts/save_accu_weather.php'
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("documento de tiempo enviado");
      }
    };
    xhr.open("GET", URL + '?q=' + res, true);
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


</body>