# J3.js - JavaScript JavaScript JavaScript

### Due: Thursday, October 16, 2014 @ 11:55:00 PM EDT

This completely-new project is all about JavaScript. Your goal
is to use information from Facebook and potentially other sources to
generate an interesting browser-based visualization of your friends'
activities.  At the end of this project, you will have an awesome
browser-based app running that uses JavaScript to access several
web-based APIs.  

Unlike previous projects, you will write no server-side code for the
assignment.  Also unlike previous projects, you are given a lot of skeleton code.
Please be sure to follow the comments above each function in the given
code, as well as the instructions in this specification document.


## Functionality Overview

You should be sure that
it supports three critical features: *typeahead*, *path-rendering*,
and *miles calculation*.


#### Typeahead

When you type into the user box in the upper left, the dropdown display should
show all of your Facebook friends for which your strings are prefixes.
So, for example, if "ott" is typed I should see "Otto Sipe" in the dropdown. Your typeahead should also look at last names. "Si" should show "Otto Sipe" as well as other friends who happen to have "si" at the **beginning** of their first or last name. Finally, the typeahead should match first and last names simultaneously. If I type "ot si", "Otto Sipe" should appear. Order does not matter either - "ott s" would match a friend by the name of "Smith Otto" and "Otto Sipe". The typeahead should be case insensitive.


![Sample Typeahead Implemenation](http://i.imgur.com/m0BBZ8X.png)

#### Rendered Path

You should be able to render the login user's checkin history 
on screen.  This entails grabbing the user's checkin
history, getting the relevant lat/long pairs for each checkin, and
animating them onscreen.  You should implement the "drop icon, move,
draw line" sequence. 

![Sample Path Implemenation](http://i.imgur.com/dTbzBUJ.jpg)

#### Miles Calculator

At the bottom right of the browser, a counter should display the miles
the login user has "travelled" so far.  It should update as the
path is being drawn onscreen. It should hold an integer value (with
commas) of the total distance that this person has traveled, according
to the dataset.  
![Sample Miles Implemenation](http://i.imgur.com/DjSD9SY.png)


## Code Walkthrough

We will now describe all the source files in your application.  Recall
that your entire application is browser-based, except for data we draw
from remote public information sources like Facebook.  You do not
implement any server-side component yourself.

#### `index.html`

This is all the HTML markup you will need for the project. You <i>do
not need to modify</i> this file (unless you are going for extra
credit, but more on that later). Examine the end of the file where are
the \<script\> tags are. The order in which scripts are loaded is
important. When any script defines a JavaScript variable with global
scope, scripts loaded after it have access to that global variable.

We
will walk through each of these JavaScript files and explain the
expected functionality. 

#### `main.js`

This script's entire purpose is to be the interface between the the
visualization of the data in the browser (we will call it the "view")
and the rest of the JavaScript code in your program. This script will
use jQuery to manipulate the DOM; this is the only place where you
have to work with jQuery. jQuery is a JavaScript library that provides
a cleaned-up browser-independent API to access the DOM. The library is
loaded as the first \<script\> tag in `index.html`. Don't try to open
the jQuery file in your browser and read through the code, it's
[minified](http://en.wikipedia.org/wiki/Minification_(programming\)). 

Read the comments in the skeleton file and implement all the
functions. This file makes heavy use of
[callbacks](http://en.wikipedia.org/wiki/Callback_(computer_programming)). We
will use jQuery to tell us when a user triggers an interesting event. You will provide an anonymous function to each of these event callbacks to handle the event.


#### `fb.js`

This file contains all the Facebook API code. We have taken care of
the OAuth handshaking code that implements the login.  However, you need to set up your developer account. If your team does not have access to a Facebook account, talk to the course staff and we can work with you. 
Please **DO NOT** use your eecs485 server for this project, because it will require you to setup your Facebook Developer account differently!

1) [Go here](https://developers.facebook.com/apps) https://developers.facebook.com/apps

2) Click `Add a New App`, and select `Website`

3) App Name: `eecs485-test`, and choose `Apps for Pages` for `category`

4) Click `Confirm`

5) Enter `http://localhost:8000` under `Site URL`

6) Click `Skip Quickstart` at the top. 

7) Go to `Status & Review`, push the button for `Do you want to make this app and all its live features available to the general public?` to `Yes`. 

8) Grab your App ID and paste it in `fb.js` as the value of the `FBAppId`

From here, follow the comments in the file. Note that there are two
API "endpoints" you should access in order to gather data about a user:

* Photos (with a geolocation tag)
* Statuses (with a geolocation tag)

#### `map.js`

This file handles map-related issues.  As always, follow the comments
in this file. Several functions are filled in for you. Take note, this
module was written to be dumb about data -- that is, it was designed
such that any data source can be fed to it. As long as `this.points`
contains a valid array of objects, those objects should get drawn on
the map properly. This means that if you want to pull in data from
other sources (Foursquare, Twitter, etc.) the code in `map.js` should
still work.

#### `distance.js`

This component will expose you to prototypes in JavaScript. You should modify the JavaScript native object `Number` so that it has two new methods. One of those methods should pretty-print long numbers with commas (e.g. it would convert 12000 to 12,000). The other should convert numbers from degrees to radians.

The other function you should write in this file is `distanceFormula()` that will take two
geographic coordinates and return the distance between them. For this
function, use an approximation of the Haversine formula. This formula
gives you the distance over the curvature of the Earth that it would
take to travel between the points. You may use external resources to
help implement this function. Your solution must be within 5% accuracy
against the solution function we have written to get full points. The
idea here is that we want a good approximation of the distance between
two points, but you do not need to be incredibly precise.
Once you have sanity-checked this function, move on.

#### `typeahead.js`
In this file you will implement the typeahead feature described above.

Simple Test Cases:

* `Si` -> `Otto Sipe`
* `oTt` -> `Otto Sipe`
* `ot si` -> `Otto Sipe`
* `ott s` -> `Smith Otto`

#### `style.css` && `channel.html` && `index.html`

Don't touch unless you are extending the project.

## How to Deploy

You will put all these files into a directory on your local machine. In this directory, enter this command `python -m SimpleHTTPServer 8000`, where `8000` is the PORTNUMBER. This will spin up a server on PORTNUMBER that will serve static files. You should then be able to view `http://localhost:8000/`. Please use the port number `8000` by default. If you really want to use another port number, please specify in `Readme.md`. 

We recommend that you run on LOCALHOST on your local computer. Please **DO NOT** use your eecs485 server for this project, because it will require you to setup your Facebook Developer account differently.

WINDOWS USERS: Install *just* python. Run `python -m http.server PORTNUMBER` from the command line and you will be all set!

## Grading

We will grade on the following four parts: 

1. A working website that connects to Facebook (20 Points) 
    - Login: click "Login", you should be able to login to facebook. After logging in, hide the "Login" button and show the "Logout" button. 
    - Logout: click  "Logout", you should be able to logout facebook. After logging out, hide the "Logout" button and show the "Login" button. 
    - Spinner: show the spinner when anything is loading.
2. Typeahead (35 Points)
    - Dropdown list: when type something in the search box, the dropdown list shows a list of friend names. 
    - Typeahead: when type any new characters in the search box, the content in the dropdown list changes accordingly. 
    - Correctness: the typeahead function should work properly for the prefixes searching, and the friend names returned should be ranked alphabetically. For example, `Jessica Jiang` should come before `Jessica Xu` and `Jessica Xu` should come before `Matt Jiang`. 
    - Profile pic: when click a friend in the dropdown list, show the profile pic of the currect selected friend at the bottom (right before miles). 
3. Rendered Path on Google Map (25 Points) 
    - When a user logs in, show this login user's places as pins with polylines on Google Map. 
    - When a user logs out, clear all pins and polylines on Google Map. 
    - The function should work whenever a new user logs in. 
4. Miles calculator (20 Points)
    - When a user logs in, show the calculated miles of the places at the bottom. Also, 
please separate every three digits using a comma. For example, if the miles is 12517, please show `12,517`. 
    - When a user logs out,  clear the miles. 
    - The function should work whenever a new user logs in. 

We provided the skeleton code framework for you, and your job is to fill all the empty functions in the repo. 
Of course, feel free to add files to the repo. You can change anything as long as it works!

**[An important notice]**: Please do use Github to keep track of your coding history. We will check your commit history on github to make sure. If you do not use Github, we will take off 10 points from the total you will get. 

For grading this project, we will clone your Github repo to our local machine. The code sitting in your pa3 repo will be what we clone. The grade is based on whether the above mentioned four parts work or not. If all of the four functions work, you have nothing to worry about!

Finally, your README.md file (put it in the root directory of your project dir) should contain the following: 

* Group number. 
* Info of all the group members (including name , unique name,  "agreed upon" contributions)
* Details about the extra credit parts you implement.  
* Anything you want us to know, e.g. how many late days you use.
 


## Extra Credit (10 Points Maximum)

Extend this project in a new and interesting way! Have fun with it - be creative.

### Examples

Each of the following tasks worths 4 points, and the maximum you can earn for extra credits is 10 points. 

* Bring in another API ([Twitter](https://dev.twitter.com/docs/api/1.1) of [Foursquare](https://developer.foursquare.com/docs/explore) anyone?) and do something unique with that data
* Fancy map overlays, transitions, and stunning visual effects
* Display other interesting aggregate statistics about users
* Only show Facebook friend updates if they occur within a user-provided polytope

