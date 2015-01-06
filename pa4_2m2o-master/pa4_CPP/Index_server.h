#ifndef INDEX_SERVER_H
#define INDEX_SERVER_H

#include <iosfwd>
#include <stdint.h>
#include <string>
#include <vector>
#include <string>
#include <iostream>
#include <unordered_map>
#include <unordered_set>
#include <cmath>
#include <algorithm>

using std::sort;
using std::unordered_set;
using std::unordered_map;
using std::cin;
using std::cout;
using std::endl;
using std::vector;
using std::string;
using std::stod;
using std::to_string;

struct Query_hit {
    Query_hit(const char *id_, double score_)
        : id(id_), score(score_)
        {}

    const char *id;
    double score;
};

struct termInfo
{
    unordered_map<int, int> docInfo; // the key is the doc id, value is the occurrence of the term in this file
    double idf; // the idf of this term
};

// functor to rank the hits
struct hitsComp
{
	bool operator()(const Query_hit& Q1, const Query_hit& Q2)
	{
		return (Q1.score>Q2.score);
	}
};

class Index_server {
public:
    void run(int port);

    // Methods that students must implement.
    void init(std::ifstream& infile);
    void process_query(const std::string& query, std::vector<Query_hit>& hits);
private:
    string removePunctuation(string& word); // remove puntuations and convert word to lower case
    unordered_map<int, double> normFac; // the key is docId, value is its normalizing factor
    unordered_map<string, termInfo> termStat; // the key is term, the value is term information namely, the idf, doc_id that contains this term and how many time this term appears in doc_id;
    unordered_set<string> stopWords;
};

#endif
