<div class="container">
    <h2><?= $diary_item['title']; ?></h2>
    <div class="row">
        <div class="col-12">
            <p><?= $diary_item['description']; ?></p>
        </div>
        <div class="col-12">
            <p>Lugar : <?= $diary_item['e_title']; ?></p>
        </div>
        <?php if (isset($diary_item['path'])): ?>
            <div class="col-12">
                <img src="<?= site_url('assets/images') . str_replace('public:/', '', $diary_item['path']); ?>" alt="">
            </div>
        <?php endif ?>
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <p>Fechas</p>
                </div>
                <?php foreach ($diary_item_fechas as $fecha_agenda): ?>
                
                    <div class="col-3">
                        <p><?= $fecha_agenda['date']; ?></p>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>