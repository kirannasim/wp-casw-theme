<?php
/**
 * Template Name: New Horizons
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
					
					<div id="site-section"><?php echo(the_title())?></div>
					
					
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
								<!--
								<li><a href="">Program</a></li>
								<li><a href="">Speakers</a></li>
								<li><a href="">Host & Sponsors</a></li>
								<li><a href="">Newsroom</a></li>
								<li><a href="">Fellowships</a></li>
								<li><a href="">Past Conferences</a></li>
								-->
							</ul>
						</div>
						
<?php
	
$hero_image = '';
$feature_thumb = '';
	
$image = get_field('hero_image');


if($image):
	$hero_image = $image['sizes'][ 'large' ];
endif;

?>

						<a href="<?php echo(get_field('hero_link')) ?>" id="nh-hero" style="background-image:url(<?php echo($hero_image) ?>)" data-display-ratio=".496">
							<div id="nh-heading">
								<span><?php echo(get_field('presentation_title')) ?></span>
							</div>
							<div id="nh-subhead">
								<span><?php echo(get_field('presentation_details')) ?></span>
							</div>
						</a>
					</div>
					
					<div id="nh-intro">
						<?php echo(get_field('introduction')) ?>
					</div>
					
	
					<div class="news-list">
						
						
						
						<?php	
						
						if(have_rows('features')):
				
							while(have_rows('features')) : the_row();
							
								$image = get_sub_field('thumbnail');
								
								$feature_thumb = $image['sizes'][ 'thumbnail' ];
				
				        ?>
				        
				        	<div class="item">
								<a href="<?php echo(get_sub_field('link')) ?>" class="main"><img src="<?php echo($feature_thumb) ?>" width="220" height="220" alt="" />
								<span class="text">
									<span class="title"><?php echo(get_sub_field('title')) ?></span>
								</span></a>
							</div>
						
							
						 <?php
						
						    endwhile;
						
						endif;
						
						?>					
					</div>
					
					
				</div>
				
				<div id="nh-about">
					
					<h2 class="about-new-horizons"><?php echo(get_field('about_heading')) ?></h2>
					<p><?php echo(get_field('about_text')) ?></p>
					
					<div class="action"><a href="<?php echo(get_field('about_link')) ?>" class="button">Learn More</a></div>
					
				</div>
		
			</div>
				
		
	</div>




	<?php
/*
	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content-cover' );
		}
	}
*/
	?>

<?php /*get_template_part( 'template-parts/footer-menus-widgets' );*/ ?>

<?php get_footer(); ?>
