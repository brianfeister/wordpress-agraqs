	<?php roots_footer_before(); ?>
		<footer id="content-info" class="<?php global $roots_options; echo $roots_options['container_class']; ?>" role="contentinfo">
			<?php roots_footer_inside(); ?>
			<div class="container">
				<?php dynamic_sidebar("Footer"); ?>
			</div>	
		</footer>
		<?php roots_footer_after(); ?>
	</div><!-- /#wrap -->	
<?php wp_footer(); ?>
<?php roots_footer(); ?>

	<!--[if lt IE 7]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
</div> <!--  header_bg  -->
<div id="footer_wrap"></div>
</div> <!--  sky_bg  -->
</body>
</html>