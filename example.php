<?php require_once('twitterfeed/twitterfeed.php'); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Twitter Feed</title>
</head>

<body>

<?php 

$tweetlist = array(
	array('user', 'twitter'), 
	array('user', 'youtube'),
	array('user', 'facebook'),
	array('user', 'google'),
	array('search', 'test'),
	);

 ?>

<table>
	<tr>

		<?php foreach ($tweetlist as $u) : ?>

			<td style="width: <?php echo (100/count($tweetlist)); ?>%; min-width: 400px;" valign="top">
				<div class="container">
					<?php twitterfeed($u[0], $u[1], 5); ?>
					<?php include 'header.php'; ?>
					<?php include 'tweets.php'; ?>
				</div>
			</td>

		<?php endforeach; ?>

	</tr>
</table>
</div>

</body>

</html>
