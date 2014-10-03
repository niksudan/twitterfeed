Twitterfeed-PHP
===============
*Version 1.5*

Framework for easy use of Twitter's API with PHP

Requires [twitteroauth](https://github.com/abraham/twitteroauth) by [abraham](https://github.com/abraham)

Twitterfeed-PHP introduces a class called Twitterfeed that allows you to easily make requests to twitter and get various tweet information from feeds.

Contents
-----
- [Setup](#setup)
- [Implementation](#implementation)
- [Examples](#examples)
- [Functions](#functions)

Setup
-----
You should have three different php files in a directory called **twitterfeed**:
- **twitterfeed.php** - contains the Twitterfeed class
- **twitteroauth.php** - from twitteroauth
- **OAuth.php** - from twitteroauth
 
Implementation
--------------

You'll need to define four constants that hold your four keys in <code>twitterfeed.php</code>:
- <code>API_KEY</code>
- <code>API_SECRET</code>
- <code>ACCESS_KEY</code>
- <code>ACCESS_SECRET</code>

You can get these by creating a twitter application via the [Twitter Application Management](https://apps.twitter.com/) site.

Throw this somewhere in your file before the twitterfeed functions to define the class. A good place is the header.

    <?php require_once('twitterfeed/twitterfeed.php'); ?>
    
To set up a list of tweets, you need to create a Twitterfeed object. It's a good idea to make it global if you need to use the class in various files.

	<?php $twitter = new Twitterfeed('user', 'twitter', 5); ?>
	
When wanting to access individual tweets, use the following loop. Some functions only work within this loop.

    <?php foreach ($twitter->tweets as $twitter->tweet) : ?>

	    ...

	<?php endforeach; ?>
	
And that's it!
	
Examples
--------

Here's a basic example showing a list of [Twitter's](http://twitter.com/twitter) latest 5 tweets:

	<html>
	<body>
	<?php require_once('twitterfeed/twitterfeed.php'); ?>
	<?php $twitter = new Twitterfeed('user', 'twitter', 5); ?>
	<ul>
		<?php foreach ($twitter->tweets as $twitter->tweet) : ?>
		
			<li>
			<h4><?php $twitter->author('name'); ?>:</h4>
			<p><?php $twitter->tweetHTML(); ?></p>
			</li>
		
		<?php endforeach; ?>
	</ul>
	</body>
	</html>

There is a detailed example included in the repository. It uses <code>header.php</code> to display module headers and <code>tweets.php</code> to display the module tweets.

Functions
---------

* * *

<h5><code>Twitterfeed(String type, String value, Integer limit)</code></h5>

Constructor for the Twitterfeed class.

The type can be the following:
- *user* - *value* must be the username
- *search* - *value* must be search query

* * *

<h5><code>hasTweets()</code></h5>

*Returns: Boolean*

Returns whether the Twitterfeed has any tweets in it.

* * *

<h5><code>isType()</code></h5>

*Returns: Boolean*

Returns whether the Twitterfeed matches that type.

* * *

<h5><code>isRT()</code></h5>

*Returns: Boolean*

Returns whether the current tweet is a retweet. Used within the loop only.

* * *

<h5><code>user([String property, Boolean echo])</code></h5>

*Returns: Mixed*

Outputs the Twitterfeed user's information. If *echo* is set to false, it will return the value instead. 

* * *

<h5><code>author([String property, Boolean echo])</code></h5>

*Returns: Mixed*

Same as *user()*, but returns the current tweet's author instead. Used within the loop only.

* * *

<h5><code>tweet([String property, Boolean echo])</code></h5>

*Returns: Mixed*

Outputs the current tweet's information. If *echo* is set to false, it will return the value instead. Used within the loop only.

* * *

<h5><code>tweetText([Boolean echo])</code></h5>

*Returns: Mixed*

Outputs the tweet's text without any tags. If *echo* is set to false, it will return the value instead. Used within the loop only.

* * *

<h5><code>tweetHTML([Boolean links, Boolean hashtags, Boolean mentions, Boolean mediaLinks])</code></h5>

*Returns: Nothing*

Outputs the tweet's text with tags. If any of the variables are set to false, they are wrapped within a *span* element instead. URLs are given the class *url*, hashtags given the class *hashtag* and mentions given the class *mention*. If *mediaLinks* is set to false, it will not show links that link to media entities.

* * *

<h5><code>searchQuery()</code></h5>

*Returns: Nothing*

Outputs the current Twitterfeed's search query only if the type is a search.

* * *

<h5><code>userAvatar()</code></h5>

*Returns: Nothing*

Outputs the Twitterfeed user's avatar URL.

* * *

<h5><code>authorAvatar()</code></h5>

*Returns: Nothing*

Outputs the current tweet author's avatar URL. Used within the loop only.

* * *

<h5><code>userURL()</code></h5>

*Returns: Nothing*

Outputs the Twitterfeed user's URL.

* * *

<h5><code>authorURL()</code></h5>

*Returns: Nothing*

Outputs the current tweet author's URL. Used within the loop only.

* * *

<h5><code>tweetURL()</code></h5>

*Returns: Nothing*

Outputs the current tweet's URL. Used within the loop only.

* * *

<h5><code>hasMedia()</code></h5>

*Returns: Boolean*

Returns if the current tweet has any media entities attached to it. Note that animated GIFs do not fall under media entities. Used within the loop only.

* * *

<h5><code>media([Integer index, String property, Boolean echo])</code></h5>

*Returns: Mixed*

Returns or outputs media entity data associated with the current tweet. Used within the loop only.

- If nothing is specified, return an array of the media entities
- If an index is given, output the media_url of the given media entities
- If a property is given, output the property of the given media entity instead
- If echo is set to false, return the value instead of outputting it
