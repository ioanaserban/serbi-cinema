<?php include 'assets/views/app.php'; ?>
<div class="container container-body">
    <form class="form-custom" method="post" action="database/login_user.php">
        <div class="form-group">
            <label for="exampleInputEmail1">Adresa de email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Nu vom distibui nimanui adresa ta de email</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Parola</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <?php
            if (isset($_GET['errorMsg'])) {
        ?>
                <small class="alert"><?= $_GET['errorMsg'] ?></small>
        <?php
            }
        ?>
        <button type="submit" class="btn btn-info">Autentificare</button>
    </form>
</div>
<?php include 'assets/views/footer.php'; ?>
