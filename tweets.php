<ul class="tweets">

	<!-- List of tweets -->

	<?php foreach ($GLOBALS['tweets'] as $GLOBALS['tweet']) : ?>

		<li>

			<hr>
			<p>
				<small>
					<?php if (tf_isRT()) {echo 'RT - ';} ?>
					<?php tf_author('name') ?> 
					<a href="<?php tf_authorURL(); ?>">
						@<?php tf_author('screen_name'); ?>
					</a>
					<span><br><?php tf_user('created_at'); ?></span>
				</small>
			</p>
			
			<div class="avatar">
				<img src="<?php tf_avatar(); ?>" width="50px">
			</div>

			<div style="margin-left: 60px;">
				<p><?php tf_tweetText(); ?></p>
				<p>
					<span><small>
						<?php tf_tweet('retweet_count'); ?> Retweets, 
						<?php tf_tweet('favorite_count'); ?> Favourites
					</small></span>
					<small style="float: right">
						<a href="<?php tf_tweetURL(); ?>">Link</a>
					</small>
				</p>
			</div>

		</li>

	<?php endforeach; ?>

</ul>
