// These are the scripts that make the Homepage work
	var $j = jQuery.noConflict();
	(function($) {
 	$(function() {
	$(document).ready(function() {	
	
// Simple content slider
$(document).ready(function(){
	// options
	var speed = 700; //transition speed - fade
	var autoswitch = false; //auto slider options
	var autoswitch_speed = 5000; //auto slider speed
	
	// add first initial active class
	$(".slide").first().addClass("active");
	
	// hide all slides
	$(".slide").hide;
	
	// show only active class slide
	$(".active").show();
	
	// Next Event Handler
	$('#next').on('click', nextSlide);// call function nextSlide
	
	// Prev Event Handler
	$('#prev').on('click', prevSlide);// call function prevSlide
	
	// Auto Slider Handler
	if(autoswitch == true){
		setInterval(nextSlide,autoswitch_speed);// call function and value 4000
	}
	
	// Switch to next slide
	function nextSlide(){
		$('.active').removeClass('active').addClass('oldActive');
		if($('.oldActive').is(':last-child')){
			$('.slide').first().addClass('active');
		} else {
			$('.oldActive').next().addClass('active');
		}
		$('.oldActive').removeClass('oldActive');
		$('.slide').fadeOut(speed);
		$('.active').fadeIn(speed);
	}
	
	// Switch to prev slide
	function prevSlide(){
		$('.active').removeClass('active').addClass('oldActive');
		if($('.oldActive').is(':first-child')){
			$('.slide').last().addClass('active');
		} else {
			$('.oldActive').prev().addClass('active');
		}
		$('.oldActive').removeClass('oldActive');
		$('.slide').fadeOut(speed);
		$('.active').fadeIn(speed);
	}
});

//Show / Hide Practice Tiles on hover

$(function() {
	$('.award-content').hover(function() {
		$(this).toggleClass('fadeIn');
	});
});

// Hide Homepage legal process steps until click
$('.legal_process_steps .tabs .tabs-nav li').click(function() {
    $('.legal_process_steps .tabs-container').show();
});

// Change BG color of Homepage legal process buttons on click
$('.legal_process_steps .tabs .tabs-nav li .legal_process_button').click(function() {
      $(".legal_process_steps .tabs .tabs-nav li .legal_process_button").css("background", "none");
      $(this).css("background", "#1c4c85");
});


	});
	});
	})(jQuery);