/* VARS */

var nav = $('header'),
    navLink = $('header li a'),
    serviceSwitcher = $('.services-switch'),
    serviceSwicherLink = $('.services-switch a'),
    service = $('.service-activity');


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

console.log('hi')

var Lightbox = function() {

    this.gallery = $('.gallery');
    this.item = $('.gallery-item');

    this.bind();
}

Lightbox.prototype.bind = function() {

    console.log('cc')
        
    this.item.on('click', $.proxy(this.openImage, this));
};

Lightbox.prototype.openImage = function(e) {
    e.preventDefault();

    console.log('hi there')
};