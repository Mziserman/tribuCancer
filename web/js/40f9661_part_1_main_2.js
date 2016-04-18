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
