<?php
/**
 * Template Name: Search
 * Template Post Type: page
 */

get_header();

?>

<div id="search">

	<div id="page">
		
		<h1>Search</h1>
		
		<div id="search-form">
			
			<form role="search" method="get" action="/">
				<input type="search" class="search-field" value="" name="s" autocomplete="off" />
				<input type="submit" class="search-submit" value="Search" />
			</form>
		
		</div>

	</div>

</div>
	
<?php get_footer(); ?>
