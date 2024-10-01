<?php
/**
 * CASW functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CASW
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
 
function casw_theme_support() {

	// Hide admin bar
	//add_filter('show_admin_bar', '__return_false');
	

	// Customize WYSIWYG
	
	
	function my_mce_buttons_2( $buttons ) {	

		$buttons[] = 'superscript';
		$buttons[] = 'subscript';
		$buttons[] = 'code';
	
		return $buttons;
	}
	add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );


	add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars' );
	function my_toolbars( $toolbars )
	{
		// Uncomment to view format of $toolbars
		/*
		echo '< pre >';
			print_r($toolbars);
		echo '< /pre >';
		die;
		*/
		
		// Add a new toolbar called "Very Simple"
		// - this toolbar has only 1 row of buttons
		$toolbars['Very Simple' ] = array();
		$toolbars['Very Simple' ][1] = array('italic', 'link');
		
		
		if(($key = array_search('wp_more' , $toolbars['Full' ][1])) !== false )
		{
		    unset( $toolbars['Full'][1][$key] );
		}		
		if(($key = array_search('alignright' , $toolbars['Full' ][1])) !== false )
		{
		    unset( $toolbars['Full'][1][$key] );
		}
		if(($key = array_search('forecolor' , $toolbars['Full' ][2])) !== false )
		{
		    unset( $toolbars['Full'][2][$key] );
		}
		if(($key = array_search('indent' , $toolbars['Full' ][2])) !== false )
		{
		    unset( $toolbars['Full'][2][$key] );
		}
		if(($key = array_search('outdent' , $toolbars['Full' ][2])) !== false )
		{
		    unset( $toolbars['Full'][2][$key] );
		}
		
			
		// remove the 'Basic' toolbar completely
		//unset( $toolbars['Basic' ] );
	
		// return $toolbars - IMPORTANT!
		return $toolbars;
	}
	



	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	//add_image_size( 'casw-fullscreen', 1980, 9999 );
	add_image_size( 'slider', 800, 800, true );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'casw' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'casw' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', casw_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new casw_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}


/* Custom Shortcodes */
include('shortcodes.php');



add_action( 'after_setup_theme', 'casw_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-casw-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-casw-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-casw-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-casw-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-casw-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-casw-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-casw-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

/**
 * Register and Enqueue Styles.
 */
function casw_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'casw-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'casw-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'casw-style', casw_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'casw-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

	// Add custom stylesheet
	$version = $theme_version . '.' . filemtime( get_template_directory() . '/assets/css/style.css' );
	wp_enqueue_style( 'casw-custom-style', get_template_directory_uri() . '/assets/css/style.css', array(), $version );

}

add_action( 'wp_enqueue_scripts', 'casw_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function casw_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'casw-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'casw-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'casw_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function casw_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'casw_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function casw_non_latin_languages() {
	$custom_css = casw_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'casw-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'casw_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function casw_menus() {

	$locations = array(
		'primary'  => __( 'Navigation Menu', 'casw' ),
		'nh' => __( 'New Horizons Menu', 'casw' ),
		'people' => __( 'People Menu', 'casw' ),
		'footer'   => __( 'Footer Menu', 'casw' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'casw_menus' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 *
 * @return string $html
 */
function casw_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'casw_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function casw_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'casw' ) . '</a>';
}

add_action( 'wp_body_open', 'casw_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function casw_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'casw' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'casw' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'casw' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'casw' ),
			)
		)
	);
	
	// Blue Sidebar.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Right Sidebar - Blue', 'casw' ),
				'id'          => 'sidebar-right-blue',
				'description' => __( 'Widgets in this area will be displayed in the right sidebar.', 'casw' ),
			)
		)
	);

}

add_action( 'widgets_init', 'casw_sidebar_registration' );



/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function casw_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'casw_dashboard_widget', // Widget slug.
		'Shortcodes', // Title.
		'casw_dashboard_widget_function' // Display function.
	);
}
add_action( 'wp_dashboard_setup', 'casw_add_dashboard_widgets' );

/**
 * Create the function to output the contents of your Dashboard Widget.
 */
function casw_dashboard_widget_function() {
	echo '<p>[anchor name="uniquename"]</p>';
	echo '<p>[button text="My Button" url="https://google.com"]</p>';
	echo '<p>[accordion title="Title"]Content[/accordion]</p>';
	echo '<p>[progress percent="10"]</p>';
	echo '<p>[special]Special Callout Content[/special]</p>';
}




function casw_remove_parent_category() {
    if ( 'category' != $_GET['taxonomy'] && 'people-categories' != $_GET['taxonomy'] )
        return;

    $parent = 'parent()';

    if ( isset( $_GET['action'] ) )
        $parent = 'parent().parent()';

    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {     
                $('label[for=parent]').<?php echo $parent; ?>.remove();       
            });
        </script>
    <?php
}

add_action( 'admin_head-edit-tags.php', 'casw_remove_parent_category' );


function casw_remove_parent_category2() {

	    
	    
    if ( 'category' != $_GET['taxonomy'] && 'people-categories' != $_GET['taxonomy'] )
        return;

    $parent = 'parent().parent()';

    if ( isset( $_GET['action'] ) )
        $parent = 'parent().parent().parent()';

    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {     
                $('label[for=parent]').<?php echo $parent; ?>.remove();       
            });
        </script>
    <?php
	    

}


add_action( 'admin_head-term.php', 'casw_remove_parent_category2' );




	
	
function casw_remove_parent_category3() {

	  ?>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {     
	           // setInterval(function() {
                	$('#newcategory_parent').add('#newpeople-categories_parent').remove();  
              //  }, 200);     
            });
        </script>
    <?php	    

}


add_action( 'admin_head-post.php', 'casw_remove_parent_category3' );
add_action( 'admin_head-post-new.php', 'casw_remove_parent_category3' );

/**
 * Enqueue supplemental block editor styles.
 */
function casw_block_editor_styles() {

	$css_dependencies = array();

	// Enqueue the editor styles.
	wp_enqueue_style( 'casw-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'casw-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'casw-block-editor-styles', casw_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'casw-block-editor-styles', casw_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'casw-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'casw_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function casw_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'casw_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 *
 * @return array $mce_init TinyMCE styles.
 */
function casw_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = casw_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'casw_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 *
 * @return array $mce_init TinyMCE styles.
 */
function casw_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = casw_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'casw_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function casw_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'casw' ),
			'slug'  => 'accent',
			'color' => casw_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'casw' ),
			'slug'  => 'primary',
			'color' => casw_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'casw' ),
			'slug'  => 'secondary',
			'color' => casw_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'casw' ),
			'slug'  => 'subtle-background',
			'color' => casw_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		if( gettype( $background_color_arr ) == 'array' ) {
			$background_color = $background_color_arr[0]['default-color'];
		}
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'casw' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'casw' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'casw' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'casw' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'casw' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'casw' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'casw' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'casw' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'casw' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( casw_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}



}

add_action( 'after_setup_theme', 'casw_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 *
 * @return string $html
 */
function casw_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'casw_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function casw_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'casw-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'casw-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'casw-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'casw-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'casw-customize-controls', 'caswBgColors', casw_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'casw_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function casw_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'casw-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'casw-customize-preview', 'caswBgColors', casw_get_customizer_color_vars() );
	wp_localize_script( 'casw-customize-preview', 'caswPreviewEls', casw_get_elements_array() );

	wp_add_inline_script(
		'casw-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( casw_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'casw_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function casw_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function casw_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
 
 
function casw_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(

	);

	/**
	* Filters Twenty Twenty theme elements
	*
	* @since Twenty Twenty 1.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'casw_get_elements_array', $elements );
}


// People Categories

add_action( 'init', 'create_people_categories_hierarchical_taxonomy', 0 );
  
function create_people_categories_hierarchical_taxonomy() {
 
	register_taxonomy('people-categories', array('people_category'), array(
	    'hierarchical' => true,
	    'labels' => array(
		    'name' => __('People Categories'),
		    'singular_name' => __('People Category'),
		    'search_items' =>  __('Search People Categories'),
		    'all_items' => __('All People Categories'),
		    'parent_item' => __('Parent People Category'),
		    'parent_item_colon' => __('Parent People Categories:'),
		    'edit_item' => __('Edit People Category'), 
		    'update_item' => __('Update People Category'),
		    'add_new_item' => __('Add New People Category'),
		    'new_item_name' => __('New People Category Name'),
		    'menu_name' => __('Categories'),
		),
	    'show_ui' => true,
	    'show_in_rest' => true,
	    'has_archive' => true,
	    'show_admin_column' => true,
	    'query_var' => true,
	    'rewrite' => array('slug' => 'people-categories', 'with_front' => false)
	));
 
}



add_action('init', 'create_custom_posts');
//add_action( 'pre_get_posts', 'casw_taxonomy_queries' );


// People

function create_custom_posts() {

    register_post_type('people',
        array(
        'labels' => array(
            'name' => __('People'),
            'menu_name' => __('All People'),
            'singular_name' => __('People'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Person'),
            'edit' => __('Edit'),
			'edit_item' => __('Edit Person'),
            'new_item' => __('New Person'),
            'view' => __('View Person'),
            'view_item' => __('View Person'),
            'search_items' => __('Search People'),
            'not_found' => __('No People found'),
            'not_found_in_trash' => __('No People found in Trash')
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'comments',
            'thumbnail'
        ),
        'can_export' => true,
        'taxonomies' => array(
            'people-categories'
        ),
        'rewrite' => array('slug' => 'people', 'with_front' => false)
    ));  
    
}

function casw_taxonomy_queries( $query ) {
    if ( ( $query->is_category() || $query->is_tag() )
        && $query->is_main_query() ) {
            $query->set( 'post_type', array( 'people' ) );
    }
}




function pagination($pages = '', $range = 4)
{
	
    global $paged;
    if(empty($paged)) $paged = 1;
 
    if($pages == '')
    {

        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
 
    if(1 != $pages)
    {

        if($paged > 1) echo "<a href=\"".get_pagenum_link($paged - 1)."\" class=\"button\">Previous</a>";
 
 /*
        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }
*/ 


        if ($paged < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\" class=\"button\">Next Page</a>";

    }
}



/*
* Default Template
* HAS ISSUE: only changes default selection, does not grab fields from ACF...
	
function casw_default_page_template() {
    global $post;
    if ( 'page' == $post->post_type 
        && 0 != count( get_page_templates( $post ) ) 
        && get_option( 'page_for_posts' ) != $post->ID // Not the page for listing posts
        && '' == $post->page_template // Only when page_template is not set
    ) {
        $post->page_template = "templates/template-landing-list.php";
    }
}
add_action('add_meta_boxes', 'casw_default_page_template', 1);

*/





/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );


/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );


/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

/**
 * Get key for start and end time
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_get_time_key( $start_time, $end_time ) {
	$hour = substr( $start_time, 0, 2);
	$minute = substr( $start_time, 3, 2 );
	if ( (int) $minute >= 30 ) {
		$minute = '30';
	} else {
		$minute = '00';
	}
	$start_time = $hour . ':' . $minute . ':00';
	
	$hour = substr( $end_time, 0, 2);
	$minute = substr( $end_time, 3, 2 );
	if ( (int) $minute > 30 ) {
		$hour = substr( $hour, 0, 1) . ( substr( $hour, 1, 1) + 1);          
		$minute = '00';
	} else if ( (int) $minute > 0 ) {
		$minute = '30';
	}
	$end_time = $hour . ':' . $minute . ':00';
	
	return $start_time . '_' . $end_time;
}
