<?php dynamic_sidebar("sidebar"); ?>
<div class="sidebar">
	<?php if ( is_front_page()) { ?>
		<h2 class="birds"><span class="sidebar_h2">Featured Events</span></h2>
		<?php do_shortcode('[events category="Featured, Events"]');?>
	<?php } elseif ( in_category( array( 'Classes' ) ) || is_page('Instruction') ) { ?>
		<h2 class="birds"><span class="sidebar_h2">Classes</span></h2>
		<?php do_shortcode('[events category="Classes" count="7"]');?>
	<?php } elseif (in_category( array( 'Blog' ) ) || is_page('Blog') ) { ?>
		<h2 class="birds"><span class="sidebar_h2">Recent Posts</span></h2>
		<?php do_shortcode('[posts category="Blog"]');?>
	<?php } elseif ( is_page('Abzahrah') ) { ?>
		<h2 class="birds"><span class="sidebar_h2">Abzahrah Events</span></h2>
		<?php do_shortcode('[events category="Abzahrah"]');?>
	<?php } elseif (in_category( array( 'Events' ) )) { ?>
		<h2 class="birds"><span class="sidebar_h2">Events</span></h2>
		<?php do_shortcode('[events category="Events"]');?>
	<?php } else { ?>
		<h2 class="birds"><span class="sidebar_h2">Featured Events</span></h2>
		<?php do_shortcode('[events category="Featured, Events"]');?>
	<?php } ?>
	
	
</div>
<div class="sidebar">
	<h2 class="sidebar_email_updates">E-mail Updates</h2>
	<a target="_blank" title="Subscribe to Amala Gameela's Email Updates" href="http://eepurl.com/e32ZA">Subscribe to receive Updates</a><br /> via Email about Amala's upcoming performances, events, workshops,<br />and more!<br /><br />
		<script type="text/javascript" language="JavaScript" src="http://amalaraqs.us2.list-manage1.com/subscriber-count?b=38&u=ccecad7a-0373-4afe-b84b-db7c1a3d6e4b&id=fea4c6db35"></script>
</div>
<div class="sidebar">
	<h2 class="birds"><span class="sidebar_h2">Contact Amala</span></h2>
	<span class="headline" id="sidebar_phone">570.236.2966</span>
	<div class="sidebar_spacer"></div>
	<span class="headline" id="sidebar_email"><a href="mailto:amala@mamalaraqs.com">Amala@AmalaRaqs.com</a></span>
	<div class="sidebar_spacer"></div>
	<span class="headline" id="sidebar_facebook"><a href="http://facebook.com/amala.gameela" target="_blank">Connect On Facebook</a></span>
	<div id="dreamstar_brand"><a href="http://www.dreamstarstudios.com"> </a></div>
	<p class="copy"><small>&copy; <?php echo date('Y'); ?> Amala Gameela</small></p>
	
</div>