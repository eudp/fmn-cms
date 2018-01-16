<div class="container">
    <div class="row">
        <div class="col-12"><h2>Multimedia</h2></div>
        <div class="col-12">
            <h3>Audio</h3>
        </div>
        
        <?php foreach ($multimedia_audio as $multimedia_item): ?>
            
            <div class="col-3">
                
                <a href="<?= site_url('multimedia/'. $multimedia_item['multimedia_id']);?>"><h5><?= $multimedia_item['title']; ?></h5></a>
                <p>Image: <a href="<?= $multimedia_item['path']; ?>"><?= $multimedia_item['path']; ?></a></p>
            </div>

        <?php endforeach; ?>

        <hr>
        
        <div class="col-12">
            <h3>Catálogos y guías</h3>
        </div>
        
        <?php foreach ($multimedia_others as $multimedia_item): ?>
            
            <div class="col-3">
                
                <a href="<?= site_url('multimedia/'. $multimedia_item['multimedia_id']);?>"><h5><?= $multimedia_item['title']; ?></h5></a>
                <p>Image: <a href="<?= $multimedia_item['path']; ?>"><?= $multimedia_item['path']; ?></a></p>
            </div>

        <?php endforeach; ?>
    
    </div>
</div>