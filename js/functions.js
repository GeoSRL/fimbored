function doJob(jobID) {
	div = 'job',
	
	$.post("inc/c.php?",{"jobID":jobID},function(html) {
			$('div#'+div+jobID).css('display','none');
		  $('#'+div+jobID).html('('+html+')').fadeIn();
	});
}

function refresh(div2ref, link2load) {
 var auto_refresh = setInterval(function () {
		$(div2ref).load(link2load).fadeIn("slow");
		});
}

$(document).ready(function() { 

	//When page loads...
	$(".tab_content").hide(); //Hide all content
  $("div#tab1").show();

	//On Click Event
	$("h4.hide_all").click(function() {
		
		$(".tab_content").slideUp();
			
	});
	
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").slideUp("slow"); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).slideDown("slow"); //Fade in the active ID content
		return false;
	});

});

var RecaptchaOptions = {
    theme : 'white',
    custom_theme_widget: 'recaptcha_widget'
 };