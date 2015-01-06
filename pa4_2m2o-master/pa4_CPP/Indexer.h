#ifndef INDEXER_H
#define INDEXER_H
#include <unordered_map>
#include <unordered_set>
#include <iosfwd>
#include <string>
#include <vector>
#include <iostream>
#include <fstream>
#include <cmath>

using std::ifstream;
using std::ostream;
using std::endl;
using std::cout;
using std::string;
using std::unordered_map;
using std::unordered_set;
using std::vector;


struct termInfo
{
	int totalOccurrence;
	std::vector<int> docID; // the docs contain this term	
};

class Indexer 
{
public:
    void index(std::ifstream& content, std::ostream& outfile);
    string removePunctuation(string& word); // remove punctuations and convert to lower cases
private:
    unordered_set<string> stopWords;
};

#endif
