<?php
/**
 * Template Name: New Horizons Speakers
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
		
		<div id="site-section"><?php echo(get_the_title($post->post_parent)) ?></div>
		
		
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
			
			<div id="nh-heading"><span><?php echo(the_title())?></span></div>
			
			<div class="nh-columns">
				<div class="nh-column-main">
				<div class="article">
								
			<div class="people-list">
	
				<?php	
				
				if(have_rows('people_list')):
		
					while(have_rows('people_list')) : the_row();
					
						$image = get_sub_field('thumbnail');
						
						$feature_thumb = $image['sizes'][ 'thumbnail' ];
		
		        ?>
					<div class="person">
						<div class="image">
							<img src="<?php echo($feature_thumb) ?>" width="115" height="115" alt="<?php echo(get_sub_field('name')) ?>" />
						</div>
						<div class="text">
							<div class="name"><?php echo(get_sub_field('name')) ?></div>
							<div class="role"><?php echo(get_sub_field('role')) ?></div>
							<?php echo(get_sub_field('summary')) ?> <?php if(get_sub_field('bio_link')):?><a href="<?php echo(get_sub_field('bio_link')) ?>">More Info</a><?php endif; ?>
						</div>
					</div>
					
				 <?php
				
				    endwhile;
				
				endif;
				
				?>	
	
			</div></div>

				</div>
			</div>
		
			
		</div>

	</div>
	

</div>




<?php get_footer(); ?>
