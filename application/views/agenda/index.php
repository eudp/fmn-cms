<div class="container">
    <div class="row">
        <div class="col-12"><h2>Agenda</h2></div>

        <?php foreach ($diary as $diary_item): ?>
            
            <div class="col-3">
                <a href="<?= site_url('agenda/'. $diary_item['diary_id']);?>"><?= $diary_item['title']; ?></a>
                <p><?= date('d/m/Y', strtotime($diary_item['date'])); ?></p>
            </div>

        <?php endforeach; ?>
    
    </div>
</div>