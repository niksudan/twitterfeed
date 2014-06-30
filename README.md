Twitterfeed-PHP
===============
Framework for easy use of Twitter's API with PHP

Requires [twitteroauth](https://github.com/abraham/twitteroauth) by [abraham](https://github.com/abraham)

This currently only supports retrieving a user's timeline.

Contents
-----
- [Setup](#setup)
- [Implementation](#implementation)
- [Functions](#functions)
 - [twitterfeed()](#twitterfeed)
 - [tf_isRT()](#tf_isrt)
 - [tf_user()](#tf_user)
 - [tf_author()](#tf_author)
 - [tf_avatar()](#tf_avatar)
 - [tf_tweet()](#tf_tweet)
 - [tf_tweetText()](#tf_tweettext)
 - [tf_tweeturl()](#tf_tweeturl)

Setup
-----
You should have four different php files in a directory called **twitterfeed**:
- **loadtweets.php** - makes the connection request to twitter
- **twitterfeed.php** - contains the framework functions
- **twitteroauth.php** - from twitteroauth
- **OAuth.php** - from twitteroauth
 
Implementation
--------------
At the beginning of the file, include twitterfeed.php, which initialises the functions.
Next, create a variable called $tweets and make it equal to the function twitterfeed() with two parameters - the desired user timeline, and the desired number of tweets to load.

    <?php 
	    require_once('twitterfeed/twitterfeed.php');
	    $GLOBALS['tweets'] = twitterfeed('user', 'twitter', 5);
	?>
	
When wanting to access individual tweets, use a foreach statement. Some functions only work within this loop.

    <?php foreach ($GLOBALS['tweets'] as $tweet) : ?>

	    ...

	<?php endforeach; ?>
	
Functions
---------

* * *

<h5><code>twitterfeed(String type, String query, Integer count)</code></h5>

*Returns: Array*

Initialises for the twitterfeed. Called at the very beginning of the code.

The <code>type</code> can be one of the following:
- <code>user</code> - Will only return tweets by the user with a username <code>query</code> 
- <code>search</code> - Will return the most recent tweets that have the <code>query</code> in it

* * *

<h5><code>tf_isRT()</code></h5>

*Returns: Boolean*

Returns if the current tweet is a retweet. Can only be used in the loop.

* * *

<h5><code>tf_user([String property])</code></h5>

*Returns: String/Array*

Returns the loaded user's information. If a property parameter is passed it will echo it if it is a string, else it will return the array. If no property is passed it will return the user array. If the tweet type is something other than a <code>user</code>, it will return the first user's details.

* * *

<h5><code>tf_author([String property])</code></h5>

*Returns: String/Array*

Same as tf_user, but for the current tweet. Can only be use in the loop.

* * *

<h5><code>tf_avatar()</code></h5>

*Returns: String (URL)*

Returns the current user's avatar. If used in the loop it will get the author's avatar.

* * *

<h5><code>tf_tweet([String property])</code></h5>

*Returns: String/Array*

Same as tf_user, but is a tweet object instead. Can only be used in the loop.

* * *

<h5><code>tf_tweetText([Boolean anchorLinks])</code></h5>

*Returns: String (with anchor tags)*

Returns the current tweets text. It will create anchor tags around links, usernames and hashtags by default if anchorLinks is not put to false. Can only be used in the loop.

* * *
