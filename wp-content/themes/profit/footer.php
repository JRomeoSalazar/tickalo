<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @subpackage Profit
 * @since Profit 1.0
 */
?>
</div><!-- #main -->
<?php if ( get_page_template_slug() != 'template-landing-page.php' || is_search() ): ?>
	<footer id="footer" class="site-footer">
		<a href="#" id="toTop" class="toTop hidden-xs hidden-sm"><i class="fa fa-angle-up"></i></a>
		<?php get_sidebar( 'footer' ); ?>
		<div class="footer-inner">
			<div class="container">
				<?php
				$mp_profit_facebook_link    = esc_url( get_theme_mod( 'mp_profit_facebook_link',  '#'  ) );
				$mp_profit_twitter_link     = esc_url( get_theme_mod( 'mp_profit_twitter_link',  '#'  ) );
				$mp_profit_linkedin_link    = esc_url( get_theme_mod( 'mp_profit_linkedin_link',  '#'  ) );
				$mp_profit_google_plus_link = esc_url( get_theme_mod( 'mp_profit_google_plus_link',  '#'  ) );
				$mp_profit_instagram_link   = esc_url( get_theme_mod( 'mp_profit_instagram_link',  '#'  ) );
				$mp_profit_pinterest_link   = esc_url( get_theme_mod( 'mp_profit_pinterest_link', '' ) );
				$mp_profit_tumblr_link      = esc_url( get_theme_mod( 'mp_profit_tumblr_link', '' ) );
				$mp_profit_youtube_link     = esc_url( get_theme_mod( 'mp_profit_youtube_link', '' ) );
				$mp_profit_rss_link  = esc_url( get_theme_mod( 'mp_profit_rss_link',  '#'  ) );
				$mp_profit_copyright = wp_kses_data( get_theme_mod( 'mp_profit_copyright' ) );
				?>
				<div class="social-profile type1 pull-right">
					<?php if ( ! empty( $mp_profit_facebook_link ) ): ?>
						<a href="<?php echo $mp_profit_facebook_link; ?>" class="button-facebook" title="Facebook"
						   target="_blank"><i class="fa fa-facebook"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_twitter_link ) ): ?>
						<a href="<?php echo $mp_profit_twitter_link; ?>" class="button-twitter" title="Twitter"
						   target="_blank"><i class="fa fa-twitter"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_linkedin_link ) ): ?>
						<a href="<?php echo $mp_profit_linkedin_link; ?>" class="button-linkedin" title="LinkedIn"
						   target="_blank"><i class="fa fa-linkedin"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_google_plus_link ) ): ?>
						<a href="<?php echo $mp_profit_google_plus_link; ?>" class="button-google" title="Google +"
						   target="_blank"><i class="fa fa-google-plus"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_instagram_link ) ): ?>
						<a href="<?php echo $mp_profit_instagram_link; ?>" class="button-instagram" title="Instagram"
						   target="_blank"><i class="fa fa-instagram"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_pinterest_link ) ): ?>
						<a href="<?php echo $mp_profit_pinterest_link; ?>" class="button-pinterest" title="Pinterest"
						   target="_blank"><i class="fa fa-pinterest"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_tumblr_link ) ): ?>
						<a href="<?php echo $mp_profit_tumblr_link; ?>" class="button-tumblr" title="Tumblr"
						   target="_blank"><i class="fa fa-tumblr"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_youtube_link ) ): ?>
						<a href="<?php echo $mp_profit_youtube_link; ?>" class="button-youtube" title="Youtube"
						   target="_blank"><i class="fa fa-youtube"></i></a>
					<?php endif; ?>
					<?php if ( ! empty( $mp_profit_rss_link ) ): ?>
						<a href="<?php echo $mp_profit_rss_link; ?>" class="button-rss" title="Rss" target="_blank"><i
								class="fa fa-rss"></i></a>
					<?php endif; ?>
				</div>
				<p class="copyright">
                    <span class="copyright-date">&copy; Copyright <?php echo date('Y') ?></span>
                    <a href="<?php echo get_site_url() ?>" title="Tíckalo">Tickalo</a>
				</p>
			</div>
		</div>
	</footer>
<?php endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>