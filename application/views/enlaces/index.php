<div class="container">
    <div class="row">
        <div class="col-12"><h2>Enlaces</h2></div>

        <?php foreach ($links as $link_item): ?>
            
            <div class="col-12">
                <a href="<?= $link_item['url'];?>"><?= $link_item['title']; ?></a>
                
                <img src="<?= site_url('assets/images') . str_replace('public:/', '', $link_item['path']); ?>" alt="">
            </div>

        <?php endforeach; ?>
    
    </div>
</div>