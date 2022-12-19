
<div class="row mt-2">
    <div class="col-6">
        <button id="photo-tab" class="btn btn-custom-1">Photos</button>
    </div>
    <div class="col-6">
        <button id="video-tab" class="btn btn-custom-1">Video</button>
    </div>
</div>

<div class="row video-grid d-none">
    <?php
    foreach($config['videos'] as $vid) {
        echo '<div class="col-4 col-lg-3 col-xl-2">';
        echo '<video controls>';
        echo '<source src="'.$vid.'" type="video/mp4">';
        echo '<video controls>';
        echo '</div>';
    }
    ?>
</div>