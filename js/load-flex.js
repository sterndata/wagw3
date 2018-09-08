  jQuery(window).load(function() {
     var animation= wagw.animation;
     var animationSpeed = wagw.animationSpeed;
     var slideshowSpeed = wagw.slideshowSpeed;
     var directionNav = wagw.directionNav;
     var controlNav = wagw.controlNav;
     var easing = wagw.easing;

     if ( controlNav == "thumbnails" ) {

       // The slider being synced must be initialized first

       jQuery ('#carousel').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: true,
          slideshow: false,
          itemWidth: 175,
          itemMargin: 15,
          asNavFor: '#slider',
       });

       jQuery('#slider').flexslider({
          animation:animation,
          animationSpeed:Number(animationSpeed),
          slideshowSpeed:Number(slideshowSpeed),
          controlNav: false,
          animationLoop: true,
          slideshow: true,
          easing: easing,
          sync: "#carousel"
        });

   }

   else {
    jQuery('.flexslider').flexslider({
        animation:animation,
        animationSpeed:Number(animationSpeed),
        slideshowSpeed:Number(slideshowSpeed),
        controlNav: controlNav,
        directionNav: directionNav,
        easing: easing,

    });

  }

  });
