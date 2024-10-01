<?php 
/*
Template Post Type: post, program
*/
get_header(); ?>

<?php

$category = get_the_category(); 

$hero_image = '';	
$image = get_field('cover_image');
if($image):
	$cover_image = $image['sizes'][ 'large' ];
endif;

?>
	
	
	<div id="article">
	
		<div id="page">

			<div id="page-share" class="share-container">
				<a href="#" title="Share this page" class="page-share" id="share-button"><span>Share</span></a>
			</div>

			<div id="site-section">News</div>
			
			<div class="columns">
				
				<div class="column-main">

					<div class="hero">
						<div class="image">
							<img src="<?php echo($cover_image) ?>" width="" height="" alt="<?php echo $alt; ?>" />
						</div>
						<div class="text">
							<div class="tag">
								<a href="<?php echo(get_category_link($category[0])) ?>"><span><?php echo($category[0]->cat_name); ?></span></a>
							</div>
							<h1 id="article-title">
								<span><?php echo(the_title())?></span>
							</h1>
						</div>
						
						<?php if(get_field('cover_image_caption')): ?>
						
						<div class="caption">
							<?php echo(get_field('cover_image_caption')) ?>
						</div>
						
						<?php endif; ?>
						
					</div>
				
					
					<?php if(get_field('author')): ?>
					
					<div class="byline"><div><span><?php echo(get_field('author')) ?></span></div></div>
					
					<?php endif; ?>
					
					<?php if(get_field('introduction')): ?>
					
					<div class="intro">
						<?php echo(get_field('introduction')) ?>
					</div>
					
					<?php endif; ?>
					
					<?php if(get_field('date_time_location')): ?>
					
					<div class="datetime">
						<?php echo(get_field('date_time_location')) ?>
					</div>
					
					<?php endif; ?>
					
					<div class="article">
						
						<?php echo(get_field('main_content')) ?>					
					
					</div>
					
					<?php if(get_field('author_bio')): ?>
					
					<div class="author">
						
						<?php echo(get_field('author_bio')) ?>
						
					</div>
					
					<?php endif; ?>
					
					
					
					<div class="more">
						<a href="/news/" class="button">More News</a>
					</div>
					
				</div>
				<div class="column-side">
					<?php dynamic_sidebar( 'sidebar-right-blue' ); ?>
				</div>
			
			</div>

										
			
		</div>

	</div>
	

<?php get_footer(); ?>
