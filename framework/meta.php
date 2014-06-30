<footer class="meta">
	<b>Posted on:</b> <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F jS, Y') ?></time>
	<span class="byline author vcard">
		<b>by</b> <span class="fn"><?php the_author() ?></span>
	</span>
	<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
</footer>