<div class="container">
    <div class="row">
        <div class="col-12"><h2>Colecciones</h2></div>

    <?php foreach ($collections as $collection_item): ?>
        
        <div class="col-3">
            <a href="<?= site_url('colecciones/'. $collection_item['collection_id']);?>"><h3><?= $collection_item['title']; ?></h2></a>
            <p>Image: <a href="<?= $collection_item['path']; ?>"><?= $collection_item['path']; ?></a></p>
        </div>

    <?php endforeach; ?>
    
    </div>
</div>