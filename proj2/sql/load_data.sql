INSERT INTO User (username, firstname, lastname, password, email) VALUES
('sportslover', 'Paul', 'Walker', 'paulpass93', 'sportslover@hotmail.com'),
('traveler', 'Rebecca', 'Travolta', 'rebeccapass15', 'rebt@explorer.org'), 
('spacejunkie', 'Bob', 'Spacey', 'bob1pass', 'bspace@spacejunkies.net');

INSERT INTO Album (title, created , lastupdated, username, access) VALUES
('I love sports', NOW(), NOW(), 'sportslover', 'public'),
('I love football', NOW(), NOW(), 'sportslover', 'public'),
('Around the World', NOW(), NOW(), 'traveler', 'public'),
('Cool Space Shots', NOW(), NOW(), 'spacejunkie', 'private'); 

INSERT INTO AlbumAccess( albumid, username) VALUES
( 4, 'traveler');


INSERT INTO Photo (picid, url, format, date) VALUES
('football_s1', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/football_s1' , 'jpg', NOW()), 
('football_s2', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/football_s2' , 'jpg', NOW()),
('football_s3', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/football_s3' , 'jpg', NOW()),
('football_s4', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/football_s4' , 'jpg', NOW()),
('space_EagleNebula', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/space_EagleNebula' , 'jpg', NOW()),
('space_GalaxyCollision', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/space_GalaxyCollision' , 'jpg', NOW()),
('space_HelixNebula', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/space_HelixNebula' , 'jpg', NOW()), 
('space_MilkyWay', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/space_MilkyWay' , 'jpg', NOW()), 
('space_OrionNebula', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/space_OrionNebula' , 'jpg', NOW()), 
('sports_s1', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s1' , 'jpg', NOW()), 
('sports_s2', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s2' , 'jpg', NOW()), 
('sports_s3', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s3' , 'jpg', NOW()), 
('sports_s4', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s4' , 'jpg', NOW()), 
('sports_s5', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s5' , 'jpg', NOW()), 
('sports_s6', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s6' , 'jpg', NOW()), 
('sports_s7', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s7' , 'jpg', NOW()), 
('sports_s8', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/sports_s8' , 'jpg', NOW()), 
('world_EiffelTower', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_EiffelTower' , 'jpg', NOW()),
('world_firenze', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_firenze' , 'jpg', NOW()), 
('world_GreatWall', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_GreatWall' , 'jpg', NOW()), 
('world_Isfahan', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_Isfahan' , 'jpg', NOW()), 
('world_Istanbul', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_Istanbul' , 'jpg', NOW()), 
('world_Persepolis', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_Persepolis' , 'jpg', NOW()), 
('world_Reykjavik', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_Reykjavik' , 'jpg', NOW()), 
('world_Seoul', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_Seoul' , 'jpg', NOW()), 
('world_Stonehenge', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_Stonehenge' , 'jpg', NOW()), 
('world_TajMahal', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_TajMahal' , 'jpg', NOW()), 
('world_TelAviv', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_TelAviv' , 'jpg', NOW()), 
('world_tokyo', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_tokyo' , 'jpg', NOW()), 
('world_WashingtonDC', 'http://eecs485-06.eecs.umich.edu:5654/ymneig/pa1/php/html/static/pictures/world_WashingtonDC' , 'jpg', NOW());

INSERT INTO Contain (albumid, picid, caption, sequencenum)  VALUES
(1, 'sports_s1', 'sports_s1', 313 ), 
(1, 'sports_s2', 'sports_s2' , 314), 
(1, 'sports_s3', 'sports_s3', 315 ), 
(1, 'sports_s4', 'sports_s4', 316), 
(1, 'sports_s5', 'sports_s5', 317 ), 
(1, 'sports_s6', 'sports_s6', 318 ), 
(1, 'sports_s7', 'sports_s7', 319 ), 
(1, 'sports_s8', 'sports_s8' , 320), 
(2, 'football_s1', 'football_s1' , 321), 
(2, 'football_s2', 'football_s2', 322 ), 
(2, 'football_s3', 'football_s3', 323 ), 
(2, 'football_s4', 'football_s4', 324 ), 
(3, 'world_EiffelTower', 'world_EiffelTower', 325),
(3, 'world_firenze', 'world_firenze', 326), 
(3, 'world_GreatWall', 'world_GreatWall', 327), 
(3, 'world_Isfahan', 'world_Isfahan', 328), 
(3, 'world_Istanbul', 'world_Istanbul', 329), 
(3, 'world_Persepolis', 'world_Persepolis', 330), 
(3, 'world_Reykjavik', 'world_Reykjavik', 331), 
(3, 'world_Seoul', 'world_Seoul', 332), 
(3, 'world_Stonehenge', 'world_Stonehenge', 333), 
(3, 'world_TajMahal', 'world_TajMahal', 334), 
(3, 'world_TelAviv', 'world_TelAviv', 335), 
(3, 'world_tokyo', 'world_tokyo', 336), 
(3, 'world_WashingtonDC', 'world_WashingtonDC', 337), 
(4, 'space_EagleNebula', 'space_EagleNebula', 338), 
(4, 'space_GalaxyCollision', 'space_GalaxyCollision', 339),
(4, 'space_HelixNebula', 'space_HelixNebula', 340), 
(4, 'space_MilkyWay', 'space_MilkyWay', 350), 
(4, 'space_OrionNebula', 'space_OrionNebula', 360);

