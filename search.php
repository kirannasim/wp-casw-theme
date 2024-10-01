<?php get_header(); ?>



<div id="search">

	<div id="page">
		
		<h1 class="page-title">Search Results</h1>
		
		<div id="search-form">
			
			<form role="search" method="get" action="/">
				<input type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
				<input type="submit" class="search-submit" value="Search" />
			</form>
		
		</div>
		
		<div id="search-results" class="column-main">
		
			<h2>Results for "<?php echo get_search_query(); ?>"</h2>
		
			<?php /* echo $wp_query->found_posts; */ ?>
			
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>


			
			<div class="result">
				<a href="<?php the_permalink(); ?>"><span class="title"><?php the_title(); ?></span></a>
				<div class="description">
				<?php if(get_field('main_content')): ?>
	                <?php echo(substr(strip_tags(get_field('main_content')), 0, 150)) ?>...
                 <?php else: ?>
				 	Description unavailable.
                <?php endif; ?>
				</div>
			</div>

			
			<?php endwhile; ?>
			
			<?php else: ?>
			
				<div id="none-found">No results were found.</div>
			
			<?php endif; ?>
			
			<div class="pagination">
				<?php get_template_part('pagination'); ?>
			</div>


		
		
		</div>
		
	</div>

</div>



<?php get_footer(); ?>