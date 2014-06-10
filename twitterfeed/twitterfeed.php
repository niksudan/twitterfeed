<?php session_start();

	// Uses associative array content documentation
	// https://dev.twitter.com/docs/platform-objects

	function twitterfeed($_user, $_count) {
		$twtr_user = $_user;
		$twtr_count = $_count;
		return json_decode(include 'loadtweets.php', true);
	}

	function tf_isRT() {
		return (isset($GLOBALS['tweet']['retweeted_status']) ? true : false);
	}

	function tf_user($property = '-1', $echo = true) {
		$u = $GLOBALS['tweets'][0]['user'];
		if ($property !== '-1') {
			if ($echo)
				echo $u[$property];
			else
				return $u[$property];
		} else
			return $u;
	}

	function tf_author($property = '-1', $echo = true) {
		$a = (isset($GLOBALS['tweet']) ? (tf_isRT() ? $GLOBALS['tweet']['retweeted_status']['user'] : $GLOBALS['tweet']['user']) : tf_user());
		if ($property !== '-1') {
			if ($echo)
				echo $a[$property];
			else
				return $a[$property];
		} else
			return $a;
	}

	function tf_avatar() {
		$u = tf_author();
		echo str_replace('_normal', '', $u['profile_image_url']);
	}

	function tf_tweet($property = '-1', $echo = true) {
		$t = (isset($GLOBALS['tweet']) ? (tf_isRT() ? $GLOBALS['tweet']['retweeted_status'] : $GLOBALS['tweet']) : $GLOBALS['tweets'][0]);
		if ($property !== '-1') {
			if ($echo)
				echo $t[$property];
			else
				return $t[$property];
		} else
			return $t;
	}

	function tf_tweetText($anchorLinks = true) {
		if ($anchorLinks) {
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

	function tf_tweeturl() {
		echo 'http://twitter.com/'.tf_author('screen_name',false).'/statuses/'.tf_tweet('id_str',false);
	}

?>
