<?php 

// Make sure search terms were sent

	$file = fopen("tweet.txt","w");
	// Strip any dangerous text out of the search
	$search_terms = htmlspecialchars($_GET['q']);
	$lat = htmlspecialchars($_GET['lat']);
	$long = htmlspecialchars($_GET['long']);
	echo $_GET['q'];
	echo $_GET['lat'];
	echo $_GET['long'];
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
		    		   'count' => '100',
		    		  'geocode' => $lat.','.$long.',10mi',
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

		print $tweet_stream;
		fclose($file);
		
	// Handle errors from API request
	} else {
		if ($http_code == 429) {
			print 'Error: Twitter API rate limit reached';
		} else {
			print 'Error: Twitter was not able to process that search';
		}
	}
	


?>
