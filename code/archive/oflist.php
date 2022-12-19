<?php
// Include header.
require 'header.php';
?>

<!--<div class="row pt-3">-->
<!--    <div class="col-12">-->
<!--        <h1>OnlyFans</h1>-->
<!--    </div>-->
<!--</div>-->
</div>
<div class="container-fluid pt-4">
<div class="row gx-md-2">
    <?php
    $parent = 'tocvxoiys3l7xr8z1jimulnnvknq9ykxgzyhs8pgds2iipzzckl';
    $dirs = glob($parent.'/*', GLOB_ONLYDIR);
    usort( $dirs, function( $a, $b ) { return filemtime($b) - filemtime($a); } );
    foreach($dirs as $dir) {
    $sub = explode('/', $dir)[1];
    $config = spyc_load_file($dir.'/inf.yml');
    $images = glob($dir.'/org/*');
//    shuffle($config['previews']);
    echo '<div class="col-6 col-md-6 col-lg-4 col-xl-3 pt-1 pb-4 mb-2 text-center">';
    echo '<h2><a href="serve.php?i='.$dir.'">'.$config['profile'].'</a></h2>';
    echo '<p class="stats"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
  <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
</svg>'.count($images).'</p>';
    foreach ($config['tags'] as $tag) {
        echo '<a class="btn btn-custom-1 ms-1" href="#">'.$tag.'</a>';
    }
    echo '<div class="row my-3">';
    echo '<div class="col-12 px-0">';
    echo '<a href="serve.php?i='.$dir.'">';
    echo '<img class="img-fluid" src="'.$parent.'/'.$sub.'/org/'.$config['previews'][0].'" loading="lazy" />';
    echo '</div>';
//    echo '<div class="col-4 d-none">';
//    echo '<img class="img-fluid" src="'.$parent.'/'.$sub.'/org/'.$config['previews'][1].'" loading="lazy" />';
//    echo '</div>';
//    echo '<div class="col-4 d-none">';
//    echo '<img class="img-fluid" src="'.$parent.'/'.$sub.'/org/'.$config['previews'][2].'" loading="lazy" />';
//    echo '</div>';
    echo '</a>';
    echo '</div>';
    echo '</div>';
    }
    ?>
    </div>

<?php
// Include footer.
require 'footer.php';
?>

