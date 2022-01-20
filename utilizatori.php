<?php include 'assets/views/app.php'; ?>
<?php $users = $dbManipulator->getUsers(); ?>

    <div class="container container-body">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Nume </th>
                <th scope="col">Prenume </th>
                <th scope="col">Data nasterii </th>
                <th scope="col">Sex </th>
                <th scope="col">Email </th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($users); $i++) { ?>
                <tr>
                    <th scope="row"><?= $users[$i]['id'] ?></th>
                    <td><?= $users[$i]['nume'] ?></td>
                    <td><?= $users[$i]['prenume'] ?></td>
                    <td><?= $users[$i]['data_nasterii'] ?></td>
                    <td><?= $users[$i]['sex'] ?></td>
                    <td><?= $users[$i]['email'] ?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>


    </div>

<?php include 'assets/views/footer.php'; ?>