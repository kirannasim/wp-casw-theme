<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 */
 
get_header();
?>

<div id="home">
	
	
	<div id="home-header">
		<div id="home-title">
			<h1 class="name">Council for the Advancement of Science Writing</h1>
			<!-- <div class="name"><span>Council for the Advancement of Science Writing</span></div> -->
			
			<div class="tagline">promoting excellence in science news since 1960</div>
		</div>
		<div class="angle"></div>
	</div>
	
	<div id="page">
		
		<div id="home-features">
			
			<div class="slider">
				<ul>
					
					
			<?php	
				
			$slider_image = null;
			
			if(have_rows('carousel')):
	
				while(have_rows('carousel')) : the_row();
				
				$image = get_sub_field('image');
				if($image):
					$slider_image = $image['sizes'][ 'slider' ];
				endif;
	
	        ?>
				
				
				<li>
					<span class="label"><span><?php echo(get_sub_field('label')) ?></span></span>
					<a href="<?php echo(get_sub_field('link')) ?>" class="image">
						<img src="<?php echo($slider_image) ?>" width="600" height="600" alt="" />
					</a>
					<a href="<?php echo(get_sub_field('link')) ?>" class="text">
						<span class="title"><?php echo(get_sub_field('title')) ?></span>
						<span class="summary"><?php echo(get_sub_field('summary')) ?></span>
					</a>
				</li>
			
				
			 <?php
			
			    endwhile;
			
			endif;
			
			?>

				</ul>
			</div>

		</div>
		
		<div id="home-subfeatures" class="news-list">

	
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
				  	'posts_per_page' => 6,
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
						<span class="title"><?php the_title(); ?></span>
						<span class="summary"><?php echo(substr(strip_tags(get_field('main_content')), 0, 150)) ?>...</span>
					</span></a>
				</div>
	
	
	          <?php endwhile; ?>

			
		</div>
		
	
	</div>
	
</div>

<?php
get_footer();
