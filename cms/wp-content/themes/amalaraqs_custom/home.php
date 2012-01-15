<?php
/**
 * @package WordPress
 * @subpackage Amala Raqs Custom

Template Name: Home

*/

get_header(); ?>

	<?php roots_content_before(); ?>
		<div id="content" class="<?php echo $roots_options['container_class']; ?>">	
		<?php roots_main_before(); ?>
			<div id="main" class="<?php echo $roots_options['main_class']; ?>" role="main">
				<div class="container">
					<?php roots_loop_before(); ?>
					<?php get_template_part('loop', 'page'); ?>
					<?php roots_loop_after(); ?>
					
					<div class="journal">
						<?php
	                    $recentEvents = new WP_Query();
	                    $recentEvents->query(array(
	                        'category_name' => 'blog',
	                        'order' => 'DESC',
	                        'posts_per_page' => 1
	                    )); 
	                    if ($recentEvents->have_posts()) : while ($recentEvents->have_posts()) : $recentEvents->the_post(); ?>
	            
	            
	                   
	                    <div class="blog_single" id="post-<?php the_ID(); ?>">
	                        
	                    <h3 class="sub_heading"><a href="<?php the_permalink();?>" title="More details about <?php the_title();?>"><?php if ( in_category('blog') ) { the_title(); } elseif (in_category('events') ) { the_title(); } elseif (in_category('classes') ) { the_title(); } else { echo '' ;} ?></a></h3>
	                      
	                        <?php
	                        
	                        $post_id = get_the_ID();
	                        
	                                echo '<h3 class="post_date">';
	                                the_time('F j, Y');
	                                echo "</h3>";
	                        ?>
	            
	                        <?php edit_post_link('Edit this entry','',''); ?>
	                        
	
	                        
	                        <p class="event_excerpt"><?php wpe_excerpt('wpe_excerptlength_45', 'wpe_excerptmore'); ?></p>            
	                                        
	                        <?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	                    </div>
	                
	                    <?php endwhile; ?>
	            
	                    <?php else : ?>
	                    
	                         <p><?php _e('None posted at this time.'); ?></p>
	                    <?php endif; ?>
					</div><!-- /journal end -->
					
				</div>
			</div><!-- /#main -->
		<?php roots_main_after(); ?>
		<?php roots_sidebar_before(); ?>			
			<aside id="sidebar" class="<?php echo $roots_options['sidebar_class']; ?>" role="complementary">
			<?php roots_sidebar_inside_before(); ?>
				<div class="container">
					<?php get_sidebar(); ?>
				</div>
			<?php roots_sidebar_inside_after(); ?>
			</aside><!-- /#sidebar -->		
		<?php roots_sidebar_after(); ?>
		</div><!-- /#content -->
	<?php roots_content_after(); ?>
<?php get_footer(); ?>