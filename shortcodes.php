<?php

	// Accordion
	add_shortcode('accordion', 'bwp_accordion_function');
	function bwp_accordion_function( $atts = array(), $content = '' ) {
	 
	    extract(shortcode_atts(array(
	     'title' => '',
	    ), $atts));
	    
	    return "<div class=\"accordion\"><div class=\"accordion-title\">$title</div><div class=\"accordion-content\">$content</div></div>";
	}	

	// Button
	add_shortcode('button', 'bwp_button_function');
	function bwp_button_function( $atts = array() ) {
	 
	    extract(shortcode_atts(array(
	     'text' => '',
	     'url' => ''
	    ), $atts));
	    
	    return "<a class=\"button\" href=\"$url\">$text</a>";
	}

	// Progress Bar
	add_shortcode('progress', 'bwp_progress_function');
	function bwp_progress_function( $atts = array() ) {
	 
	    extract(shortcode_atts(array(
	     'percent' => 0,
	    ), $atts));
	    
	    return "<div class=\"progress\"><span style=\"width:$percent%\"></span><strong>$percent%</strong></div>";
	}

	// Special
	add_shortcode('special', 'bwp_special_function');
	function bwp_special_function( $atts = array(), $content = ''  ) {
  
	    return "<div class=\"special\">$content</div>";
	}

	// Special
	add_shortcode('anchor', 'bwp_anchor_function');
	function bwp_anchor_function( $atts = array() ) {
 
 	    extract(shortcode_atts(array(
	     'name' => '',
	    ), $atts));
	     

	    return "<a name=\"$name\"></a>";
	}
		
?>