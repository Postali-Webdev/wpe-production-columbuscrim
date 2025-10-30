// These are the scripts that make the Homepage work
	var $j = jQuery.noConflict();
	(function($) {
 	$j(function() {
	$j(document).ready(function() {		
    

	
// // Mobile menu script
//   $('#menu-icon').click(function(e){
//     e.preventDefault();
//     $('#mobile-nav').slideToggle(400);
//     // Change this boolean number to adjust animation speed
//     $(this).toggleClass('open');
//   });


// // Mobile menu sub menu
//   $('#menu-item-16544 > a, #menu-item-16560 > a, #menu-item-17071 > a, #menu-item-17170 > a, #menu-item-15213 > a').click(function(e){
//     e.preventDefault();    
//       if ($(this).next('ul').hasClass("open")) {
//         $('.sub-menu').removeClass('open');
//     } else {
//         $('.sub-menu').removeClass('open');
//         $(this).next('ul').slideToggle(400);
//       }
//   });

    $j("#menu-icon").bind("click", function(e) {
    var body = $("html");
    e.preventDefault();
    if (body.hasClass("nav-open")) {
      body.removeClass("nav-open");
      $j("#mobile-nav li.menu-item-has-children > a, .sub-menu").removeClass("open");
    } else {
      e.stopPropagation();
      body.one("click", function() {
        body.removeClass("nav-open");
        $("#jmobile-nav, #menu-icon").removeClass("open");
        $j("#mobile-nav li.menu-item-has-children > a, #mobile-nav li.menu-item-has-children > .sub-menu").removeClass("open");
      }).addClass("nav-open");
    }
  });
  $j("#mobile-nav").bind("click", function() {
    event.stopPropagation();
  });
  $j("#menu-icon").on("click", function() {
    $j("#mobile-nav, #menu-icon").toggleClass("open");
    event.preventDefault();
  });

  $j('#mobile-nav li.menu-item-has-children > a').click(function(e){
    e.preventDefault();
    $j(this).toggleClass('open');
    $j(this).siblings('.sub-menu').toggleClass('open');
  });


	
	});
	});
	
  //Set filter dropdown selection to current page
  (function() {
    $j( document ).ready(function() {
      
      if ($j('.filter-container select[name="categoryfilter"]').length) {
        let currentUrl = window.location.pathname;
        let menu = '.filter-container';
        let menuArray = [];
        let sel = $j(menu + ' select')[0].children;
        let userAgent = window.navigator.userAgent;

        for (var i=0, n=$j(sel).length; i<n;i++) {
          menuArray.push(sel[i]);
          
          if ( $j(sel[i]).val() === currentUrl) {
            
            $j(sel[i]).attr("selected", "selected");
          }
        }
        if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
          menuArray.forEach((item, index) => {
            if ($j(item).val() === currentUrl) {
              
              $j(menu + ' select').prepend(`<option selected="selected" disabled="disabled" value="#">${item.outerText}</option>`)
            }
          })
        }
        $j(menu + ' select').on('click', function(e) {
          $j(menu).addClass('active-select');
        })
      }
    });
  })();

  // Accordions
  // Clicking on the accordion header title
	$(".accordions").on("click", ".accordions_title", function() {
	// will (slide) toggle the related panel.
	$(this).toggleClass("active").next().slideToggle();
	}); 


  $(document).ready(function($) {
    if( $('.page-template-page-practice-area').length ) {
      var currentLocation = $(location).attr('pathname');
      var link = $('.related-links-container .menu li');
      link.each(function(index, item) {
          var url = $(item).find('a').attr('href');
          if( currentLocation == url ) {
              $(item).addClass('current-menu-item');
          }
      })  
    }
});

})(jQuery);