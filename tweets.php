<ul class="tweets">
	<?php foreach ($twitter->tweets as $twitter->tweet) : ?>
		<li>
			<hr>
			<p>
				<small>
					<?php if ($twitter->isRT()) {echo 'RT - ';} ?>
					<?php $twitter->author('name') ?> 
					<a href="<?php $twitter->authorURL(); ?>">
						@<?php $twitter->author('screen_name'); ?>
					</a>
					<span><br><?php $twitter->tweet('created_at'); ?></span>
				</small>
			</p>
			<div class="avatar">
				<img src="<?php $twitter->authorAvatar(); ?>" width="50px">
			</div>
			<div style="margin-left: 60px;">
				<p><?php $twitter->tweetHTML(); ?></p>
				<p>
					<span><small>
						<?php $twitter->tweet('retweet_count'); ?> Retweets, 
						<?php $twitter->tweet('favorite_count'); ?> Favourites
					</small></span>
					<small style="float: right">
						<a href="<?php $twitter->tweetURL(); ?>">Link</a>
					</small>
				</p>
			</div>
		</li>
	<?php endforeach; ?>
</ul>
