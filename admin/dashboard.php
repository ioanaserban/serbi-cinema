<?php

include __DIR__ . '/../middleware/admin.php';
include __DIR__.'/../assets/views/app.php';

?>
<div class="container">
    <h1>Pagina dashboard</h1>

    <?php dump($dbManipulator->getCategories()); ?>
</div>
<?php include __DIR__.'/../assets/views/footer.php'; ?>
