<?php 
require_once('twitterfeed/twitterfeed.php');

$u = 'testing';

if (isset($_GET['username']))
	$u = $_GET['username'];

$GLOBALS['tweets'] = twitterfeed('search', $u, 10);
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title></title>
</head>

<style type="text/css">
	body {
		font-family: sans-serif;
		width: 480px;
		margin: auto;
		background: #ddd;
	}
	#container {
		background: #fff;
		border-radius: 10px;
		overflow: hidden;
		margin: 1em 0;
	}
	header {
		text-shadow: 0 0 10px black;
		color: white;
		padding: 1em;
	}
	header img {
		box-shadow: 0 0 15px black;
	}
	ul {
		margin: 0;
		list-style: none;
		padding-left: 0;
	}
	li {
		padding: 0 15px;
		margin-top: 1em;
	}
	#tweets img {
		float: left;
		margin-right: 1em;
	}
	a {
		text-decoration: none;
	}
</style>

<body>

<div id="container">

	<header style="background: url('<?php tf_user('profile_banner_url'); ?>/1500x500'); background-size: 120%; background-repeat: no-repeat;">
		<img src="<?php tf_avatar(); ?>" width="100px" style="float: right;">

		<h1><?php tf_user('name'); ?>'s Timeline</h1>
		<p>
			<small>
				Followers: <?php tf_user('followers_count'); ?>
				<br>Following: <?php tf_user('friends_count'); ?>
				<br>Tweets: <?php tf_user('statuses_count'); ?>
			</small>
		</p>
	</header>

	<ul id="tweets">

		<?php foreach ($GLOBALS['tweets'] as $tweet) : ?>
			<li>
				<p>
					<small>
						<?php if (tf_isRT()) {echo 'RT - ';} ?>
						<?php tf_author('name') ?> 
						<a href="http://twitter.com/<?php tf_author('screen_name'); ?>">
							@<?php tf_author('screen_name'); ?>
						</a>
					</small>
				</p>
				<p>
					<div style="width:50px; height: 50px; overflow: hidden; float: left;"><img src="<?php tf_avatar(); ?>" width="50px"></div>
					<div style="margin-left: 60px;"><?php tf_tweetText(); ?></p></div>
				<p>
					<small>
						<?php tf_tweet('retweet_count'); ?> Retweets, 
						<?php tf_tweet('favorite_count'); ?> Favourites
					</small>
					<small style="float: right">
						<a href="<?php tf_tweeturl(); ?>">Link</a>
					</small>
				</p>
				<hr>
			</li>
		<?php endforeach; ?>

	</ul>

</div>

</body>
</html>
