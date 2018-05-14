<div class="container">
    <div class="row">
        <?php foreach ($highlight as $highlight_item): ?>

            <?php 
                if (!isset($highlight_item['slug'])) {
                    $url =$highlight_item['url'];
                } else {
                    $url = site_url($highlight_item['type'] . '/'. $highlight_item['slug']);
                }

                if (!isset($highlight_item['excerpt'])) {
                    $excerpt = '';
                } else {
                    $excerpt = $highlight_item['excerpt'];
                }

            ?>
            
            <div class="col-3">
                <a href="<?= $url ;?>"><h5><?= $highlight_item['title']; ?></h5></a>
                <p><?= $excerpt ?></p>
                <img src="<?= site_url('assets/images') . str_replace('public:/', '', $highlight_item['path']); ?>" alt="">
            </div>

        <?php endforeach; ?>
    
    </div>

    <div class="row">
        <div class="col-md-4">
            <a class="twitter-timeline" href="https://twitter.com/fundacionmuseos?ref_src=twsrc%5Etfw"  data-width="300"  data-height="300">Tweets by fundacionmuseos</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div class="col-md-8">
            <div id="map" style="height: 400px; width: 800px"></div>
                <script>
                  function initMap() {
                    var uluru = {lat: 10.5013898, lng: -66.9022893};
                    var map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 17,
                      center: uluru
                    });
                    var marker = new google.maps.Marker({
                      position: uluru,
                      map: map
                    });
                  }
                </script>
                <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCl7z1LBEqlfv45y1lzOeNVjlMgCsDTbnk&callback=initMap">
                </script>
        </div>
    </div>
</div>