<?php include 'assets/views/app.php'; ?>
<?php $categories = $dbManipulator->getCategories(); ?>

<div class="container container-body">

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
            </tr>
        <?php } ?>

        </tbody>
    </table>

    <div class="btn btn-info my-3">Adauga o categorie</div>

</div>

<?php include 'assets/views/footer.php'; ?>