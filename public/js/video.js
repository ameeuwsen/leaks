$(document).ready(function() {
    $('.magnific').magnificPopup({
        type:'iframe',
        gallery: {
            enabled: true, // set to true to enable gallery
            preload: [0,5], // read about this option in next Lazy-loading section
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

    $grid.masonry();
});