<div class="container">
    <div class="row">
        <div class="col-6">
            <p>Imagen: <?= $news_item['path']; ?></p>
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
    </div>
</div>