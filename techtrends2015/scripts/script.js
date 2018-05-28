$(document).ready(function(){
    function adjustMask(){
            $('.nav-mask').width($('.container').offset().left);
    }

    function fixDrawerHeight(){
            var article = $('li.active article');
            var extra = $(article).parent().find('.extra');
            var total_height = article.outerHeight(true) + $(extra).height();
            $(article).parent().css({'height': total_height}).addClass('active');
    }

    var isTouch = ($('html').hasClass('touch') ? true : false);
    
    /**
         * Top Navigation
         */
        var $nav, $friedolin, $menu, breakpoint, viewport, mobile_breakpoint;
        $nav = $("nav.main");
        $friedolin = $nav.find(".logo");
        $menu = $nav.find(".menu");

        viewport = $(window).width();
        previous_viewport = 0;
        breakpoint = 1025;
        mobile_breakpoint = 480;


        var list_item_line_height = 40;

        evalWindowSize();

        $(window).resize(function(e){
            adjustMask();
            evalWindowSize();
            fixDrawerHeight();
            if ($('.clock').length > 0) {
                drawClocks();
            }
            if ($('.projects').length > 0) {
                $('.projects li:not(.active)').each(function(){
                    $(this).removeAttr('style');
                });
            }
        });

        $(window).scroll(function () {
            //Desktop
            if (!isTouch) {

                // Skirt- Teaser
                $('.skirt').hover(
                    function () {
                        $(this).find('.info').stop(true, false).show();
                    }, function () {
                        $(this).find('.info').stop(true, false).hide();
                    }
                );
            
                if ($(document).scrollTop() > 80) {
                    if (!$menu.hasClass('closed') && !hovering) {
                        closeNav(true);
                    }
                } else {
                    if ($menu.hasClass('closed') && viewport > breakpoint) {
                        openNav(true);
                    }
                }

                //Case Study - New Business Form
                if ($('#block-frogweb-2').length > 0) {

                    if(isScrolledIntoView('.node-work header, .node-industry header,.node-static-page header')){
                        $('.contact').addClass('inview');
                    } else if($('.contact').hasClass('inview')){
                        $('.contact').removeClass('inview');
                    }

                    if (($(window).scrollTop()+$(window).height()) >= $('#block-frogweb-2').offset().top) {
                        $('.contact').addClass('lock');
                    } else {
                        $('.contact').removeClass('lock');
                    }
                }
            }
        });

        $menu.bind('inview', function (event, visible) {
            if (visible == false && isTouch) {
                if (!$menu.hasClass('closed')) {
                    closeNav(true);
                }
            }
        });

        // expand and collapse secondary nav
        $menu.find("i").each(function(e){
            $(this).on("click",function(e){
                toggleSubMenu($(this));
            });
        });

        // evaluate friedolin events
        $friedolin.on("click",function(e){
            if(isTouch){
                pde(e);
                if($menu.hasClass('active')){
                    closeNav(true);
                } else {
                    openNav(true);
                }
            }
        });

        //Menu Enter
        var hovering = false;
        $nav.children(".wrapper").on("mouseenter",function(e){
            if(!isTouch){
                hovering = true;
                openNav(true);
            }
        });

        //Menu Exit
        $nav.children(".wrapper").on("mouseleave",function(e){
            hovering = false;
            setTimeout(function(){
                if(!hovering){
                    if(viewport < breakpoint){
                        closeNav(true);
                    } else {
                        if ($(document).scrollTop() > 80) closeNav(true);
                    }
                }
            },1500);
        });

        function toggleSubMenu(subMenu){
            $menu.children("li.active").not(subMenu.parent()).removeClass("active").find("ul").slideToggle();
            subMenu.parent().toggleClass("active");
            subMenu.parent().find("ul").slideToggle();
        }

        function evalWindowSize(){
            viewport = $(window).width();
            if(viewport >= breakpoint && previous_viewport < breakpoint){
                $nav.addClass("desktop");
                repositionNav();
            }
            if(viewport < breakpoint && previous_viewport >= breakpoint){
                $nav.removeClass("desktop");
                repositionNav();
            }
            if(viewport < mobile_breakpoint && previous_viewport >= mobile_breakpoint){
                repositionNav();
            }
            previous_viewport = viewport;
        }

        function openNav(animate){
            if($nav.hasClass("desktop")){
                if (!$menu.hasClass('animating')) {
                    if(animate){
                        $menu.show();
                        $menu.addClass('animating').animate({left:"80px"},250,function(e){
                            $menu.removeClass("active, animating"); }
                        );
                    } else {
                        $menu.css("left","80px").show().addClass("active");
                    }
                }
            } else {
                if(animate){
                    $menu.slideDown(250,function(e){
                        $(this).is(":visible") ? $(this).addClass('active') : $(this).removeClass("active");
                    });
                } else {
                    $menu.show();
                }
            }
            $menu.removeClass('closed');
        }

        function closeNav(animate){
            if($nav.hasClass("desktop")){
                if(animate){
                    $menu.addClass('animating').animate({left:"-500px"},250,function(e){$menu.hide().removeClass("active, animating")});
                }else{
                    $menu.css("left","-500px").hide().removeClass("active");
                }
            } else {
                if(animate){
                    $menu.slideUp(250,function(e){
                        $(this).is(":visible") ? $(this).addClass('active') : $(this).removeClass("active");
                    });
                } else {
                    $menu.toggle().removeClass("active");
                }
            }
            $menu.addClass('closed');
            toggleSubMenu($menu.find('li.active a'));
        }

        function repositionNav(){
            var left = "80px";
            var top = "0px";
            if(viewport >= breakpoint){
                // desktop
            }
            if(viewport <= breakpoint && viewport >= mobile_breakpoint){
                left = "80px";
                top = "0px";
            }else if(viewport < mobile_breakpoint){
                left = "0px";
                top = "80px";
            }
            $menu.css("left",left).css("top",top);
        }

        //Function to prevent Default Events
        function pde(e){
            var evt = e || window.event; // IE compatibility

            if(e.preventDefault){
                evt.preventDefault();
            } else{
                evt.returnValue = false;
                evt.cancelBubble = true;
            }
        }

        function getUrlVars(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }

        if(isTouch){
            $('input, textarea').on('focus', function(){
                $('header#navbar').css({position:'absolute'})
            });

            $('input, textarea').on('blur', function(){
                $('header#navbar').css({position:'fixed'})
            });

            $('.img-shape').click(function(e){
                pde(e);
            });
        }

        //end of nav
    jQuery.cachedScript = function( url, options ) {
        options = $.extend( options || {}, {
            dataType: "script",
            cache: true,
            url: url
        });
        return jQuery.ajax( options );
    };
    
    //$.cachedScript("//platform.twitter.com/widgets.js");
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