<?php include 'assets/views/app.php'; ?>
<?php
if (!empty($_GET['filterCategoryName'])) {
    $movies = $dbManipulator->getMoviesAndCategoriesFilterByCategoryName($_GET['filterCategoryName']);

} else {
    $movies = $dbManipulator->getMoviesAndCategories();

}

$counter['countRezervi'] = 0;

if (!empty($_GET['movieId'])) {
    $counter = $dbManipulator->getCountRezervari($_GET['movieId']);
}


foreach ($movies as $key => $movie) {
    $movies[$key]['availableDateAndHours'] = $dbManipulator->getAvailableDateAndHoursByMovieId($movie['id_film']);
}
?>
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
                        <div class="card-text">
                            <h5 class="card-title"><?= $movies[$i]['nume'] ?></h5>
                            <p class="card-text">Regizor: <?= $movies[$i]['regizor'] ?></p>
                            <p class="card-text">Casa de productie: <?= $movies[$i]['casa_de_productie'] ?></p>
                            <p class="card-text">Categorie: <?= $movies[$i]['categorie'] ?></p>
                        </div>
                        <?php if (User::isLoggedIn()) { ?>
                            <button type="button" class="btn btn-info mt-3 d-flex" data-toggle="modal"
                                    data-target="#addReservation<?= $movies[$i]['id_film'] ?>">
                                <img class="mr-2" src="/assets/images/plus_circle_icon.svg">
                                <span>Adauga o rezervare</span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal fade" id="addReservation<?= $movies[$i]['id_film'] ?>" tabindex="-1" role="dialog"
                     aria-labelledby="addReservation<?= $movies[$i]['id_film'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Adauga rezervare</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-group" method="post" action="/client/rezervari-create.php">
                                <div class="modal-body">
                                    <input type="hidden" name="movieId" value="<?= $movies[$i]['id_film'] ?>">
                                    <?php if (!count($movies[$i]['availableDateAndHours'])) { ?>
                                        Nu exista perioada libera pentru a rezerva un loc la acest film.
                                    <?php } else { ?>
                                        <select class="form-control" id="dateFor<?= $movies[$i]['id_film'] ?>"
                                                name="date"
                                                onchange='selectChooseHour(`<?= json_encode($movies[$i]['availableDateAndHours']) ?>`, this, <?= $movies[$i]['id_film'] ?>)'
                                                required>
                                            <option selected>None</option>
                                            <?php foreach ($movies[$i]['availableDateAndHours'] as $date => $hours) ?>
                                            <option value="<?= $date ?>"><?= $date ?></option>
                                            <?php ?>
                                        </select>

                                        <select class="form-control d-none mt-3"
                                                id="hoursFor<?= $movies[$i]['id_film'] ?>" name="hour"
                                                onchange="getFreeSpotsMovie(<?= $movies[$i]['id_film'] ?>)" required>

                                        </select>

                                        <select class="form-control d-none mt-3"
                                                id="spotFor<?= $movies[$i]['id_film'] ?>" name="spot" required>

                                        </select>
                                    <?php } ?>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide
                                    </button>
                                    <button type="submit" class="btn btn-info">Salveaza</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    <?php } else { ?>
        <div class="mb-4">
            <div class="d-flex">
                <form class="form-group d-flex">
                    <div class="mr-3">
                        <input name="filterCategoryName" class="form-control" placeholder="Ex. Actiune"
                               value="<?= !empty($_GET['filterCategoryName']) ? $_GET['filterCategoryName'] : '' ?>">
                    </div>
                    <div>
                        <button class="btn btn-secondary">Filtrare dupa categorie</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mb-4">
            <div class="d-flex">
                <form class="form-group d-flex">
                    <div class="mr-3">
                        <input name="movieId" class="form-control" placeholder="Ex. 1,2"
                               value="<?= !empty($_GET['movieId']) ? $_GET['movieId'] : '' ?>">
                    </div>
                    <div>
                        <button class="btn btn-secondary">Cate rezervari au filmele</button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center ml-4"><?= $counter['countRezervi'] ?></div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Nume film</th>
                <th scope="col">Regizor</th>
                <th scope="col">Casa de productie</th>
                <th scope="col">Categorie</th>
                <th scope="col">Actiune</th>
                <th scope="col">Info</th>
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
                        <img class="mr-2 cursor-pointer" src="/assets/images/edit_icon.svg" data-toggle="modal"
                             data-target="#editMovie<?= $movies[$i]['id_film'] ?>">
                        <img class="cursor-pointer" src="/assets/images/delete_icon.svg" data-toggle="modal"
                             data-target="#deleteMovie<?= $movies[$i]['id_film'] ?>">
                    </td>
                    <td><img src="assets/images/info.svg" class="cursor-pointer" data-toggle="modal"
                             data-target="#info<?= $movies[$i]['id_film'] ?>"></td>

                </tr>

                <div class="modal fade" id="info<?= $movies[$i]['id_film'] ?>" tabindex="-1"
                     aria-labelledby="info<?= $movies[$i]['id_film'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Info despre
                                    <strong><?= $movies[$i]['nume'] ?></strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div>Rezervari all time
                                    barbati: <?= $dbManipulator->getGenderStatisticByMovieId($movies[$i]['id_film'])['M'] ?> </div>
                                <div>Rezervari all time
                                    femei: <?= $dbManipulator->getGenderStatisticByMovieId($movies[$i]['id_film'])['F'] ?> </div>

                                <div>
                                    Categoria contine <?= $dbManipulator->getNumberOfMoviesPerCategory()[$movies[$i]['id_categorie']] ?> filme in total
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editMovie<?= $movies[$i]['id_film'] ?>" tabindex="-1" role="dialog"
                     aria-labelledby="editMovie<?= $movies[$i]['id_film'] ?>" aria-hidden="true">
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
                                    <input type="hidden" class="form-control" id="filmId" name="filmId"
                                           value="<?= $movies[$i]['id_film'] ?>">

                                    <div class="form-group">
                                        <label for="filmName">Nume film</label>
                                        <input type="text" class="form-control" id="filmName" name="filmName"
                                               value="<?= $movies[$i]['nume'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="directorName">Nume regizor</label>
                                        <input type="text" class="form-control" id="directorName" name="directorName"
                                               value="<?= $movies[$i]['regizor'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="producer">Casa de productie</label>
                                        <input type="text" class="form-control" id="producer" name="producer"
                                               value="<?= $movies[$i]['casa_de_productie'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Categorie</label>
                                        <select class="form-control" aria-label="Categorie" id="category"
                                                name="category">
                                            <option>Selecteaza categoria</option>
                                            <?php for ($j = 0; $j < count($categories); $j++) { ?>
                                                <option <?= $movies[$i]['categorie'] == $categories[$j]['nume'] ? 'selected' : '' ?>
                                                        value="<?= $categories[$j]['id_categorie'] ?>"><?= $categories[$j]['nume'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide
                                    </button>
                                    <button type="submit" class="btn btn-info">Editeaza</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteMovie<?= $movies[$i]['id_film'] ?>" tabindex="-1" role="dialog"
                     aria-labelledby="deleteMovie<?= $movies[$i]['id_film'] ?>" aria-hidden="true">
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
                                    <input type="hidden" class="form-control" id="filmId" name="filmId"
                                           value="<?= $movies[$i]['id_film'] ?>">
                                    Esti sigur ca vrei sa stergi filmul? Aceasta actiune este ireversibila.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide
                                    </button>
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

        <div class="modal fade" id="addNewMovie" tabindex="-1" role="dialog" aria-labelledby="addNewMovie"
             aria-hidden="true">
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
