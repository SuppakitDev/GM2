
$(document).ready(function() {
	

	$(window).load(function () {
		$(".loaded").fadeOut();
		$(".preloader").delay(600).fadeOut("slow");
	});

	  
	  
	  


<!-- =============================================== -->
<!-- ========== fancy box ========== -->
<!-- =============================================== -->



	$(".youtube-media").on("click", function(e) {
		var jWindow = $(window).width();
		if (jWindow <= 410) {
			return;
		}
		$.fancybox({
			href: this.href,
			padding: 4,
			type: "iframe",
			'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
		});
		return false;
	});
	





<!-- =============================================== -->
<!-- ========== owlcarousel team ========== -->
<!-- =============================================== -->













<!-- =============================================== -->
<!-- ========== scrollTop.js ========== -->
<!-- =============================================== -->
    
$('.scrollup').click(function(){
$("html, body").animate({ scrollTop: 0 }, 2000);
return false;
});



<!-- =============================================== -->
<!-- ========== scrolldown.js ========== -->
<!-- =============================================== -->

$('.scrolldown a').bind('click', function () {
    $('html , body').stop().animate({
        scrollTop: $($(this).attr('href')).offset().top - 160
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
});

			


<!-- =============================================== -->
<!-- ========== navbardown.js ========== -->
<!-- =============================================== -->

$('.nav a').bind('click', function () {
    $('html , body').stop().animate({
        scrollTop: $($(this).attr('href')).offset().top - 80
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
});			
			
			

	
// scroll Up

    $(window).scroll(function(){
        if ($(this).scrollTop() > 600) {
            $('.scrollup').fadeIn('slow');
        } else {
            $('.scrollup').fadeOut('slow');
        }
    });
    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });		


		
		
});






		
  
 


	