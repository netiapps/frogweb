jQuery(document).ready(function(){
    jQuery(".open-popup").fullScreenPopup();

    jQuery('a[href="#popup-800-show"]').click(function(){
        jQuery(".fsp-wrapper").addClass('800-show');
    });

    jQuery('a[href="#popup-subway"]').click(function(){
        jQuery(".fsp-wrapper").addClass('subway');
    });

    jQuery('a[href="#popup-bus-stop"]').click(function(){
        jQuery(".fsp-wrapper").addClass('bus-stop');
    });

    jQuery('a[href="#popup-statue"]').click(function(){
        jQuery(".fsp-wrapper").addClass('statue');
    });

    jQuery('a[href="#popup-barrier"]').click(function(){
        jQuery(".fsp-wrapper").addClass('barrier');
    });

    jQuery('a[href="#popup-building6"]').click(function(){
        jQuery(".fsp-wrapper").addClass('building6');
    });

    jQuery('a[href="#popup-level3"]').click(function(){
        jQuery(".fsp-wrapper").addClass('level3');
    });

    jQuery('a[href="#popup-success"]').click(function(){
        jQuery(".fsp-wrapper").addClass('success');
    });

});

