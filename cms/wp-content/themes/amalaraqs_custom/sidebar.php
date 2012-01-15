<?php dynamic_sidebar("sidebar"); ?>
<div class="sidebar">
	<?php if ( is_front_page()) { ?>
		<h2 class="birds"><span class="sidebar_h2">Featured Events</span></h2>
		<?php do_shortcode('[events category="Featured, Events"]');?>
	<?php } elseif ( in_category( array( 'Classes' ) ) || is_page('Classes') ) { ?>
		<h2 class="birds"><span class="sidebar_h2">Classes</span></h2>
		<?php do_shortcode('[events category="Classes"]');?>
	<?php } elseif (in_category( array( 'Blog' ) )) { ?>
		<h2 class="birds"><span class="sidebar_h2">Recent Posts</span></h2>
		<?php do_shortcode('[posts category="Blog"]');?>
	<?php } elseif (in_category( array( 'Events' ) )) { ?>
		<h2 class="birds"><span class="sidebar_h2">Events</span></h2>
		<?php do_shortcode('[events category="Events"]');?>
	<?php } else { ?>
		<h2 class="birds"><span class="sidebar_h2">Classes</span></h2>
		<?php do_shortcode('[events category="Classes"]');?>
	<?php } ?>
	
	
</div>
<div class="sidebar">
	<h2 class="sidebar_email_updates">E-mail Updates</h2>
	<a target="_blank" title="Subscribe to Amala Gameela's Email Updates" href="http://feedburner.google.com/fb/a/mailverify?uri=AmalaGameela-UpcomingEventsFeed&loc=en_US">Subscribe to receive Updates</a><br /> via Email about Amala's upcoming performances, events, workshops, and more!
</div>
<div class="sidebar">
	<h2 class="birds"><span class="sidebar_h2">Contact Amala</span></h2>
	<span class="headline" id="sidebar_phone">570.236.2966</span>
	<div class="sidebar_spacer"></div>
	<span class="headline" id="sidebar_email">Amala@AmalaRaqs.com</span>
	<div class="sidebar_spacer"></div>
	<span class="headline" id="sidebar_facebook">Connect On Facebook</span>
	<div id="dreamstar_brand"><a href="http://www.dreamstarstudios.com"> </a></div>
	<p class="copy"><small>&copy; <?php echo date('Y'); ?> Amala Gameela</small></p>
	
</div>