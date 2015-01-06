
var Facebook = function(map, view, callback) {
	var that = this;
	this.login = function() {
		// login a user and call callback() if successfull
		// be sure to provide appropriate {scopes: "scopes,go,here"}



		// get "photos" and "statuses" with places attached
		// pass the data to the map with map.passToMap({...})
		// after *all* two API calls have returned, call map.renderAllPoints()
		// yay! async :) 

		// be sure your scopes are right during login
		// example: FB.api(id+"/photos?fields=place.fields(location,name)&limit=1000", this.passToMap);
		// use developers.facebook.com/tools/explorer to test!

		// hint, what should the user see while they wait?
		 FB.login(function(response) {
   			if(response.authResponse){
   	
   			callback();
   			}
 		}, {
   		scope: 'user_friends, public_profile, user_likes, user_photos, friends_location,user_location, friends_photos, user_status,friends_status', 
   		return_scopes: true
 		});
   	
	}

	this.logout = function() {
		// log the user out, remember the buttons!
		FB.logout(function(response){
			view.showLogin();
			view.clearFriendList();
			map.removeData();
			document.getElementById("miles_traveled").innerHTML = "0";
			document.getElementById("user_img").src = "";
	
			
		});
			

	}

	this.getFriends = function(cb) {
		// return a list of the user and user's friends as 
		// an argument to cb, be sure to add the logged 
		// in fb user too! 
		// returns somethin like cb([{name:"",id:""},...]);
		view.showSpinner();
		FB.api('/me/taggable_friends', function(response) {
	
			
				cb(response.data);
     	});





	}

	var count = 0;
	this.passToMap = function(response) {
		// helper function for the search
		// pulls out anything with a place
		// call map.addPoint(point)
		// be sure to make the time: new Date("time_string")
		for (var i in response){
			if(response[i].place !== undefined){
				var singleObj = {};
				singleObj['place'] = response[i].place;
				singleObj['id'] = response[i].id;
				
				if(response[i].created_time !== undefined){
				singleObj['date'] = new Date(response[i].created_time);
				}
				else{
				singleObj['date'] = new Date(response[i].updated_time);
				}


				map.addPoint(singleObj);
			}

		}



	}

	this.init = function() {

		/* provided FB init code, don't need to touch much at all*/

		var that = this; // note this usefull trick!
		window.fbAsyncInit = function() {
	
			// init the FB JS SDK
			FB.init({
				appId      : '1524813727763752',	// App ID from the app dashboard
				channelUrl : '/channel.html', 	// Channel file for x-domain comms
				status     : true,
				xfbml      : true,
				version    : 'v2.0',
				cookie     : true,
				oauth      : true
			});

			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					// the user is logged in and has authenticated
					callback(); // we'll give you this one

				} else if (response.status === 'not_authorized') {
					// the user is logged in to Facebook, 
					// but has not authenticated your app
				} else {
					// the user isn't logged in to Facebook.
				}
			});
		};

		// Load the SDK asynchronously - ignore this Magic!
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	}	

	this.init();
}


