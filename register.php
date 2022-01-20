<?php include 'assets/views/app.php'; ?>
<div class="container container-body">
    <form class="form-custom" method="post" action="database/register_user.php">
        <div class="form-group">
            <label for="exampleInputEmail1">Adresa de email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <small id="emailHelp" class="form-text text-muted">Nu vom distibui nimanui adresa ta de email</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Parola</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>

        <div class="form-group">
            <label for="lastName">Nume</label>
            <input type="text" name="lastName" class="form-control" id="lastName" required>
        </div>

        <div class="form-group">
            <label for="firstName">Prenume</label>
            <input type="text" name="firstName" class="form-control" id="firstName" required>
        </div>

        <div class="form-group">
            <label for="birthday">Data nasterii</label>
            <input type="text" name="birthday" class="form-control" id="birthday" required>
        </div>

        <label>Sex</label>
        <select class="form-control mb-3" required>
            <option value="M" selected>Masculin</option>
            <option value="F">Feminin</option>
        </select>
        <?php
        if (isset($_GET['errorMsg'])) {
            ?>
            <small class="alert"><?= $_GET['errorMsg'] ?></small>
            <?php
        }
        ?>
        <button type="submit" class="btn btn-info">Inregistrare</button>
    </form>
</div>
<?php include 'assets/views/footer.php'; ?>
