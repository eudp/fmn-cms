<div class="container">
    
    <div class="row">
        <div class="col-6">
            <img src="<?= site_url('assets/images') . $multimedia_item['path']; ?>" alt="">
        </div>
        <div class="col-6">
            <h2><?= $multimedia_item['title']; ?></h2>
            <p><?= $multimedia_item['description']; ?></p>

            <?php if (isset($multimedia_item['multimedia_path'])): ?>

                <p>Click para descargar:</p>

                <a href="<?= $multimedia_item['multimedia_path']; ?>"><?= $multimedia_item['file_name']; ?></a>

            <?php endif; ?>


        </div>
    </div>
</div>