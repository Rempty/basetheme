<?php get_header(); ?>
<section id="content" class="clearfix">
    <div class="container">
    <div class="row">
    <div id="main" class="col-md-9">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">         
            <?php if(function_exists('bcn_display')) { ?>
                <div class="breadcrumb clearfix clearboth">
                <?php bcn_display(); ?>
                </div><!--breadcrumb-->    
            <?php } ?>
            <div class="post-thumb">
            <?php 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                the_post_thumbnail('lansdscape-thumb');
            } 
            ?>
            </div><!--.post-thumb-->
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			</div>
			<?php edit_post_link(__('Edit this entry.'), '<p>', '</p>'); ?>            
		</article>
		<?php //comments_template(); ?>
		<?php endwhile; endif; ?>
    </div><!--#main-->
    <?php get_sidebar(); ?>
    </div><!--.row-->
</div><!--.container-->
<?php get_footer(); ?>