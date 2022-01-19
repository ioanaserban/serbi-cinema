<?php include 'assets/views/app.php'; ?>
<?php $categories = $dbManipulator->getCategories(); ?>

<div class="container container-body categories">

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Index</th>
            <th scope="col">Nume categorie</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($categories); $i++) { ?>
            <tr>
                <th scope="row"><?= $categories[$i]['id_categorie'] ?></th>
                <td><?= $categories[$i]['nume'] ?></td>
                <td class="d-flex">
                    <img class="cursor-pointer" src="/assets/images/delete_icon.svg" data-toggle="modal" data-target="#deleteCategory<?= $categories[$i]['id_categorie'] ?>">
                </td>
            </tr>
            <div class="modal fade" id="deleteCategory<?= $categories[$i]['id_categorie'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteCategory<?= $categories[$i]['id_categorie'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Sterge categoria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/admin/categorii-delete.php" method="post">
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="categId" name="categId" value="<?= $categories[$i]['id_categorie'] ?>">
                                Esti sigur ca vrei sa stergi categoria? Aceasta actiune este ireversibila.
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

    <button type="button" class="btn btn-info my-3" data-toggle="modal" data-target="#addNewCategory">
        Adauga o categorie
    </button>

    <div class="modal fade" id="addNewCategory" tabindex="-1" role="dialog" aria-labelledby="addNewCategory" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Adauga o categorie nou</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/filme-create.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categName">Nume categorie</label>
                            <input type="text" class="form-control" id="categName" name="categName">
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