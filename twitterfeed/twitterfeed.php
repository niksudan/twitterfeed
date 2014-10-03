<?php

// Twitterfeed-PHP v1.5.1
// Nik Sudan
// https://github.com/NikSudan/Twitterfeed-PHP/

// API Keys
define('API_KEY', '');
define('API_SECRET', '');
define('ACCESS_KEY', '');
define('ACCESS_SECRET', '');

class Twitterfeed {

	private $type;
	private $value;
	private $limit;

	public $tweet;
	public $tweets;

	// Constructor
	public function __construct($type = 'user', $value = 'twitter', $limit = 10) {
		$this->type = $type;
		$this->value = $value;
		$this->limit = intval($limit);
		$this->tweets = $this->getData();
		if ($this->type == 'search') {
			$this->tweets = $this->tweets->statuses;
		}
	}

	// Returns tweet data
	private function getData() {
		require_once('twitteroauth.php');
		$c = new TwitterOAuth(API_KEY, API_SECRET, ACCESS_KEY, ACCESS_SECRET);
		switch ($this->type) {
			case 'user':
				$url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$this->value;
				break;
			case 'search':
				$url = "https://api.twitter.com/1.1/search/tweets.json?q=".$this->value;
				break;
			default:
				trigger_error('Unknown Twitterfeed type "'.$this->type.'"', E_USER_ERROR);
		}
		return $c->get($url."&count=".$this->limit);
	}

	// Returns if there are tweets
	public function hasTweets() {
		return $this->tweets ? true : false;
	}

	// Returns if the Twitterfeed is the given type
	public function isType($type) {
		return $this->type == $type ? true : false;
	}

	// Returns if tweet was a retweet
	public function isRT() {
		if (!$this->tweet)
			trigger_error('Unknown tweet', E_USER_ERROR);
		return isset($this->tweet->retweeted_status) ? true : false;
	}

	// Returns twitterfeed user info
	public function user($property = null, $echo = true, $user = null) {
		if ($this->type == 'user') {
			$user = $this->tweets[0]->user;
		} else {
			if (!$user)
				trigger_error('Unknown user', E_USER_ERROR);
		}
		if ($property) {
			if ($echo) echo $user->$property;
			else return $user->$property;
		} else
			return $user;
	}

	// Returns tweet author info
	public function author($property = null, $echo = true) {
		if ($this->tweet) {
			$author = $this->isRT() ? $this->tweet->retweeted_status->user : $this->tweet->user;
			$result = $this->user($property, $echo, $author);
			if (!$echo)
				return $result;
		} else
			trigger_error('Unknown tweet', E_USER_ERROR);
	}

	// Returns tweet info
	public function tweet($property = null, $echo = true) {
		if (isset($this->tweet)) {
			$tweet = $this->isRT() ? $this->tweet->retweeted_status : $this->tweet;
		} else
			trigger_error('Unknown tweet', E_USER_ERROR);
		if ($property) {
			if ($echo) echo $tweet->$property;
			else return $tweet->$property;
		} else
			return $tweet;
	}

	// Returns tweet text
	public function tweetText($echo = true) {
		if ($echo)
			echo $this->tweet('text', false);
		else
			return $this->tweet('text', false);
	}

	// Returns tweet html
	public function tweetHTML($links = true, $hashtags = true, $mentions = true, $mediaLinks = true, $echo = true) {
		$content = $this->tweetText(false);
		$entities = $this->tweet('entities', false);
		foreach ($entities->urls as $link) {
			$replacer = $links ? '<a class="url" href="'.$link->url.'">'.$link->url.'</a>' : '<span class="url">'.$link->url.'</span>';
			$content = str_replace($link->url, $replacer, $content);
		}
		foreach ($entities->hashtags as $hashtag) {
			$replacer = $hashtags ? '<a class="hashtag" href="http://twitter.com/hashtag/'.$hashtag->text.'">#'.$hashtag->text.'</a>' : '<span class="hashtag">#'.$hashtag->text.'</span>';
			$content = str_replace('#'.$hashtag->text, $replacer, $content);
		}
		foreach ($entities->user_mentions as $mention) {
			$replacer = $mentions ? '<a class="mention" href="http://twitter.com/'.$mention->screen_name.'" title="'.$mention->name.'">@'.$mention->screen_name.'</a>' : '<span class="mention">@'.$mention->screen_name.'</span>';
			$content = str_replace('@'.$mention->screen_name, $replacer, $content);
		}
		if (isset($entities->media)) {
			if ($mediaLinks) {
				foreach ($entities->media as $media) {
					$replacer = $links ? '<a class="url" href="'.$media->url.'">'.$media->url.'</a>' : '<span class="url">'.$media->url.'</span>';
					$content = str_replace($media->url, $replacer, $content);
				}
			} else {
				foreach ($entities->media as $media) {
					$content = str_replace($media->url, '', $content);
				}
			}
		}
		if ($echo)
			echo trim($content);
		else
			return trim($content);
	}

	// Returns the search query
	public function searchQuery($echo = true) {
		if ($this->type == 'search') {
			if ($echo)
				echo $this->value;
			else
				return $this->value;
		} else
			trigger_error('Twitterfeed is not a search', E_USER_ERROR);
	}

	// Returns user avatar
	public function userAvatar($echo = true) {
		if ($echo)
			echo str_replace('_normal', '', $this->user('profile_image_url', false));
		else
			return str_replace('_normal', '', $this->user('profile_image_url', false));
	}

	// Returns author avatar
	public function authorAvatar($echo = true) {
		if ($echo)
			echo str_replace('_normal', '', $this->author('profile_image_url', false));
		else
			return str_replace('_normal', '', $this->author('profile_image_url', false));
	}

	// Returns user url
	public function userURL($echo = true) {
		if ($echo)
			echo 'http://twitter.com/'.$this->user('screen_name', false);
		else
			return 'http://twitter.com/'.$this->user('screen_name', false);
	}

	// Returns author url
	public function authorURL($echo = true) {
		if ($echo)
			echo 'http://twitter.com/'.$this->author('screen_name', false);
		else
			return 'http://twitter.com/'.$this->author('screen_name', false);
	}

	// Returns tweet url
	public function tweetURL($echo = true) {
		if ($echo)
			echo 'http://twitter.com/'.$this->author('screen_name',false).'/statuses/'.$this->tweet('id_str',false);
		else
			return 'http://twitter.com/'.$this->author('screen_name',false).'/statuses/'.$this->tweet('id_str',false);
	}

	// Returns if has media
	public function hasMedia() {
		return isset($this->tweet('entities', false)->media) && count($this->tweet('entities', false)->media) > 0 ? true : false;
	}

	// Returns tweet media
	public function media($index = null, $property = 'media_url', $echo = true) {
		if ($index === null) {
			return $this->tweet('entities', false)->media;
		} else {
			if ($echo)
				echo $this->tweet('entities', false)->media[$index]->$property;
			else
				return $this->tweet('entities', false)->media[$index]->$property;
		}
	}

}
