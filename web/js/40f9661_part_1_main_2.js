/* VARS */

var nav = $('header'),
    navLink = $('header li a'),
    serviceSwitcher = $('.services-switch'),
    serviceSwicherLink = $('.services-switch a'),
    service = $('.service-activity'),
    shadow = $('.shadow'),
    articleSwitcher = $('.item .wrapper'),
    articleSwitcherLink = $('.news-section-title');


/* Handle menu */



/* END MENU */


/* Handle switch between panels */

    serviceSwicherLink.on('click', function(e)
    {
        e.preventDefault();

        var value = $(this).attr('data-item');

        if(!$(this).hasClass('active'))
        {
            // Remove class active on switcher items
            serviceSwicherLink.removeClass('active');
            // Add the current item switcher as active
            $(this).addClass('active');
            // Remove class for current activity
            service.removeClass('show');
            // Display the selected activity
            $('#item-'+value).addClass('show');
        }
    });

/* END SWITCH PANELS */

/* Handle switch between articles and archives */
    
    articleSwitcherLink.on('click', function(e) {
        e.preventDefault();

        var value = $(this).attr('href');

        if(!$(this).hasClass('active')) {
            articleSwitcherLink.removeClass('active');

            $(this).addClass('active');

            articleSwitcher.removeClass('show');

            $('.wrapper.'+value).addClass('show');
        }

    });

/* End switch */

$('#home-video').on('click', function(e) {
    e.preventDefault();

    var target = $(this).attr('href');

    $('#lightbox').fadeIn();
    $('.lightbox-container img').fadeOut();
    $('.lightbox-container').append('<video controls autoplay><source src="/assets/videos/'+target+'.mp4" type="video/mp4"><source src="/assets/videos/'+target+'.webm" type="video/webm">Votre navigateur ne supporte pas les vidéos</video>');
});


$('.gallery-item').on('click', function(e) {
    e.preventDefault();

    var target = $(this).attr('href');
    
    openLightbox(target);
});


$('#lightbox .close').on('click', function(e) {
    closeLightbox();
});
$('#lightbox').on('mouseup', function(e) {
    var video = $('.lightbox-container video');

    if(!video.is(e.target)) {
        closeLightbox();
    } else {
        video.get(0).paused ? video.get(0).play() : video.get(0).pause()
    }
});
$(window).on('keydown', function(e) {
    if(e.keyCode == "27") {
        closeLightbox();
    }
}); 

function openLightbox(image) {
    var wideImage = $('.lightbox-container img');
    // $('.lightbox').addClass('show');
    $('#lightbox').fadeIn();

    wideImage.attr('src', image);
}

function closeLightbox() {
    $('#lightbox').fadeOut();
    $('.lightbox-container video').remove();
}








