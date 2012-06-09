<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php roots_post_before(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php roots_post_inside_before(); ?>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<p class="meta">
					<?php if ( in_category(array('Classes','Abzahrah','Featured','Performances','Classes')) && function_exists('event_long_date')) {

						echo 'Event Date: <strong>';
						event_long_date();
						echo '</strong> | ';
						echo event_location();
						echo ' | <a href="';
						event_address();
						echo '">View Map</a>'; 
						
					} else {
						echo 'Posted On: <strong>';
						the_date();
						echo '</strong>';
					} ?>
				</p>
				
				<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail();
				} else {
				     	// No image for this post
				} ?>
				
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php roots_post_inside_after(); ?>		
		</article>
	<?php roots_post_after(); ?>
<?php endwhile; // End the loop ?>