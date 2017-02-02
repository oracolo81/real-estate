(function($) {
  "use strict";
  
  // If JavaScript is enabled remove 'no-js' class and give 'js' class
  jQuery('html').removeClass('no-js').addClass('js');
  
  // Add .osx class to html if on Os/x
  if ( navigator.appVersion.indexOf("Mac")!=-1 ) 
  	jQuery('html').addClass('osx');
  
  // When DOM is fully loaded
  jQuery(document).ready(function($) {
  
    $(window).load(function() {
  
      // External Links
  		$('a[rel=external]').attr('target','_blank');	
      // External Links - End
      
      
      // Tooltips
      $('body').tooltip({
          delay: { show: 300, hide: 0 },
          selector: '[data-toggle=tooltip]:not([disabled])'
      });
      // Tooltips - End
            
                  
      // Dynamic Progress Bar
      $('.progress-bar').css('width',  function(){ return ($(this).attr('data-percentage')+'%')});
      // Dynamic Progress Bar - End
     
     
  	  // Back To Top Button    
      // hide #back-top first
    	$(".back-to-top").hide();
    	
    	// fade in #back-top
    	$(function () {
    		$(window).scroll(function () {
    			if ($(this).scrollTop() > 500) {
    				$('.back-to-top').fadeIn(500);
    			} else {
    				$('.back-to-top').fadeOut(500);
    			}
    		});
    
    	  // scroll body to 0px on click
    		$('.back-to-top').click(function () {
    			$('body,html').animate({
    				scrollTop: 0
    			}, 800);
    			return false;
    		});
    	});
  	  // Back To Top Button - End
     
     
    	// Fixed Menu
      // $('.navbar').sticky({topSpacing:0});
    	// Fixed Menu - End
      
       
      // Move Nav
      $(window).scroll(function(){ 
        if ($(this).scrollTop() > 50){ 
          $('.navbar').addClass("navbar-move");
        } 
        else{
          $('.navbar').removeClass("navbar-move");
        }
      });
      // Move Nav - End
      
      
      // Mobile Menu 
      selectnav('nav', {
        label: 'Navigate to...',
        nested: true,
        indent: '-'
      });
      // Mobile Menu - End
      
    
      // Isotope                     
      $('.portfolio-mansonry-container').isotope({
          itemSelector: '.portfolio-masonry-item',
          layoutMode: 'masonry',
          onLayout: function () {
      
          }
      });
      
      $('.blog-masonry-container').isotope({
          itemSelector: '.blog-masonry-post',
          layoutMode: 'masonry'
      });
      
      $('.filter li a').on('click', function (event) {     
          event.preventDefault();
          var selector = $(this).attr('data-filter');
          var container = $(this).closest('.portfolio-mansonry-all').find('.portfolio-mansonry-container');
          container.isotope({
              filter: selector
          });
          $(this).closest('.filter').children('li').removeClass('active');
          $(this).parent('li').addClass('active'); 
      });
      // Isotope - End
    
      
    	// Countdown
      $(function() {
      
        $('.countdown').countdown({
          date: "january 04, 2015 15:00:00",
          render: function(data) {
            var el = $(this.el);
            el.empty()
              .append("<div class=\"counter-item item-day\">" + this.leadingZeros(data.days, 2) + "</div>")
              .append("<div class=\"counter-item\">" + this.leadingZeros(data.hours, 2) + "</div>")
              .append("<div class=\"counter-item\">" + this.leadingZeros(data.min, 2) + "</div>")
              .append("<div class=\"counter-item\">" + this.leadingZeros(data.sec, 2) + "</div>");
          }
        });
    
      });
    	// Countdown - End
      
  
      // Magnific Popup
      $('.image-link').magnificPopup({type:'image'});
      
      $('.popup-gallery').magnificPopup({
      	delegate: 'a',
      	type: 'image',
      	tLoading: 'Loading image #%curr%...',
      	mainClass: 'mfp-img-mobile',
      	gallery: {
      		enabled: true,
      		navigateByImgClick: true,
      		preload: [0,1] // Will preload 0 - before current, and 1 after the current image
      	},
      	image: {
      		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
      		titleSrc: function(item) {
      			return item.el.attr('title') + '<small>By Your Company</small>';
      		}
      	}
      });
      // Magnific Popup - End
    
    
  	  // Parallax
      var detectmob = false;	
      if(navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/iPad/i)
        || navigator.userAgent.match(/iPod/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)) {							
          detectmob = true;
      }
      
      if (detectmob === true) {
        $( '.parallax' ).each(function(){
      			$(this).addClass('parallax-mobile');
      	});
      }
      else {
          $( '#parallax-one' ).parallax();
          $( '#parallax-two' ).parallax();
          $( '#parallax-three' ).parallax();
      }  
  	  // Parallax - End
      
      
      // Fitvids
      $("body").fitVids();    
      // Fitvids - End         
  
  
      
  
  
   
  	});
    // Window Load - End
          
  
  });
  // Document Ready - End
  
  
})(jQuery);
      