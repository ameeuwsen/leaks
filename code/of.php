<?php
// Include header.
require 'header.php';

//Setup page variables
$dumps = glob('of/*.yml', GLOB_BRACE);
usort( $dumps, function( $a, $b ) { return filemtime($b) - filemtime($a); } );
?>
</div>

<div class="container-fluid p-0 pt-4">
    <div class="row gx-md-2">
        <?php
        foreach($dumps as $dump) {
            $config = spyc_load_file($dump);
            $serve = explode('.', explode('/', $dump)[1])[0];
            echo '<div class="col-12 col-md-6 col-lg-4 col-xl-3 pt-1 mb-2 text-center">';
            echo '<h2><a href="ofserve.php?i='.$serve.'">'.$config['profile'].'</a></h2>';
            echo '<p class="stats"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
  <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
</svg>'.count($config['images']).'</p>';
            foreach ($config['tags'] as $tag) {
                echo '<div class="btn btn-custom-1 ms-1">'.$tag.'</div>';
            }

            // Portrait Preview Builder
            $pvalue = $config['previews']['portrait'];
            if(is_array($pvalue)) {
                $preview = $pvalue[array_rand($config['previews']['portrait'], 1)];
            } else {
                $preview = $pvalue;
            }

            // Build preview tile
            echo '<div class="row">';
            echo '<a href="ofserve.php?i='.$serve.'">';
            echo '<div class="col-12 px-0 my-2 teaser preview-portrait" style="background-image:url(\''.$preview.'\');">';
            echo '</div>';
            echo '<div class="col-12 px-0 my-2 teaser preview-landscape" style="background-image:url(\''.$config['previews']['landscape'].'\');">';
            echo '</div>';
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

