<div class="container">
    <div class="row">
        <div class="col-12"><h2>Museos</h2></div>

    <?php foreach ($establishments as $establishment_item): ?>

        <div class="col-3">
            <h3><?= $establishment_item['acronym']; ?></h2>
            <p><?= $establishment_item['title']; ?></p>
            <p>Link pic: <a href="<?= $establishment_item['path']; ?>"><?= $establishment_item['path']; ?></a></p>
        </div>

    <?php endforeach; ?>
    
    </div>
</div>