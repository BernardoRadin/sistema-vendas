$(function(){
    var open = true;
    var windowSize = $(window)[0].innerWidth;

    if(windowSize < 768){
        open = false
        $('.menu').css('width','0')
    }
    
    $('.menu-icon').click(function(){
        if(open == true){
            $('.menu').animate({'width': 0, 'padding': 0});
            $('.content,header').animate({'left': 0, 'width': '100%'}, function(){
                $('.menu > *').css({'display': 'none'});
                open = false;
                $('.menu').css({'display': 'none'});
            })
        }else{
            var newWidth = windowSize - 283;
            $('.menu').css({'display': 'none'});
            $('.menu > *').css({'display': 'block'});
            $('.menu').css({'display': 'block'});
            $('.menu').animate({'width': '283px', 'padding': 0});
            $('.content,header').animate({'left': '283px','width': newWidth}, function(){
                // $('.loggout').css({'position':'absolute'});
                open = true;
            })
        }
    })
})