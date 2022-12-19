$('.magnific').magnificPopup({
    type:'image',
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
$(window).on("load", function() {
    $grid.masonry();
    $('#loading').addClass('d-none');
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
    $('#loading').addClass('d-none');
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