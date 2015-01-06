#include<iostream>
#include<stdio.h>
#include<iomanip>
#include<sstream>
#include<fstream>
#include<cstring>
#include<vector>
#include<cmath>
#include<unordered_set>
#include<unordered_map>
using namespace std;

void iterationMode(double p, int numIter, string in, string out);

int main(int argc, char *argv[])
{
	if(argc<5)
	{
		cerr<<"Usage: dvalue itenumber inputnetfile outputfile"<<endl;
		exit(1);
	}

	double p=atof(argv[1]);
	int numIter=atoi(argv[2]);	

	string in(argv[3]);
	string out(argv[4]);
	
	iterationMode(p, numIter, in, out);

	return 0;
}


void iterationMode(double p, int numIter, string in, string out)
{
	ifstream infile(in);

	unordered_map<int, double> rank; // the rank of the node 
	unordered_map<int, double> rankTmp; // the rank in the computation process
	unordered_map<int, unordered_set<int> > incomingNode; // the node that can directly go to this node
	unordered_map<int, int> outgoingNum; // the number of outgoing connections for each node
	unordered_set<int> sinkNode; // node that does not point to any other node

	unordered_set<int> normalNode; // node that can direct to at least one node

	string line;

	vector<int> vec;
	while(getline(infile, line))
	{
		int first_pos=line.find_first_of(">", 0);
		int last_pos=line.find_last_of("<", line.size()-1);
		if(first_pos>last_pos) // does not contain incoming or outgoing vertex info 
			continue;
		if(vec.size()==0) // if reading the outgoing vertex
		{
			vec.push_back(atoi(line.substr(first_pos+1, last_pos-first_pos-1).c_str()));
			rank.insert(make_pair(vec[0], 1.0));
			normalNode.insert(vec[0]);
		}
		else // if reading destination vertex
		{
			vec.push_back(atoi(line.substr(first_pos+1, last_pos-first_pos-1).c_str()));
			rank.insert(make_pair(vec[1], 1.0));
			sinkNode.insert(vec[1]);
			if(vec[0]!=vec[1]) // not a self cycle
			{
				// update the incoming node
				if(incomingNode.find(vec[1])==incomingNode.end())
				{
					unordered_set<int> hashSetTmp;
					hashSetTmp.insert(vec[0]);
					incomingNode[vec[1]]=hashSetTmp;
				}
				else
				{
					incomingNode[vec[1]].insert(vec[0]);
				}
	
				// update the outgoing number
				if(outgoingNum.find(vec[0])==outgoingNum.end())
				{
					outgoingNum[vec[0]]=1;
				}
				else
				{
					outgoingNum[vec[0]]++;
				}
			}
			vec.clear();
		}
	}
	
	for(auto itr=rank.begin(); itr!=rank.end(); itr++)
	{
		itr->second=1/(double)rank.size();
		rankTmp.insert(*itr);
	}
	// delete non-sink node in sinkNode data structure
	for(auto itr=normalNode.begin(); itr!=normalNode.end(); itr++)
		sinkNode.erase(*itr);
	normalNode.clear();

	double damplingTerm=(1-p)/(double)rank.size();

	for(int k=0; k<numIter; k++)
	{
		//cout<<k<<endl;//------------------------------------>keep track of the time in each loop
	
		// the second term in d(...+...), sinknode term
		double sinkSum=0;
		for(auto itr=sinkNode.begin(); itr!=sinkNode.end(); itr++)
		{
			sinkSum+=rank[*itr];
		}	
		sinkSum/=(double)(rank.size()-1);

		// update rankTmp
		for(auto itr1=rankTmp.begin(); itr1!=rankTmp.end(); itr1++)
		{
			double result=0;

			// add the rank from the sinkNode
			if(sinkNode.find(itr1->first)!=sinkNode.end())
			{
				result-=(itr1->second)/(double)(rank.size()-1);
			}
			result+=sinkSum;
			
			// add rank from node has direct connection to it
			if(incomingNode.find(itr1->first)!=incomingNode.end())
			{
				for(auto itr2=incomingNode[itr1->first].begin(); itr2!=incomingNode[itr1->first].end(); itr2++)
				{
					result+=(rank[*itr2]/(double)outgoingNum[*itr2]);
				}	
				//cout<<endl;
			}
			
			result*=p;
			result+=damplingTerm;
			itr1->second=result;
		}	

		// exchange
		rank=rankTmp;	
	}

	// write to file
	FILE * pFile=fopen(out.c_str(), "w");
	for(auto itr=rank.begin(); itr!=rank.end(); itr++)
	{
		fprintf(pFile, "%d, %.4e\n", itr->first, itr->second);
	}
	
}

