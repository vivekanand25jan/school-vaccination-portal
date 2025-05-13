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



