<?php 
/*
Template Post Type: event
*/
get_header(); ?>

<?php
// Start the Loop.
while ( have_posts() ) :
  the_post();
  ?>
  <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div id="page-title">
			<h1><?php the_title() ?></h1>
		</div><!-- #page-title -->

    <div id="page">
      <div class="page-inner" >
    
      <?php if ( has_post_thumbnail() ) : ?>
    
        <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
      
      <?php endif; ?>

      <div class="event-content">
        <?php the_content() ?>
        <?php if ( get_field( 'register_url' ) ) : ?>

        <a href="<?php the_field( 'register_url' ) ?>" class="button"><?php _e( 'Register Now', 'casw' ) ?></a>

        <?php endif; ?>
      </div>

      <?php 
      $free_forms = array();
      $results = get_field( 'free_forms' );
      if ( $results ) {
        foreach ( $results as $form ) {
          $row = array();
          $row[ 'type' ] = 'free_form';
          $row[ 'title' ] = $form[ 'title' ];
          $row[ 'description' ] = $form[ 'description' ];

          $time_key = $form[ 'start_time' ] . '_' . $form[ 'end_time' ];
          if ( ! isset( $free_forms[ $time_key ] ) ) {
            $free_forms[ $time_key ] = array();  
          }
          $free_forms[ $time_key ][] = $row;
        }
      }

      $cur_date = new DateTime();
      $cur_date->modify('-1 day');
      $sessions = get_posts( array(
        'numberposts'	      => -1,
        'post_type'		      => 'session',
        'fields'            => 'ids',
        'meta_query'        => array(
          'relation'        => 'AND',
          'event'           => array(
            'key'           => 'event',
            'value'         => $post->ID,
            'compare'       => '='
          ),
          'date'            => array(
            'key'           => 'date',
            'value' 	      => $cur_date->format('Y-m-d'),
            'type' 		      => 'DATE',
            'compare' 	    => '>='
            // 'compare'       => 'EXISTS'
          ),
          'start_time'      => array(
            'key'           => 'start_time',
            'compare'       => 'EXISTS'
          )
        ),
        'orderby'           => array(
          'date'            => 'asc',
          'start_time'      => 'asc'
        )
      ) );    

      if ( !empty( $sessions ) ) : 
        
        $dates = array();
        foreach ( $sessions as $session_id ) {
          $date_key = get_field( 'date', $session_id, false );
          $date = get_field( 'date', $session_id );
          
          $start_time = get_field( 'start_time', $session_id, false );
          $end_time = get_field( 'end_time', $session_id, false );
          $time_key = cf_get_time_key( $start_time, $end_time );
          
          if ( ! isset( $dates[ $date_key ] ) ) {
            $dates[ $date_key ] = array();
            $dates[ $date_key ][ 'date' ] = $date;
            $dates[ $date_key ][ 'agendas' ] = $free_forms;
          }        

          if ( ! isset( $dates[ $date_key ][ 'agendas' ][ $time_key ] ) ) {
            $dates[ $date_key ][ 'agendas' ][ $time_key ] = array();
          }
          
          $dates[ $date_key ][ 'agendas' ][ $time_key ][] = array(
            'type' => 'session',
            'id' => $session_id
          );
        }
        
        foreach ( $dates as $index => $value ) {
          ksort( $dates[ $index ][ 'agendas'] );
        }

        ksort( $dates );

        ?>

        <div class="agendas-wrap">
          <h2><?php _e( 'Agenda', 'casw' ) ?></h2>
          
          <ul class="tabs">
            <?php $i = 1; foreach ( $dates as $key => $value ) : ?>
              <li>
                <a class="<?php echo $i == 1 ? ' active' : '' ?>" href="#agendas_<?php echo esc_attr( $key ) ?>"><?php _e( 'Day', 'casw' ) ?> <?php echo $i++ ?></a>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="tab-content">
            <?php $i = 1; foreach ( $dates as $key => $value ) : ?>
              <div class="tab-pane<?php echo $i++ == 1 ? ' active' : '' ?>" id="agendas_<?php echo esc_attr( $key ) ?>">
                <div class="date"><?php echo $value[ 'date' ] ?></div>
                <div class="agendas">
                  <?php foreach ( $value[ 'agendas' ] as $time_key => $agendas ) : ?>
                    <div class="agenda-wrap">
                      <div class="times">
                        <?php
                        $times = explode( '_', $time_key );
                        echo date_format( date_create( $times[0] ), 'g:ia') . ' - ' . date_format( date_create( $times[1] ), 'g:ia');
                        ?>
                      </div>
                      <div class="agenda">
                        <?php foreach ( $agendas as $agenda ) : ?>
                          
                          <?php if ( $agenda[ 'type' ] == 'session') : 
                            $session_id = $agenda[ 'id' ];
                            ?>
                            <div class="session">                          
                              <h3><a href="<?php the_permalink( $session_id) ?>"><?php echo get_the_title( $session_id ) ?></a></h3>

                              <div class="session-time"><?php the_field( 'start_time', $session_id ) ?> - <?php the_field( 'end_time', $session_id ) ?> <?php the_field( 'timezone', $session_id ) ?></div>

                              <?php if ( $speakers = get_field( 'speakers', $session_id ) ) : ?>
                                <div class="speakers">
                                  <h3><?php _e( 'Speakers', 'casw' ) ?></h3>
                                  <?php foreach ( $speakers as $speaker_id ) : ?>
                                    <div class="speaker">
                                      <?php if ( has_post_thumbnail( $speaker_id ) ) : ?>
                                        <div class="avatar">
                                          <?php echo get_the_post_thumbnail( $speaker_id, 'full' ); ?>
                                        </div>                            
                                      <?php endif; ?>

                                      <div class="info">
                                        <h4><a href="<?php the_permalink( $speaker_id) ?>"><?php echo get_the_title( $speaker_id ) ?> - <?php the_field( 'role', $speaker_id ) ?></a></h4>
                                        <div class="metas"><?php the_field( 'position', $speaker_id ) ?> | <?php the_field( 'company', $speaker_id ) ?></div>
                                      </div>
                                    </div><!-- .speaker -->
                                  <?php endforeach; ?>
                                </div><!-- .speakers -->
                              <?php endif; ?>

                              <a href="<?php the_permalink( $session_id) ?>" class="button"><?php _e( 'Learn More', 'casw' ) ?></a>

                            </div><!-- .session -->
                          <?php else : ?>
                            <div class="free-form">
                              <h6><?php echo $agenda[ 'title' ] ?></h6>
                              <div><?php echo $agenda[ 'description' ] ?></div>
                            </div><!-- .free-form -->
                          <?php endif; ?>
                        <?php 
                        endforeach;
                        ?>
                      </div><!-- .agenda -->
                    </div><!-- .agenda-wrap -->
                    <?php
                  endforeach; ?>
                </div><!-- .agendas -->
              </div><!-- .tab-pane -->
            <?php endforeach; ?>
          </div><!-- .tab-content -->
        </div>
      <?php endif; ?>
      </div>

  </article>
  <?php 

endwhile; // End the loop.
?>

<?php get_footer(); ?>
