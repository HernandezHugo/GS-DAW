<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');

//pages: profile
//3. Gestión del sistema de ficheros mediante PHP: Subida de un fichero, subida de múltiples ficheros mediante formularios.
//4. Gestión PHP del almacenamiento de ficheros en carpetas (read, write, scan), en la base de datos (pointer, binary) o en ambos sitios.

?>
<div id="carouselExampleAutoplaying" class="carousel slide portada" data-bs-ride="carousel">
  <div class="position-relative ">
    <div id="img_container" class="position-absolute weather">
    </div>
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
<main class="container">
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



<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/ajax/ajax_accu_weather.php');
?>

</body>

</html>