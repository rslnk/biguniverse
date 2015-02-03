jQuery.noConflict();
(function($) {
    $(function() {
        /*** Dropdown menu ***/
        
        var timeout    = 200;
        var closetimer = 0;
        var ddmenuitem = 0;

         $(function() {
                $('#cover-post').cycle({
                    fx:     'scrollHorz',
                    timeout: '7000',
                    next:   '#rarr',
                    prev:   '#larr'
                });
            })

        function dd_open() {
            dd_canceltimer();
            dd_close();
            var liwidth = $(this).width();
            ddmenuitem = $(this).find('ul').css({'visibility': 'visible', 'width': liwidth});
            ddmenuitem.prev().addClass('dd_hover').parent().addClass('dd_hover');
        }

        function dd_close() {
            if(ddmenuitem) ddmenuitem.css('visibility', 'hidden').prev().removeClass('dd_hover').parent().removeClass('dd_hover');
        }

        function dd_timer() {closetimer = window.setTimeout(dd_close, timeout);
        }

        function dd_canceltimer() {
            if (closetimer) {
                window.clearTimeout(closetimer);
                closetimer = null;
            }
        }
        document.onclick = dd_close;

        $('#dd > li').bind('mouseover', dd_open);
        $('#dd > li').bind('mouseout',  dd_timer);

        $('#larr, #rarr').hide();
        $('.cover-post').hover(
            function(){
                $('#larr, #rarr').show();
            }, function(){
                $('#larr, #rarr').hide();
            }
        


   
    
);
        /*** Misc ***/

        $('#comment, #author, #email, #url')
        .focusin(function(){
            $(this).parent().css('border-color','#888');
        })
        .focusout(function(){
            $(this).parent().removeAttr('style');
        });
        $('.rpthumb:last, .comment:last').css('border-bottom','none');

    })
})(jQuery)
