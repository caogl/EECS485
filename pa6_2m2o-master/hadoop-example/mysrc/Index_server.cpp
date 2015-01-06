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
    int get_param(const mg_request_info *, const char *,const char *, string&, string&);
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

// Load inverted index && tf-idf data and page rank data from the file of the given name.
void Index_server::init(std::ifstream& infile1, std::ifstream& infile2)
{
	// load the inverted index from disk.
	string::size_type lasPos, pos;
	string delimiter="	 ";
	unordered_map<int, double> hashTmp;
	string line;

	while(getline(infile1,line))
	{
		lasPos = line.find_first_not_of(delimiter,0);
		pos = line.find_first_of(delimiter,lasPos);
		string word = line.substr(lasPos,pos-lasPos); // the word
		wordTfIdf[word]=hashTmp;
		lasPos = line.find_first_not_of(delimiter,pos);
		pos = line.find_first_of(delimiter,lasPos);
		int num_docs = atoi(line.substr(lasPos,pos-lasPos).c_str()); // how many links contain this word
	
		for(int i=0; i<num_docs; i++)
		{
			lasPos = line.find_first_not_of(delimiter,pos);
			pos = line.find_first_of(delimiter,lasPos);
			string info=line.substr(lasPos, pos-lasPos);
			
			string::size_type colonPos=info.find_first_of(":", 0);
			int doc_id=atoi(info.substr(0, colonPos).c_str());
			double tfidf=stod(info.substr(colonPos+1, info.size()-colonPos-1));
			wordTfIdf[word][doc_id]=tfidf;
		}
	}
	
	// load the page rank data from disk
	while(getline(infile2, line))
	{
		pos=line.find_first_of(", ", 0);
		lasPos=line.find_first_not_of(", ", pos);
		int pageId=atoi(line.substr(0, pos).c_str());
		double rank=stod(line.substr(lasPos, line.size()-lasPos));
		pageRank[pageId]=rank;
	}
	
	// hard coding the stop words file

	vector<string> vec={"a" ,"a's" ,"able" ,"about" ,"above" ,"according" ,"accordingly" ,"across" ,"actually" ,"after" ,"afterwards" ,"again" ,"against" ,"ain't" ,"all" ,"allow" ,"allows" ,"almost" ,"alone" ,"along" ,"already" ,"also" ,"although" ,"always" ,"am" ,"among" ,"amongst" ,"an" ,"and" ,"another" ,"any" ,"anybody" ,"anyhow" ,"anyone" ,"anything" ,"anyway" ,"anyways" ,"anywhere" ,"apart" ,"appear" ,"appreciate" ,"appropriate" ,"are" ,"aren't" ,"around" ,"as" ,"aside" ,"ask" ,"asking" ,"associated" ,"at" ,"available" ,"away" ,"awfully" ,"b" ,"be" ,"became" ,"because" ,"become" ,"becomes" ,"becoming" ,"been" ,"before" ,"beforehand" ,"behind" ,"being" ,"believe" ,"below" ,"beside" ,"besides" ,"best" ,"better" ,"between" ,"beyond" ,"both" ,"brief" ,"but" ,"by" ,"c" ,"c'mon" ,"c's" ,"came" ,"can" ,"can't" ,"cannot" ,"cant" ,"cause" ,"causes" ,"certain" ,"certainly" ,"changes" ,"clearly" ,"co" ,"com" ,"come" ,"comes" ,"concerning" ,"consequently" ,"consider" ,"considering" ,"contain" ,"containing" ,"contains" ,"corresponding" ,"could" ,"couldn't" ,"course" ,"currently" ,"d" ,"definitely" ,"described" ,"despite" ,"did" ,"didn't" ,"different" ,"do" ,"does" ,"doesn't" ,"doing" ,"don't" ,"done" ,"down" ,"downwards" ,"during" ,"e" ,"each" ,"edu" ,"eg" ,"eight" ,"either" ,"else" ,"elsewhere" ,"enough" ,"entirely" ,"especially" ,"et" ,"etc" ,"even" ,"ever" ,"every" ,"everybody" ,"everyone" ,"everything" ,"everywhere" ,"ex" ,"exactly" ,"example" ,"except" ,"f" ,"far" ,"few" ,"fifth" ,"first" ,"five" ,"followed" ,"following" ,"follows" ,"for" ,"former" ,"formerly" ,"forth" ,"four" ,"from" ,"further" ,"furthermore" ,"g" ,"get" ,"gets" ,"getting" ,"given" ,"gives" ,"go" ,"goes" ,"going" ,"gone" ,"got" ,"gotten" ,"greetings" ,"h" ,"had" ,"hadn't" ,"happens" ,"hardly" ,"has" ,"hasn't" ,"have" ,"haven't" ,"having" ,"he" ,"he's" ,"hello" ,"help" ,"hence" ,"her" ,"here" ,"here's" ,"hereafter" ,"hereby" ,"herein" ,"hereupon" ,"hers" ,"herself" ,"hi" ,"him" ,"himself" ,"his" ,"hither" ,"hopefully" ,"how" ,"howbeit" ,"however" ,"i" ,"i'd" ,"i'll" ,"i'm" ,"i've" ,"ie" ,"if" ,"ignored" ,"immediate" ,"in" ,"inasmuch" ,"inc" ,"indeed" ,"indicate" ,"indicated" ,"indicates" ,"inner" ,"insofar" ,"instead" ,"into" ,"inward" ,"is" ,"isn't" ,"it" ,"it'd" ,"it'll" ,"it's" ,"its" ,"itself" ,"j" ,"just" ,"k" ,"keep" ,"keeps" ,"kept" ,"know" ,"knows" ,"known" ,"l" ,"last" ,"lately" ,"later" ,"latter" ,"latterly" ,"least" ,"less" ,"lest" ,"let" ,"let's" ,"like" ,"liked" ,"likely" ,"little" ,"look" ,"looking" ,"looks" ,"ltd" ,"m" ,"mainly" ,"many" ,"may" ,"maybe" ,"me" ,"mean" ,"meanwhile" ,"merely" ,"might" ,"more" ,"moreover" ,"most" ,"mostly" ,"much" ,"must" ,"my" ,"myself" ,"n" ,"name" ,"namely" ,"nd" ,"near" ,"nearly" ,"necessary" ,"need" ,"needs" ,"neither" ,"never" ,"nevertheless" ,"new" ,"next" ,"nine" ,"no" ,"nobody" ,"non" ,"none" ,"noone" ,"nor" ,"normally" ,"not" ,"nothing" ,"novel" ,"now" ,"nowhere" ,"o" ,"obviously" ,"of" ,"off" ,"often" ,"oh" ,"ok" ,"okay" ,"old" ,"on" ,"once" ,"one" ,"ones" ,"only" ,"onto" ,"or" ,"other" ,"others" ,"otherwise" ,"ought" ,"our" ,"ours" ,"ourselves" ,"out" ,"outside" ,"over" ,"overall" ,"own" ,"p" ,"particular" ,"particularly" ,"per" ,"perhaps" ,"placed" ,"please" ,"plus" ,"possible" ,"presumably" ,"probably" ,"provides" ,"q" ,"que" ,"quite" ,"qv" ,"r" ,"rather" ,"rd" ,"re" ,"really" ,"reasonably" ,"regarding" ,"regardless" ,"regards" ,"relatively" ,"respectively" ,"right" ,"s" ,"said" ,"same" ,"saw" ,"say" ,"saying" ,"says" ,"second" ,"secondly" ,"see" ,"seeing" ,"seem" ,"seemed" ,"seeming" ,"seems" ,"seen" ,"self" ,"selves" ,"sensible" ,"sent" ,"serious" ,"seriously" ,"seven" ,"several" ,"shall" ,"she" ,"should" ,"shouldn't" ,"since" ,"six" ,"so" ,"some" ,"somebody" ,"somehow" ,"someone" ,"something" ,"sometime" ,"sometimes" ,"somewhat" ,"somewhere" ,"soon" ,"sorry" ,"specified" ,"specify" ,"specifying" ,"still" ,"sub" ,"such" ,"sup" ,"sure" ,"t" ,"t's" ,"take" ,"taken" ,"tell" ,"tends" ,"th" ,"than" ,"thank" ,"thanks" ,"thanx" ,"that" ,"that's" ,"thats" ,"the" ,"their" ,"theirs" ,"them" ,"themselves" ,"then" ,"thence" ,"there" ,"there's" ,"thereafter" ,"thereby" ,"therefore" ,"therein" ,"theres" ,"thereupon" ,"these" ,"they" ,"they'd" ,"they'll" ,"they're" ,"they've" ,"think" ,"third" ,"this" ,"thorough" ,"thoroughly" ,"those" ,"though" ,"three" ,"through" ,"throughout" ,"thru" ,"thus" ,"to" ,"together" ,"too" ,"took" ,"toward" ,"towards" ,"tried" ,"tries" ,"truly" ,"try" ,"trying" ,"twice" ,"two" ,"u" ,"un" ,"under" ,"unfortunately" ,"unless" ,"unlikely" ,"until" ,"unto" ,"up" ,"upon" ,"us" ,"use" ,"used" ,"useful" ,"uses" ,"using" ,"usually" ,"uucp" ,"v" ,"value" ,"various" ,"very" ,"via" ,"viz" ,"vs" ,"w" ,"want" ,"wants" ,"was" ,"wasn't" ,"way" ,"we" ,"we'd" ,"we'll" ,"we're" ,"we've" ,"welcome" ,"well" ,"went" ,"were" ,"weren't" ,"what" ,"what's" ,"whatever" ,"when" ,"whence" ,"whenever" ,"where" ,"where's" ,"whereafter" ,"whereas" ,"whereby" ,"wherein" ,"whereupon" ,"wherever" ,"whether" ,"which" ,"while" ,"whither" ,"who" ,"who's" ,"whoever" ,"whole" ,"whom" ,"whose" ,"why" ,"will" ,"willing" ,"wish" ,"with" ,"within" ,"without" ,"won't" ,"wonder" ,"would" ,"would" ,"wouldn't" ,"x" ,"y" ,"yes" ,"yet" ,"you" ,"you'd" ,"you'll" ,"you're" ,"you've" ,"your" ,"yours" ,"yourself" ,"yourselves" ,"z" ,"zero"};
	for(unsigned int i=0; i<vec.size(); i++)
	{
		string::size_type pos=vec[i].find_first_of("'", 0);
		if(pos==string::npos)
			stopWords.insert(vec[i]);
		else
		{
			stopWords.insert(vec[i].substr(0, pos));
			stopWords.insert(vec[i].substr(pos+1, vec[i].size()-pos-1));
		}
	}
}

// Search the index for documents matching the query. The results are to be
// placed in the supplied "hits" vector, which is guaranteed to be empty when
// this method is called.
void Index_server::process_query(const std::string& query, std::vector<Query_hit>& hits, double w)
{
	cout << "Processing query '" << query << "'" << " with weight: "<<w<<endl;
	string::size_type lasPos, pos;
	string delimiter="	' ";
	
	// add other puntucation marks as delimiters 
	for(int i=33; i<=47; i++)
		delimiter+=char(i);
	for(int i=58; i<=64; i++)
		delimiter+=char(i);
	for(int i=91; i<=94; i++)
		delimiter+=char(i);
	for(int i=123; i<=126; i++)
		delimiter+=char(i);
	delimiter+=char(96);
	
	unordered_map<string, int> queryHash; // parse the strings in the query and put it into this hashMap::<word, frequency>
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
	
	unordered_set<int> matchedId; // the link id that matches this query
	
	// first put all the link Ids that contains the first quert term into a hashSet, then delete if link ids does not contain second/third... term 
	for(auto itr=wordTfIdf[queryHash.begin()->first].begin(); itr!=wordTfIdf[queryHash.begin()->first].end(); itr++)
	{
		matchedId.insert(itr->first);
	}
	
	//cout<<queryHash.begin()->first<<" "<<queryHash.begin()->second<<endl;//////////////////////////////////////////

	for(auto itr=++queryHash.begin(); itr!=queryHash.end(); itr++) // for the 2nd word in the query to last
	{
		if(wordTfIdf.find(itr->first)==wordTfIdf.end()) // if this word in the query does not exist in any links
		{
			matchedId.clear();
			break;
		}

		unordered_set<int> toErase;
		for(auto itr1=matchedId.begin(); itr1!=matchedId.end(); itr1++) // for all links that contains all previous word in the query
		{
			if(wordTfIdf[itr->first].find(*itr1)==wordTfIdf[itr->first].end()) 
			{
				toErase.insert(*itr1); 
			}
		}
		/*---- delete the doc ids that has the previous word in query(hashed order) but not in current one ----*/
		for(auto itr1=toErase.begin(); itr1!=toErase.end(); itr1++)
			matchedId.erase(*itr1);
	}
	
	
	//cout<<"here are the matches: "<<endl;
	//for(auto itr=matchedDocID.begin(); itr!=matchedDocID.end(); itr++)
	//{
	//	cout<<itr->first<<" "<<itr->second<<endl;
	//}
	
	/*---- compute the score of the query for macthed links ----*/
	double queryNormFac=0; // the normalization factor of the query 
	for(auto itr = queryHash.begin();itr!=queryHash.end();itr++)
	{
		double idf=log(32393.0/wordTfIdf[itr->first].size())/log(10.0); // there are totally 32393 links
		queryNormFac+=pow(itr->second*idf, 2);
	}
	queryNormFac=sqrt(queryNormFac);

	for(auto itr=matchedId.begin(); itr!=matchedId.end(); itr++) // for each matched link
	{
		double score=0;
		for(auto itr1 = queryHash.begin();itr1!=queryHash.end();itr1++)
		{
			score+=wordTfIdf[itr1->first][*itr]*(itr1->second*(log(32393.0/wordTfIdf[itr1->first].size())/log(10.0))/queryNormFac);
		}
		score=(1-w)*score;
		if(pageRank.find(*itr)!=pageRank.end()) // if there is link from or to this page
			score+=w*pageRank[*itr];
		string cid = to_string(*itr);
		char *id=new char[cid.length()+1];
		strcpy(id,cid.c_str());
		hits.push_back(Query_hit(id,score));
	}
	
	// sort the hits
	hitsComp comp;
	sort(hits.begin(), hits.end(), comp);

	cout<<"The ordered score and doc id"<<endl;
	for(unsigned int i=0; i<hits.size(); i++)
	{
		cout<<hits[i].id<<" "<<hits[i].score<<endl;
	}
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
	    string weight;
            if (get_param(request_info, "q","w", query, weight) == -1) {
                // If the request doesn't have the "q" field, this is not an index
                // query, so ignore it.
                return 1;
            }
	  

            vector<Query_hit> hits;
            Index_server *server = static_cast<Index_server *>(request_info->user_data);
	    double w = stod(weight);
		
            pthread_mutex_lock(&mutex);
            server->process_query(query, hits, w);
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

    int get_param(const mg_request_info *request_info, const char *name, const char * name2,string& param, string &param2)
    {
        const char *get_params = request_info->query_string;
        size_t params_size = strlen(get_params);

        // On the off chance that operator new isn't thread-safe.
        pthread_mutex_lock(&mutex);
        char *param_buf = new char[params_size + 1];
        char *param_buf2 = new char[params_size+1];
        pthread_mutex_unlock(&mutex);
        
        param_buf[params_size] = '\0';
	param_buf[params_size] = '\0';
        int param_length = mg_get_var(get_params, params_size, name, param_buf, params_size);
        if (param_length < 0) {
            return param_length;
        }
	int param_length2 = mg_get_var(get_params, params_size, name2, param_buf2, params_size);
	if(param_length2 <0){
		return param_length2;
	}

        // Probably not necessary, just a precaution.
        param = param_buf;
        param2 = param_buf2;
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

