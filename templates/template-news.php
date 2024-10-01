<?php
/**
 * Template Name: Landing News
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
			
			<h1 class="page-title"><?php echo(get_field('page_title')) ?></h1>
			<div class="news-list">
				
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
				  	'posts_per_page' => 12,
				    'meta_query' => array(
				        array(
				            'key'     => 'feature',
				            'value'   => '"feature"',
				            'compare' => 'LIKE'
				        )
				    )
				);
				$custom_query = new WP_Query( $args );
	
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
					<a href="<?php echo(get_category_link($item_category[0])) ?>" class="category"><?php echo($item_category[0]->cat_name); ?></a>
					<a href="<?php the_permalink(); ?>" class="main"><img src="<?php echo($thumb); ?>" width="220" height="220" alt="" />
					<span class="text">
						<h2 class="title"><?php the_title(); ?></h2>
						<span class="summary"><?php echo(substr(strip_tags(get_field('main_content')), 0, 150)) ?>...</span>
					</span></a>
				</div>
	
	
	          <?php endwhile; ?>
	
			  
			  <div class="pagination">
					
				<a href="/news/archive/" class="button">More News</a>
			</div>
			
		
		</div>

	</div>
	
</div>

<?php get_footer(); ?>
