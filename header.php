<?php if (tf_isType('user')) : ?>

	<!-- User Profile Header -->

	<div class="header" style="background: url('<?php tf_user('profile_banner_url'); ?>/1500x500');">

		<img src="<?php tf_avatar(); ?>" width="100px" style="float: right;">

		<h1><?php tf_user('name'); ?>'s Timeline</h1>

		<p>
			<small>
				Followers: <?php tf_user('followers_count'); ?>
				<br>Following: <?php tf_user('friends_count'); ?>
				<br>Tweets: <?php tf_user('statuses_count'); ?>
			</small>
		</p>

	</div>

<?php else : ?>

	<!-- Search Header -->

	<div class="header">

		<h1>'<?php tf_searchQuery(); ?>' Tweets</h1>

	</div>



<?php endif; ?>
