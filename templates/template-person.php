<?php
/**
 * Template Name: Page Person
 * Template Post Type: page
 */

get_header();

$slug = get_post_field( 'post_name', get_post() );

?>


<div id="people">

	<div id="page">
		
		
		<div id="page-share" class="share-container">
			<a href="#" title="Share this page" class="page-share" id="share-button"><span>Share</span></a>
		</div>
		
		<div id="site-section"><?php echo(the_title())?></div>
		
		<div class="columns">
			
			<div class="column-main person-detail">
				
				
						<div class="image">
							<img src="<?php echo(get_field('image')) ?>" width="115" height="115" alt="<?php echo(the_title())?>" />
						</div>
						<div class="text">
							<h2 class="name"><?php echo(get_field('first_name')) ?> <?php echo(get_field('last_name')) ?></h2>
							<div class="role"><?php echo(get_field('role')) ?></div>
							<?php echo(get_field('long_bio')) ?></div>
					</div>
				
				?>	
	
			</div>
			<div class="column-side">
				<?php dynamic_sidebar( 'sidebar-right-blue' ); ?>
				<!--<div class="side-box">
					<ul class="side-nav">
						<?php
						if ( has_nav_menu( 'people' ) ) {
		
							wp_nav_menu(
								array(
									'container'  => '',
									'items_wrap' => '%3$s',
									'theme_location' => 'people',
									'depth' => 1
								)
							);
		
						}
						?>
					</ul>
				</div>
				
			</div>-->
		
		</div>

									
		
	</div>

</div>

<?php get_footer(); ?>
