

/*
	hints:
	-implement the line with a google.maps.Polyline
	-let google redraw the polyline (see .getPath()) when a new
	point is added - don't delete the whole thing and add it again 
	-use google.maps.Marker for markers
	-use .setMap(null)do remove/delete either of these from your map
	you're making work for yourself if you do it any other way
*/

var Map = function Map(view) {
	var that = this;
	var mapOptions = {
		// feel free to edit map options
		disableDefaultUI: true,
		zoom: 5,
		center: new google.maps.LatLng(39.50, -98.35),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	this.init = function() {
		// render map here
		
		this.map = new google.maps.Map($('#map_canvas')[0], mapOptions);
	
		
		if(0 < that.markers.length) 
		{
			for(var i =0; i < that.markers.length; i++)
			{
				var marker_tmp = that.markers[i];
				marker_tmp.setMap(this.map);

			}
			that.Polylines.setMap(this.map);
			
		}

	}

	this.points = []; // { lat:0.0, lng:0.0, name: "", time: Date() }
	this.markers = []; // array of markers already on map
	this.Coordinates = []; //array of lattitude and longitude for polylines
	this.Polylines;

	this.addPoint = function(point) {
		// adds a point to this.points
		var singleObj = {};
		singleObj['lat'] = point['place'].location.latitude;
		singleObj['lng'] = point['place'].location.longitude;
		singleObj['name'] = point['place'].name;
		singleObj['time'] = point['date'];
		that.points.push(singleObj);
	}

	this.renderAllPoints = function () {
		// remove all old map data, *sort* the points
		// and render each point ever ~300ms
		// don't render the point if dist(this_pt,prev) === 0	
		that.removeData();
		
		that.points.sort(function(a,b){
  			return new Date(a.time) - new Date(b.time);
		});
		
		view.setMiles();
		
		while(0 < that.points.length)
		{
			var previous = that.points[0];
		
			var myLatlng = new google.maps.LatLng(previous.lat,previous.lng);
			that.Coordinates.push(myLatlng);
			var marker = new google.maps.Marker({
				position: myLatlng,
				animation: google.maps.Animation.DROP,

				map: this.map,
				title: previous.name
			});
			
			
			that.markers.push(marker);
			
			that.Polylines = new google.maps.Polyline({
				path: that.Coordinates,
				strokeColor: "#FF0000",
				strokeOpacity: 1.0,
				strokWeight: 3
			});


			that.points.splice(0,1);
		
			if(0< that.points.length)
			{
				var tmp = distanceFormula(that.points[0],previous);
				tmp = Math.round(tmp);
				while(0 < that.points.length && tmp === 0)
				{
		
					that.points.splice(0,1);
					if(that.points.length === 0){
						break;
					}	
					
					tmp = distanceFormula(that.points[0],previous);
				}
			}
			
		}

		if(0 < that.markers.length) 
		{
			
			for(var i =0; i < that.markers.length; i++)
			{
				
				var marker_tmp = that.markers[i];
				marker_tmp.setMap(this.map);

			}
			that.Polylines.setMap(this.map);
			
		}
		

	}

	this.removeData = function() {
		// reset distance, clear polypath and markers

		for(var i = 0; i < that.markers.length; i++){
			that.markers[i].setMap(null);
		}

		that.markers = [];
		that.markers.length = 0;
		
		if(that.Polylines){
			that.Polylines.setMap(null);
		}
		that.Coordintates = [];
		that.Coordinates.length = 0;

	
	}

	this.renderSinglePoint = function(cb) {

		// render a single point on the map
		// pan the map to the new point
		// make sure to update the polypath
		// consider recursion :)
		
		



	}

	// call the initializer
	this.init();
}