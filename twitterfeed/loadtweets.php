<?php
require_once('twitteroauth.php');

// Add your keys here

$api_key = '';
$api_secret = '';
$access_key = '';
$access_secret = '';

$connection = new TwitterOAuth($api_key, $api_secret, $access_key, $access_secret);

switch ($GLOBALS['twtr_type']) {

	case 'user':
		$twtr_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twtr_option[0]."&count=".$twtr_option[1];
		break;

	case 'search':
		$GLOBALS['twtr_srch'] = $twtr_option[0];
		$twtr_url = "https://api.twitter.com/1.1/search/tweets.json?q=".$twtr_option[0]."&count=".$twtr_option[1];
		break;

	default:
		$GLOBALS['twtr_type'] = 'search';
		$GLOBALS['twtr_srch'] = $twtr_option[0];
		$twtr_url = "https://api.twitter.com/1.1/search/tweets.json?q=".$twtr_option[0]."&count=".$twtr_option[1];
		break;
}

$tweets = json_encode($connection->get($twtr_url));
return $tweets;
