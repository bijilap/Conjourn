<?php 

// Make sure search terms were sent

	$file = fopen("tweet.txt","w");
	// Strip any dangerous text out of the search
	$search_terms = htmlspecialchars($_GET['q']);
	$lat = htmlspecialchars($_GET['lat']);
	$long = htmlspecialchars($_GET['long']);
	//echo $_GET['q'];
	//echo $_GET['lat'];
	//echo $_GET['long'];
	// Create an OAuth connection
	require 'app_tokens.php';
	require 'tmhOAuth.php';
	$connection = new tmhOAuth(array(
	  'consumer_key'    => $consumer_key,
	  'consumer_secret' => $consumer_secret,
	  'user_token'      => $user_token,
	  'user_secret'     => $user_secret
	));
	
	// Run the search with the Twitter API
	$http_code = $connection->request('GET',$connection->url('1.1/search/tweets'), 
		    	array('q' => $search_terms,
		    		   'count' => '510',
		    		  'geocode' => $lat.','.$long.',25mi',
		    		   'lang' => 'en'
				 ));
	//print $http_code;
	// Search was successful
	if ($http_code == 200) {
		
		// Extract the tweets from the API response
		$response = json_decode($connection->response['response'],true);
		$tweet_data = $response['statuses']; 
		
		//print $response['screen_name'];
		// Accumulate tweets from search results
		$tweet_stream = '';		
		foreach($tweet_data as $tweet) {
			
			// Ignore retweets
			if (isset($tweet['retweeted_status'])) {
				continue;
			}
			
			// Add this tweet's text to the results
			//$tweet_stream .= $tweet['text'] ." - ".$tweet['user']['screen_name'] .'<br/><br/>';
			$tmp = preg_replace("/http.*/", " ",$tweet['text']);
			$tmp=$tmp.PHP_EOL;
			fwrite($file,$tmp);
			//$tweet_stream .= $tweet['text'] .'<br/><br/>';
			$tweet_stream .= $tmp .'.';
		}
			
		// Send the result tweets back to the Ajax request

		//Call to Bijil's Sentiment Analyser

		//print $tweet_stream;
		fclose($file);

		$output = array();
		//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

		exec("python cgi-bin/percepclassify.py cgi-bin/senti.model < tweet.txt |grep POS|wc -l", $poscnt);
		//var_dump( $output);
		//print $poscnt[0];

		exec("python cgi-bin/percepclassify.py cgi-bin/senti.model < tweet.txt |grep NEG|wc -l", $negcnt);
	/*	print "<br>";
		print $negcnt[0];
		
print "<br>";
		if (abs($poscnt[0]-$negcnt[0]) <5)
		{
			print "<h>Normal</h>";
		}
		else if($poscnt[0]>$negcnt[0])
		{
			print "<h>Positive</h>";
		}
		else
		{
			print "<h>Negative</h>";
		}*/
$response = file_get_contents("http://api.wunderground.com/api/85d4e790fba476fd/conditions/current/alert/q/".$lat.",".$long.".json");
$response = json_decode($response,true);
//print $response;
//print $item['current_observation']->temp_f;
$temp=0;
$icon=0;
$hum=0;
foreach ($response as $item)
{
 $temp=$item['temp_f'];
 $icon=$item['icon_url'];
 $hum=$item['relative_humidity'];

 
    
}
 $dl=$response['current_observation']['display_location'];
 $city=$dl['city'];
	//print_r($response);	

   //print $city;
   
   $city=preg_replace("/[\s-]+/", "", $city);
   //print $city;

	$RSSURL="http://news.google.com/news?q='".$city."'&output=rss";
	//$URL5 = "http://feeds.finance.yahoo.com/rss/2.0/headline?s=";
	//$URL6="&region=US&lang=en-US";
	//$RSSURL = $URL5.urlencode($_POST['company']).$URL6;
	$headers1 = get_headers($RSSURL);
	$errors1 = substr($headers1[0], 9, 3);
	if($errors1 != "404"){
					$xmlStr1 = file_get_contents($RSSURL);
					if ($xmlStr1 === false) 
				        {
					die('Request failed');
					}
					
					$xmlData1 = simplexml_load_string($xmlStr1);
					if ($xmlData1 === false) 
					{
							die('Parsing failed');
					}
					 //echo $xmlData1->channel->item->link[0];
					//var_dump($xmlData1);
					//echo $xmlData1->channel->title;
					if($xmlData1->channel->title == "Yahoo! Finance: RSS feed not found")
					{
					
						//echo '<div style="text-align:center;"><h2>Financial Company News is not available.</h2></div>';
					}
					else
					{
						$i=0;
						$linksarray = array();
						foreach($xmlData1->channel->item as $child)
            					{
						  //echo $child->link."<br/>;";
						  //echo $child->title."<br/>;";
					          $linksarray[$i][0]= $child->title;
                				  $linksarray[$i][1]= $child->link;
						  //echo "Here is the stored".$linksarray[$i][0]."<br/>;";
						  //echo "Here is the stored".$linksarray[$i][1]."<br/>;";
                				  $i++;
            					}
						//echo $i;
						$count = $i;
     // echo '<div style="text-align:left;"><font face="Times New Roman" size="+2"><strong>News Headlines</strong></font></div>';		
	//echo '<hr style="height:1px;border:2px solid;color:#333;background-color:#333;">';
	//echo '<ul>';
						$file1 = fopen("news.txt","w");
						$json_arr="[";
	for($i = 0; $i < $count-1; $i++)
	{
		$json_arr=$json_arr.'{"headline":"'.$linksarray[$i][0].'"},';
		$tmp1=$linksarray[$i][0].PHP_EOL;
		fwrite($file1,$tmp1);
		//echo '<li><a href="'.$linksarray[$i][1].'"</a>'.$linksarray[$i][0].'</li>';				
	}
	$json_arr=$json_arr.'{"headline":"'.$linksarray[0][0].'"}]}';
	//echo '</ul>';
	fclose($file1);
	}		  
	}



	exec("python cgi-bin/percepclassify.py cgi-bin/senti.model < news.txt |grep POS|wc -l", $poscnt_n);

	exec("python cgi-bin/percepclassify.py cgi-bin/senti.model < news.txt |grep NEG|wc -l", $negcnt_n);

$good=$poscnt_n[0]*3+$poscnt[0];
$bad=$negcnt_n[0]*3+$negcnt[0];
$json='{"Happy":'.$good.',"Sad":'.$bad.',"Weather":'.$temp.',"humid":"'.$hum.'","icon":"'.$icon.'","news":';
$json=$json.$json_arr;

	//$json='{"Happy":'.$poscnt[0].',"Sad":'.$negcnt[0].',"Weather":'.$temp.',"humid":"'.$hum.'","icon":"'.$icon.'"}';
		print $json;




	// Handle errors from API request
	} else {
		if ($http_code == 429) {
			print 'Error: Twitter API rate limit reached';
		} else {
			print 'Error: Twitter was not able to process that search';
		}
	}
	


?>
