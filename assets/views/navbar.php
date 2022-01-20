<header class="h-62px">



    <div class="navbar navbar-light shadow-sm fixed-top">
        <div class="container">
            <div class="d-flex align-items-center">
                <a href="/" class="navbar-brand d-flex align-items-center">
                    <img src="/assets/images/cinema_icon.svg" alt="cinemaIcon">
                    <strong>SerbiCinema</strong>
                </a>
                <ul class="list-unstyled d-flex mb-0">
                    <li><a href="/filme.php" class="text-black underline-none ">Filme</a></li>
                    <?php if (User::isLoggedIn()) { ?>
                        <li><a href="/rezervari.php" class="text-black underline-none">Rezervari</a></li>
                    <?php } ?>
                    <?php if (User::isAdmin()) { ?>
                        <li><a href="/categorii.php" class="text-black underline-none">Categorii</a></li>
                        <li><a href="/sali.php" class="text-black underline-none">Sali</a></li>
                        <li><a href="/utilizatori.php" class="text-black underline-none">Clienti</a></li>
                    <?php } ?>
            </div>

            <?php if (!isset($_SESSION['user']['id'])) { ?>
            <div>
                <a class="btn btn-outline-light" href="/login.php">
                    Login
                </a>
                <a class="btn btn-outline-light" href="/register.php">
                    Creeaza cont
                </a>
            </div>
            <?php } else {?>
                <a class="btn btn-outline-light" href="/database/logout.php">
                    Logout
                </a>
            <?php } ?>
        </div>
    </div>
</header>