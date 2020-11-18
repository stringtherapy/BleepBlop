<?php 
	$list1 = file_get_contents("profan.txt");         //text file containing profanity words
	$list2 = file_get_contents("three.txt");	  //text file containing only 3-letter profanity words extracted from profan.txt
    	$exem2 = explode("\n",$newlist);		  //converting string of 3-letter words into array (for later use) 	
    
	
	$mess="any message";                              //string from user 
	$me=explode(" ",$mess);				  //string to array conversion	
    	$length = count($me);				  //number of words from user
	$censored='';					  //pre-defining the output variable 
    	$melow = array();			          //pre-defining an array needed in the for loop		

	for ($i = 0; $i < $length; $i++)					 	     //each word from user passes through this loop for filtering 
		
	{
        $melow[$i] = strtolower($me[$i]);	                                             //making the word lowercase 
	$me2[$i] = preg_replace('/[^A-Za-z0-9\-]/', '', $melow[$i]);	 	             //removing all the special characters
	    if(strlen($me2[$i]) >= 4){	                                                     //ignoring words less than 4 characters to prevent mis-interpretation of short words like pronouns as substrings of profanity words   					
	    $me3[$i] = "/$me2[$i]/";                                                         //adding delimiters required to run the upcoming RegEx function - preg_match()
	    	if(preg_match($me3[$i], $list)==1){                              	     //the core comparison takes place here 
            		if(!in_array($me2[$i], $exem)){				 	     //ignoring the exemptional words for which preg_match failed (a temporary solution)							
	    		$me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>";   //censoring the profanity word either by striking
            		//$me[$i] = str_repeat("*", strlen($me[$i]));			     //or the classic star-ing	
	    		}
	    }
	    } else if(in_array($me2[$i], $exem2)){                                           //to get any 3-letter bad words that escaped the first check
	    $me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>";               //censoring it
	    $sensored .= "$me[$i]"." ";                                                      //compiling the censored version of original message
	    }
	    echo "<div id=output>$sensored</div>";                                           //final output    
	}	
	}	
	
    
 

$exem = array("whole", "will", "other","mother","long","fell","best","face","star","ones","horn","chin","lock","full","test","phone","head");  //cases for which the program failed 

?>
