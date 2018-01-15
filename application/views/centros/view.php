<div class="container">
    <h2><?= $establishment_item['title']; ?></h2>
    <div class="row">
        <div class="col-4">
            <p><?= $establishment_item['description']?></p>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <?php var_dump($establishment_carousel);?>
                </div>
                <div class="col-3">
                    <h4>Horario</h4>
                    <p><?= $establishment_item['schedule']?></p>
                </div>
                <div class="col-3">
                    <h4>Dirección</h4>
                    <p><?= $establishment_item['address']?></p>
                </div>
                <div class="col-3">
                    <h4>Servicios</h4>
                    <?php echo (isset($establishment_item['services']) ? '<p>' . $establishment_item['services'] . '</p>' : ''); ?>
                </div>
                <div class="col-3">
                    <h4>Contactos</h4>
                    
                    <?php echo (isset($establishment_item['phone']) ? '<p>' . $establishment_item['phone'] . '</p>' : ''); ?>

                    <?php echo (isset($establishment_item['facebook_url']) ? '<p>' . $establishment_item['facebook_url'] . '</p>' : ''); ?>

                    <?php echo (isset($establishment_item['twitter_url']) ? '<p>' . $establishment_item['twitter_url'] . '</p>' : ''); ?>

                    <?php echo (isset($establishment_item['site_url']) ? '<p>' . $establishment_item['site_url'] . '</p>' : ''); ?>

                    <?php echo (isset($establishment_item['email']) ? '<p>' . $establishment_item['email'] . '</p>' : ''); ?>
                </div>
            </div>
        </div>
    </div>
</div>