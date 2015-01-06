
	Number.prototype.toRad = function() {
		// convert an angle (in degrees) to radians
		return this.valueOf()*Math.PI/180;
	}

	Number.prototype.prettyPrint = function() {
		// return a string representation of an integer
		// which has commas every three digits
		return this.toLocaleString();
	};

	distanceFormula = function(first, second){
		// compute the distance in miles between two lat lng points
		// a point should look like {lat: 0.0, lng: 0.0}
		var radlat1 = first['lat'].toRad();
		var radlng1 = first['lng'].toRad();
		var radlat2 = second['lat'].toRad();
		var radlng2 = second['lng'].toRad();
		var theta = first['lng']-second['lng'];
		var radtheta = theta.toRad();
		var dist = Math.sin(radlat1)*Math.sin(radlat2)+Math.cos(radlat1)*Math.cos(radlat2)*Math.cos(radtheta);
		dist = Math.acos(dist);
		dist = dist*180/Math.PI;
		dist=dist*60*1.1515;
		return dist;

		


	};
