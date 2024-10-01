<?php
/**
 * Template Name: Landing List
 * Template Post Type: page
 */

get_header();

$slug = get_post_field( 'post_name', get_post() );

?>



<div id="<?php echo($slug) ?>">
	
	
	
<?php
	
$hero_image = '';
$feature_thumb = '';
	
$image = get_field('hero_image');


if($image):
	$hero_image = $image['sizes'][ 'large' ];
endif;

?>
	
	
<style>
	@media screen and (max-width: 700px) {
		#landing-hero .text {
			background: linear-gradient(180deg, <?php
		$hex = get_field('main_color');
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		echo "rgba($r, $g, $b, 0) 30px, rgba($r, $g, $b, 1) 100px";
		?>);	
		}
	}
</style>
	
	<div id="landing-hero" style="background-image:url(<?php echo($hero_image) ?>)">
		<div id="landing-share" class="share-container">
			<a href="#" id="share-button" title="Share this page"><span>Share</span></a>
		</div>
		<div class="text">
			<h1><?php echo(the_title()) ?></h1>
			<div class="intro"><?php echo(get_field('intro_text')) ?></div>
			<a href="<?php echo(get_field('button_link')) ?>" class="button"><?php echo(get_field('button_text')) ?></a>
		</div>
	</div>
		
	<div id="page">
		
		<div class="button-list">
			
			
			
			
			
			<?php	
			
			if(have_rows('landing_features')):
	
				while(have_rows('landing_features')) : the_row();
	
	        ?>
				
				<div class="item">
					<div class="text">
						<div class="title"><a href="<?php echo(get_sub_field('link')) ?>"><?php echo(get_sub_field('title')) ?></a></div>
						<div class="detail"><?php echo(get_sub_field('detail')) ?></div>
						<div class="summary"><?php echo(get_sub_field('summary')) ?></div>
					</div>
					<div class="link">
						<a href="<?php echo(get_sub_field('link')) ?>" class="button">More Info</a>
					</div>
				</div>
			
				
			 <?php
			
			    endwhile;
			
			endif;
			
			?>


			
			
			
			
			
			
					
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
