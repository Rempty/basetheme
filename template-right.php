<?php
 /* Template Name: Right Sidebar */
?>
<?php get_header(); ?>

<section id="content" class="clearfix">
    <div class="container">
    <div class="row">
    <div id="main" class="col-md-9">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="page" id="page-<?php the_ID(); ?>">         
            
            <?php if(function_exists('bcn_display')) { ?>
                <div class="breadcrumb clearfix clearboth">
                <?php bcn_display(); ?>
                </div><!--breadcrumb-->    
            <?php } ?>
                        
            
			<h2><?php the_title(); ?></h2>
                       

			<div class="entry">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>            

		</article>
		
		<?php //comments_template(); ?>

		<?php endwhile; endif; ?>
    
    </div><!--#main-->
    <?php get_sidebar(); ?>    
    </div><!--.row-->
</div><!--#container-->

<?php get_footer(); ?>
