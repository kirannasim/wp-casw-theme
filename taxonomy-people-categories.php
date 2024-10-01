<?php
 
get_header();
$category = get_queried_object(); 


?>


<div id="people">

	<div id="page">

		<div id="page-share" class="share-container">
			<a href="#" title="Share this page" class="page-share" id="share-button"><span>Share</span></a>
		</div>

		<h1 class="page-title"><?php echo($category->name); ?></h1>
		
		<div class="columns">
			
			<div class="column-main people-list">
				


<?php

	
$args = array(
  'post_type' => 'people',
  'meta_key'  => 'last_name',
  'orderby'	  => 'meta_value',
  'order'    => 'ASC', 
  'tax_query' => array(
	  array(
		  'taxonomy' => 'people-categories',
		  'field' => 'slug',
		  'terms' => $category->name
	  )
  ),
  'cat' => get_cat_ID($category->name)
);
$custom_query = new WP_Query( $args );
?>

 
<?php
   while($custom_query->have_posts()) :
      $custom_query->the_post();
      
      $item_category = get_queried_object(); 
      $thumb = '';	
      $image = get_field('photo');
if($image):
	$thumb = $image['sizes'][ 'thumbnail' ];
endif;

?>


					<div class="person">
						<div class="image">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo($thumb); ?>" width="115" height="115" alt="<?php echo(get_sub_field('name')) ?>" /></a>
						</div>
						<div class="text">
							<h2 class="name"><a href="<?php the_permalink(); ?>"><?php echo(get_field('first_name')) ?> <?php echo(get_field('last_name')) ?></a></h2>
							<div class="role"><?php echo(get_field('role')) ?></div>
							<?php echo(get_field('short_bio')) ?> <a href="<?php the_permalink(); ?>">More Info</a>
						</div>
					</div>
					
              <?php endwhile; ?>
		

							
			</div>
			<div class="column-side">	
				<?php dynamic_sidebar( 'sidebar-right-blue' ); ?>
			</div>
		
		</div>
						
		
	</div>

</div>





<?php get_footer(); ?>
