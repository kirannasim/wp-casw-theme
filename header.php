<!DOCTYPE html>
<html>
	<head>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-WML7D3M');</script>
		<!-- End Google Tag Manager -->
		
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-16x16.png" />
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-96x96.png" />
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-192x192.png" />
        <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-120x120.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-152x152.png" />
		<link rel="apple-touch-icon" sizes="167x167" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-167x167.png" />
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicons/favicon-180x180.png" />
		
		<!-- Osano Cookie Consent -->
        <script src="https://cmp.osano.com/16CW0kSf8SsG61gZ1/b6cd3c0e-0a21-4178-ba2e-7a8ca3fd88b5/osano.js"></script>
		
		<?php  wp_head();  ?>
		
		<link rel="stylesheet" href="//s3.amazonaws.com/bandwidthcdn/styles/ui-1.2.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/global.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/pages.css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/displays.css" />
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="//s3.amazonaws.com/bandwidthcdn/javascript/ui-1.2.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/global.js"></script>

		
	</head>

	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WML7D3M"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
	
		<!--
						<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'enable_header_search', true );

					if ( true === $enable_header_search ) {

						?>

						<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php casw_the_theme_svg( 'search' ); ?>
								</span>
								<span class="toggle-text"><?php _e( 'Search', 'casw' ); ?></span>
							</span>
						</button>

					<?php } ?>


		-->
		
		
		
		<div id="header">
			<div id="site-name"><a href="/" title="Home">CASW</a></div>
			<!-- <h1><a href="/" title="Home">CASW</a></h1> -->
			<div id="nav">
				<div id="nav-menu"></div>
				<ul>
				
				<?php
				if ( has_nav_menu( 'primary' ) ) {

					wp_nav_menu(
						array(
							'container'  => '',
							'items_wrap' => '%3$s',
							'theme_location' => 'primary',
							'depth' => 2
						)
					);

				}
				?>
					<li class="search"><a href="/search/">Search</a></li>			
				</ul>
			</div>
			<div id="header-extras">
				<a href="/search/" id="search-button" title="Search CASW"><span>Search</span></a>
				<a href="/about/donate/" id="donate-button" title="Donate to CASW">Donate</a>
			</div>
		</div>

				
		
		
<?php /*
		
			<?php
					if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<div class="header-toggles hide-no-js">

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'casw' ); ?></span>
										<span class="toggle-icon">
											<?php casw_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button>

							</div>

							<?php
						}

						if ( true === $enable_header_search ) {
							?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php casw_the_theme_svg( 'search' ); ?>
										<span class="toggle-text"><?php _e( 'Search', 'casw' ); ?></span>
									</span>
								</button>

							</div>

							<?php
						}
						?>

						</div>
						<?php
					}
					?>

				</div>

			</div>

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>

*/?>
		
		<div id="content">
		

		<?php
		// Output the menu modal.
		//get_template_part( 'template-parts/modal-menu' );
