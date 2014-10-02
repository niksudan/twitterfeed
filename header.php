<?php if ($twitter->isType('user')) : ?>
	<div class="header" style="background: url('<?php $twitter->user('profile_banner_url'); ?>/1500x500');">
		<div class="avatar">
			<img src="<?php $twitter->userAvatar(); ?>">
		</div>
		<h1><?php $twitter->user('name'); ?>'s Timeline</h1>
		<p>
			<small>
				Followers: <?php $twitter->user('followers_count'); ?>
				<br>Following: <?php $twitter->user('friends_count'); ?>
				<br>Tweets: <?php $twitter->user('statuses_count'); ?>
			</small>
		</p>
	</div>
<?php else : ?>
	<div class="header">
		<h1>'<?php $twitter->searchQuery(); ?>' Tweets</h1>
	</div>
<?php endif; ?>
