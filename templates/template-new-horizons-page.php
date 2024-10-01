<?php
/**
 * Template Name: New Horizons Page
 * Template Post Type: page
 */

get_header();

$slug = get_post_field( 'post_name', get_post() );

?>

<div id="new-horizons">

	<div id="page">
		
		
		<div id="page-share" class="share-container">
			<a href="#" title="Share this page" class="page-share" id="share-button"><span>Share</span></a>
		</div>
		
		<div class="xxx-template-new-horizons-page" id="site-section"><?php echo(get_the_title($post->post_parent)) ?></div>
		
		
		<div id="nh-header">
			<div id="nh-nav">
				<ul>
					
					<?php
					if ( has_nav_menu( 'nh' ) ) {
	
						wp_nav_menu(
							array(
								'container'  => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'nh',
								'depth' => 1
							)
						);
	
					}
					?>

				</ul>
			</div>
		</div>
			
		<div id="nh-content">
			
			<h1 id="nh-heading"><span><?php echo(the_title())?></span></h1>
			
			<div class="nh-columns">
				<div class="nh-column-main">
				
					<div class="article">
	
						<?php echo(get_field('main_content')) ?>					
				
					</div>
				</div>
			</div>
		
			
		</div>

	</div>
	

</div>




<?php get_footer(); ?>
