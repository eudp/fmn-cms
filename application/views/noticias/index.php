<div class="container">
    <div class="row">
        <div class="col-12"><h2>Noticias</h2></div>

        <?php foreach ($news as $news_item): ?>
            
            <div class="col-3">
                <span><?= date('j \d\e F, Y', $news_item['publication_date']); ?></span>
                <a href="<?= site_url('noticias/'. $news_item['news_id']);?>"><h3><?= $news_item['title']; ?></h3></a>
                <p><?= $news_item['excerpt']?></p>
                <p>Image: <a href="<?= $news_item['path']; ?>"><?= $news_item['path']; ?></a></p>
            </div>

        <?php endforeach; ?>
    
    </div>
</div>