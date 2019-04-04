<?php if ( is_active_sidebar( 'bulk-footer-area' ) ) { ?>  				
	<div id="content-footer-section" class="row clearfix">
		<div class="container">
			<?php dynamic_sidebar( 'bulk-footer-area' ) ?>
		</div>	
	</div>		
<?php } ?> 
</div>
<footer id="colophon" class="footer-credits container-fluid row">
	<div class="container">
	<?php do_action( 'bulk_generate_footer' ); ?> 
	</div>	
</footer>
<!-- end main container -->
</div>
<?php wp_footer(); ?>

</body>
</html>
