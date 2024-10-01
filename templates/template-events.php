<?php
/**
 * Template Name: Events Page
 */

get_header();
?>

<div id="events-page">

	<?php while ( have_posts() ) : the_post(); ?>	

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<?php
				$hero_image_url = '';
				$hero_image = get_field( 'hero_image' );
				
				if ( $hero_image ) {
					$hero_image_url = $hero_image['sizes']['large'];					
				}
			?>
			
			<?php if ( $hero_image_url ) : ?>
				<div id="landing-hero" style="background-image:url(<?php echo esc_url( $hero_image_url ); ?>)">
			<?php else : ?>
				<div id="landing-hero">
			<?php endif; ?>

				<div id="landing-share" class="share-container">
					<a href="#" id="share-button" title="Share this page"><span>Share</span></a>
				</div>
				<div class="text">
					<h1><?php echo get_the_title(); ?></h1>
					<div class="intro"><?php the_field( 'intro_text' ); ?></div>
					<a href="<?php the_field( 'button_link' ); ?>" class="button"><?php the_field( 'button_text' ); ?></a>
				</div>

			</div><!-- #landing-hero -->

			<div id="page">

				<div class="page-inner">

				<?php
					$args = array(
						'post_type' => 'event',
						'post_status' => 'publish',
						'posts_per_page' => -1
					);
					$events = new WP_Query( $args );
					if ( $events -> have_posts() ) :
						?>

						<div class="events">
						
						<?php
						while ( $events -> have_posts() ) :
							$events->the_post();
							$event_id = get_the_ID();
							$cur_date = new DateTime();
      						$cur_date->modify('-1 day');

							$sessions = get_posts( array(
								'numberposts'		=> -1,
								'post_type'			=> 'session',
								'fields' 			=> 'ids',
								'meta_query'     	=> array(
								  	'relation' 		=> 'AND',
								  	'event' 		=> array(
										'key' 		=> 'event',
										'value' 	=> $event_id,
										'compare' 	=> '='
									),
									'date' 			=> array(
										'key' 		=> 'date',
										'value' 	=> $cur_date->format('Y-m-d'),
										'type' 		=> 'DATE',
										'compare' 	=> '>='
									),
									'start_time' 	=> array(
										'key' 		=> 'start_time',
										'compare' 	=> 'EXISTS'
									)
								),
								'orderby'     		=> array(
								  'date' 			=> 'asc',
								  'start_time' 		=> 'asc'
								)
							) );    

							$start_date = '';
							$end_date = '';
						
							if ( !empty( $sessions ) ) : 
								
								$dates = array();

								foreach ( $sessions as $session_id ) {
									$date = get_field( 'date', $session_id );
									$start_time = get_field( 'start_time', $session_id, false );
								  	$end_time = get_field( 'end_time', $session_id, false );

									$dates[] = array(
										'date'			=> $date,
										'start_time'	=> $start_time,
										'end_time'		=> $end_time
									);
								}
								
								ksort( $dates );

								$start_date = $dates[0]['date'];

								if ( sizeof( $dates ) > 1 ) {									
									$end_date = $dates[sizeof( $dates ) - 1]['date'];
								}

							endif;
							?>

							<div class="event">
								<div class="event-details">
									<h3 class="event-title">
										<a href="<?php echo get_the_permalink() ?>">
											<?php echo get_the_title() ?>
										</a>
									</h3>
									<div class="event-date">
										<?php echo $start_date; ?><?php echo $end_date ? ' - ' . $end_date : ''; ?>
									</div>
									<div class="event-content">
										<?php the_excerpt() ?>
									</div>
								</div>
								<div class="event-more">
									<a href="<?php echo get_the_permalink() ?>" class="button"><?php _e( 'More Info', 'casw' ) ?></a>
								</div>
							</div>
							
							<?php
						endwhile;
						?>

						</div><!-- .events -->

						<?php
					endif;
					wp_reset_query();
				?>

				</div>

			</div><!-- #page -->

		</article>
		
	<?php endwhile; ?>
	
</div>

<?php get_footer(); ?>