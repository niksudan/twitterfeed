<?php session_start();

// Uses associative array content documentation for properties
// https://dev.twitter.com/docs/platform-objects

function twitterfeed($_1 = 'user', $_2 = 'twitter', $_3 = 10) {

	$GLOBALS['tweet'] = null;
	$GLOBALS['twtr_type'] = $_1;
	$twtr_option[0] = $_2;
	$twtr_option[1] = $_3;

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

function tf_tweetText($_anchorLinks = true) {
	if ($_anchorLinks) {
		$content_array = explode(" ", tf_tweet('text', false));
		$output = '';
		foreach($content_array as $content) {
			//Link
			if((substr($content, 0, 7) == "http://") || (substr($content, 0, 8) == "https://") || (substr($content, 0, 4) == "www.")) {
				$u = $content;
				$content = '<a href="' . $u . '">' . $content . '</a>';
			}
			//Hashtag
			if(substr($content, 0, 1) == "#") {
				$u = preg_split('/#\w+/', $content);
				$content = '<a href="http://twitter.com/hashtag/' . substr($content,1,strlen($content)) . '?src=hash">' . $content . '</a>';
			}
			//Mention
			if(substr($content, 0, 1) == "@") {
				$u = preg_split("/[^a-zA-Z0-9_]+/", (substr($content,1,strlen($content))));
				$content = '<a href="http://twitter.com/' . $u[0] . '">' . $content . '</a>';
			}
			$output .= " " . $content;
		}
		echo trim($output);
	} else
		echo tf_tweet('text');
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
