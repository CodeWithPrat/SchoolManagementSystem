$(document).ready(function(){		
	var pageId = window.location.href.split('/').pop().replace('.php', '');
	$(".menu-link").parent('li').removeClass('active');
	if($('#'+pageId).length) {
		$('#'+pageId).addClass('active');
	} else {
		$('#dashboard').addClass('active');
	}	
});