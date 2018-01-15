<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <?php var_dump($exposition_carousel); ?>
                </div>
                <div class="col-12">
                    <h3><?= $exposition_item['title']; ?></h3>
                    <br>
                    <p><?= $exposition_item['description']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <h4>Museo</h4>
                    <p><?= $exposition_item['title_m']; ?></p>
                </div>
                <div class="col-12">
                    <h4>Lugar de exhibición</h4>
                    <p><?= $exposition_item['exhibition_place']; ?></p>
                </div>
                <div class="col-12">
                    <h4>Dirección</h4>
                    <p><?= $exposition_item['address']; ?></p>
                </div>
                <div class="col-12">
                    <h4>Horario</h4>
                    <p><?= $exposition_item['schedule']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>