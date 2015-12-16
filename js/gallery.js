var gallery = {};

    gallery.init = function(){
        var $container = $('.masonry');
        // initialize Masonry after all images have loaded  
        $container.imagesLoaded( function() {
            $container.masonry();
        });
    }

$('document').ready(gallery.init);