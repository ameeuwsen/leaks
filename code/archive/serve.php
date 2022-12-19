<?php
// Include header.
require 'header.php';
// Get meta data
$directory = $_GET['i'];
$config = spyc_load_file($directory.'/inf.yml');
?>
<div class="row pt-3">
    <div class="col-6">
        <a class="btn btn-custom-2" href="/of.php"><-- back to list</a>
    </div>
    <div class="col-6 text-end">
        <button id="compact" class="btn btn-custom-2 compact">-</button>
        <button id="comfort" class="btn btn-custom-2 comfort d-none">+</button>
    </div>
</div>
<div class="row">
<div class="col-12 text-center mt-3">
  <h2><?php echo $config['profile']; ?> </h2>
  <a class="btn btn-custom-2" href="https://onlyfans.com/<?php echo $config['profile']; ?>">OnlyFans</a>
    <?php
    $size = round(filesize($settings['vault'] . '/' . $config['zip'] . '.zip')  / 1024 / 1024 / 1024, 1);
    ?>
<!--      <a class="btn btn-primary" href="--><?php //echo $settings['vault'].'/'.$config['zip'];?><!--.zip">Full Download --><?php //echo $size ?><!-- GB</a>-->
<!--  --><?php //foreach ($config['tags'] as $tag) {
//    echo '<a class="btn btn-custom-1 ms-1" href="#">'.$tag.'</a>';
//  }
//  ?>
</div>
</div>
<div class="row mt-2">
    <div class="col-6">
        <button id="photo-tab" class="btn btn-custom-1">Photos</button>
    </div>
    <div class="col-6">
        <button id="video-tab" class="btn btn-custom-1">Video</button>
    </div>
</div>
<div class="row pager-top text-center">
    <div class="col-12">
        <?php
        $current_page = $_GET['page'];
        if (!empty($current_page) && $current_page > 0) {
            echo '<a class="btn btn-custom-2 me-1" href="serve.php?i='.$directory.'&page='.($current_page - 1).'"> < </a>';
        }
        echo '<span class="btn btn-custom-2">'.($current_page + 1).'</span>';
        if(empty($current_page)) {
            echo '<a class="btn btn-custom-2 ms-1" href="serve.php?i='.$directory.'&page=1"> > </a>';
        } elseif(!empty($current_page)) {
            echo '<a class="btn btn-custom-2 ms-1" href="serve.php?i='.$directory.'&page='.($current_page + 1).'"> > </a>';
        }
        ?>
    </div>
</div>
<div class="row video-grid d-none">
    <?php
    $vids = glob($directory . "/vid/*.{mp4}", GLOB_BRACE);

//    print("<pre>".print_r($vids,true)."</pre>");
    foreach($vids as $vid) {
        echo '<div class="col-12">';
        echo '<video controls>';
        echo '<source src="/'.$vid.'" type="video/mp4">';
        echo '<video controls>';
        echo '</div>';
    }
    ?>
</div>
<div class="row mt-2 previews-grid">
  <?php
  $originals = glob($directory . "/org/*", GLOB_BRACE);
  $items = [];
  //      print("<pre>".print_r($items,true)."</pre>");

  foreach($originals as $id => $file) {
      $items[$id] = [
          'path' => $file,
          'filesize' => filesize($file)
      ];
  }

  if($config['sort'] == 'path') {
      usort($items, function ($a, $b) {
          return $b['path'] <=> $a['path'];
      });
  } else {
      usort($items, function ($a, $b) {
          return $b['filesize'] <=> $a['filesize'];
      });
  }


  //Pager logic
  $current_page = $_GET['page'];
  $next_page = '';
  $previous_page = '';
  $perpage = 50;
  $items = array_slice($items,$current_page * $perpage,$perpage);


  foreach($items as $image) {
    echo '<div class="col-6 col-md-4 col-lg-3 col-xl-2 px-0 gx-1 preview-item">';
    echo '<a href="/'.$image['path'].'" class="magnific">';
    echo '<div class="card">';
    echo '<img src="'.$directory.'/prev/'.explode('.', explode('/', $image['path'])[3])[0].'.webp'.'" />';
    echo '</div>';
    echo '</a>';
    echo '</div>';
  }
  ?>
</div>
<script>
    $('.magnific').magnificPopup({
        type:'image',
        gallery: {
            enabled: true, // set to true to enable gallery
            preload: [0,2], // read about this option in next Lazy-loading section
            navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button
            tPrev: 'Previous (Left arrow key)', // title for left button
            tNext: 'Next (Right arrow key)', // title for right button
            tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
        }
    });
    var $grid = $('.previews-grid').masonry({
        // options
        itemSelector: '.preview-item',
        initLayout: false
    });
    $(window).on("load", function() {
        $grid.masonry();
    });

    $('#comfort').click(function () {
        $('#loading').removeClass('d-none');
        $('.preview-item')
            .removeClass('col-4')
            .removeClass('col-md-3')
            .removeClass('col-lg-2')
            .removeClass('col-xl-1')
            .addClass('col-6')
            .addClass('col-md-4')
            .addClass('col-lg-3')
            .addClass('col-xl-2');
        $grid.masonry();
        $('#comfort').addClass('d-none');
        $('#compact').removeClass('d-none');
        $('#loading').addClass('d-none');
    });
    $('#compact').click(function () {
        $('#loading').removeClass('d-none');
        $('.preview-item')
            .removeClass('col-6')
            .removeClass('col-md-4')
            .removeClass('col-lg-3')
            .removeClass('col-xl-2')
            .addClass('col-4')
            .addClass('col-md-3')
            .addClass('col-lg-2')
            .addClass('col-xl-1')
        $grid.masonry();
        $('#compact').addClass('d-none');
        $('#comfort').removeClass('d-none');
        $('#loading').addClass('d-none');;
    });
    $('#photo-tab').click(function () {
        $('.video-grid').addClass('d-none');
        $('.previews-grid').removeClass('d-none');
        $grid.masonry();
    });
    $('#video-tab').click(function () {
        $('.video-grid').removeClass('d-none');
        $('.previews-grid').addClass('d-none');
        $grid.masonry();
    });
    var videos = document.querySelectorAll('video');
    for(var i=0; i<videos.length; i++)
        videos[i].addEventListener('play', function(){pauseAll(this)}, true);


    function pauseAll(elem){
        for(var i=0; i<videos.length; i++){
            //Is this the one we want to play?
            if(videos[i] == elem) continue;
            //Have we already played it && is it already paused?
            if(videos[i].played.length > 0 && !videos[i].paused){
                // Then pause it now
                videos[i].pause();
            }
        }
    }
</script>
<?php
// Include header.
require 'footer.php';
?>
