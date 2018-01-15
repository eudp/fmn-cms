<div class="container">
    <div class="row">
        <div class="col-12"><h2>Centros</h2></div>

    <?php foreach ($establishments as $establishment_item): ?>
        
        <div class="col-3">
            <h3><?= $establishment_item['acronym']; ?></h2>
            <a href="<?= site_url('centros/'. $establishment_item['establishment_id']);?>"><?= $establishment_item['title']; ?></a>
            <p>Image: <a href="<?= $establishment_item['path']; ?>"><?= $establishment_item['path']; ?></a></p>
        </div>

    <?php endforeach; ?>
    
    </div>
</div>