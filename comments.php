<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<?php __('This post is password protected. Enter the password to view comments.') ?>
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h3 id="comments"><?php comments_number(__('No Responses'), __('One Response'), __('% Responses' ));?></h3>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p><?php __('Comments are closed.') ?></p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

	<h3><?php comment_form_title( __('Leave a Reply'), __('Leave a Reply to %s' )); ?></h3>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php _e('You must be') ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in'); ?></a> <?php _e('to post a comment.'); ?></p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

			<p><?php _e('Logged in as', 'basetheme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out') ?> &raquo;</a></p>

		<?php else : ?>

			<div class="input-block">
                <label for="author"><?php _e('Name'); ?> <?php if ($req) echo '<span class="requerido">*</span>'; ?></label>
				<input type="text" placeholder="<?php _e('Name'); ?>" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />				
			</div>

			<div class="input-block">
                <label for="email"><?php _e('Mail', 'basetheme'); ?> <?php if ($req) echo '<span class="requerido">*</span>'; ?></label>
				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e('Mail'); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                <?php _e('(will not be published)', 'basetheme'); ?>
			</div>

			<div class="input-block">
                <label for="url"><?php _e('Website'); ?></label>
				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e('Website') ?>" size="22" tabindex="3" />
			</div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div class="textarea-block">
			<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
		</div>

		<div>
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment') ?>" />
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif; ?>
