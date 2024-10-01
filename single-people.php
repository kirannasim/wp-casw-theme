<?php 
/*
Template Post Type: person
*/
get_header(); ?>

<?php

$category = get_the_category(); 

$cover_image = '';	
$image = get_field('photo');
if($image):
	$cover_image = $image['sizes'][ 'medium' ];
endif;

?>
	<div id="person">
	
		<div id="page">

			<div id="page-share" class="share-container">
				<a href="#" title="Share this page" class="page-share" id="share-button"><span>Share</span></a>
			</div>

			<div id="site-section">People</div>
			
			<div class="columns">
				
				<div class="column-main">
					
					<div class="article">
					
						
						<img src="<?php echo($cover_image) ?>" width="200" height="200" alt="" id="person-image" />
						
						<div id="person-details">
							<h1><?php echo(get_field('first_name')) ?> <?php echo(get_field('last_name')) ?></h1>
							<div class="person-role"><?php echo(get_field('role')) ?></div>
							<div class="person-affiliation"><em><?php echo(get_field('affiliation')) ?></em></div>
						</div>
						<div id="person-bio">
							<?php echo(get_field('full_bio')) ?>
						</div>
					</div>
									
				</div>
				<div class="column-side">
					<?php dynamic_sidebar( 'sidebar-right-blue' ); ?>
					<!--<div class="side-box">
						<div class="side-nav">
						
						<?php 
							
							$args = array(
								'taxonomy' => 'people-categories',
								'title_li' => ''
							);
					
							
							wp_list_categories($args) 
							
							?>
						</div>
						
					</div>-->				
				</div>
			
			</div>

										
			
		</div>

	</div>

<?php get_footer(); ?>
