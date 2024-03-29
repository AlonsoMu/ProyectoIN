$(function() {

	/* MENU */
  var siteSticky = function() {
		$(".js-sticky-header").sticky({topSpacing:0});
	};
	siteSticky();

	var siteMenuClone = function() {

		$('.js-clone-nav').each(function() {
			var $this = $(this);
			$this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
		});


		setTimeout(function() {
			
			var counter = 0;
      $('.site-mobile-menu .has-children').each(function(){
        var $this = $(this);
        
        $this.prepend('<span class="arrow-collapse collapsed">');

        $this.find('.arrow-collapse').attr({
          'data-toggle' : 'collapse',
          'data-target' : '#collapseItem' + counter,
        });

        $this.find('> ul').attr({
          'class' : 'collapse',
          'id' : 'collapseItem' + counter,
        });

        counter++;

      });

    }, 1000);

		$('body').on('click', '.arrow-collapse', function(e) {
      var $this = $(this);
      if ( $this.closest('li').find('.collapse').hasClass('show') ) {
        $this.removeClass('active');
      } else {
        $this.addClass('active');
      }
      e.preventDefault();  
      
    });

		$(window).resize(function() {
			var $this = $(this),
				w = $this.width();

			if ( w > 768 ) {
				if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
			}
		})

		$('body').on('click', '.js-menu-toggle', function(e) {
			var $this = $(this);
			e.preventDefault();

			if ( $('body').hasClass('offcanvas-menu') ) {
				$('body').removeClass('offcanvas-menu');
				$this.removeClass('active');
			} else {
				$('body').addClass('offcanvas-menu');
				$this.addClass('active');
			}
		}) 

		// click outisde offcanvas
		$(document).mouseup(function(e) {
	    var container = $(".site-mobile-menu");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	      if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
	    }
		});
	}; 
	siteMenuClone();


	/* GALERIA */
	if ( $('.owl-2').length > 0 ) {
      $('.owl-2').owlCarousel({
          center: false,
          items: 1,
          loop: true,
          stagePadding: 0,
          margin: 20,
          smartSpeed: 1000,
          autoplay: true,
          nav: true,
          dots: true,
          pauseOnHover: false,
          responsive:{
              600:{
                  margin: 20,
                  nav: true,
                items: 2
              },
              1000:{
                  margin: 20,
                  stagePadding: 0,
                  nav: true,
                items: 3
              }
          }
      });            
  }
});


/* KIOSCO */
function kiosco(evt, negocioName) {
	var i, x, tab;
	x = document.getElementsByClassName("nego_acti");
	for (i = 0; i < x.length; i++) {
	  x[i].style.display = "none";
	}

	tab = document.getElementsByClassName("tabs");
	for (i = 0; i < x.length; i++) {
	  tab[i].className = tab[i].className.replace(" corrector_nav_hover", "");
	}
	
	document.getElementById(negocioName).style.display = "block";
	evt.currentTarget.className += " corrector_nav_hover";
}

$(".topright").click(function(){
	this.parentElement.style.display="none";
	$(".tabs").removeClass('corrector_nav_hover');
});