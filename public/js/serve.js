$(document).ready(function() {
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
        $('.held').each(function () {
            $(this).attr('src', $(this)
                .attr('data-src'))
                .removeClass('d-none');
        });
        setTimeout(function(){
            $('.held').each(function () {
              $(this).attr('loading', '')
            });
            console.log("killing loader")
            $('#loading').addClass('d-none');
        },5000);
        // setInterval(function(){
        //     $grid.masonry();
        //     $('#loading').addClass('d-none');
        // }, 4000);
    });

    $('.previews-grid').imagesLoaded().done( function() {
        console.log("waiting images loaded")
        $('#loading').addClass('d-none');
        $grid.masonry();
    });

    $('.held').scroll(function () {
        $grid.masonry();
        console.log("kick off masonry!");
    })

    // Size adjusters
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

    // $('#reverse').click(function () {
    //     if($.cookie('reverse') == 'true') {
    //         $.cookie('reverse', 'false');
    //     } else {
    //         $.cookie('reverse', 'true');
    //     }
    //     location.reload();
    // });

    $('#shuffle').click(function () {
        if($.cookie('shuffle') == 'true') {
            $.cookie('shuffle', 'false');
        } else {
            $.cookie('shuffle', 'true');
        }
        location.reload();
    });
});