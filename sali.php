<?php include 'assets/views/app.php'; ?>
<?php $sali = $dbManipulator->getSali(); ?>

    <div class="container container-body">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Sala</th>
                <th scope="col">Numar de locuri</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($sali); $i++) { ?>
                <tr>
                    <th scope="row"><?= $sali[$i]['idSala'] ?></th>
                    <td>Sala nr.<?= $sali[$i]['numarSala'] ?></td>
                    <td><?= $sali[$i]['numarLocuriTotal'] ?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <div class="btn btn-info my-3">Adauga o sala</div>

    </div>

<?php include 'assets/views/footer.php'; ?>