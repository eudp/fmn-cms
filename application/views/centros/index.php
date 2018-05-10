<div class="container">
    <div class="row">
        <div class="col-12"><h2>Centros</h2></div>

        <?php foreach ($establishments as $establishment_item): ?>
            
            <div class="col-3">
                <h3><?= $establishment_item['acronym']; ?></h3>
                <a href="<?= site_url('centros/'. $establishment_item['slug']);?>"><?= $establishment_item['title']; ?></a>
                
                <img src="<?= site_url('assets/images') . str_replace('public:/', '', $establishment_item['path']); ?>" alt="">
            </div>

        <?php endforeach; ?>
    
    </div>
</div>