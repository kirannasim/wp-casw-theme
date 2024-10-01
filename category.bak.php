<?php

get_header();



$category = get_the_category(); 


?>


	<div id="news">
	
		<div id="page">
			
			<div id="page-share" class="share-container">
				<a href="#" title="Share this page" class="page-share" id="share-button"><span>Share</span></a>
			</div>
			
			<h2><?php echo($category[0]->cat_name); ?></h2>
			
			<div class="news-list">
				

<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'posts_per_page' => 4,
  'paged' => $paged,
  'cat' => get_cat_ID($category[0]->cat_name)
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
					<a href="<?php echo(get_category_link($item_category[0])) ?>" class="category"><?php echo($item_category[0]->cat_name); ?></a>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo($thumb); ?>" width="220" height="220" alt="" />
					<span class="text">
						<span class="title"><?php the_title(); ?></span>
						<span class="summary"><?php echo(substr(strip_tags(get_field('main_content')), 0, 100)) ?>...</span>
					</span></a>
				</div>


              <?php endwhile; ?>


            
<?php
      
?>

			
				
			</div>
			
			<div class="pagination">
				
	
<?php if (function_exists("pagination")) {
          pagination($custom_query->max_num_pages);
      } ?>

				<a href="" class="button">Next Page</a>
			</div>
					
			
		</div>

	</div>
	
</div>



<?php get_footer(); ?>
