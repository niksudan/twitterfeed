<?php

// Twitterfeed-PHP v1.3
// Nik Sudan
// https://github.com/NikSudan/Twitterfeed-PHP/

// Uses associative array content documentation for properties
// https://dev.twitter.com/docs/platform-objects

function twitterfeed($_1 = 'user', $_2 = 'twitter', $_3 = 10) {

	$GLOBALS['tweet'] = null;
	$GLOBALS['twtr_type'] = $_1;
	$GLOBALS['twtr_option'][0] = $_2;
	$GLOBALS['twtr_option'][1] = $_3;

	$out = json_decode(include 'loadtweets.php', true);
	if ($GLOBALS['twtr_type'] == 'search')
		$out = $out['statuses'];

	$GLOBALS['tweets'] = $out;
}

function tf_author($_property = '-1', $echo = true) {
	$a = (isset($GLOBALS['tweet']) ? (tf_isRT() ? $GLOBALS['tweet']['retweeted_status']['user'] : $GLOBALS['tweet']['user']) : tf_user());
	if ($_property !== '-1') {
		if ($echo)
			echo $a[$_property];
		else
			return $a[$_property];
	} else
		return $a;
}

function tf_user($_property = '-1', $echo = true) {
	$u = $GLOBALS['tweets'][0]['user'];
	if ($_property !== '-1') {
		if ($echo)
			echo $u[$_property];
		else
			return $u[$_property];
	} else
		return $u;
}

function tf_tweet($_property = '-1', $echo = true) {
	$t = (isset($GLOBALS['tweet']) ? (tf_isRT() ? $GLOBALS['tweet']['retweeted_status'] : $GLOBALS['tweet']) : $GLOBALS['tweets'][0]);
	if ($_property !== '-1') {
		if ($echo)
			echo $t[$_property];
		else
			return $t[$_property];
	} else
		return $t;
}

function tf_tweetText($_links = true, $_hashtags = true, $_mentions = true) {
	$content = tf_tweet('text', false);
	$entities = tf_tweet('entities', false);
	foreach ($entities['urls'] as $_link) {
		$_replacer = $_links ? '<a class="url" href="'.$_link['url'].'">'.$_link['url'].'</a>' : '<span class="url">'.$_link['url'].'</span>';
		$content = str_replace($_link['url'], $_replacer, $content);
	}
	foreach ($entities['hashtags'] as $_hashtag) {
		$_replacer = $_hashtags ? '<a class="hashtag" href="http://twitter.com/hashtag/'.$_hashtag['text'].'">#'.$_hashtag['text'].'</a>' : '<span class="hashtag">#'.$_hashtag['text'].'</span>';
		$content = str_replace('#'.$_hashtag['text'], $_replacer, $content);
	}
	foreach ($entities['user_mentions'] as $_mention) {
		$_replacer = $_mentions ? '<a class="mention" href="http://twitter.com/'.$_mention['screen_name'].'">@'.$_mention['screen_name'].'</a>' : '<span class="mention">@'.$_mention['screen_name'].'</span>';
		$content = str_replace('@'.$_mention['screen_name'], $_replacer, $content);
	}
	echo $content;
}

function tf_tweetURL() {
	echo 'http://twitter.com/'.tf_author('screen_name',false).'/statuses/'.tf_tweet('id_str',false);
}

function tf_authorURL() {
	echo 'http://twitter.com/'.tf_author('screen_name', false);
}

function tf_userURL() {
	echo 'http://twitter.com/'.tf_user('screen_name', false);
}

function tf_avatar() {
	$u = tf_author();
	echo str_replace('_normal', '', $u['profile_image_url']);
}

function tf_searchQuery() {
	echo isset($GLOBALS['twtr_srch']) ? $GLOBALS['twtr_srch'] : '';
}

function tf_isRT() {
	return (isset($GLOBALS['tweet']['retweeted_status']) ? true : false);
}

function tf_isType($_type) {
	return ($GLOBALS['twtr_type'] == $_type ? true : false);
}
