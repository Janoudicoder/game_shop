

<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="fotos/1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="fotos/2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="fotos/3.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="fotos/4.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="fotos/5.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p>&copy; MJ GAMES</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $("#carouselExampleIndicators").carousel();

        // Set the interval for automatic sliding (in milliseconds)
        var interval = 2000; // Change this value to adjust the slide interval

        // Function to automatically advance to the next slide
        function nextSlide() {
            $("#carouselExampleIndicators").carousel("next");
        }

        // Start the carousel interval
        var slideInterval = setInterval(nextSlide, interval);

        // Pause the carousel when the mouse is over it
        $("#carouselExampleIndicators").on("mouseenter", function () {
            clearInterval(slideInterval);
        });

        // Resume the carousel when the mouse leaves it
        $("#carouselExampleIndicators").on("mouseleave", function () {
            slideInterval = setInterval(nextSlide, interval);
        });
    });
</script>