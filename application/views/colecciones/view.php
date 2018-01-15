<div class="container">
    <h2><?= $collection_item['title']; ?></h2>
    <div class="row">
        <div class="col-4">
            <p><?= $collection_item['description']?></p>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <?php var_dump($collection_carousel);?>
                </div>

                <?php foreach ($collection_works as $work_item): ?>
                    
                    <div class="col-3">
                        <h5><?= $work_item['title']; ?></h5>
                        <p><?= $work_item['description']; ?></p>
                        <p>Image: <a href="<?= $work_item['path']; ?>"><?= $work_item['path']; ?></a></p>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>