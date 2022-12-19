<?php
// Include header.
require 'header.php';
// Get meta data
$dump = $_GET['i'];
$config = spyc_load_file('of/'.$dump.'.yml');
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
    </div>
</div>
<div class="row pager-top text-center">
    <div class="col-12">
        <?php
        $items = $config['images'];

        if (isset($config['reverse'])) {
            $items = array_reverse($items);
        }

        //Pager logic
        $current_page = $_GET['page'];
        $next_page = '';
        $previous_page = '';
        $perpage = 200;
        $items = array_slice($items,$current_page * $perpage,$perpage);

        $current_page = $_GET['page'];

        if (isset($current_page) && $current_page > 0) {
            $previous_page = '<a class="btn btn-custom-2 me-1" href="ofserve.php?i='.$dump.'&page='.($current_page - 1).'"> < </a>';
        }

        if(empty($current_page) && count($items) > $perpage - 1) {
            $next_page = '<a class="btn btn-custom-2 ms-1" href="ofserve.php?i='.$dump.'&page=1"> > </a>';
        } elseif(!empty($current_page  && count($items) > $perpage - 1)) {
            $next_page = '<a class="btn btn-custom-2 ms-1" href="ofserve.php?i='.$dump.'&page='.($current_page + 1).'"> > </a>';
        }

        echo $previous_page;
        echo '<span class="btn btn-custom-2">'.($current_page + 1).'</span>';
        echo $next_page;
        ?>
    </div>
</div>
<div class="row mt-2 previews-grid">
    <?php

    foreach($items as $link) {
        echo '<div class="col-6 col-md-4 col-lg-3 px-0 gx-1 preview-item">';
        echo '<a class="magnific" href="'.$link.'">';
        echo '<div class="card">';
        echo '<img src="'.explode('.jpg', $link)[0].'.md.jpg'.'" />';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
    ?>
</div>
<div class="row pager-bottom text-center">
    <div class="col-12">
        <?php
        echo $previous_page;
        echo '<span class="btn btn-custom-2">'.($current_page + 1).'</span>';
        echo $next_page;
        ?>
    </div>
</div>
<script src="assets/serve.js">
<?php
// Include header.
require 'footer.php';
?>
