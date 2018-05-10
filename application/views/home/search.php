<div class="container">
    <h3>Búsqueda</h3>
    <div class="row">
        <div class="col-12"><h5>Noticias</h5></div>
        <?php foreach ($news as $news_item): ?>
            
            <div class="col-3">
                <span><?= date('j \d\e F, Y', $news_item['publication_date']); ?></span>
                <a href="<?= site_url('noticias/'. $news_item['slug']);?>"><h5><?= $news_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
    <div class="row">
        <div class="col-12"><h5>Noticias Museos</h5></div>
        <?php foreach ($news_museums as $news_item): ?>
            
            <div class="col-3">
                <span><?= date('j \d\e F, Y', $news_item['publication_date']); ?></span>
                <a href="<?= site_url('noticias-museos/'. $news_item['slug']);?>"><h5><?= $news_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
    <div class="row">
        <div class="col-12"><h5>Multimedia</h5></div>
        <?php foreach ($multimedia as $multimedia_item): ?>
            
            <div class="col-3">
                <span><?= date('j \d\e F, Y', $multimedia_item['creation_date']); ?></span>
                <a href="<?= site_url('multimedia/'. $multimedia_item['slug']);?>"><h5><?= $multimedia_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
    <div class="row">
        <div class="col-12"><h5>Multimedia Museos</h5></div>
        <?php foreach ($multimedia_museums as $multimedia_item): ?>
            
            <div class="col-3">
                <span><?= date('j \d\e F, Y', $multimedia_item['creation_date']); ?> - <?= domain_museum($multimedia_item['museums']) ?></span>
                <a href="<?= site_url('multimedia-museos/'. $multimedia_item['slug']);?>"><h5><?= $multimedia_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
    <div class="row">
        <div class="col-12"><h5>Agenda</h5></div>
        <?php foreach ($diary as $diary_item): ?>
            
            <div class="col-3">
                <!-- <span><?= date('j \d\e F, Y', $diary_item['publication_date']); ?></span> -->
                <a href="<?= site_url('agenda/'. $diary_item['slug']);?>"><h5><?= $diary_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
    <div class="row">
        <div class="col-12"><h5>Agenda Museos</h5></div>
        <?php foreach ($diary_museums as $diary_item): ?>
            
            <div class="col-3">
                <!-- <span><?= date('j \d\e F, Y', $diary_item['publication_date']); ?> - <?= domain_museum($diary_item['museums']) ?></span> -->
                <a href="<?= site_url('agenda-museos/'. $diary_item['slug']);?>"><h5><?= $diary_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
    <div class="row">
        <div class="col-12"><h5>Exposiciones</h5></div>
        <?php foreach ($expositions as $expositions_item): ?>
            
            <div class="col-3">
                <span><?= date('j \d\e F, Y', $expositions_item['creation_date']); ?></span>
                <a href="<?= site_url('exposiciones/'. $expositions_item['slug']);?>"><h5><?= $expositions_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
    <div class="row">
        <div class="col-12"><h5>Exposiciones Museos</h5></div>
        <?php foreach ($expositions_museums as $expositions_item): ?>
            
            <div class="col-3">
                <span><?= date('j \d\e F, Y', $expositions_item['creation_date']); ?> - <?= domain_museum($expositions_item['museums']) ?></span>
                <a href="<?= site_url('exposiciones-museos/'. $expositions_item['slug']);?>"><h5><?= $expositions_item['title']; ?></h5></a>
            </div>

        <?php endforeach; ?>
    
    </div>
</div>