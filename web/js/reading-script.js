$(function() {
    
    var $target = $('.reading-bloc');
    
    function removeFontClass($el) {
        
        if ($el.hasClass('font-gara')) {
            $el.removeClass('font-gara')
        } else if ($el.hasClass('font-bask')) {
            $el.removeClass('font-bask')
        } else if ($el.hasClass('font-open')) {
            $el.removeClass('font-open')
        } else if ($el.hasClass('font-robo')) {
            $el.removeClass('font-robo')
        } else if ($el.hasClass('font-aria')) {
            $el.removeClass('font-aria')
        } else if ($el.hasClass('font-time')) {
            $el.removeClass('font-time')
        }
    }
    
    function removeSizeClass ($el) {
        if ($el.hasClass('font-xs')) {
            $el.removeClass('font-xs')
        } else if ($el.hasClass('font-sm')) {
            $el.removeClass('font-sm')
        } else if ($el.hasClass('font-nm')) {
            $el.removeClass('font-nm')
        } else if ($el.hasClass('font-lg')) {
            $el.removeClass('font-lg')
        } else if ($el.hasClass('font-xl')) {
            $el.removeClass('font-xl')
        }
    }
    
    function removeColorClass ($el){
        if ($el.hasClass('color-black-white')) {
            $el.removeClass('color-black-white')
        } else if ($el.hasClass('color-white-black')) {
            $el.removeClass('color-white-black')
        }
    }
    
    function addOptionClass ($el, $class) {
        $el.addClass($class);
    }
    
    $('div.reading-font-bloc > button').click(function() {
        removeFontClass($target);
        addOptionClass($target, $(this).attr('id'));
    });

    $('div.reading-size-bloc > button').click(function() {
        removeSizeClass($target);
        addOptionClass($target, $(this).attr('id'));
    });
    
    $('div.reading-color-bloc > button').click(function() {
        removeColorClass($target);
        addOptionClass($target, $(this).attr('id'));
    });
    
});
