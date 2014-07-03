Twitterfeed-PHP
===============
*Version 1.2*

Framework for easy use of Twitter's API with PHP

Requires [twitteroauth](https://github.com/abraham/twitteroauth) by [abraham](https://github.com/abraham)

Contents
-----
- [Setup](#setup)
- [Implementation](#implementation)
- [Examples](#examples)
- [Functions](#functions)
 - [twitterfeed()](#twitterfeedstring-type-string-query-integer-count)
 - [tf_user()](#tf_userstring-property)
 - [tf_author()](#tf_authorstring-property)
 - [tf_tweet()](#tf_tweetstring-property)
 - [tf_tweetText()](#tf_tweettextboolean-anchorlinks)
 - [tf_tweetURL()](#tf_tweeturl)
 - [tf_userURL()](#tf_userurl)
 - [tf_authorURL()](#tf_authorurl)
 - [tf_avatar()](#tf_avatar)
 - [tf_searchQuery()](#tf_avatar)
 - [tf_isRT()](#tf_isrt)
 - [tf_isType()](#tf_istypestring-type)

Setup
-----
You should have four different php files in a directory called **twitterfeed**:
- **loadtweets.php** - makes the connection request to twitter
- **twitterfeed.php** - contains the framework functions
- **twitteroauth.php** - from twitteroauth
- **OAuth.php** - from twitteroauth
 
Implementation
--------------

You'll need to specify values for <code>$api_key</code>, <code>$api_secret</code>, <code>$access_key</code>, and <code>$access_secret</code> in **loadtweets.php**. You can get these by creating a twitter application via the [Twitter Application Management](https://apps.twitter.com/) site.
 
Throw this somewhere in your file before the twitterfeed functions to set everything up.

    <?php require_once('twitterfeed/twitterfeed.php'); ?>
    
To set up a list of tweets, you need to use the function <code>twitterfeed()</code> before you use any of the other functions.
	
When wanting to access individual tweets, use the following loop. Some functions only work within this loop.

    <?php foreach ($GLOBALS['tweets'] as $GLOBALS['tweet']) : ?>

	    ...

	<?php endforeach; ?>
	
Examples
--------

Here's a basic example showing a list of [Twitter's](http://twitter.com/twitter) latest 5 tweets:

	<html>
	<body>
	<?php require_once('twitterfeed/twitterfeed.php'); ?>
	<?php twitterfeed('user', 'twitter', 5); ?>
	<ul>
		<?php foreach ($GLOBALS['tweets'] as $GLOBALS['tweet']) : ?>
		
			<li>
			<h4><?php tf_author('name'); ?>:</h4>
			<p><?php tf_tweetText(); ?></p>
			</li>
		
		<?php endforeach; ?>
	</ul>
	</body>
	</html>

There is a detailed example included in the repository. It creates something similar to tweetdeck using the framework. <code>example.php</code> is the main file. It uses <code>header.php</code> to display module headers and <code>tweets.php</code> to display the module tweets.

Functions
---------

* * *

<h5><code>twitterfeed(String type, String query, Integer count)</code></h5>

*Returns: Array*

Initialises for the twitterfeed. Called at the very beginning of the code.

The <code>type</code> (twitterfeed type) can be one of the following:
- <code>user</code> - Will only return tweets by the user with a username <code>query</code> 
- <code>search</code> - Will return the most recent tweets that have the <code>query</code> in it

By default it will return 10 tweets.

* * *

<h5><code>tf_user([String property])</code></h5>

*Returns: String/Array*

Returns the loaded user's information. If a property parameter is passed it will echo it if it is a string, else it will return the array. If no property is passed it will return the user array. If the twitterfeed type is something other than <code>user</code>, it will return the first user's details.

[User Properties](https://dev.twitter.com/docs/platform-objects/users)

* * *

<h5><code>tf_author([String property])</code></h5>

*Returns: String/Array*

Same as <code>tf_user()</code>, but for the current tweet. Can only be use in the loop.

[User Properties](https://dev.twitter.com/docs/platform-objects/users)

* * *

<h5><code>tf_tweet([String property])</code></h5>

*Returns: String/Array*

Same as <code>tf_user()</code>, but is a tweet object instead. Can only be used in the loop.

[Tweet Properties](https://dev.twitter.com/docs/platform-objects/tweets)

* * *

<h5><code>tf_tweetText([Boolean anchorLinks])</code></h5>

*Returns: String (with anchor tags)*

Returns the current tweet's text. It will create anchor tags around links, usernames and hashtags by default if <code>anchorLinks</code> is not set to false. Can only be used in the loop.

* * *

<h5><code>tf_tweetURL()</code></h5>

*Returns: String (URL)*

Returns a link to the current tweet. Can only be used in the loop.

* * *

<h5><code>tf_userURL()</code></h5>

*Returns: String (URL)*

Returns a link to the loaded user's profile. If the twitterfeed type is not set to <code>user</code>, it will return the first user's details.

* * *

<h5><code>tf_authorURL()</code></h5>

*Returns: String (URL)*

Returns a link to the tweet's author. Will use <code>tf_userURL()</code> if used the loop.

* * *

<h5><code>tf_avatar()</code></h5>

*Returns: String (URL)*

Returns the current user's avatar. If used in the loop it will get the author's avatar.

* * *

<h5><code>tf_searchQuery()</code></h5>

*Returns: String*

Returns the search query used if the twitterfeed type was set to <code>search</code>.

* * *

<h5><code>tf_isRT()</code></h5>

*Returns: Boolean*

Returns if the current tweet is a retweet. Can only be used in the loop.

* * *

<h5><code>tf_isType(String type)</code><h5>

*Returns: Boolean*

Returns whether the <code>type</code> matches the twitterfeed type.

* * *
