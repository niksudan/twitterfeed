<?php
	require_once('twitteroauth.php');

	$api_key = '';
	$api_secret = '';
	$access_key = '';
	$access_secret = '';

	$connection = new TwitterOAuth($api_key, $api_secret, $access_key, $access_secret);
	$tweets = json_encode($connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twtr_user."&count=".$twtr_count));
	return $tweets;
?>
