<?php
/*
Plugin Name: Lightweight Grid Columns
Plugin URI: http://generatepress.com
Description: Add lightweight grid columns to your content using easy to use shortcodes.
Version: 0.4
Author: Thomas Usborne
Author URI: http://edge22.com
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * Load plugin textdomain.
 *
 * @since 0.1
 */
add_action( 'plugins_loaded', 'lgc_load_textdomain' );
function lgc_load_textdomain() {
  load_plugin_textdomain( 'lgc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}

if ( ! function_exists( 'lgc_shortcodes_register_shortcode' ) ) :
/*
 * Declare our shortcode
 */
add_action( 'init','lgc_shortcodes_register_shortcode' );
function lgc_shortcodes_register_shortcode()
{
	add_shortcode( 'lgc_column', 'lgc_columns_shortcode' );
}
endif;

if ( ! function_exists( 'lgc_add_shortcode_button' ) ) :
/*
 * Set it up so we can register our TinyMCE button
 */
add_action('admin_init', 'lgc_add_shortcode_button');
function lgc_add_shortcode_button() 
{
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) )
		return;
		
	// check if WYSIWYG is enabled
	if ( get_user_option( 'rich_editing' ) == 'true') {
		add_filter( 'mce_external_plugins', 'lgc_shortcodes_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'lgc_shortcodes_register_button' );
	}
}
endif;

if ( ! function_exists( 'lgc_shortcodes_add_tinymce_plugin' ) ) :
/*
 * Register our tinyMCE button javascript
 */
function lgc_shortcodes_add_tinymce_plugin( $plugin_array ) {
	$plugin_array[ 'lgc_shortcodes_button' ] = plugins_url( '/js/button.js', __FILE__ );
	return $plugin_array;
}
endif;

if ( ! function_exists( 'lgc_shortcodes_register_button' ) ) :
/*
 * Register our TinyMCE button
 */
function lgc_shortcodes_register_button( $buttons ) {
	array_push( $buttons, 'lgc_shortcodes_button' );
	return $buttons;
}
endif;

if ( ! function_exists( 'lgc_translatable_strings' ) ) :
add_action( 'admin_head','lgc_translatable_strings', 0 );
function lgc_translatable_strings()
{
	?>
	<script type="text/javascript">
		var lgc_add_columns = '<?php _e( 'Add columns', 'lgc' ); ?>';
		var lgc_columns = '<?php _e( 'Columns', 'lgc' ); ?>';
		var lgc_desktop = '<?php _e( 'Desktop grid percentage', 'lgc' ); ?>';
		var lgc_tablet = '<?php _e( 'Tablet grid percentage', 'lgc' ); ?>';
		var lgc_mobile = '<?php _e( 'Mobile grid percentage', 'lgc' ); ?>';
		var lgc_content = '<?php _e( 'Content', 'lgc' ); ?>';
		var lgc_last = '<?php _e( 'Last column in row?', 'lgc' ); ?>';
	</script>
	<?php
}
endif;

if ( ! function_exists( 'lgc_shortcodes_admin_css' ) ) :
/*
 * Add our admin CSS
 */
add_action( 'admin_enqueue_scripts', 'lgc_shortcodes_admin_css' );
function lgc_shortcodes_admin_css() {
	wp_enqueue_style( 'lgc-columns-admin', plugins_url('/css/admin.css', __FILE__) );
}
endif;

if ( ! function_exists( 'lgc_shortcodes_css' ) ) :
/*
 * Add the unsemantic framework
 */
add_action( 'wp_enqueue_scripts', 'lgc_shortcodes_css', 99 );
function lgc_shortcodes_css() {
	wp_enqueue_style( 'lgc-unsemantic-grid-responsive-tablet', plugins_url('/css/unsemantic-grid-responsive-tablet.min.css', __FILE__) );
}
endif;

if ( ! function_exists( 'lgc_columns_shortcode' ) ) :
/*
 * Create the output of the columns shortcode
 */
function lgc_columns_shortcode( $atts , $content = null ) {

	extract( shortcode_atts(
		array(
			'grid' => '50',
			'tablet_grid' => '50',
			'mobile_grid' => '100',
			'last' => '',
			'class' => '',
			'style' => '',
		), $atts )
	);
	
	$clear = ( 'true' == $last ) ? '<div class="lgc-clear"></div>' : '';
	$inlineCSS = ( ! empty( $style ) ) ? ' style="' . esc_attr( $style ) . '"' : '';
	return lgc_columns_helper( '<div class="lgc-column lgc-grid-parent lgc-grid-' . intval( $grid ) . ' lgc-tablet-grid-' . intval( $tablet_grid ) . ' lgc-mobile-grid-' . intval( $mobile_grid ) . '"><div class="inside-grid-column ' . esc_attr( $class ) . '"' . $inlineCSS . '>' . $content . '</div></div>' . $clear );

}
endif;

if ( ! function_exists( 'lgc_columns_helper' ) ) :
function lgc_columns_helper( $content ){   
    
	$array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr( $content, $array );
    return do_shortcode( shortcode_unautop( force_balance_tags( trim( $content ) ) ) );
	
}
endif;

if ( ! function_exists( 'lgc_ie_compatibility' ) ) :
/** 
 * Add compatibility for IE8 and lower
 * @since 0.3
 */
add_action('wp_head','lgc_ie_compatibility');
function lgc_ie_compatibility()
{
?>
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo plugins_url('/css/ie.min.css', __FILE__); ?>" />
	<![endif]-->
<?php
}
endif;