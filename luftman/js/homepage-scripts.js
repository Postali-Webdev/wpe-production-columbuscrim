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

// Hide Homepage legal process steps until click
$('.legal_process_steps .tabs .tabs-container .tab-content:last-of-type').css("display", "none");
$('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-content div:first-of-type').addClass('show');
$('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-nav ul li:first-of-type').addClass('active');

$('.interior-tabs-nav span').click(function() {

    // Check for active
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-nav li').removeClass('active');
    $(this).parent().addClass('active');

    // Display active tab
    let currentTab = $(this).attr('id');
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-content div').css('display','none');
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-content div').removeClass('show');
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-content div#' + currentTab).toggleClass('show');
    

    return false;
});

$('.tabs-nav li').click(function() {
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-nav ul li').removeClass('active');
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-content div').removeClass('show');
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-content div:first-of-type').addClass('show');
    $('.legal_process_steps .tabs .tabs-container .tab-content .tabs-content .interior-tabs-nav ul li:first-of-type').addClass('active');
});


	});
	});
	})(jQuery);