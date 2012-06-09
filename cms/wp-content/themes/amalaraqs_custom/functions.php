<?php

require_once get_template_directory() . '/inc/roots-activation.php'; 	// activation
require_once get_template_directory() . '/inc/roots-options.php'; 		// theme options
require_once get_template_directory() . '/inc/roots-cleanup.php'; 		// cleanup
// require_once get_template_directory() . '/inc/roots-htaccess.php'; 		// rewrites for assets, h5bp htaccess
require_once get_template_directory() . '/inc/roots-hooks.php'; 		// hooks
require_once get_template_directory() . '/inc/roots-actions.php'; 		// actions
require_once get_template_directory() . '/inc/roots-widgets.php'; 		// widgets
require_once get_template_directory() . '/inc/roots-custom.php'; 		// custom functions

$roots_options = roots_get_theme_options();

// set the maximum 'Large' image width to the maximum grid width
if (!isset($content_width)) {
	global $roots_options;
	$roots_css_framework = $roots_options['css_framework'];
	switch ($roots_css_framework) {
	    case 'blueprint': 	$content_width = 950;	break;
	    case '960gs_12': 	$content_width = 940;	break;
	    case '960gs_16': 	$content_width = 940;	break;
	    case '960gs_24': 	$content_width = 940;	break;
	    case '1140': 		$content_width = 1140;	break;
	    case 'adapt':	 	$content_width = 940;	break;	    
	    default: 			$content_width = 950;	break;
	}
}

// function roots_setup() {
//	load_theme_textdomain('roots', get_template_directory() . '/lang');
	
	// tell the TinyMCE editor to use editor-style.css
	// if you have issues with getting the editor to show your changes then use the following line:
	// add_editor_style('editor-style.css?' . time());
//	add_editor_style('editor-style.css');
	
	// http://codex.wordpress.org/Post_Thumbnails
//	add_theme_support('post-thumbnails');
	// set_post_thumbnail_size(150, 150, false);
	
	// http://codex.wordpress.org/Post_Formats
	// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	
//	 http:codex.wordpress.org/Function_Reference/add_custom_image_header
//	if (!defined('HEADER_TEXTCOLOR')) { define('HEADER_TEXTCOLOR', '');	}
//	if (!defined('NO_HEADER_TEXT')) { define('NO_HEADER_TEXT', true); }	
//	if (!defined('HEADER_IMAGE')) { define('HEADER_IMAGE', get_template_directory_uri() . '/img/amala_logo.jpg'); }
//	if (!defined('HEADER_IMAGE_WIDTH')) { define('HEADER_IMAGE_WIDTH', 300); }
//	if (!defined('HEADER_IMAGE_HEIGHT')) { define('HEADER_IMAGE_HEIGHT', 75); }

//	function roots_custom_image_header_site() { }
//	function roots_custom_image_header_admin() { 
//		<style type="text/css">
//			.appearance_page_custom-header #headimg { min-height: 0; }
//		</style>
//	}

//	add_custom_image_header('roots_custom_image_header_site', 'roots_custom_image_header_admin');
	
//  }

// add_action('after_setup_theme', 'roots_setup');


add_theme_support('menus');
register_nav_menus(array(
	'primary_navigation' => __('Primary Navigation', 'roots'),
	'utility_navigation' => __('Utility Navigation', 'roots')
));	


// create widget areas: sidebar, footer
$sidebars = array('Sidebar', 'Footer');
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar,
		'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="container">',
		'after_widget' => '</div></article>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

// Shortcode for printing root URL inside posts

function bloginfo_shortcode( $atts ) {
   extract(shortcode_atts(array(
       'key' => 'siteurl',
   ), $atts));
   return get_bloginfo($key);
}
add_shortcode('url', 'bloginfo_shortcode');

// Add Support for the_post_thumbnail();

add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 620, '', true ); // Normal post thumbnails 
	add_image_size( 'full', 620, 750, true ); // Small sidebar thumbnail size
	
/*
Custom RSS Output to accomodate Post Events Plugin and event_date(); function
*/

function custom_rss_output($content) {
		global $post;

    $date = event_date('start', 'M d, Y', false);
    if($date):
		   if ( has_post_thumbnail( $post->ID ) ){ 	  	
          $content = '<h3>Event Date: '.event_date('start', 'M d, Y', false) . get_the_post_thumbnail( $post->ID, 'full' ) . '</h3>'.$content; 
       } else {
       		$content = '<h3>Event Date: ' . event_date('start', 'M d, Y', false) . '</h3>'.$content;
       }
       return $content;
    else:    
          $content = '<h3>Post Date: ' . the_time('M d, Y') . '</h3>' . $content;
    endif;
    return $content;
}
add_filter('the_excerpt_rss', 'custom_rss_output');



// Custom Filters for Multiple Excerpt Lengths

function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($post) {
	return '... ' . '<a class="readmore" href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function wpe_excerptlength_10($length) {
    return 10;
}
function wpe_excerptlength_30($length) {
    return 30;
}
function wpe_excerptlength_90($length) {
    return 90;
}
function wpe_excerptmore($more) {
	return '... ' . '<a class="readmore" href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>';
}
function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}


//  Shortcode for adding YouTube Video Embeds with Fancybox Effect ---> Requires Fancybox be called via .video_box class method

function generate_youtube_embed( $atts, $content = null ) {
	// default parameters
	extract(shortcode_atts(array(
		'youtube_id' => '',
		'rel' => ''
	), $atts));
	// Print the following HTML
	ob_start();	
	echo '<a class="video-box fancybox.iframe" rel="' . $rel . '" href="http://www.youtube.com/embed/' . $youtube_id . '?autoplay=1&rel=0">' . $content . '<span></span></a>';
	return ob_get_clean();
}

add_shortcode('video', 'generate_youtube_embed');


// Shortcode for custom event listing display 

function generate_event_listing( $atts, $content = null ) {
	// default parameters
	extract(shortcode_atts(array(
		'category' => 'Featured',
		'count' => 4
	), $atts));
	// Print the following HTML

								// set the parameters for a new WP_Query 
																
	              $current_date = date('ymd');
	              $sidebarEvents = new WP_Query();
	              $sidebarEvents->query(array(
	                  'category_name' => $category,
	                  'meta_key' => '_date_compare',
	                  'meta_compare' => '>=',
	                  'meta_value' => $current_date,
	                  'orderby' => 'meta_value',
	                  'order'   => 'ASC',
	                  'posts_per_page' => $count
	              ));
	              
	              // beginning the loop now...
	              
	              if ($sidebarEvents->have_posts()) : ?>
	              
	              <ul class="event_list">
	              
		              <?php while ($sidebarEvents->have_posts()) : $sidebarEvents->the_post(); ?>
		
									<li>

										<h3 class="sb_event"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>

										<div class="date">			
											<?php event_date('start','D, M '); ?>
											<?php event_date_range(); ?>&nbsp;|&nbsp;
											<?php event_date('start','g:ia');?> 
										</div>
																														
											
		        	    	<br class="clearfix" />
		        	    	
		        	    </li>
		        	    
		        	    
                 	<?php endwhile; ?>
                 	
              		</ul>

                 	<?php else: ?>
                 	
                 	<p>Sorry, none listed at this time. <a href="mailto:amala@amalaraqs.com">Email Amala</a> for more info about upcoming performances, classes, or to book her for yours today.</p>
                 	

                 	<?php endif; ?>
									<?php wp_reset_query(); ?>
									
<?php }

// shortcode for events listing	
add_shortcode('events', 'generate_event_listing');




// Shortcode for custom loop with title only 

function generate_post_sidebar( $atts, $content = null ) {
	// default parameters
	extract(shortcode_atts(array(
		'category' => 'Blog',
		'count' => 4
	), $atts));
	// Print the following HTML

								// set the parameters for a new WP_Query 
																
	              $sidebarLoop = new WP_Query();
	              $sidebarLoop->query(array(
	                  'category_name' => $category,
	                  'order'   => 'ASC',
	                  'posts_per_page' => $count
	              ));
	              
	              // beginning the loop now...
	              
	              if ($sidebarLoop->have_posts()) : ?>
	              
	              <ul class="recent_posts">
	              
		              <?php while ($sidebarLoop->have_posts()) : $sidebarLoop->the_post(); ?>
		
									<li>

										<h3 class="sb_event"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
																					
										<div class="date">												
											Posted on: <?php the_time('M j, Y'); ?>
										</div>
											
		        	    	<br class="clearfix" />
		        	    	
		        	    </li>
		        	    
		        	    
                 	<?php endwhile; ?>
                 	
              		</ul>

                 	<?php else: ?>
                 	                 	

                 	<?php endif; ?>
									<?php wp_reset_query(); ?>
									
<?php }

// shortcode for post loop	
add_shortcode('posts', 'generate_post_sidebar');





// Shortcode for custom loop with title only 

function generate_post_main( $atts, $content = null ) {
	// default parameters
	extract(shortcode_atts(array(
		'category' => 'Blog',
		'count' => 99
	), $atts));
	// Print the following HTML

								// set the parameters for a new WP_Query 
																
	              $mainLoop = new WP_Query();
	              $mainLoop->query(array(
	                  'category_name' => $category,
	                  'order'   => 'DESC',
	                  'posts_per_page' => $count
	              ));
	              
	              // beginning the loop now...
	              
	              if ($mainLoop->have_posts()) : ?>
	              
	              <ul class="recent_posts">
	              
		              <?php while ($mainLoop->have_posts()) : $mainLoop->the_post(); ?>
		
									<li>

										<h3 class="sb_event"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
																					
										<div class="date">												
											Posted on: <strong><?php the_time('M j, Y'); ?></strong>
										</div>
										
										<p><?php wpe_excerpt('wpe_excerptlength_90', 'wpe_excerptmore'); ?></p>
											
		        	    	<br class="clearfix" />
		        	    	
		        	    </li>
		        	    
		        	    
                 	<?php endwhile; ?>
                 	
              		</ul>

                 	<?php else: ?>
                 	                 	

                 	<?php endif; ?>
									<?php wp_reset_query(); ?>
									
<?php }

// shortcode for events listing	
add_shortcode('posts_full', 'generate_post_main');
?>