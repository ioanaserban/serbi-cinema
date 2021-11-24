<?php include 'assets/views/app.php'; ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="/assets/images/film_homepage_4.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/assets/images/film_homepage_2.jpeg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/assets/images/film_homepage_1.jpeg" alt="Third slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/assets/images/film_homepage4.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container container-body">

    <div class="welcome-text">
        <h2>
            Bun venit la SerbiCinema!
        </h2>

    </div>

    <?php $movies = $dbManipulator->getMoviesAndCategories(); ?>

    <div class="custom-grid">
        <?php for ($i = 0; $i < count($movies); $i++) { ?>
        <div class="card">
            <img class="card-img-top" src="/assets/images/cinema-gallery-img.jpeg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $movies[$i]['nume'] ?></h5>
                <p class="card-text">Regizor: <?= $movies[$i]['regizor'] ?></p>
                <p class="card-text">Casa de productie: <?= $movies[$i]['casa_de_productie'] ?></p>
                <p class="card-text">Categorie: <?= $movies[$i]['categorie'] ?></p>
            </div>
        </div>
        <?php } ?>

    </div>

</div>
<?php include 'assets/views/footer.php'; ?>
