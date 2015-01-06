#include <iostream>
#include <fstream>
#include <vector>
#include <string>
#include <cstdlib>
#include <map>
#include <set>
#include <stdio.h>
#include <stdlib.h>
#include <getopt.h>
#include <unordered_map>
#include <algorithm>
#include <unordered_set>
#include <cctype>

using namespace std;


struct myclass {
  bool operator() (string a,string b) { 
  transform(a.begin(), a.end(), a.begin(), ::tolower);
  transform(b.begin(), b.end(), b.begin(), ::tolower);
  return (a<b);
  }
} myobject;

struct pageInfo{
     unordered_set<int> pointsTo;
     unordered_set<int> pointedBy;
     double hub_prev;
     double auth_prev;
     double hub_cur;
     double auth_cur;
     double norm_auth;
     double norm_hub;
};

int main(int argc, char ** argv){
int k;
double converge;
bool kIterate = false;

if(argv[2][1] == 'k'){
     k= atoi(argv[3]);
     kIterate = true;
}
else {
     converge = atof(argv[3]);
}
if (argc != 8){
     cout << "Incorrect Command Line"<< endl;
     exit(EXIT_FAILURE);
}

int h = atoi(argv[1]); 
string query = argv[4];
string invertedIndex = argv[6];
string wiki_graph = argv[5];
string hitsOutput = argv[7];

ifstream ifGraph;
ifstream ifInvInd;

unordered_set <string> queryWords;
string delimiter=" ";
string word;
string wordLower;


size_t laspos = query.find_first_not_of(delimiter,0);
size_t pos = query.find_first_of(delimiter,laspos);
while(laspos!=string::npos || pos != string::npos)
{
     word = query.substr(laspos,pos-laspos);
     string wordLower = word;
     transform(wordLower.begin(), wordLower.end(), wordLower.begin(), ::tolower);
     queryWords.insert(wordLower);
     laspos = query.find_first_not_of(delimiter,pos);
     pos = query.find_first_of(delimiter,laspos);
}


map<int, unordered_set<string>> firstMap;


/*-------------GO THROUGH INVERTED INDEX ----------------*/
ifInvInd.open(invertedIndex, ifstream::in);
string term;
int docID;

string line;

while(getline(ifInvInd, line)){

     pos = line.find(delimiter);
     term = line.substr(0, pos);
     string documentID = line.substr(pos, line.size());
     docID = stoi(documentID);
     transform(term.begin(), term.end(), term.begin(), ::tolower);

     auto itQuery = queryWords.find(term);
     if(itQuery != queryWords.end()) {           
          auto it = firstMap.find(docID);
          //if first term in query
          if (it == firstMap.end() ){
               unordered_set<string> tmp;
               tmp.insert(term);
               firstMap.insert(pair<int, unordered_set<string>>(docID, tmp));
            
          }
          else if (it != firstMap.end()){
         
               it->second.insert(term);  
          } 
          
     }
     else continue;

}

ifInvInd.close();
vector <int> toErase;
for (auto it = firstMap.begin(); it != firstMap.end(); it++) {
    if (it->second.size() != queryWords.size()){
          toErase.push_back(it->first);
     }
}
for(int i = 0; i < toErase.size(); i++){
firstMap.erase(toErase[i]);
}



//maximum number in seed set is h
map<int, set<int> > seedSet;
int i = 0;
for(auto it = firstMap.begin(); it!= firstMap.end(); it++) {
     if(i == h) break;
     set<int> tmp;
     seedSet.insert(pair<int, set<int> >(it->first, tmp));
     i++;
}




/*
for(auto it = firstMap.begin(); it != firstMap.end(); it++){
cout << it->first<<" ";
     for(auto it2 = it->second.begin(); it2 != it->second.end(); it2++){
     cout << *it2 << " ";
     }
cout << endl;
}
*/
/*
for(auto it = seedSet.begin(); it != seedSet.end(); it++){
cout << it->first<<" "<< it->second<<endl;
}
*/

/*-------------GO THROUGH GRAPH------------------------*/

set<int> baseSet;

ifGraph.open(wiki_graph, ifstream::in);

int numNode;
getline(ifGraph, line);
size_t spacePos;
spacePos = line.find_first_of(delimiter,0);
string numN = line.substr(spacePos + 1, line.size()-spacePos-1);  
numNode = stoi(numN);

//get to Arcs
for(int i= 0; i < numNode; i++) {
     getline(ifGraph, line);
}
int numDirEdges;
getline(ifGraph, line);
spacePos = line.find_first_of(delimiter,0);
string numD = line.substr(spacePos + 1, line.size()-spacePos-1); 
numDirEdges = stoi(numD);

while(getline(ifGraph, line)){
     spacePos = line.find_first_of(delimiter,0);
     string documentID = line.substr(0, spacePos);   
     string documentID2 = line.substr(spacePos+1, line.size()-spacePos-1);
     docID = stoi(documentID);
     int docID2 = stoi(documentID2);

      
     auto itSeed1 = seedSet.find(docID);
     auto itSeed2 = seedSet.find(docID2);
     
     if(itSeed1 != seedSet.end() and itSeed2 == seedSet.end()){
          if( seedSet.find(docID2) == seedSet.end()){ 
              
               itSeed1->second.insert(docID2);
         
          }
     }
     //if element in seed is pointed to by another element 
      else if(itSeed2 != seedSet.end() and itSeed1 == seedSet.end()){
          if( seedSet.find(docID) == seedSet.end() ){
             
               itSeed2->second.insert(docID);
             
           }
     }
     
}
//put seed set in base set

/*-----First Version----*/

for(auto it = seedSet.begin(); it != seedSet.end(); it++) {
     int i =0;

     for(auto it2 = it->second.begin(); it2 != it->second.end(); it2++){
     
          baseSet.insert(*it2);
          i++;
          
          if(i == 50){
        
           break;
           }
      
          
     }
     
}

/*-------Second Version------*/

/*
for(auto it = seedSet.begin(); it != seedSet.end(); it++) {
     int i = 0;
    
     for(auto it2 = it->second.begin(); it2 != it->second.end();){
     
          if(baseSet.find(*it2) == baseSet.end()){

               baseSet.insert(*it2);
               i++;
               
               if(i == 50 ) {
               break;        
               }
            } 
  
          it2++;
          if(it2 == it->second.end()) break;
  
     }
     

}

*/
for(auto it = seedSet.begin(); it != seedSet.end(); it++) {
     baseSet.insert(it->first);
}

//for(auto it = baseSet.begin(); it != baseSet.end(); it++) cout << *it<<endl;

//cout << baseSet.size()<<endl;


/*
for(auto it = seedSet.begin(); it != seedSet.end(); it++){
cout << it->first << " "<<it->second.size()<<endl;
}
*/


/*
for(auto it = baseSet.begin(); it != baseSet.end(); it++){
cout << *it<<endl;
}
*/

ifGraph.close();

map<int, struct pageInfo> pageData; 

/*---------SAVE GRAPH INFORMATION FOR BASE SET---------------*/
ifGraph.open(wiki_graph, ifstream::in);
getline(ifGraph, line);
spacePos = line.find_first_of(delimiter,0);
numN = line.substr(spacePos + 1, line.size()-spacePos-1);  
numNode = stoi(numN);
//get to Arcs
for(int i= 0; i < numNode; i++) {
     getline(ifGraph, line);
}
getline(ifGraph, line);
spacePos = line.find_first_of(delimiter,0);
numD = line.substr(spacePos + 1, line.size()-spacePos-1); 
numDirEdges = stoi(numD);

while(getline(ifGraph, line)){
     spacePos = line.find_first_of(delimiter,0);
     string documentID = line.substr(0, spacePos);   
     string documentID2 = line.substr(spacePos+1, line.size()-spacePos-1);
     docID = stoi(documentID);
     int docID2 = stoi(documentID2); 
     
     auto itSeed1 = baseSet.find(docID);
     auto itSeed2 = baseSet.find(docID2);
     
     if(docID == docID2) continue;
     
     if(itSeed1 != baseSet.end() and itSeed2 != baseSet.end()){
          auto itData = pageData.find(docID);
          auto itData2 = pageData.find(docID2);
          if(itData != pageData.end()){
               itData->second.pointsTo.insert(docID2);
          }
          else{
               unordered_set<int> tmp_points;
               unordered_set<int> tmp_pointed;
               tmp_points.insert(docID2);
               struct pageInfo tmp_info ={tmp_points, tmp_pointed, 1, 1};
               pageData.insert(pair<int, struct pageInfo>(docID, tmp_info));
          
          }
          if(itData2 != pageData.end()){
               itData2->second.pointedBy.insert(docID);
          }
          else{
               unordered_set<int> tmp_points;
               unordered_set<int> tmp_pointed;
               tmp_pointed.insert(docID);
               struct pageInfo tmp_info = {tmp_points, tmp_pointed, 1, 1};
               pageData.insert(pair<int, struct pageInfo>(docID2, tmp_info));
          }
          
     }
     
}

ifGraph.close();

/*
int j = 0;
for(auto it = pageData.begin(); it != pageData.end(); it++){
cout << j << " "<<it->first<<endl;
cout << " pointsTo"<< endl;
     for(auto it2 = it->second.pointsTo.begin(); it2 != it->second.pointsTo.end(); it2++){
          cout << *it2 << " ";
     }
     cout << endl;
cout <<"pointedBy" << endl;
     for(auto it2 = it->second.pointedBy.begin(); it2 != it->second.pointedBy.end(); it2++){
          cout << *it2 << " ";
     }
cout << endl;
cout <<endl;
j++;
}
*/

/*---------------ITERATE-----------------------*/


if(kIterate){
     //for k iterations
     for(int i = 0; i <k; i++) {
          //for every element in base set
          for(auto it = pageData.begin(); it != pageData.end(); it++) {
               double cur_auth= 0;
               double cur_hub = 0;
               //hub scores
               
               for(auto it2 = it->second.pointsTo.begin(); it2!= it->second.pointsTo.end(); it2++){
                    auto it3 = pageData.find(*it2);
                    cur_hub += it3->second.auth_prev;
               }
             
               //authority scores
               for(auto it4 = it->second.pointedBy.begin(); it4 != it->second.pointedBy.end(); it4++){
                    auto it5 = pageData.find(*it4);
                    cur_auth += it5->second.hub_prev;
               }
               
               
               
               if(it->second.pointsTo.empty()){
                    it->second.hub_cur = 0;
               }
               else {
                    it->second.hub_cur = cur_hub;
               }
               if(it->second.pointedBy.empty()){
                    it->second.auth_cur = 0;
               }
               else{
                    it->second.auth_cur = cur_auth;
               }
        
           }
           
         //hub normalizer
         double hubSum = 0;     
         for(auto it6 = pageData.begin(); it6 != pageData.end(); it6++){
               hubSum += pow((it6->second.hub_cur), 2.0);
         }
         double hubNorm = sqrt(hubSum);
         //authority normalizer 
         double authSum = 0;
         for(auto it7 = pageData.begin(); it7 != pageData.end(); it7++){
               authSum += pow((it7->second.auth_cur), 2.0);
         }
         double authNorm = sqrt(authSum);
         
         for(auto it = pageData.begin(); it!= pageData.end(); it++){
               it->second.norm_hub = it->second.hub_cur / hubNorm;
               it->second.norm_auth = it->second.auth_cur/authNorm;                    
         }
           
            
          // make current previous before next iteration
          for(auto it= pageData.begin(); it != pageData.end(); it++){
               it->second.hub_prev = it->second.norm_hub;
               it->second.auth_prev = it->second.norm_auth;
          }


     }


}
else {

     while(true){
          //for every element in base set
          for(auto it = pageData.begin(); it != pageData.end(); it++) {
               double cur_auth= 0;
               double cur_hub = 0;
               //hub scores
               
               for(auto it2 = it->second.pointsTo.begin(); it2!= it->second.pointsTo.end(); it2++){
                    auto it3 = pageData.find(*it2);
                    cur_hub += it3->second.auth_prev;
               }
             
               //authority scores
               for(auto it4 = it->second.pointedBy.begin(); it4 != it->second.pointedBy.end(); it4++){
                    auto it5 = pageData.find(*it4);
                    cur_auth += it5->second.hub_prev;
               }
               
               
               
               if(it->second.pointsTo.empty()){
                    it->second.hub_cur = 0;
               }
               else {
                    it->second.hub_cur = cur_hub;
               }
               if(it->second.pointedBy.empty()){
                    it->second.auth_cur = 0;
               }
               else{
                    it->second.auth_cur = cur_auth;
               }
        
          }
           
         //hub normalizer
         double hubSum = 0;     
         for(auto it6 = pageData.begin(); it6 != pageData.end(); it6++){
               hubSum += pow((it6->second.hub_cur), 2.0);
         }
         double hubNorm = sqrt(hubSum);
         //authority normalizer 
         double authSum = 0;
         for(auto it7 = pageData.begin(); it7 != pageData.end(); it7++){
               authSum += pow((it7->second.auth_cur), 2.0);
         }
         double authNorm = sqrt(authSum);
         
         for(auto it = pageData.begin(); it!= pageData.end(); it++){
               it->second.norm_hub = it->second.hub_cur / hubNorm;
               it->second.norm_auth = it->second.auth_cur/authNorm;                    
         }
           
            
         
          
          //stopping Criteria 
          bool stop = true;
          for(auto it = pageData.begin(); it != pageData.end(); it++){
               double xAuth = abs(it->second.norm_auth - it->second.auth_prev)/(it->second.auth_prev);                      
               double xHub = abs(it->second.norm_hub - it->second.hub_prev)/(it->second.hub_prev);  
               if(xAuth > converge)   stop = false;
               if(xHub > converge) stop = false;
          }
          if(stop == true) break;
     
           // make current previous before next iteration
          for(auto it= pageData.begin(); it != pageData.end(); it++){
               it->second.hub_prev = it->second.norm_hub;
               it->second.auth_prev = it->second.norm_auth;
          }
     
   
     }




}


/*---------------OUTPUT TO FILE---------------*/
ofstream outFile;
outFile.open(hitsOutput);

for(auto it = pageData.begin(); it != pageData.end(); it++){
outFile << it->first <<","<< it->second.norm_hub <<","<< it->second.norm_auth<<endl;
}




outFile.close();






return 0;
}
