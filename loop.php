<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <div class="row">
            <div class="col-xs-3 col-md-1">
                <div class="fecha">
                    <span class="mes"><?php the_time('M'); ?></span><br/>
                    <span class="dia"><?php the_time('d'); ?></span>
                    <span class="anio"><?php the_time('Y'); ?></span>
                </div>    
            </div><!--columna-->
            
            <div class="col-xs-9 col-md-11">
            <?php 
                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                    the_post_thumbnail();
                } 
                ?>
    		<h3 class="entry-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="entry-content">
				
				<?php the_excerpt(); ?>
	   		     <?php the_tags( __('Tags: '), ', ', ''); ?>   
                 <p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary" title="<?php the_title(); ?>"><?php _e('Read More'); ?></a>
                 </p>

			</div>
            </div><!--columna-->
            </div><!--.row-->
	       </article>
 
	<?php endwhile;?>
    <?php if(function_exists('wp_paginate')) {
        wp_paginate();
    } ?> 
    <?php if (function_exists('wp_pagination')) wp_pagination($wp_query); ?>
	
<?php else: ?>
    <p><?php _e('Search not found') ?></p>
<?php endif; ?>