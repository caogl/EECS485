#include "Indexer.h"

string Indexer::removePunctuation(string& word)
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


// Reads content from the supplied input file stream, and transforms the
// content into the actual on-disk inverted index file.
void Indexer::index(ifstream& content, ostream& outfile)
{
	vector<string> vec={"a" ,"a's" ,"able" ,"about" ,"above" ,"according" ,"accordingly" ,"across" ,"actually" ,"after" ,"afterwards" ,"again" ,"against" ,"ain't" ,"all" ,"allow" ,"allows" ,"almost" ,"alone" ,"along" ,"already" ,"also" ,"although" ,"always" ,"am" ,"among" ,"amongst" ,"an" ,"and" ,"another" ,"any" ,"anybody" ,"anyhow" ,"anyone" ,"anything" ,"anyway" ,"anyways" ,"anywhere" ,"apart" ,"appear" ,"appreciate" ,"appropriate" ,"are" ,"aren't" ,"around" ,"as" ,"aside" ,"ask" ,"asking" ,"associated" ,"at" ,"available" ,"away" ,"awfully" ,"b" ,"be" ,"became" ,"because" ,"become" ,"becomes" ,"becoming" ,"been" ,"before" ,"beforehand" ,"behind" ,"being" ,"believe" ,"below" ,"beside" ,"besides" ,"best" ,"better" ,"between" ,"beyond" ,"both" ,"brief" ,"but" ,"by" ,"c" ,"c'mon" ,"c's" ,"came" ,"can" ,"can't" ,"cannot" ,"cant" ,"cause" ,"causes" ,"certain" ,"certainly" ,"changes" ,"clearly" ,"co" ,"com" ,"come" ,"comes" ,"concerning" ,"consequently" ,"consider" ,"considering" ,"contain" ,"containing" ,"contains" ,"corresponding" ,"could" ,"couldn't" ,"course" ,"currently" ,"d" ,"definitely" ,"described" ,"despite" ,"did" ,"didn't" ,"different" ,"do" ,"does" ,"doesn't" ,"doing" ,"don't" ,"done" ,"down" ,"downwards" ,"during" ,"e" ,"each" ,"edu" ,"eg" ,"eight" ,"either" ,"else" ,"elsewhere" ,"enough" ,"entirely" ,"especially" ,"et" ,"etc" ,"even" ,"ever" ,"every" ,"everybody" ,"everyone" ,"everything" ,"everywhere" ,"ex" ,"exactly" ,"example" ,"except" ,"f" ,"far" ,"few" ,"fifth" ,"first" ,"five" ,"followed" ,"following" ,"follows" ,"for" ,"former" ,"formerly" ,"forth" ,"four" ,"from" ,"further" ,"furthermore" ,"g" ,"get" ,"gets" ,"getting" ,"given" ,"gives" ,"go" ,"goes" ,"going" ,"gone" ,"got" ,"gotten" ,"greetings" ,"h" ,"had" ,"hadn't" ,"happens" ,"hardly" ,"has" ,"hasn't" ,"have" ,"haven't" ,"having" ,"he" ,"he's" ,"hello" ,"help" ,"hence" ,"her" ,"here" ,"here's" ,"hereafter" ,"hereby" ,"herein" ,"hereupon" ,"hers" ,"herself" ,"hi" ,"him" ,"himself" ,"his" ,"hither" ,"hopefully" ,"how" ,"howbeit" ,"however" ,"i" ,"i'd" ,"i'll" ,"i'm" ,"i've" ,"ie" ,"if" ,"ignored" ,"immediate" ,"in" ,"inasmuch" ,"inc" ,"indeed" ,"indicate" ,"indicated" ,"indicates" ,"inner" ,"insofar" ,"instead" ,"into" ,"inward" ,"is" ,"isn't" ,"it" ,"it'd" ,"it'll" ,"it's" ,"its" ,"itself" ,"j" ,"just" ,"k" ,"keep" ,"keeps" ,"kept" ,"know" ,"knows" ,"known" ,"l" ,"last" ,"lately" ,"later" ,"latter" ,"latterly" ,"least" ,"less" ,"lest" ,"let" ,"let's" ,"like" ,"liked" ,"likely" ,"little" ,"look" ,"looking" ,"looks" ,"ltd" ,"m" ,"mainly" ,"many" ,"may" ,"maybe" ,"me" ,"mean" ,"meanwhile" ,"merely" ,"might" ,"more" ,"moreover" ,"most" ,"mostly" ,"much" ,"must" ,"my" ,"myself" ,"n" ,"name" ,"namely" ,"nd" ,"near" ,"nearly" ,"necessary" ,"need" ,"needs" ,"neither" ,"never" ,"nevertheless" ,"new" ,"next" ,"nine" ,"no" ,"nobody" ,"non" ,"none" ,"noone" ,"nor" ,"normally" ,"not" ,"nothing" ,"novel" ,"now" ,"nowhere" ,"o" ,"obviously" ,"of" ,"off" ,"often" ,"oh" ,"ok" ,"okay" ,"old" ,"on" ,"once" ,"one" ,"ones" ,"only" ,"onto" ,"or" ,"other" ,"others" ,"otherwise" ,"ought" ,"our" ,"ours" ,"ourselves" ,"out" ,"outside" ,"over" ,"overall" ,"own" ,"p" ,"particular" ,"particularly" ,"per" ,"perhaps" ,"placed" ,"please" ,"plus" ,"possible" ,"presumably" ,"probably" ,"provides" ,"q" ,"que" ,"quite" ,"qv" ,"r" ,"rather" ,"rd" ,"re" ,"really" ,"reasonably" ,"regarding" ,"regardless" ,"regards" ,"relatively" ,"respectively" ,"right" ,"s" ,"said" ,"same" ,"saw" ,"say" ,"saying" ,"says" ,"second" ,"secondly" ,"see" ,"seeing" ,"seem" ,"seemed" ,"seeming" ,"seems" ,"seen" ,"self" ,"selves" ,"sensible" ,"sent" ,"serious" ,"seriously" ,"seven" ,"several" ,"shall" ,"she" ,"should" ,"shouldn't" ,"since" ,"six" ,"so" ,"some" ,"somebody" ,"somehow" ,"someone" ,"something" ,"sometime" ,"sometimes" ,"somewhat" ,"somewhere" ,"soon" ,"sorry" ,"specified" ,"specify" ,"specifying" ,"still" ,"sub" ,"such" ,"sup" ,"sure" ,"t" ,"t's" ,"take" ,"taken" ,"tell" ,"tends" ,"th" ,"than" ,"thank" ,"thanks" ,"thanx" ,"that" ,"that's" ,"thats" ,"the" ,"their" ,"theirs" ,"them" ,"themselves" ,"then" ,"thence" ,"there" ,"there's" ,"thereafter" ,"thereby" ,"therefore" ,"therein" ,"theres" ,"thereupon" ,"these" ,"they" ,"they'd" ,"they'll" ,"they're" ,"they've" ,"think" ,"third" ,"this" ,"thorough" ,"thoroughly" ,"those" ,"though" ,"three" ,"through" ,"throughout" ,"thru" ,"thus" ,"to" ,"together" ,"too" ,"took" ,"toward" ,"towards" ,"tried" ,"tries" ,"truly" ,"try" ,"trying" ,"twice" ,"two" ,"u" ,"un" ,"under" ,"unfortunately" ,"unless" ,"unlikely" ,"until" ,"unto" ,"up" ,"upon" ,"us" ,"use" ,"used" ,"useful" ,"uses" ,"using" ,"usually" ,"uucp" ,"v" ,"value" ,"various" ,"very" ,"via" ,"viz" ,"vs" ,"w" ,"want" ,"wants" ,"was" ,"wasn't" ,"way" ,"we" ,"we'd" ,"we'll" ,"we're" ,"we've" ,"welcome" ,"well" ,"went" ,"were" ,"weren't" ,"what" ,"what's" ,"whatever" ,"when" ,"whence" ,"whenever" ,"where" ,"where's" ,"whereafter" ,"whereas" ,"whereby" ,"wherein" ,"whereupon" ,"wherever" ,"whether" ,"which" ,"while" ,"whither" ,"who" ,"who's" ,"whoever" ,"whole" ,"whom" ,"whose" ,"why" ,"will" ,"willing" ,"wish" ,"with" ,"within" ,"without" ,"won't" ,"wonder" ,"would" ,"would" ,"wouldn't" ,"x" ,"y" ,"yes" ,"yet" ,"you" ,"you'd" ,"you'll" ,"you're" ,"you've" ,"your" ,"yours" ,"yourself" ,"yourselves" ,"z" ,"zero"};
	for(unsigned int i=0; i<vec.size(); i++)
	{
		stopWords.insert(vec[i]);
	}
	string line;
	string::size_type lasPos, pos;
	// parsed file, index+1 is file id, key is each term in the file, value is term occurence in the file
	vector<unordered_map<string, int> > file; 
	unordered_map<string, termInfo> termStat; // the key is term, value is termInfo struct

	termInfo termInfoTmp;
	unordered_map<string, int> hashMapTmp;

	string delimiter=" ";
	int fileID=0;
	while(getline(content, line))
	{
		fileID++;
		lasPos=line.find_first_not_of(delimiter, 0);
		pos=line.find_first_of(delimiter, lasPos);
		while(lasPos!=string::npos || pos!=string::npos)
		{
			string word=line.substr(lasPos, pos-lasPos);
			word=removePunctuation(word);
			// if word consists of special chars only, word will return as a empty string
			if(stopWords.find(word)==stopWords.end() && word!="") 
			{
				// for termStat
				if(termStat.find(word)==termStat.end())
				{
					termInfo termInfoTmp;
					termInfoTmp.totalOccurrence=1;
					termInfoTmp.docID.push_back(fileID);
					termStat[word]=termInfoTmp;
				}
				else
				{
					termStat[word].totalOccurrence++;
					if(termStat[word].docID.back()!=fileID)
						termStat[word].docID.push_back(fileID);
				}

				// for parsed file
				if(hashMapTmp.find(word)!=hashMapTmp.end())
				{
					hashMapTmp[word]=1;
				}
				else
				{
					hashMapTmp[word]++;
				}
			}
			lasPos=line.find_first_not_of(delimiter, pos);
			pos=line.find_first_of(delimiter, lasPos);
		}
		file.push_back(hashMapTmp);
		hashMapTmp.clear();
	}

	for(unordered_map<string, termInfo>::iterator itr=termStat.begin(); itr!=termStat.end(); itr++)
	{
		outfile<<itr->first<<" ";
		outfile<<log(200/itr->second.docID.size())/log(10)<<" ";
		outfile<<itr->second.totalOccurrence<<" ";
		for(unsigned int i=0; i<itr->second.docID.size(); i++)
		{
			double normFac=0; // normalization factor
			outfile<<itr->second.docID[i]<<" "<<file[itr->second.docID[i]-1][itr->first]<<" ";
			for(unordered_map<string, int>::iterator itr1=file[itr->second.docID[i]-1].begin(); itr1!=file[itr->second.docID[i]-1].end(); itr1++)
			{
				normFac+=pow(itr1->second, 2)*pow(log(200/termStat[itr1->first].docID.size())/log(10), 2);
			}
			outfile<<normFac<<" ";
		}
		outfile<<endl;
	}
    // Fill in this method to parse the content and build your
    // inverted index file.
}
