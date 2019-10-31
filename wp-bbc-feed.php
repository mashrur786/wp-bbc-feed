<?php
/**
 * Plugin Name:       WP BBC Feed
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       a WordPress plugin which will fetch and render the 10 latest stories from the BBC News feed
 * Version:           1.0.0
 * Author:            Mashrur Chowdhury
 * Author URI:        http://mashrur.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-bbc-feed
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


require plugin_dir_path( __FILE__ ) . 'includes/class-wp-bbc-feed.php';


function wp_bbc_feed_widget_init() {
		register_widget('WP_BBC_Feed');
	}
add_action( 'widgets_init', 'wp_bbc_feed_widget_init' );


?>
