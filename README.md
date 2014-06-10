Twitterfeed-PHP
===============
Framework for easy use of Twitter's API with PHP

Requires [twitteroauth](https://github.com/abraham/twitteroauth) by [abraham](https://github.com/abraham)

This currently only supports retrieving a user's timeline.

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
	    $GLOBALS['tweets'] = twitterfeed('twitter', 5);
	?>
	
When wanting to access individual tweets, use a foreach statement. Some functions only work within this loop.

    <?php foreach ($GLOBALS['tweets'] as $tweet) : ?>

	    ...

	<?php endforeach; ?>
	
Functions
---------

* * *

**twitterfeed(username, count)**

*Returns: Array*

Initialises for the twitterfeed. Called at the start of the code.

* * *

**tf_isRT()**

*Returns: Boolean*

Returns if the current tweet is a retweet. Can only be used in the loop.

* * *

**tf_user([String property])**

*Returns: String/Array*

Returns the loaded user's information. If a property parameter is passed it will echo it if it is a string, else it will return the array. If no property is passed it will return the user array.

* * *

**tf_author([String property])**

*Returns: String/Array*

Same as tf_user, but for the current tweet. Can only be use in the loop.

* * *

**tf_avatar()**

*Returns: String (URL)*

Returns the current user's avatar. If used in the loop it will get the author's avatar.

* * *

**tf_tweet([String property])**

*Returns: String/Array*

Same as tf_user, but is a tweet object instead. Can only be used in the loop.

* * *

**tf_tweetText([Boolean anchorLinks])**

*Returns: String (with anchor tags)*

Returns the current tweets text. It will create anchor tags around links, usernames and hashtags by default if anchorLinks is not put to false. Can only be used in the loop.

* * *
