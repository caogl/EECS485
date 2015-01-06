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
    void init(std::ifstream& infile1, std::ifstream& infile2);
    void process_query(const std::string& query, std::vector<Query_hit>& hits, double w);
private:
    string removePunctuation(string& word); // remove puntuations and convert word to lower case
    unordered_map<string, unordered_map<int, double> > wordTfIdf; // the key is word, the value is a <doc_id, tf-idf> pair
    unordered_map<int, double> pageRank; // <page_id, page_rank> pair
    unordered_set<string> stopWords;
};

#endif
