		</div>

		<div id="footer">
			<ul id="footer-links">
				
				<?php
				if ( has_nav_menu( 'footer' ) ) {

					wp_nav_menu(
						array(
							'container'  => '',
							'items_wrap' => '%3$s',
							'theme_location' => 'footer',
							'depth' => 1
						)
					);

				}
				?>
			</ul>
			<div id="footer-bottom">
				<div id="footer-title">
					<div class="name">Council for the Advancement of Science Writing</div>
					<div class="tagline">promoting excellence in science news since 1960</div>
				</div>
				<div id="footer-social">
					<a href="http://www.twitter.com/ScienceWriting" class="twitter" title="Follow us on Twitter"><span>Twitter</span></a>
					<a href="https://www.facebook.com/SciWriting" class="facebook" title="Follow us on Facebook"><span>Facebook</span></a>
					<a href="https://www.youtube.com/c/CASWScienceWriting" class="youtube" title="Follow us on YouTube"><span>YouTube</span></a>
					<a href="https://www.linkedin.com/company/council-for-the-advancement-of-science-writing-inc" class="linkedin" title="Follow us on LinkedIn"><span>LinkedIn</span></a>
				</div>
				<div id="footer-copyright">
					PO Box 17337 | Seattle, WA 98127<br/>
					&copy;<?php
					echo date_i18n(
						/* translators: Copyright date format, see https://www.php.net/date */
						_x( 'Y', 'copyright date format', 'casw' )
					);
					?>. CASW was incorporated in 1961 as a nonprofit, tax-exempt 50l(c)(3) educational organization.
				</div>
				<div id="footer-credit">
					<a href="https://bandwidthproductions.com"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bandwidth.png" width="75" height="33" alt="Website designed and developed by Bandwidth Productions" /></a>
				</div>
			</div>
		</div>
		
		<?php wp_footer(); ?>
					
	</body>
</html>
