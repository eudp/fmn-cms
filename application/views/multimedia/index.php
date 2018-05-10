<div class="container">
    <div class="row">
        <div class="col-12"><h2>Multimedia</h2></div>
        <div class="col-12">
            <h3>Audio</h3>
        </div>
        
        <?php foreach ($multimedia_audio as $multimedia_item): ?>
            
            <div class="col-3">
                
                <a href="<?= site_url('multimedia/'. $multimedia_item['slug']);?>"><h5><?= $multimedia_item['title']; ?></h5></a>
                <img src="<?= site_url('assets/images') . str_replace('public:/', '', $multimedia_item['path']); ?>" alt="">
            </div>

        <?php endforeach; ?>

        <hr>
        
        <div class="col-12">
            <h3>Catálogos y guías</h3>
        </div>
        
        <?php foreach ($multimedia_others as $multimedia_item): ?>
            
            <div class="col-3">
                
                <a href="<?= site_url('multimedia/'. $multimedia_item['slug']);?>"><h5><?= $multimedia_item['title']; ?></h5></a>
                <img src="<?= site_url('assets/images') . str_replace('public:/', '', $multimedia_item['path']); ?>" alt="">
            </div>

        <?php endforeach; ?>
    
    </div>
</div>