<?php
/**
 * Template Name: Page
 * Template Post Type: page
 */
 
get_header();
$category = get_the_category(); 


?>


	
	<div id="static">
	
		<div id="page">

			<div id="page-share" class="share-container">
				<a href="#" title="Share this page" class="page-share" id="share-button"><span>Share</span></a>
			</div>

			<h1 class="page-title"><?php echo(the_title())?></h1>
			
			<div class="columns">
				
				<div class="column-main">
					
					<div class="article">
						
						<?php if(get_field('introduction')): ?>
						
						<div class="intro">
							<?php echo(get_field('introduction')) ?>
						</div>
						
						<?php endif; ?>
						
						
							
							<?php echo(get_field('main_content')) ?>					
						
					
					
					</div>
					
				</div>
				<div class="column-side">
					<?php dynamic_sidebar( 'sidebar-right-blue' ); ?>
				</div>
			
			</div>

										
			
		</div>

	</div>






<?php get_footer(); ?>
