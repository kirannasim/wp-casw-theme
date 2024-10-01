<?php
/**
 * Template Name: Landing New Horizons Programs
 * Template Post Type: page
 */

get_header();
$category = get_the_category(); 


?>



	<div id="news">
	
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
					<div class="news-inline-list">				
					
					<?php
						
	
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args = array(
					  'posts_per_page' => 2,
					  'paged' => $paged,
					  'post_parent' => 95,
					  'post_type' => 'page'
					);
					$custom_query = new WP_Query( $args );
					
					
					
					?>
					
					 
					<?php
					   while($custom_query->have_posts()) :
					      $custom_query->the_post();
					      
					      $item_category = get_the_category(); 
					      $thumb = '';	
					      $image = get_field('cover_image');
					if($image):
						$thumb = $image['sizes'][ 'thumbnail' ];
					endif;
					
					?>
					
					
					
					
			
							<div class="item">
								<a href="<?php the_permalink(); ?>"><img src="<?php echo($thumb); ?>" width="220" height="220" alt="" />
								<span class="text">
									<span class="title"><?php the_title(); ?></span>
									<span class="summary"><?php echo(substr(strip_tags(get_field('main_content')), 0, 180)) ?>...</span>
								</span></a>
							</div>
			
			
			              <?php endwhile; ?>
			
			
			            
			<?php
			      
			?>
			
						<div class="pagination">
							
				
			<?php if (function_exists("pagination")) {
			          pagination($custom_query->max_num_pages);
			      } ?>
			
						</div>
		</div>

	</div>					
				
		</div>

	</div>
	
</div>

<?php get_footer(); ?>
