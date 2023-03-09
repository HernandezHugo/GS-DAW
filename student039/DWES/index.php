<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');

//category:link to its own page
//pages: descrip, categories, profile, about us, contact, payment.
//1. Dinamización de páginas web con AJAX, para evitar la secuencia form>action en todo momento.
//2. Obtención de información de servidores externos mediante AJAX y utilización en página propia. Almacenamiento histórico de dicha información (ficheros, base de datos...).
//3. Gestión del sistema de ficheros mediante PHP: Subida de un fichero, subida de múltiples ficheros mediante formularios.
//4. Gestión PHP del almacenamiento de ficheros en carpetas (read, write, scan), en la base de datos (pointer, binary) o en ambos sitios.
//5. Utilización de COOKIES en PHP (superglobal $_COOKIE)

?>
<main class="container">
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
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
    <section></section>
</main>

<div class="offcanvas show offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Cookies</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body small">
    <p>We use cookies to make Hotelsito great. By using our site, you agree to our cookie policy.</p>
    <button name="settingCookie" type="submit" class="btn btn-outline-primary" data-bs-dismiss="offcanvas" aria-label="Close">Accept</button>
  </div>
</div>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/scripts/ajax_accu_weather.php');
?>

</body>

</html>