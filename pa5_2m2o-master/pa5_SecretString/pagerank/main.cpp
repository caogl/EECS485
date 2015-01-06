#include<iostream>
#include<sstream>
#include<fstream>
#include<cstring>
#include<cmath>
#include<unordered_set>
#include<unordered_map>
using namespace std;

void iterationMode(double p, int numIter, ifstream& infile, ofstream& outfile);
void criteriaMode(double p, double criteria, ifstream& infile, ofstream& outfile);

int main(int argc, char *argv[])
{
	if(argc<6)
	{
		cerr<<"Usage: <dvalue> (-k <numiterations> | -converge <maxchange>) inputnetfile outputfile"<<endl;
		exit(1);
	}

	double p=atof(argv[1]);
	
	const char* in=argv[4];
	const char* out=argv[5];
	ifstream infile(in);
	ofstream outfile(out);
	
	char mode1[]="-k";
	char mode2[]="-converge";
	if(!strcmp(argv[2], mode1))
	{
		int numIter=atoi(argv[3]);
		iterationMode(p, numIter, infile, outfile);
	}
	else if(!strcmp(argv[2], mode2))
	{
		double criteria=atof(argv[3]);
		criteriaMode(p, criteria, infile, outfile);
	}

	return 0;
}


void criteriaMode(double p, double criteria, ifstream& infile, ofstream& outfile)
{
	unordered_map<int, double> rank; // the rank of the node 
	unordered_map<int, double> rankTmp; // the rank in the computation process
	unordered_map<int, unordered_set<int> > incomingNode; // the node that can directly go to this node
	unordered_map<int, int> outgoingNum; // the number of outgoing connections for each node
	unordered_set<int> sinkNode; // node that does not point to any other node

	string line;
	getline(infile, line);
	istringstream iss1(line);
	string str1;
	int num_node;
	iss1>>str1>>num_node;
	double init_rank=1/(double)num_node;

	int index=0; 
	int nodeId;
	while(getline(infile, line) && index<num_node)
	{
		istringstream iss(line);
		iss>>nodeId;
		rank.insert(make_pair(nodeId, init_rank));
		rankTmp.insert(make_pair(nodeId, init_rank));

		sinkNode.insert(nodeId);
		index++;
	}
	//rankTmp=rank;
	
	int dest;
	while(getline(infile, line))
	{
		istringstream iss(line);
		iss>>nodeId>>dest;
		if(nodeId!=dest) // not self cycle
		{
			sinkNode.erase(nodeId);

			// update the incoming node
			if(incomingNode.find(dest)==incomingNode.end())
			{
				unordered_set<int> hashSetTmp;
				hashSetTmp.insert(nodeId);
				incomingNode[dest]=hashSetTmp;
			}
			else
			{
				incomingNode[dest].insert(nodeId);
			}
	
			// update the outgoing number
			if(outgoingNum.find(nodeId)==outgoingNum.end())
			{
				outgoingNum[nodeId]=1;
			}
			else
			{
				outgoingNum[nodeId]++;
			}
		}
	}
	
	double damplingTerm=(1-p)/(double)num_node;

	while(true)
	{
		// the second term in d(...+...), sinknode term
		double sinkSum=0;
		for(auto itr=sinkNode.begin(); itr!=sinkNode.end(); itr++)
		{
			sinkSum+=rank[*itr];
		}	
		sinkSum/=(double)(num_node-1);

		// update rankTmp
		for(auto itr1=rankTmp.begin(); itr1!=rankTmp.end(); itr1++)
		{
			double result=0;

			// add the rank from the sinkNode
			if(sinkNode.find(itr1->first)!=sinkNode.end())
			{
				result-=(itr1->second)/(double)(num_node-1);
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

		// check break criteria
		bool toBreak=true;
		for(auto itr=rank.begin(); itr!=rank.end(); itr++)
		{
			if((fabs(itr->second-rankTmp[itr->first])/itr->second)>criteria)
			{
				toBreak=false;
				break;
			}
		}

		if(toBreak)
			break;

		// exchange
		rank=rankTmp;		
	}

	for(auto itr=rank.begin(); itr!=rank.end(); itr++)
	{
		outfile<<itr->first<<","<<itr->second<<endl;
	}
	
}

void iterationMode(double p, int numIter, ifstream& infile, ofstream& outfile)
{
	unordered_map<int, double> rank; // the rank of the node 
	unordered_map<int, double> rankTmp; // the rank in the computation process
	unordered_map<int, unordered_set<int> > incomingNode; // the node that can directly go to this node
	unordered_map<int, int> outgoingNum; // the number of outgoing connections for each node
	unordered_set<int> sinkNode; // node that does not point to any other node

	string line;
	getline(infile, line);
	istringstream iss1(line);
	string str1;
	int num_node;
	iss1>>str1>>num_node;
	double init_rank=1/(double)num_node;

	int index=0; 
	int nodeId;
	while(getline(infile, line) && index<num_node)
	{
		istringstream iss(line);
		iss>>nodeId;
		rank.insert(make_pair(nodeId, init_rank));
		rankTmp.insert(make_pair(nodeId, init_rank));

		sinkNode.insert(nodeId);
		index++;
	}
	//rankTmp=rank;
	
	int dest;
	while(getline(infile, line))
	{
		istringstream iss(line);
		iss>>nodeId>>dest;
		if(nodeId!=dest) // not self cycle
		{
			sinkNode.erase(nodeId);

			// update the incoming node
			if(incomingNode.find(dest)==incomingNode.end())
			{
				unordered_set<int> hashSetTmp;
				hashSetTmp.insert(nodeId);
				incomingNode[dest]=hashSetTmp;
			}
			else
			{
				incomingNode[dest].insert(nodeId);
			}
	
			// update the outgoing number
			if(outgoingNum.find(nodeId)==outgoingNum.end())
			{
				outgoingNum[nodeId]=1;
			}
			else
			{
				outgoingNum[nodeId]++;
			}
		}
	}
	
	double damplingTerm=(1-p)/(double)num_node;


	for(int k=0; k<numIter; k++) // number of iterations
	{
		// the second term in d(...+...), sinknode term

		cout<<k<<endl;//------------------------------------>keep track of the time in each loop

		double sinkSum=0;
		for(auto itr=sinkNode.begin(); itr!=sinkNode.end(); itr++)
		{
			sinkSum+=rank[*itr];
		}	
		sinkSum/=(double)(num_node-1);

		// update rankTmp
		for(auto itr1=rankTmp.begin(); itr1!=rankTmp.end(); itr1++)
		{
			double result=0;

			// add the rank from the sinkNode
			if(sinkNode.find(itr1->first)!=sinkNode.end())
			{
				result-=(itr1->second)/(double)(num_node-1);
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

	for(auto itr=rank.begin(); itr!=rank.end(); itr++)
	{
		outfile<<itr->first<<","<<itr->second<<endl;
	}
}
