<div class="container">
    <div class="row">
        <div class="col-12"><h2>Exposiciones</h2></div>
        <div class="col-12">
            <h3>Actuales</h3>
        </div>
        
        <?php foreach ($expositions_active as $exposition_item): ?>
            
            <div class="col-3">
                <h5><?= $exposition_item['title']; ?></h5>
                <p><?= substr(strip_tags($exposition_item['description']),0,200) . ' ...'; ?></p>
                <a href="<?= site_url('exposiciones/'. $exposition_item['exposition_id']);?>">Ver más: </a>
                <p>Image: <a href="<?= $exposition_item['path']; ?>"><?= $exposition_item['path']; ?></a></p>
            </div>

        <?php endforeach; ?>

        <hr>
        
        <div class="col-12">
            <h3>Pasadas</h3>
        </div>
        
        
        <?php foreach ($expositions_inactive as $exposition_item): ?>
            
            <div class="col-3">
                <h5><?= $exposition_item['title']; ?></h5>
                <p><?= substr(strip_tags($exposition_item['description']),0,200) . ' ...'; ?></p>
                <a href="<?= site_url('exposiciones/'. $exposition_item['exposition_id']);?>">Ver más: </a>
                <p>Image: <a href="<?= $exposition_item['path']; ?>"><?= $exposition_item['path']; ?></a></p>
            </div>

        <?php endforeach; ?>
    
    </div>
</div>