<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Twitter Feed</title>
	<?php require_once('twitterfeed/twitterfeed.php'); ?>
</head>
<body>

<?php
	global $twitter;
	$twitter = new Twitterfeed('user', 'niksudan', 5);
?>

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
