$(document).ready(function(){
    jQuery.cachedScript = function( url, options ) {
        options = $.extend( options || {}, {
            dataType: "script",
            cache: true,
            url: url
        });
        return jQuery.ajax( options );
    };
    
    $.cachedScript("//platform.twitter.com/widgets.js");
    /*    
    var links = $('#nav a');
    $('#nav').localScroll({ hash : true}, 800);
    
    $('#nav a').click(function(){
        links.removeClass('selected');
        $(this).addClass('selected');
    });
    
    var sections = {},
        _height  = $(window).height(),
        i        = 0;

    // Grab positions of our sections 
    $('section').each(function(){
        sections[this.id] = $(this).offset().top;
    });


    $(document).scroll(function(){
        var pos = $(this).scrollTop();
        for(i in sections){
            if(sections[i] > pos && sections[i] < pos + _height){
                links.removeClass('selected');
                $('a[href="#'+i+'"]').addClass('selected');
            }  
        }
    });
    */

    $('.vote a.btn').click(function(){
        var poll = $(this).parents('.vote')
        if(!poll.hasClass('disabled')){
            var trend = $(this).parents('section');
            $.ajax({
                type: "POST",
                url: "index.php",
                data: { trend: trend.attr('data-trend'), vote : $(this).attr('data-vote')},
                dataType: 'json',
                beforeSend : function(){
                    poll.addClass('disabled');                        
                },
                success: function(data){ //23
                    poll.find('li.yes .row span').animate({width: (data.yes-1)+'%', 'border-right' : (data.yes-1 <=0 ? "0px" : 'auto')}, 800, function(){ poll.find('li.yes .label').html(data.yes+'%'); });
                    poll.find('li.no .row span').animate({width: (data.no-1)+'%', 'border-right' : (data.no-1 <=0 ? "0px" : 'auto')}, 800, function(){
                        poll.find('li.no .label').html(data.no+'%');
                        poll.parents('section').find('.social').removeClass('disabled');                                                             
                    });
                    
                }              
            });
        }
    });
    
    $('img[data-src-gif]').bind('inview', function (event, visible) {
        if (visible == true) {
            // element is now visible in the viewport
            $(this).attr('src', $(this).attr('data-src-gif'));
            $(this).unbind('inview');
        }
    });
});