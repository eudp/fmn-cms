<div class="container">
    <h2><?= $establishment_item['title']; ?></h2>
    <div class="row">
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <h4>Horario</h4>
                    <p><?= $establishment_item['schedule']?></p>
                </div>
                <div class="col-12">
                    <h4>Dirección</h4>
                    <p><?= $establishment_item['address']?></p>
                </div>
                <div class="col-12">
                    <h4>Teléfono</h4>
                    <p><?= $establishment_item['phone']?></p>
                    <br>
                    <?php echo (isset($establishment_item['facebook_url']) ? '<p>' . $establishment_item['facebook_url'] . '</p>' : ''); ?>
                    <?php echo (isset($establishment_item['twitter_url']) ? '<p>' . $establishment_item['twitter_url'] . '</p>' : ''); ?>
                    <?php echo (isset($establishment_item['site_url']) ? '<p>' . $establishment_item['site_url'] . '</p>' : ''); ?>
                    <?php echo (isset($establishment_item['email']) ? '<p>' . $establishment_item['email'] . '</p>' : ''); ?>
                </div>
                <div class="col-12">
                    <h4>Servicios</h4>
                    <?= $establishment_item['services']?>
                </div>
            </div>
        </div>

        <div class="col-4">
            <?php var_dump($establishment_carousel);?>
        </div>
        <div class="col-4">
            <h3><?= $establishment_item['acronym']?></h3>
            <h2><?= $establishment_item['title']?></h2>

            <p><?= $establishment_item['description']?></p>

        </div>
    
    </div>
</div>