<?php include 'assets/views/app.php'; ?>
<?php $movies = $dbManipulator->getMoviesAndCategories(); ?>
<?php $categories = $dbManipulator->getCategories(); ?>

<div class="container container-body movies">
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
                <th scope="col"></th>
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
                        <td class="d-flex">
                            <img class="mr-2 cursor-pointer" src="/assets/images/edit_icon.svg" data-toggle="modal" data-target="#editMovie<?= $movies[$i]['id_film'] ?>">
                            <img class="cursor-pointer" src="/assets/images/delete_icon.svg" data-toggle="modal" data-target="#deleteMovie<?= $movies[$i]['id_film'] ?>">
                        </td>
                    </tr>
                    <div class="modal fade" id="editMovie<?= $movies[$i]['id_film'] ?>" tabindex="-1" role="dialog" aria-labelledby="editMovie<?= $movies[$i]['id_film'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Editeaza filmul</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/admin/filme-update.php" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="filmId" name="filmId" value="<?= $movies[$i]['id_film'] ?>">

                                        <div class="form-group">
                                            <label for="filmName">Nume film</label>
                                            <input type="text" class="form-control" id="filmName" name="filmName" value="<?= $movies[$i]['nume'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="directorName">Nume regizor</label>
                                            <input type="text" class="form-control" id="directorName" name="directorName" value="<?= $movies[$i]['regizor'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="producer">Casa de productie</label>
                                            <input type="text" class="form-control" id="producer" name="producer" value="<?= $movies[$i]['casa_de_productie'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="category">Categorie</label>
                                            <select class="form-control" aria-label="Categorie" id="category" name="category">
                                                <option>Selecteaza categoria</option>
                                                <?php for ($j = 0; $j < count($categories); $j++) { ?>
                                                    <option <?= $movies[$i]['categorie'] == $categories[$j]['nume'] ? 'selected' :'' ?> value="<?= $categories[$j]['id_categorie'] ?>"><?= $categories[$j]['nume'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                                        <button type="submit" class="btn btn-info">Editeaza</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteMovie<?= $movies[$i]['id_film'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMovie<?= $movies[$i]['id_film'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Sterge filmul</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/admin/filme-delete.php" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" class="form-control" id="filmId" name="filmId" value="<?= $movies[$i]['id_film'] ?>">
                                        Esti sigur ca vrei sa stergi filmul? Aceasta actiune este ireversibila.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                                        <button type="submit" class="btn btn-info">Sterge</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php } ?>

            </tbody>
        </table>

        <button type="button" class="btn btn-info my-3" data-toggle="modal" data-target="#addNewMovie">
            Adauga un film nou
        </button>

        <div class="modal fade" id="addNewMovie" tabindex="-1" role="dialog" aria-labelledby="addNewMovie" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Adauga un film nou</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/filme-create.php" method="post">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="filmName">Nume film</label>
                                <input type="text" class="form-control" id="filmName" name="filmName">
                            </div>
                            <div class="form-group">
                                <label for="directorName">Nume regizor</label>
                                <input type="text" class="form-control" id="directorName" name="directorName">
                            </div>
                            <div class="form-group">
                                <label for="producer">Casa de productie</label>
                                <input type="text" class="form-control" id="producer" name="producer">
                            </div>

                            <div class="form-group">
                                <label for="category">Categorie</label>
                                <select class="form-control" aria-label="Categorie" id="category" name="category">
                                    <option selected>Selecteaza categoria</option>
                                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                                        <option value="<?= $categories[$i]['id_categorie'] ?>"><?= $categories[$i]['nume'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                        <button type="submit" class="btn btn-info">Adauga</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>



    <?php } ?>
</div>

<?php include 'assets/views/footer.php'; ?>
