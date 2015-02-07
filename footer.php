                                                                </section><!--#content-->
                   
    
            
		<footer id="footer">
            <div class="container">
<?php

	$bottom_1_is_active = sidebar_exist_and_active('bottom-widget-area-1');
	$bottom_2_is_active = sidebar_exist_and_active('bottom-widget-area-2');
	$bottom_3_is_active = sidebar_exist_and_active('bottom-widget-area-3');
	$bottom_4_is_active = sidebar_exist_and_active('bottom-widget-area-4');

	if ( $bottom_1_is_active || $bottom_2_is_active || $bottom_3_is_active || $bottom_4_is_active ) : // hide this area if no widgets are active...
?>
	    <div id="bottom-bg">
		<div id="bottom" class="container_24">
		    <div class="bottom-content-padding">
<?php
                        $output = '';
			// all 4 active: 1 case
			if ( $bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'col-md-3', 'bottom-widget-area-1' );
			    $output .= get_dynamic_column( 'bottom_2', 'col-md-3', 'bottom-widget-area-2' );
			    $output .= get_dynamic_column( 'bottom_3', 'col-md-3', 'bottom-widget-area-3' );
			    $output .= get_dynamic_column( 'bottom_4', 'col-md-3', 'bottom-widget-area-4' );
			}
			// 3 active: 4 cases
			if ( $bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'col-md-4', 'bottom-widget-area-1' );
			    $output .= get_dynamic_column( 'bottom_2', 'col-md-4', 'bottom-widget-area-2' );
			    $output .= get_dynamic_column( 'bottom_3', 'col-md-4', 'bottom-widget-area-3' );
			}
			if ( $bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'col-md-4', 'bottom-widget-area-1' );
			    $output .= get_dynamic_column( 'bottom_2', 'col-md-4', 'bottom-widget-area-2' );
			    $output .= get_dynamic_column( 'bottom_4', 'col-md-4 last_column', 'bottom-widget-area-4' );
			}
			if ( $bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'col-md-4', 'bottom-widget-area-1' );
			    $output .= get_dynamic_column( 'bottom_3', 'col-md-4', 'bottom-widget-area-3' );
			    $output .= get_dynamic_column( 'bottom_4', 'col-md-4 last_column', 'bottom-widget-area-4' );
			}
			if ( !$bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_2', 'col-md-4', 'bottom-widget-area-2' );
			    $output .= get_dynamic_column( 'bottom_3', 'col-md-4', 'bottom-widget-area-3' );
			    $output .= get_dynamic_column( 'bottom_4', 'col-md-4', 'bottom-widget-area-4' );
			}
			// 2 active: 6 cases
			if ( $bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && !$bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'col-md-6', 'bottom-widget-area-1' );
			    $output .= get_dynamic_column( 'bottom_2', 'col-md-6', 'bottom-widget-area-2' );
			}
			if ( $bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'col-md-6', 'bottom-widget-area-1' );
			    $output .= get_dynamic_column( 'bottom_3', 'col-md-6', 'bottom-widget-area-3' );
			}
			if ( !$bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_2', 'col-md-6', 'bottom-widget-area-2' );
			    $output .= get_dynamic_column( 'bottom_3', 'col-md-6 last_column', 'bottom-widget-area-3' );
			}
			if ( !$bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_2', 'col-md-6', 'bottom-widget-area-2' );
			    $output .= get_dynamic_column( 'bottom_4', 'col-md-6 last_column', 'bottom-widget-area-4' );
			}
			if ( !$bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_3', 'col-md-6', 'bottom-widget-area-3' );
			    $output .= get_dynamic_column( 'bottom_4', 'col-md-6', 'bottom-widget-area-4' );
			}
			if ( $bottom_1_is_active && !$bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'col-md-6', 'bottom-widget-area-1' );
			    $output .= get_dynamic_column( 'bottom_4', 'col-md-6', 'bottom-widget-area-4' );
			}
			// 1 active: 4 cases
			if ( $bottom_1_is_active && !$bottom_2_is_active && !$bottom_3_is_active && !$bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_1', 'full_width', 'bottom-widget-area-1' );
			}
			if ( !$bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && !$bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_2', 'full_width', 'bottom-widget-area-2' );
			}
			if ( !$bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_3', 'full_width', 'bottom-widget-area-3' );
			}
			if ( !$bottom_1_is_active && !$bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {
			    $output .= get_dynamic_column( 'bottom_4', 'full_width', 'bottom-widget-area-4' );
			}
                        
                        echo $output;
?>
		    </div>
		    <!-- end bottom-content-padding -->
		</div>
		<!-- end bottom -->
	    </div>
	    <!-- end bottom-bg -->                
          <?php	endif; ?>     
              
                <div class="clearfix"></div>
            </div>
		</footer>

	</div>


	<?php wp_footer(); ?>


<!-- here comes the javascript -->

<!-- jQuery is called via the Wordpress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/theme.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>

	
</body>
</html>