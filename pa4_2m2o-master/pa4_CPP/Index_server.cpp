#include "Index_server.h"

#include <cassert>
#include <cstdlib>
#include <cstring>
#include <fstream>
#include <iostream>
#include <pthread.h>
#include <sstream>

#include "mongoose.h"

using std::cerr;
using std::cout;
using std::endl;
using std::ifstream;
using std::ostream;
using std::ostringstream;
using std::string;
using std::vector;

namespace {
    int handle_request(mg_connection *);
    int get_param(const mg_request_info *, const char *, string&);
    string get_param(const mg_request_info *, const char *);
    string to_json(const vector<Query_hit>&);

    ostream& operator<< (ostream&, const Query_hit&);
}

pthread_mutex_t mutex;

// Runs the index server on the supplied port number.
void Index_server::run(int port)
{
    // List of options. Last element must be NULL
    ostringstream port_os;
    port_os << port;
    string ps = port_os.str();
    const char *options[] = {"listening_ports",ps.c_str(),0};

    // Prepare callback structure. We have only one callback, the rest are NULL.
    mg_callbacks callbacks;
    memset(&callbacks, 0, sizeof(callbacks));
    callbacks.begin_request = handle_request;

    // Initialize the global mutex lock that effectively makes this server
    // single-threaded.
    pthread_mutex_init(&mutex, 0);

    // Start the web server
    mg_context *ctx = mg_start(&callbacks, this, options);
    if (!ctx) {
        cerr << "Error starting server." << endl;
        return;
    }

    pthread_exit(0);
}

string Index_server::removePunctuation(string& word)
{
	string str;
	int lasPos=0;
	unsigned int i;
	for(i=0; i<word.size(); i++)
	{
		if(!isalnum(word[i]))
		{
			str=str+word.substr(lasPos, i-lasPos);
			lasPos=i+1;
		}
		else
		{
			word[i]=tolower(word[i]);
		}
	}
	str=str+word.substr(lasPos, i-lasPos);
	return str;
}

// Load index data from the file of the given name.
void Index_server::init(ifstream& infile)
{
    // Fill in this method to load the inverted index from disk.
	string::size_type lasPos, pos;
	string delimiter=" ";
	termInfo termInfoTmp;
	string line;

	while(getline(infile,line))
	{
		lasPos = line.find_first_not_of(delimiter,0);
		pos = line.find_first_of(delimiter,lasPos);
		string word = line.substr(lasPos,pos-lasPos); // the term
		termStat[word]=termInfoTmp;
		lasPos = line.find_first_not_of(delimiter,pos);
		pos = line.find_first_of(delimiter,lasPos);
		double idf = stod(line.substr(lasPos,pos-lasPos)); // idf of the term
		termStat[word].idf=idf;
		lasPos = line.find_first_not_of(delimiter,pos);
		pos = line.find_first_of(delimiter,lasPos);
		// occurrence is useless for computing similarity here

		vector<string> vec; // the vector to hold the remaining strings 
		lasPos = line.find_first_not_of(delimiter,pos);
		pos = line.find_first_of(delimiter,lasPos);		
		
		while(lasPos!=string::npos || pos != string::npos)
		{
			string strTmp = line.substr(lasPos,pos-lasPos);
			vec.push_back(strTmp);
			lasPos = line.find_first_not_of(delimiter,pos);
			pos = line.find_first_of(delimiter,lasPos);	
		}
		
		int numDocs=vec.size()/3; // how many docs that contains this term
		for(int i=0; i<numDocs; i++)
		{
			int docID=atoi(vec[i*3].c_str());
			int appearance=atoi(vec[i*3+1].c_str());
			double docNormFac=stod(vec[i*3+2]);
			normFac[docID]=docNormFac;
			termStat[word].docInfo[docID]=appearance;
		}
	}
	

	vector<string> vec={"a" ,"a's" ,"able" ,"about" ,"above" ,"according" ,"accordingly" ,"across" ,"actually" ,"after" ,"afterwards" ,"again" ,"against" ,"ain't" ,"all" ,"allow" ,"allows" ,"almost" ,"alone" ,"along" ,"already" ,"also" ,"although" ,"always" ,"am" ,"among" ,"amongst" ,"an" ,"and" ,"another" ,"any" ,"anybody" ,"anyhow" ,"anyone" ,"anything" ,"anyway" ,"anyways" ,"anywhere" ,"apart" ,"appear" ,"appreciate" ,"appropriate" ,"are" ,"aren't" ,"around" ,"as" ,"aside" ,"ask" ,"asking" ,"associated" ,"at" ,"available" ,"away" ,"awfully" ,"b" ,"be" ,"became" ,"because" ,"become" ,"becomes" ,"becoming" ,"been" ,"before" ,"beforehand" ,"behind" ,"being" ,"believe" ,"below" ,"beside" ,"besides" ,"best" ,"better" ,"between" ,"beyond" ,"both" ,"brief" ,"but" ,"by" ,"c" ,"c'mon" ,"c's" ,"came" ,"can" ,"can't" ,"cannot" ,"cant" ,"cause" ,"causes" ,"certain" ,"certainly" ,"changes" ,"clearly" ,"co" ,"com" ,"come" ,"comes" ,"concerning" ,"consequently" ,"consider" ,"considering" ,"contain" ,"containing" ,"contains" ,"corresponding" ,"could" ,"couldn't" ,"course" ,"currently" ,"d" ,"definitely" ,"described" ,"despite" ,"did" ,"didn't" ,"different" ,"do" ,"does" ,"doesn't" ,"doing" ,"don't" ,"done" ,"down" ,"downwards" ,"during" ,"e" ,"each" ,"edu" ,"eg" ,"eight" ,"either" ,"else" ,"elsewhere" ,"enough" ,"entirely" ,"especially" ,"et" ,"etc" ,"even" ,"ever" ,"every" ,"everybody" ,"everyone" ,"everything" ,"everywhere" ,"ex" ,"exactly" ,"example" ,"except" ,"f" ,"far" ,"few" ,"fifth" ,"first" ,"five" ,"followed" ,"following" ,"follows" ,"for" ,"former" ,"formerly" ,"forth" ,"four" ,"from" ,"further" ,"furthermore" ,"g" ,"get" ,"gets" ,"getting" ,"given" ,"gives" ,"go" ,"goes" ,"going" ,"gone" ,"got" ,"gotten" ,"greetings" ,"h" ,"had" ,"hadn't" ,"happens" ,"hardly" ,"has" ,"hasn't" ,"have" ,"haven't" ,"having" ,"he" ,"he's" ,"hello" ,"help" ,"hence" ,"her" ,"here" ,"here's" ,"hereafter" ,"hereby" ,"herein" ,"hereupon" ,"hers" ,"herself" ,"hi" ,"him" ,"himself" ,"his" ,"hither" ,"hopefully" ,"how" ,"howbeit" ,"however" ,"i" ,"i'd" ,"i'll" ,"i'm" ,"i've" ,"ie" ,"if" ,"ignored" ,"immediate" ,"in" ,"inasmuch" ,"inc" ,"indeed" ,"indicate" ,"indicated" ,"indicates" ,"inner" ,"insofar" ,"instead" ,"into" ,"inward" ,"is" ,"isn't" ,"it" ,"it'd" ,"it'll" ,"it's" ,"its" ,"itself" ,"j" ,"just" ,"k" ,"keep" ,"keeps" ,"kept" ,"know" ,"knows" ,"known" ,"l" ,"last" ,"lately" ,"later" ,"latter" ,"latterly" ,"least" ,"less" ,"lest" ,"let" ,"let's" ,"like" ,"liked" ,"likely" ,"little" ,"look" ,"looking" ,"looks" ,"ltd" ,"m" ,"mainly" ,"many" ,"may" ,"maybe" ,"me" ,"mean" ,"meanwhile" ,"merely" ,"might" ,"more" ,"moreover" ,"most" ,"mostly" ,"much" ,"must" ,"my" ,"myself" ,"n" ,"name" ,"namely" ,"nd" ,"near" ,"nearly" ,"necessary" ,"need" ,"needs" ,"neither" ,"never" ,"nevertheless" ,"new" ,"next" ,"nine" ,"no" ,"nobody" ,"non" ,"none" ,"noone" ,"nor" ,"normally" ,"not" ,"nothing" ,"novel" ,"now" ,"nowhere" ,"o" ,"obviously" ,"of" ,"off" ,"often" ,"oh" ,"ok" ,"okay" ,"old" ,"on" ,"once" ,"one" ,"ones" ,"only" ,"onto" ,"or" ,"other" ,"others" ,"otherwise" ,"ought" ,"our" ,"ours" ,"ourselves" ,"out" ,"outside" ,"over" ,"overall" ,"own" ,"p" ,"particular" ,"particularly" ,"per" ,"perhaps" ,"placed" ,"please" ,"plus" ,"possible" ,"presumably" ,"probably" ,"provides" ,"q" ,"que" ,"quite" ,"qv" ,"r" ,"rather" ,"rd" ,"re" ,"really" ,"reasonably" ,"regarding" ,"regardless" ,"regards" ,"relatively" ,"respectively" ,"right" ,"s" ,"said" ,"same" ,"saw" ,"say" ,"saying" ,"says" ,"second" ,"secondly" ,"see" ,"seeing" ,"seem" ,"seemed" ,"seeming" ,"seems" ,"seen" ,"self" ,"selves" ,"sensible" ,"sent" ,"serious" ,"seriously" ,"seven" ,"several" ,"shall" ,"she" ,"should" ,"shouldn't" ,"since" ,"six" ,"so" ,"some" ,"somebody" ,"somehow" ,"someone" ,"something" ,"sometime" ,"sometimes" ,"somewhat" ,"somewhere" ,"soon" ,"sorry" ,"specified" ,"specify" ,"specifying" ,"still" ,"sub" ,"such" ,"sup" ,"sure" ,"t" ,"t's" ,"take" ,"taken" ,"tell" ,"tends" ,"th" ,"than" ,"thank" ,"thanks" ,"thanx" ,"that" ,"that's" ,"thats" ,"the" ,"their" ,"theirs" ,"them" ,"themselves" ,"then" ,"thence" ,"there" ,"there's" ,"thereafter" ,"thereby" ,"therefore" ,"therein" ,"theres" ,"thereupon" ,"these" ,"they" ,"they'd" ,"they'll" ,"they're" ,"they've" ,"think" ,"third" ,"this" ,"thorough" ,"thoroughly" ,"those" ,"though" ,"three" ,"through" ,"throughout" ,"thru" ,"thus" ,"to" ,"together" ,"too" ,"took" ,"toward" ,"towards" ,"tried" ,"tries" ,"truly" ,"try" ,"trying" ,"twice" ,"two" ,"u" ,"un" ,"under" ,"unfortunately" ,"unless" ,"unlikely" ,"until" ,"unto" ,"up" ,"upon" ,"us" ,"use" ,"used" ,"useful" ,"uses" ,"using" ,"usually" ,"uucp" ,"v" ,"value" ,"various" ,"very" ,"via" ,"viz" ,"vs" ,"w" ,"want" ,"wants" ,"was" ,"wasn't" ,"way" ,"we" ,"we'd" ,"we'll" ,"we're" ,"we've" ,"welcome" ,"well" ,"went" ,"were" ,"weren't" ,"what" ,"what's" ,"whatever" ,"when" ,"whence" ,"whenever" ,"where" ,"where's" ,"whereafter" ,"whereas" ,"whereby" ,"wherein" ,"whereupon" ,"wherever" ,"whether" ,"which" ,"while" ,"whither" ,"who" ,"who's" ,"whoever" ,"whole" ,"whom" ,"whose" ,"why" ,"will" ,"willing" ,"wish" ,"with" ,"within" ,"without" ,"won't" ,"wonder" ,"would" ,"would" ,"wouldn't" ,"x" ,"y" ,"yes" ,"yet" ,"you" ,"you'd" ,"you'll" ,"you're" ,"you've" ,"your" ,"yours" ,"yourself" ,"yourselves" ,"z" ,"zero"};
	for(unsigned int i=0; i<vec.size(); i++)
	{
		stopWords.insert(vec[i]);
	}
}

// Search the index for documents matching the query. The results are to be
// placed in the supplied "hits" vector, which is guaranteed to be empty when
// this method is called.
void Index_server::process_query(const string& query, vector<Query_hit>& hits)
{
	cout << "Processing query '" << query << "'" << endl;
	string::size_type lasPos, pos;
	string delimiter=" ";

	unordered_map<string, int> queryHash; // parse the strings in the query and put it into this hashMap 
	lasPos = query.find_first_not_of(delimiter,0);
	pos = query.find_first_of(delimiter,lasPos);
	while(lasPos!=string::npos || pos != string::npos)
	{
		string word=query.substr(lasPos, pos-lasPos);
		// make all word lower case for match, and remove special chars in the word
		word=removePunctuation(word);
		if(stopWords.find(word)==stopWords.end() && word!="") // if not a stop word
		{
			if(queryHash.find(word)==queryHash.end()) // if not already in this hashMap
			{
				queryHash[word]=1;
			}
			else
			{
				queryHash[word]++;
			}
		}
		lasPos = query.find_first_not_of(delimiter, pos);
		pos = query.find_first_of(delimiter, lasPos);
	}
	if(queryHash.empty()) // no need to search anymore, if not return, will be error......
		return;	
	
	unordered_map<int, int> matchedDocID; // the doc id that matches this query
	
	// first put all the docIDs that contains the first quert term into a hashSet, then delete if docID does not contain second/third... term 
	for(auto itr=termStat[queryHash.begin()->first].docInfo.begin(); itr!=termStat[queryHash.begin()->first].docInfo.end(); itr++)
	{
		matchedDocID.insert(*itr);
	}
	
	//cout<<queryHash.begin()->first<<" "<<queryHash.begin()->second<<endl;

	vector<int> docIDtoErase;
	for(auto itr=++queryHash.begin(); itr!=queryHash.end(); itr++)
	{
		//cout<<itr->first<<" "<<itr->second<<endl;
		for(auto itr1=matchedDocID.begin(); itr1!=matchedDocID.end(); itr1++)
		{
			if(termStat.find(itr->first)==termStat.end()) // this term does not exist in all docs
			{
				matchedDocID.clear();
				break;
			}
			else if(termStat[itr->first].docInfo.find(itr1->first)==termStat[itr->first].docInfo.end())
			{
				//matchedDocID.erase(itr1); //-----fatal error, cannot delete while iterate!!!!!
				docIDtoErase.push_back(itr1->first); 
			}
		}
	}
	
	/*---- delete the doc ids that has the first term in query(hashed order) but not in all others ----*/
	for(unsigned int i=0; i<docIDtoErase.size(); i++)
		matchedDocID.erase(docIDtoErase[i]);
	
	//cout<<"here are the matches: "<<endl;
	//for(auto itr=matchedDocID.begin(); itr!=matchedDocID.end(); itr++)
	//{
	//	cout<<itr->first<<" "<<itr->second<<endl;
	//}
	
	/*---- compute the similarity score for matched docs ----*/

	for(auto itr=matchedDocID.begin(); itr!=matchedDocID.end(); itr++)
	{
		double num = 0; // numerator
		double den = 0; // denominator
		double queryNormFac=0;
		for(auto itr1 = queryHash.begin();itr1!=queryHash.end();itr1++)
		{
			num+=itr1->second*termStat[itr1->first].docInfo[itr->first]*termStat[itr1->first].idf*termStat[itr1->first].idf;
			queryNormFac+=pow(itr1->second*termStat[itr1->first].idf, 2);
			
		}
		den=sqrt(normFac[itr->first])*sqrt(queryNormFac);
		double score=num/den;
		string cid = to_string(itr->first);
		char *id=new char[cid.length()+1];
		strcpy(id,cid.c_str());
		hits.push_back(Query_hit(id,score));
	}
	
	// sort the hits
	hitsComp comp;
	sort(hits.begin(), hits.end(), comp);

	//cout<<"The ordered score and doc id"<<endl;
	//for(int i=0; i<hits.size(); i++)
	//{
	//	cout<<hits[i].id<<" "<<hits[i].score<<endl;
	//}
}

namespace {
    int handle_request(mg_connection *conn)
    {
        const mg_request_info *request_info = mg_get_request_info(conn);

        if (!strcmp(request_info->request_method, "GET") && request_info->query_string) {
            // Make the processing of each server request mutually exclusive with
            // processing of other requests.

            // Retrieve the request form data here and use it to call search(). Then
            // pass the result of search() to to_json()... then pass the resulting string
            // to mg_printf.
            string query;
            if (get_param(request_info, "q", query) == -1) {
                // If the request doesn't have the "q" field, this is not an index
                // query, so ignore it.
                return 1;
            }

            vector<Query_hit> hits;
            Index_server *server = static_cast<Index_server *>(request_info->user_data);

            pthread_mutex_lock(&mutex);
            server->process_query(query, hits);
            pthread_mutex_unlock(&mutex);

            string response_data = to_json(hits);
            int response_size = response_data.length();

            // Send HTTP reply to the client.
            mg_printf(conn,
                      "HTTP/1.1 200 OK\r\n"
                      "Content-Type: application/json\r\n"
                      "Content-Length: %d\r\n"
                      "\r\n"
                      "%s", response_size, response_data.c_str());
        }

        // Returning non-zero tells mongoose that our function has replied to
        // the client, and mongoose should not send client any more data.
        return 1;
    }

    int get_param(const mg_request_info *request_info, const char *name, string& param)
    {
        const char *get_params = request_info->query_string;
        size_t params_size = strlen(get_params);

        // On the off chance that operator new isn't thread-safe.
        pthread_mutex_lock(&mutex);
        char *param_buf = new char[params_size + 1];
        pthread_mutex_unlock(&mutex);

        param_buf[params_size] = '\0';
        int param_length = mg_get_var(get_params, params_size, name, param_buf, params_size);
        if (param_length < 0) {
            return param_length;
        }

        // Probably not necessary, just a precaution.
        param = param_buf;
        delete[] param_buf;

        return 0;
    }

    // Converts the supplied query hit list into a JSON string.
    string to_json(const vector<Query_hit>& hits)
    {
        ostringstream os;
        os << "{\"hits\":[";
        vector<Query_hit>::const_iterator viter;
        for (viter = hits.begin(); viter != hits.end(); ++viter) {
            if (viter != hits.begin()) {
                os << ",";
            }

            os << *viter;
        }
        os << "]}";

        return os.str();
    }

    // Outputs the computed information for a query hit in a JSON format.
    ostream& operator<< (ostream& os, const Query_hit& hit)
    {
        os << "{" << "\"id\":\"";
        int id_size = strlen(hit.id);
        for (int i = 0; i < id_size; i++) {
            if (hit.id[i] == '"') {
                os << "\\";
            }
            os << hit.id[i];
        }
        return os << "\"," << "\"score\":" << hit.score << "}";
    }
}

