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
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" />	
	<link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/base.css" />
    <link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/forms.css" />
    <link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/framework.css" />
    <link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/slicknav.css" />
    <link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/custom.css" />   
    
    <link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/responsive.css" />

       
    
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
    
    
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<div id="page-wrap">        
<header id="header" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-8">
			<h1>
                <a href="<?php bloginfo('wpurl'); ?>">
                    <img title="<?php bloginfo('description'); ?>" alt="<?php bloginfo('name'); ?>" src="<?php bloginfo("template_url"); ?>/img/logo.png" />
                </a>
            </h1>            
            </div>
            
            <div class="col-md-8  col-xs-4">
            <nav id="topmenu">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'topmenu', 'menu_id' => 'menu-topmenu', 'container' => '' ) ); ?>
            </nav>
            </div>
        </div>  
    </div><!--.container-->
</header>