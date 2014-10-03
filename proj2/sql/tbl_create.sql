CREATE TABLE User (
username varchar(20) NOT NULL, 
firstname varchar(20), 
lastname varchar(20),
password varchar(20),
email varchar(40),
PRIMARY KEY (username)
);

CREATE TABLE Album (
albumid int NOT NULL AUTO_INCREMENT, 
title varchar(50),
created datetime NOT NULL default '0000-00-00 00:00:00',
lastupdated datetime NOT NULL default '0000-00-00 00:00:00', 
username varchar(20),
access varchar(10),
CONSTRAINT chk_access CHECK (access='public' OR access='private'),
PRIMARY KEY (albumid),
FOREIGN KEY (username) REFERENCES User(username)
);

CREATE TABLE Photo (
picid varchar(40) NOT NULL,
url varchar(255),
format char(3),
date datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY (picid)
);

CREATE TABLE Contain (
albumid int NOT NULL, 
picid varchar(40) NOT NULL,
caption varchar(255),
sequencenum int NOT NULL,
PRIMARY KEY (albumid, picid),
FOREIGN KEY (albumid) REFERENCES Album(albumid), 
FOREIGN KEY(picid) REFERENCES Photo(picid)
ON DELETE CASCADE
);

CREATE TABLE AlbumAccess (
albumid int NOT NULL, 
username varchar(20) NOT NULL,
FOREIGN KEY (albumid) REFERENCES Album(albumid),
FOREIGN KEY (username) REFERENCES User(username),
PRIMARY KEY (albumid, username)
)

