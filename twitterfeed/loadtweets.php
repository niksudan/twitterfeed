<?php
	require_once('twitteroauth.php');

	$api_key = '';
	$api_secret = '';
	$access_key = '';
	$access_secret = '';

	$connection = new TwitterOAuth($api_key, $api_secret, $access_key, $access_secret);

	switch ($GLOBALS['twtr_type']) {
		case 'user':
			$twtr_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twtr_input."&count=".$twtr_count;
			break;
		case 'search':
			$twtr_url = "https://api.twitter.com/1.1/search/tweets.json?q=".$twtr_input."&count=".$twtr_count;
			break;
	}

	$tweets = json_encode($connection->get($twtr_url));
	return $tweets;
