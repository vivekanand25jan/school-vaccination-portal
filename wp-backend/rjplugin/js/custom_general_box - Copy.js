/******************************************************************************
		  	Navigation on click/ on load / on hasch chage scroll to 
******************************************************************************/

jQuery(document).ready(function($){
"use strict";

$("#header").click(function (e) { e.preventDefault(); });
$("#mainheader").click(function (e) { e.preventDefault(); });

//on page load show from hash index.html#about
/*********************************************************************************/
var url = window.location.href;
var type = url.split('#');
var hash = '';
if(type.length > 1) 
{ 
hash = type[1];
}

if (hash!=""){
var hash_fullname= "#" + hash;
$( "a[href='"+hash_fullname+"']" ).addClass('selected');
	if(hash_fullname=="#home"){ 
	// hiding subpage header 
	$('#header').hide('fade', { direction: 'left', easing: 'easeInQuad' }, 1000);
	Animation("#header","fadeOutUp","200");
	}
	else {
	// hiding Home page header 
	$('#mainheader').hide('fade', { direction: 'left', easing: 'easeInQuad' }, 600);
	Animation("#mainheader","fadinUp","200");
	}

		$('#wrapper').scrollTo(hash_fullname, 2000, {easing:'easeInOutExpo', axis:'x', onAfter:function(){ // scrollto callback  function 
			if(hash_fullname=="#home")
			{ // for home page animation
			Homepage_Animation();
			}
			else 
			{ // sub page animation
				if ( $('#header').is(':hidden')){ // if header is hidden then do animation
					Subpage_animation();
				}
			} 
		
				} // scrollto callback function close
		
		});//	scrollto close

}// hash!="" close



// on click navigation 
/*********************************************************************************/
$('.main-nav a.nav-link,.brand a.nav-link,a.nav-link').click(function () {
			
var name = $(this).attr('href');
if(name!="#")  { // if navigation not equalt to "#"

if(name=="#home"){
$('.selected').removeClass('selected');
$( "a[href='"+name+"']" ).addClass('selected');

$('#header').hide('fade', { direction: 'left', easing: 'easeInQuad' }, 1000);
Animation("#header","fadeOutUp","200");
}
else {
$('.selected').removeClass('selected');
$( "a[href='"+name+"']" ).addClass('selected');
$('#mainheader').hide('fade', { direction: 'left', easing: 'easeInQuad' }, 600);
Animation("#mainheader","fadinUp","200");
}

//	scrollto start
$('#wrapper').scrollTo($(this).attr('href'), 2000, {easing:'easeInOutExpo', axis:'x', onAfter:function(){ // scrollto callback  function 

if(name=="#home"){ // for home page animation 

Homepage_Animation();
$( "a[href='#home']" ).addClass('selected');
}
else { // sub page animation
if ( $('#header').is(':hidden')){
Subpage_animation();
}
} // else close

} // scrollto callback function close

} );//	scrollto close

} // if navigation not equalt to "#" end

}); // navigation click end


}); // end document.ready


// hash change and browser histry
/*********************************************************************************/

$(window).bind("hashchange", function(e) {
									  
//on hash change getting the ID
var url = window.location.href;
var type = url.split('#');
var hash = '';
if(type.length > 1) 
{ 
hash = type[1];
}

if (hash!=""){
var hash_fullname= "#" + hash;

	if(hash_fullname=="#home"){ 
	// hiding subpage header 
	$('#header').hide('fade', { direction: 'left', easing: 'easeInQuad' }, 1000);
	Animation("#header","fadeOutUp","200");
	}
	else {
	// hiding Home page header 
	$('#mainheader').hide('fade', { direction: 'left', easing: 'easeInQuad' }, 600);
	Animation("#mainheader","fadinUp","200");
	}

		$('#wrapper').scrollTo(hash_fullname, 2000, {easing:'easeInOutExpo', axis:'x', onAfter:function(){ // scrollto callback  function 
			if(hash_fullname=="#home")
			{ // for home page animation 
			Homepage_Animation();
			}
			else 
			{ // sub page animation
				if ( $('#header').is(':hidden')){ // if header is hidden then do animation
					Subpage_animation();
				}
			} 
		
				} // scrollto callback function close
		
		});//	scrollto close

}// hash!="" close

});


/***************************************************
		  		For	Menu Selection active
***************************************************/

jQuery(document).ready(function($){
"use strict";

// on hash change 
window.onhashchange = function() {
$('.selected').removeClass('selected');
var hash = window.location.hash;
$( "a[href='"+hash+"']" ).addClass('selected');
}
// on click navigation add class selected
$("#header ul.nav li a").click(function () {
	$('ul.nav li a').removeAttr('class');
	$(this).attr('class', 'nav-link selected');
	});


$(function(){
	$('#sub-nav').slicknav({
	label: '',
	duration: 1000,
	easingOpen: "easeOutQuint", //available with jQuery UI
	closeOnClick:true
});
});


});

/***************************************************
		  	//custom animation functions
***************************************************/
function modalshow(modalid) 
{
	$(modalid).modal('show');
}

function Animation(element,effect,timedelay) 
{
    $(element).delay(timedelay).removeClass().addClass(effect + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
     $(this).removeClass();
    });
};

function Animation(element,effect,timedelay) 
{
    $(element).delay(timedelay).removeClass().addClass(effect + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
     $(this).removeClass();
    });
};

function Homepage_Animation()
{
$('#mainheader').show('fade', { easing: 'easeInQuad' }, 900);
Animation("#mainheader","fadeInUp","200");
Animation("#spmenu1","fadeInRight","300");
Animation("#spmenu2","fadeInRight","800");
Animation("#spmenu3","fadeInRight","5000");
Animation("#1","fadeInLeft","800");
Animation("#2","fadeInUp","1800");
Animation("#3","fadeInDown","800");
Animation("#4","fadeInLeft","1800");
Animation("#5","fadeInRight","800");
}

function Subpage_animation ()
{
Animation("#header","fadeInDown","200");
$('#header').show('fade', { direction: 'top', easing: 'easeInQuad' }, 500);
}



/***************************************************
		  		Home page Social icon animation
***************************************************/

jQuery(function($){
	//region Socials jumps
	$('.accura-jump a,' +
		'.accura-jump-bg a').each(function () {
			var $el = $(this);
			$el.append($el.find('i').clone());
		});

$('.accura-social-icons-big a i').wrap('<span></span>');
	//end region
});


/***************************************************
		  		BoxFX
***************************************************/
jQuery(document).ready(function($){
"use strict";
new BoxesFx( document.getElementById( 'boxgallery' ) );

// Box Animation Auto Play
jQuery(document).ready(function($){
"use strict";	

      var el=4;
	  
      repeat(2000,function(){
	 // alert(el);
        if(el==4){
        $('#boxgallery nav span:nth-child(0)').click();
           el=2;
        }
        else{
          $('#boxgallery nav span:nth-child('+el+')').click();
		//  alert(el);
          el=el+1;
          }
        });
      });

 });

jQuery(document).ready(function($){
"use strict";
$(window).resize(function () {
		resizePanel();
	});
 });



function resizePanel() {

	width = $(window).width();
	height = $(window).height();

	mask_width = width * $('.item').length;
		
	$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		
	$('#wrapper, .item').css({width: width, height: height});
	$('#mask').css({width: mask_width, height: height});
	$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
		
}

$(window).load(function() {    

	var theWindow        = $(window),
	    $bg              = $(".bg"),
	    aspectRatio      = $bg.width() / $bg.height();

	function resizeBg() {

		if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
		    $bg
		    	.removeClass()
		    	.addClass('bgheight');
		} else {
		    $bg
		    	.removeClass()
		    	.addClass('bgwidth');
		}

	}

	theWindow.resize(function() {
		resizeBg();
	}).trigger("resize");



});



// ******************************************************************************************
// Reservation Form Start
// ******************************************************************************************
jQuery(document).ready(function($){
"use strict";	
  $('#reservation_form').validate(
    {
    rules: {
    name: {
    minlength: 2,
    required: true
    },
	phone: {
    required: true,
    },
    email: {
    required: true,
    email: true
    },
    subject: {
    minlength: 2,
    required: true
    },
    message: {
    minlength: 2,
    required: true
    }
    },
    highlight: function(element) {
    $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
    element
    .text('OK!').addClass('valid')
    .closest('.control-group').removeClass('error').addClass('success');
    },
	submitHandler: function(form) {
					// do other stuff for a valid form
					$.post('reservation_form.html', $("#reservation_form").serialize(), function(data) { // action file is here 
						$('#reservation_form').html(data);
					});
				}
    });
    }); // end document.ready


//Reservation Form END


// ******************************************************************************************
// Contact Form Start
// ******************************************************************************************
jQuery(document).ready(function($){
"use strict";	
  $('#contact_form').validate(
    {
    rules: {
    name: {
    minlength: 2,
    required: true
    },
	phone: {
    required: true,
    },
    email: {
    required: true,
    email: true
    },
    subject: {
    minlength: 2,
    required: true
    },
    message: {
    minlength: 2,
    required: true
    }
    },
    highlight: function(element) {
    $(element).closest('.control-group').removeClass('success').addClass('error');
    },
    success: function(element) {
    element
    .text('OK!').addClass('valid')
    .closest('.control-group').removeClass('error').addClass('success');
    },
	submitHandler: function(form) {
					// do other stuff for a valid form
					$.post('contact_form.html', $("#contact_form").serialize(), function(data) { // action file is here 
						$('#contact_form').html(data);
					});
				}
    });
    }); // end document.ready


//Contact Form END

// ******************************************************************************************
// Configuration Start		
// ******************************************************************************************

//google MAP 
		var color = "#9E2811" // google map background colour
		var saturation = 100 // 
		var  Longitude= 23.62461//(Fist Value Longitude, Second Value Latitude), get YOUR coordenates here!: http://itouchmap.com/latlong.html
		var Latitude=58.56124
		var marker_content="<h2> Bait Al Luban </h2> Serving Authentic Omani Cuisine" // marker or  on click content (Info Window) 
		var pointerUrl = 'assets/img/map-marker.png' // set your color pointer here!
		
//Configuration END


//****************************************************************************
		  		// Google map 
//****************************************************************************
jQuery(document).ready(function($){
		 "use strict";
			//dragable mobile
			var drag;
			if($(window).width()<796){drag=false;}else{drag=true;}
			
		/* googleMaps */
		
				function map_canvas_loaded() {
				var latlng = new google.maps.LatLng(Longitude,Latitude);
				
				// setting styles here 
				var styles = [
					{
						"featureType": "landscape",
						"stylers": [
							{"hue": "#000"},
							{"saturation": -100},
							{"lightness": 40},
							{"gamma": 1}
						]
					},
					{
						"featureType": "road.highway",
						"stylers": [
							{"hue": color},
							{"saturation": saturation},
							{"lightness": 20},
							{"gamma": 1}
						]
					},
					{
						"featureType": "road.arterial",
						"stylers": [
							{"hue": color},
							{"saturation": saturation},
							{"lightness": -10},
							{"gamma": 1}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{"hue": color},
							{"saturation": saturation},
							{"lightness": 20},
							{"gamma": 1}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{"hue": "#000"},
							{"saturation": -100},
							{"lightness": 15},
							{"gamma": 1}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{"hue": "#000"},
							{"saturation": -100},
							{"lightness": 25},
							{"gamma": 1}
						]
					}
				];		
				var options = {
				 center : new google.maps.LatLng(23.624418, 58.564832),
				 mapTypeId: google.maps.MapTypeId.ROADMAP,
				 zoom : 17,
				 styles: styles
				};
				var map_canvas = new google.maps.Map(document.getElementById('map_canvas'), options);
				var pointer = new google.maps.LatLng(Longitude,Latitude);
				var marker0= new google.maps.Marker({
				 position : pointer,
				 map : map_canvas,
				 icon: pointerUrl //Custom Pointer URL
				 });
				google.maps.event.addListener(marker0,'click',
				 function() {
				 var infowindow = new google.maps.InfoWindow(
				 {content:marker_content });
				 infowindow.open(map_canvas,marker0);
				 });
				}
				window.onload = function() {
				 map_canvas_loaded();
				};
			/* End */
			
		});

//Google map end 
		

jQuery(document).ready(function($){
		 "use strict";
/* Date Picker */
  $('.form_datetime').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
  });
		
/* // Date Picker */  



//****************************************************************************
		  		//Home page Promotions options
//****************************************************************************
jQuery(document).ready(function($){
"use strict";
  	$('.spmenu1, .spmenu2, .spmenu3, .spmenu4').hover(function() {
  		$(this).addClass('forefront');
  	}, function() {
  		$(this).removeClass('forefront');
  	})
});

$(document).ready(function() {
	"use strict";
    var $lightbox = $('#lightbox');
    
    $('[data-target="#lightbox"]').on('click', function(event) {
        var $img = $(this).find('img'), 
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                'maxHeight': $(window).height() - 100
            };
    
        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
            
        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});	

	$(document).ready(function() {
	"use strict";
    var $lightbox = $('#lightbox3');
        
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
            
        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});	

$(document).ready(function() {
"use strict";
    var $lightbox = $('#lightbox2');
    
    $('[data-target="#lightbox2"]').on('click', function(event) {
        var $img = $(this).find('iframe'), 
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                'maxHeight': $(window).height() - 100
            };
    
        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('iframe').attr('src', src);
        $lightbox.find('iframe').attr('alt', alt);
        $lightbox.find('iframe').css(css);
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('iframe');
            
        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
});

//Home page Promotions options    

// toogle options 

$(document).ready(function() {
"use strict";
   	$('.toggle-content').hide();  //hides the toggled content

	$('.toggle-link').click(function () {
		if ($(this).is('.toggle-close')) {
			$(this).removeClass('toggle-close').addClass('toggle-open').parent().next('.toggle-content').slideToggle(300);
  $('#scrolldynamic').getNiceScroll().resize();
			return false;
		} 
		
		else {
			$(this).removeClass('toggle-open').addClass('toggle-close').parent().next('.toggle-content').slideToggle(300);
			$(".menuscroll").getNiceScroll().resize();
			  $('#scrolldynamic').getNiceScroll().resize();
			return false;
		}
	});			  
});

//toogle options end 



// Scroll Bar options 
  $(document).ready(function() {  
	"use strict";
	$(".contentscroll").niceScroll({cursorcolor:"#f32a2a",
								 touchbehavior:true,scrollspeed:120,mousescrollstep:80,smoothscroll:true});
	//$("#home_nav").niceScroll({cursorcolor:"#f32a2a",
//								 touchbehavior:true});
	//$("#menutop").niceScroll({cursorcolor:"#f32a2a",touchbehavior:true,scrollspeed:120,mousescrollstep:80,smoothscroll:true});

$(".contentscroll").mouseover(function() {
$(".contentscroll").getNiceScroll().resize();
});
 
});
  
// Scroll Bar options end 

//Preloader

jQuery(document).ready(function($){
"use strict";

$("body").jpreLoader(
	  {
		splashID:"#jSplash",
		showPercentage:!0,
		autoClose:!0,
		showSplash: true,
		splashFunction:function(){
		$("#circle").delay(1250).animate({opacity:1},700,"linear");
		//	$('#mainheader').show('fade', { easing: 'easeInQuad' }, 900);
//
 }
	 })
//Homepage_Animation();



});


/* Video Containers */
$(".video_containers").fitVids();
/* //Video Containers */
