<?php 
/*
Template Post Type: person
*/
get_header(); ?>

<?php

// Start the Loop.
while ( have_posts() ) : the_post();
	$event_id = get_field( 'event' );
  	?>
	  
	<article <?php post_class(); ?> id="session-<?php the_ID(); ?>">

		<div id="page-title">
			<h1><?php echo get_the_title( $event_id ) ?> <span>|</span> <?php the_title() ?></h1>
		</div><!-- #page-title -->

		<div id="page">

			<div class="page-inner">

				<div class="session-details">

					<div class="session-meta">
						<span class="session-date"><?php echo date_format( date_create( get_field( 'date' ) ), 'F j, Y') ?></span>
						<span class="gap"> | </span>
						<span class="event-where"><?php the_field( 'city' ) ?>, <?php the_field( 'state' ) ?></span>
						<span class="gap"> | </span>
						<span class="event-time"><?php the_field( 'start_time' ) ?> - <?php the_field( 'end_time' ) ?> <?php the_field( 'timezone' ) ?></span>
					</div>
					<div class="session-content">
						<?php the_content() ?>
					</div>				
					<a href="<?php echo get_the_permalink( $event_id ) ?>" class="button"><?php _e( 'Back To Agenda', 'casw' ) ?></a>

				</div><!-- .session -->

				<?php if ( $speakers = get_field( 'speakers', get_the_ID() ) ) : ?>
					<div class="speakers">
						<h2><?php _e( 'Speakers', 'casw' ) ?></h2>

						<?php foreach ( $speakers as $speaker_id ) : ?>
							<div class="speaker">
								<div class="speaker-details">
									<?php if ( has_post_thumbnail( $speaker_id ) ) : ?>
										<div class="avatar">
											<?php echo get_the_post_thumbnail( $speaker_id, 'full' ); ?>
										</div>                            
									<?php endif; ?>

									<div class="info">
										<h3><a href="<?php the_permalink( $speaker_id) ?>"><?php echo get_the_title( $speaker_id ) ?> - <?php the_field( 'role', $speaker_id ) ?> </a></h3>							
										<div class="metas">
											<?php the_field( 'position', $speaker_id ) ?>
											<span class="gap"> | </span>
											<?php the_field( 'company', $speaker_id ) ?>
										</div>
										<div class="speaker-content">
											<?php the_content() ?>
										</div>
										<a href="<?php the_permalink( $speaker_id) ?>" class="readmore">More Info</a>
									</div>
								</div><!-- .speaker -->
							</div>
						<?php endforeach; ?>
					</div><!-- .speakers -->
				<?php endif; ?>
				<!-- Speakers -->
			</div>
		</div><!-- #page -->

	</article>
	<?php 

endwhile; // End the loop.
?>

<?php get_footer(); ?>