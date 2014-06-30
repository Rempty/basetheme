<?php get_header(); ?>

<section id="content" class="clearfix">
    <div class="container">
    <div class="row">
    <div id="main">
	   <?php get_template_part( 'loop', 'index' ); ?>
    </div><!--#main-->
    <?php get_sidebar(); ?>    
    </div><!--.row-->
</div><!--#container-->

<?php get_footer(); ?>
