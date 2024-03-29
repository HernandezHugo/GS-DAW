<!-- show cookies section just one time -->
<?php if ($cookie == 1) :
    setcookie("use", 0, time() + 86400) ?>
    <div class="offcanvas show offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Cookies</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <p>We use cookies to make Hotelsito great. By using our site, you agree to our cookie policy.</p>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <button name="settingCookie" type="submit" class="btn btn-outline-primary" data-bs-dismiss="offcanvas" aria-label="Close">Accept</button>
                <button class="btn btn-outline-primary" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
            </form>
        </div>
    </div>
<?php endif; ?>

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

        <hr class="my-5" />

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