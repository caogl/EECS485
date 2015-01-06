
$(document).ready(function () {

	/* 
	Notes: 

	all jQuery $("selector") calls should be in this file,
	*don't* add them elsewhere. this will probably be the only
	file making a new Obj() too. if you're confused please
	ask a GSI - but be sure to read the docs first!!!

	show and hide the spinner when anything is loading.
	only show login or logout buttons - not both
	make sure the clear map function stops the current search
	don't let glitchy UI slide - you'll lose points!
	think in terms of callbacks! it will help you fix async problems

	sometimes jquery and bootstrap dont get along, if .hide() and .show()
	don't work right use: addClass("hide") or removeClass("hide")

	Lastly: We will grade everything on the latest version of Chrome,
	so dev with Chrome for gosh sake! Use the dev tools too they're
	amazing!
	*/

	var map = new Map(this);
	var typeahead = new Typeahead();
	var that = this;
	var fb = new Facebook(map, this, function() {
		// called on successful login
		that.showLogout();
		// set typeahead data and show/hide buttons

		fb.getFriends(function(dataList) {

			typeahead.setDataList(dataList);
		});
			

		FB.api('/me/photos?fields=place.fields(location,name)&limit=1000',function(response){
   				fb.passToMap(response.data);
   				FB.api('/me/statuses?fields=place.fields(location,name)&limit=1000',function(response){
   					fb.passToMap(response.data);
   					that.hideSpinner();
   					map.renderAllPoints();
   				});	
   			});

			
			
	});

	// create dat spinner
	this.spinner = new Spinner({radius: 30, length: 30}).spin($("#spinner")[0]);
		
	this.setMiles = function() {
		// update #miles_traveled div
		var Miles = 0;

		for(var i = 1; i<map.points.length; i++){

			
			Miles += distanceFormula(map.points[i-1], map.points[i]);
			Miles = Math.round(Miles);
		}
		document.getElementById("miles_traveled").innerHTML = Miles.prettyPrint();
		
	}

	this.setPic = function(user_id) {
		// set the src of the #user_img
		// check out http://graph.facebook.com/ottosipe/picture?type=large
		
		for(var i in typeahead.list) {
			if(user_id == typeahead.list[i].id){			
				var pic_url = typeahead.list[i].picture.data.url;
				break;
			}
		}
		
		document.getElementById("user_img").src = pic_url;
	}

	this.showLogin = function() {
		// show and hide the right buttons
		$(".logout").addClass("hide");
		$(".login").removeClass("hide");
		
	}
	this.clearFriendList = function() {
		typeahead.list = [];
		typeahead.list.length = 0;
	}
	this.showLogout = function() {
		$(".login").addClass("hide");
		$(".logout").removeClass("hide");

	}

	this.showSpinner = function() {
		$("#spinner").removeClass("hide");
		//alert("spinner show");
	}

	this.hideSpinner = function() {
		$("#spinner").addClass("hide");
		//alert("spinner hide");
	}

	/* 
	attach all of the buttons and key press events below here
	- .login(click)
	- .logout(click)
	- #user(keyup): use typeahead.search(key, callback)
	- the call back should render the .drop_items with IDs and Names
		- attach a .drop_item(click)
	 		- start the fb search, call fb.search(id)
	 		- reset and clear #search_dropdown
	- .clear(click): remove data and reset miles/image, other UI
	*/
	$("#login_bar").find(".login").click(function(){
		
		fb.login();


	});
	$("#login_bar").find(".logout").click(function(){
		
		fb.logout();
		map.removeData();

	});

	$('#user').bind('input', function() {
    /* This will be fired every time, when textbox's value changes. */
    	var searchValue = $('#user').val();
    	typeahead.search(searchValue,function(found_list){
    		$("#search_dropdown").removeClass("hide");
    		$("#search_dropdown").empty();
    		for (var i in found_list) 
    		{		
				$("#search_dropdown").append("<div class='drop_item' id='"+found_list[i].id+"'>"+found_list[i].name+"</div>");
				

			}
			$(".drop_item").click(function(){
				
				that.setPic(this.id);
			});

    	});


	} );

	$("button").click(function(){
		
		map.removeData();
		document.getElementById("user_img").src = "";
		document.getElementById("miles_traveled").innerHTML = "0";
	});



});

