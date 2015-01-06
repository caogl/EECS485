#Group Name:
	Group 54
#Members & contruibution:
	astinlul 33%
	caogl 33%
	yinghe 34%

#the dataset directory is as follows:
	./hadoop-example/dataset
	notice that the stopword file is also in this directory

#Our front end web address is:
	http://eecs485-06.eecs.umich.edu:5654/ymneig/pa6/search

###Note:(other details)
        need to make the web server runing by going to the server directory address:
	/var/www/html/group54/hadoop-example/mysrc
	then type ./ServerRun
	then begin the query of the web interface
	the code for this the server in c++ is in this directory and if what to make again, please change MakefileC++ to Makefile then type make in bash command

#Structure of the githup root
        
        hadoop-example: contains the code for building indexer using Hadoop framework. Most code can be found in /mysrc folder

        PageRank:  contains the code for calculating pageRank of the docs. We put the mining.edges.xml into the folder for convience

        html: all the code for the web interface

        eecs485pa6inv.sh: bash script for calculating inverted index with tfidf. the result will be found under a new folder called "invoutput" under the root. The file is called part-r-00000

        eecs485pa6pr.sh: bash script for calculating pagerank. the result will be found under a new folder called "proutput". The file is called proutput.txt

