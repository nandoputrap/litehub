$(document).ready(function() {
	$('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
	$('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
	// $(window).scroll(function () { 
	//       console.log($(window).scrollTop())
	//       if ($(window).scrollTop() > 322) {
	//       	$('#nav_bar').addClass('navbar-fixed');
	//       }
	//       if ($(window).scrollTop() < 323) {
	//       	$('#nav_bar').removeClass('navbar-fixed');
	//       }
 //  	});
});