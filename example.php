<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Twitter Feed v1.4</title>
	<?php require_once('twitterfeed/twitterfeed-new.php'); ?>
</head>
<body>

<?php
	global $twitter;
	$twitter = new Twitterfeed('search', 'google', 5);
?>

<pre><?php echo var_dump($twitter->tweets); ?></pre>

<table>
	<tr>
		<?php if ($twitter->hasTweets()) : ?>
			<td style="width: <?php echo (100); ?>%; min-width: 400px;" valign="top">
				<div class="container">
					<?php include 'header.php'; ?>
					<?php include 'tweets.php'; ?>
				</div>
			</td>
		<?php endif; ?>
	</tr>
</table>
	
</body>
</html>
