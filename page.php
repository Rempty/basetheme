<?php get_header(); ?>
<section id="content" class="clearfix">
    <div class="container">
    
    <div id="main">
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
			</div>			
		</article>
		<?php //comments_template(); ?>
		<?php endwhile; endif; ?>
    </div><!--#main-->
    
</div><!--.container-->
<?php get_footer(); ?>