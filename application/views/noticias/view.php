<div class="container">
    <div class="row">
        <div class="col-6">
            <img src="<?= site_url('assets/images') . $news_item['path']; ?>" alt="">
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <span><?= $news_item['publication_date']; ?></span>
                    <h2><?= $news_item['title']; ?></h2>
                    <p><?= $news_item['description']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <?php foreach ($photo_gallery as $photo_gallery_item): ?>
            
                    <div class="col-3">
                        <img src="<?= site_url('assets/images') . str_replace('public:/', '', $photo_gallery_item['path']); ?>" alt="">
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>