<?php include 'assets/views/app.php'; ?>
<?php $sali = $dbManipulator->getSali(); ?>
<?php

foreach ($sali as $key => $sala)
    $sali[$key]['spots'] = $dbManipulator->getSpotsOfMovieRoom($sala['idSala']);
?>

    <div class="container container-body movies">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Sala</th>
                <th scope="col">Numar de locuri</th>
                <th scope="col">Actiuni</th>
                <th scope="col">Locuri</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($sali); $i++) { ?>
                <tr>
                    <th scope="row"><?= $sali[$i]['idSala'] ?></th>
                    <td>Sala nr.<?= $sali[$i]['numarSala'] ?></td>
                    <td><?= $sali[$i]['numarLocuriTotal'] ?></td>
                    <td class="d-flex">
                        <img class="mr-2 cursor-pointer" src="/assets/images/edit_icon.svg" data-toggle="modal" data-target="#editMovieRoom<?= $sali[$i]['idSala'] ?>">
                        <img class="cursor-pointer" src="/assets/images/delete_icon.svg" data-toggle="modal" data-target="#deleteMovieRoom<?= $sali[$i]['idSala'] ?>">
                    </td>
                    <td><img src="assets/images/info.svg" class="cursor-pointer" data-toggle="modal" data-target="#spots<?= $sali[$i]['idSala'] ?>"></td>
                </tr>

                <div class="modal fade" id="spots<?= $sali[$i]['idSala'] ?>" tabindex="-1" aria-labelledby="spots<?= $sali[$i]['idSala'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Locuri disponibile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php foreach ($sali[$i]['spots'] as $spot) { ?>
                                    <div class="d-flex">
                                        <div class="d-flex mt-3">
                                            <div>Rand: <?= $spot['rand'] ?></div>
                                            <div></div>
                                        </div>
                                        <div class="d-flex mt-3 ml-5">
                                            <div>Numar: <?= $spot['numar'] ?></div>
                                            <div></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editMovieRoom<?= $sali[$i]['idSala'] ?>" tabindex="-1" role="dialog" aria-labelledby="editMovieRoom<?= $sali[$i]['idSala'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Editeaza sala</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/admin/sali-update.php" method="post">
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" id="salaId" name="salaId" value="<?= $sali[$i]['idSala'] ?>">
                                    <div class="form-group">
                                        <label for="salaNo">Numarul salii</label>
                                        <input type="number" class="form-control" id="salaNo" name="salaNo" value="<?= $sali[$i]['numarSala'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="numarLocuri">Numar de locuri in sala</label>
                                        <input type="number" class="form-control" id="numarLocuri" name="numarLocuri" value="<?= $sali[$i]['numarLocuriTotal'] ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                                    <button type="submit" class="btn btn-info">Salveaza</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteMovieRoom<?= $sali[$i]['idSala'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMovieRoom<?= $sali[$i]['idSala'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Sterge sala</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/admin/sali-delete.php" method="post">
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" id="salaId" name="salaId" value="<?= $sali[$i]['idSala'] ?>">
                                    Esti sigur ca vrei sa stergi sala? Aceasta actiune este ireversibila.
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

        <button type="button" class="btn btn-info my-3" data-toggle="modal" data-target="#addNewMovieRoom">
            Adauga o sala noua
        </button>

        <div class="modal fade" id="addNewMovieRoom" tabindex="-1" role="dialog" aria-labelledby="addNewMovieRoom" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Adauga o sala noua</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/sali-create.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="salaNo">Numarul salii</label>
                                <input type="number" class="form-control" id="salaNo" name="salaNo">
                            </div>
                            <div class="form-group">
                                <label for="numarLocuri">Numar de locuri in sala</label>
                                <input type="number" class="form-control" id="numarLocuri" name="numarLocuri">
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
    </div>

<?php include 'assets/views/footer.php'; ?>