<?php get_header(); ?>

<section id="content" class="clearfix">
    <div class="container">
    <div class="row">
    <div id="main" class="col-md-9">
    
    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h2>Archivo para la categoria: &#8216;<?php single_cat_title(); ?>&#8217; </h2>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h2>Posts tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2>Archivo para <?php the_time('F jS, Y'); ?></h2>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2>Archivo para <?php the_time('F, Y'); ?></h2>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2 class="pagetitle">Archivo para <?php the_time('Y'); ?></h2>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h2 class="pagetitle">Archivo por autor</h2>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="pagetitle">Archivo del Blog</h2>
			
			<?php } ?>
    
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

