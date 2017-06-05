<?php
 /* Template Name: Homepage */
?>
<?php get_header(); ?>

<section class="home__slider">    
    
</section><!--home__slider-->

<section id="content" class="clearfix">
    <div class="container">
    <section id="main" class="fullwidth">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
		<article class="page" id="page-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>            

		</article>
		
		<?php //comments_template(); ?>

		<?php endwhile; endif; ?>

    </div><!--.container-->
</section><!--#main-->

<?php get_footer(); ?>
