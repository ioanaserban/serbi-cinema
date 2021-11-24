<?php include 'assets/views/app.php'; ?>
<?php $movies = $dbManipulator->getMoviesAndCategories(); ?>

<div class="container container-body">
    <?php if (!User::isAdmin()) { ?>
        <div class="welcome-text">
            <h2>
                Selectia de filme
            </h2>
        </div>

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
    <?php } else { ?>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Nume film</th>
                <th scope="col">Regizor</th>
                <th scope="col">Casa de productie</th>
                <th scope="col">Categorie</th>
            </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($movies); $i++) { ?>
                    <tr>
                        <th scope="row"><?= $movies[$i]['id_film'] ?></th>
                        <td><?= $movies[$i]['nume'] ?></td>
                        <td><?= $movies[$i]['regizor'] ?></td>
                        <td><?= $movies[$i]['casa_de_productie'] ?></td>
                        <td><?= $movies[$i]['categorie'] ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

        <div class="btn btn-info my-3">Adauga un film nou</div>

    <?php } ?>
</div>

<?php include 'assets/views/footer.php'; ?>
