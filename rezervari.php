<?php include 'assets/views/app.php'; ?>
<?php $reservations = $dbManipulator->getRezervari(!User::isAdmin() ? $_SESSION['user']['id'] : null); ?>

    <div class="container container-body">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Nume</th>
                <th scope="col">Prenume</th>
                <th scope="col">Data</th>
                <th scope="col">Ora</th>
                <th scope="col">Film</th>
                <th scope="col">Sala</th>
                <th scope="col">Numar</th>
                <th scope="col">Rand</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($reservations); $i++) { ?>
                <tr>
                    <th scope="row"><?= $reservations[$i]['id'] ?></th>
                    <td><?= $reservations[$i]['Nume_client'] ?></td>
                    <td><?= $reservations[$i]['Prenume_client'] ?></td>
                    <td><?= $reservations[$i]['data'] ?></td>
                    <td><?= $reservations[$i]['ora'] ?></td>
                    <td><?= $reservations[$i]['Film'] ?></td>
                    <td><?= $reservations[$i]['Sala'] ?></td>
                    <td><?= $reservations[$i]['numar'] ?></td>
                    <td><?= $reservations[$i]['rand'] ?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <div class="btn btn-info my-3">Adauga o rezervare</div>

    </div>

<?php include 'assets/views/footer.php'; ?>