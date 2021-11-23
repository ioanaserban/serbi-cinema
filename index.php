<?php include 'assets/views/app.php'; ?>
<div class="container">
    <h1>Pagina index</h1>

    <?php dump($dbManipulator->getCategories()); ?>
</div>
<?php include 'assets/views/footer.php'; ?>
