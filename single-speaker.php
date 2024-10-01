<?php 
/*
Template Post Type: Session
*/
get_header(); ?>

<?php
// Start the Loop.
while ( have_posts() ) :
  the_post();
  ?>
	<article <?php post_class(); ?> id="speaker-<?php the_ID(); ?>">

		<div id="page">

			<div class="page-inner">

				<!-- Speaker -->
				<div class="speaker-details">

					<?php if ( has_post_thumbnail() || get_field( 'twitter_url' ) || get_field( 'linkedin_url' ) || get_field( 'site_url' ) ) : ?>
						<div class="avatar">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
							<?php endif; ?>
							
							<?php if ( get_field( 'twitter_url' ) || get_field( 'linkedin_url' ) || get_field( 'site_url' ) ) : ?>
								<ul class="socials">
									<?php if ( get_field( 'twitter_url' ) ) : ?>
										<li><a href="<?php the_field( 'twitter_url' ) ?>" title="<?php _e( 'Twitter', 'casw' )?>" class="speaker-twitter"></a></li>
									<?php endif; ?>
									<?php if ( get_field( 'linkedin_url' ) ) : ?>
										<li><a href="<?php the_field( 'linkedin_url' ) ?>" title="<?php _e( 'Linkedin', 'casw' )?>" class="speaker-linkedin"></a></li>
									<?php endif; ?>
									<?php if ( get_field( 'site_url' ) ) : ?>
										<li><a href="<?php the_field( 'site_url' ) ?>" title="<?php _e( 'Web Site', 'casw' )?>" class="speaker-website"></a></li>
									<?php endif; ?>
								</ul><!-- .social-shares -->
							<?php endif; ?>
						</div><!-- .avatar -->
					<?php endif; ?>

					<div class="info">
						<h3><?php the_title() ?></h3>
						<div class="metas">
							<span><?php the_field( 'position' ) ?></span>
							<span class="gap">|</span>
							<span><?php the_field( 'company' ) ?></span>
						</div>
						<?php if ( get_field( 'affiliations' ) ) : ?>
							<div class="affiliations"><?php the_field( 'affiliations' ) ?></div>
						<?php endif; ?>
						<div class="speaker-content"><?php the_content() ?></div>
					</div><!-- .info -->

				</div><!-- .speaker -->

				<?php
				$cur_date = new DateTime();
				$cur_date->modify('-1 day');
				$sessions = get_posts( array(
					'numberposts'		=> -1,
					'post_type'			=> 'session',
					'fields' 			=> 'ids',
					'meta_query'     	=> array(
						'relation' 			=> 'AND',
						'speakers' 			=> array(
							'relation' 			=> 'OR',
							array(
								'key' 			=> 'speakers',
								'value' 		=> sprintf( ':"%s";', get_the_ID() ),
								'compare' 		=> 'LIKE'
							),
							array(
								'key' 			=> 'speakers',
								'value' 		=> sprintf( ';i:%d;', get_the_ID() ),
								'compare' 		=> 'LIKE'
							),
						),
						'date' 			=> array(
							'key' 			=> 'date',
							'value' 		=> $cur_date->format('Y-m-d'),
							'type' 			=> 'DATE',
										'compare' 		=> '>='
						),
						'start_time' 	=> array(
							'key' 			=> 'start_time',
							'compare' 		=> 'EXISTS'						
						)
					),
					'orderby'     		=> array(
						'date' 				=> 'asc',
						'start_time' 		=> 'asc'
					)
				) );

				if ( $sessions ) : ?>
					<!-- Upcoming Events -->
					<div class="upcoming-events">

						<h2>Upcoming Events</h2>

						<div class="sessions">
							<?php foreach ( $sessions as $session_id ) : ?>
								<div class="session">
									<h3 class="session-title">
										<a href="<?php echo get_the_permalink( $session_id ) ?>">
											<?php echo get_the_title( get_field( 'event', $session_id ) ) ?>: <?php echo get_the_title( $session_id ) ?>
										</a>
									</h3>
									<div class="session-meta">
										<span class="session-date"><?php echo date_format( date_create( get_field( 'date', $session_id ) ), 'F j, Y') ?></span>
										<span class="gap"> | </span>
										<span class="event-where"><?php echo get_field( 'city', $session_id ) ?>, <?php echo get_field( 'state', $session_id ) ?></span>
										<span class="gap"> | </span>
										<span class="event-time"><?php echo get_field( 'start_time', $session_id ) ?> - <?php echo get_field( 'end_time', $session_id ) ?> <?php echo get_field( 'timezone', $session_id ) ?></span>
									</div>
									<div class="session-content">
										<?php echo get_the_excerpt( $session_id ) ?>
									</div>				
									<a href="<?php echo get_the_permalink( $session_id ) ?>" class="button"><?php _e( 'Learn More', 'casw' ) ?></a>
								</div>
							<?php endforeach; ?>
						</div>

					</div><!-- .upcoming-events -->
				<?php endif; ?>

			</div>

		</div><!-- #page -->

	</article>
	<?php 

endwhile; // End the loop.
?>

<?php get_footer(); ?>
