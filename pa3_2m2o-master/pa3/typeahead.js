
var Typeahead = function Typeahead() {

	this.list = []; // list of objects like: { name:"", id:"" }
	this.setDataList = function(data) {
		// set the list to a list of name,id pairs
		// then sort it by fullname A-Z 		
        this.list.length = 0;
        this.list = [];
		for(var i in data)
        {
            var singleObj = {};
            singleObj['name'] = data[i].name;
            singleObj['id'] = data[i].id;
            singleObj['picture'] = data[i].picture;
            this.list.push(singleObj);
        } 
                
        this.list.sort(function(a,b){
            var nameA=a.name.toLowerCase(), nameB=b.name.toLowerCase();
            if(nameA < nameB){
                return -1;
            }
            if(nameA > nameB){
                return 1;
            }
            return 0;
         });




	}

	this.search = function(key, cb) {
		// given a key, make it lowercase, seperate it into an 
		// array ofdistinct words by spaces and compare it to the 
		// lowercase version of each name, if all sub-keys are
		// present as the prefixes in the name add the pair to the 
		// subset returned to the callback

		// ex: key: "oT S" -> keys: ["to","s"]
		// matches	{name:"Otto Sipe", id: "12345"}
		var key_lower = key.toLowerCase();
		if( key_lower.length !== 0)
		{
			var prefixes = key_lower.match(/\S+/g);
        	var data_found = [];
        	
        	
        	for(var i in this.list)
        	{
            	
                var full_name = this.list[i].name.match(/\S+/g);
                var initial_length = full_name.length;
            	if(prefixes.length > full_name.length)
            	{
            		continue;
            	}
            	else if(prefixes.length <= full_name.length)
            	{
            		
                    for(var j=0 ; j < prefixes.length; j++ )
            		{
          				var k = 0;
            			while(k < full_name.length)
            			{
            				var cur_name = full_name[k].toLowerCase();
            				if(cur_name !== "" && cur_name.indexOf(prefixes[j]) === 0 )
            				{
            					
            					full_name.splice(k, 1);
            					break;
            				}

            				k= k+1;
            			}
            		}
                    if(full_name.length === ( initial_length- prefixes.length)){
                        data_found.push(this.list[i]);
                    }



            	}
            	


                        		
            	
           

        	}
    	}
        
        cb(data_found);



	}
}
