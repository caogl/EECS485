CREATE TABLE Photo (
sequencenum int NOT NULL,
url varchar(255),
filename varchar(10),
caption varchar(255),
datetaken datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY (sequencenum)
);


LOAD XML LOCAL INFILE 'search.xml'
into table Photo
ROWS identified by '<photo>';
