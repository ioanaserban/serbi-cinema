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

        <button type="button" class="btn btn-info my-3" data-toggle="modal" data-target="#exampleModalCenter">
            Adauga un film nou
        </button>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Adauga un film nou</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="text" class="form-control" id="filmName" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                        <button type="button" class="btn btn-info">Adauga</button>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>

<?php include 'assets/views/footer.php'; ?>
