(function($){"use strict";

	//google MAP  , 
		var color = "#f00000" // google map background colour
		var saturation = 10 // 
		var  Longitude= 23.61302//(Fist Value Longitude, Second Value Latitude), get YOUR coordenates here!: http://itouchmap.com/latlong.html
		var Latitude=58.45312
		var marker_content="<h2 style='color:#000;'> MADO </h2> Discover the flavors of MADO" // marker or  on click content (Info Window) 
		var pointerUrl = 'http://localhost:8084/experiment/MADO/wp-backend/rjplugin/images/map-marker.png' // set your color pointer here!
		
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
				 center : new google.maps.LatLng(23.61387, 58.45527),
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

	

})(jQuery);