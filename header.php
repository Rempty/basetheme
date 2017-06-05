<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
    <![endif]-->      
	<link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/template.css" />       
    
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<div id="page-wrap">        
<header id="header" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-8">
			<h1>
                <a href="<?php bloginfo('wpurl'); ?>" title="<?php bloginfo('description'); ?>">
					<?php
					$logo = get_theme_mod( 'baset_logo' );
					if($logo == "") {
						$logo =  get_bloginfo("template_url").'/img/logo.png';
					}
					?>
                    <img alt="<?php bloginfo('name'); ?>" src="<?php echo $logo; ?>" class="img-responsive" />
                    <span><?php bloginfo('name'); ?></span>
                </a>
            </h1>            
            </div>
            
            <div class="col-md-9  col-xs-4">
            <nav id="topmenu">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'topmenu', 'menu_id' => 'menu-topmenu', 'container' => '' ) ); ?>
            </nav>
            </div>
        </div>  
    </div><!--.container-->
</header>