<?php get_header(); ?>

<section id="content" class="clearfix">
    <div class="container">
    <div class="row">
	<section id="main" class="col-md-9">
        <h2 class="entry-title"><?php _e('Search Results') ?></h2>
        <?php get_template_part( 'loop', 'index' ); ?>
    </section><!--#main-->
    <?php get_sidebar(); ?>
    </div><!--row-->
    </div><!--container-->
<?php get_footer(); ?>