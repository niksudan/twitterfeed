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
				<?php if ($twitter->hasMedia()) : ?>
					<ul class="media">
						<?php for ($i = 0; $i < count($twitter->media()); $i ++) : ?>
							<li>
								<a href="<?php $twitter->media($i, 'url'); ?>">
									<img width="256" src="<?php $twitter->media($i); ?>" title="Photo by <?php $twitter->author('name'); ?>">
								</a>
							</li>
						<?php endfor; ?>
					</ul>
				<?php endif; ?>
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
