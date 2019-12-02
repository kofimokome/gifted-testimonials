<?php
/**
 * Plugin Name: Gifted Testimonials
 * Plugin URI: https://github.com/kofimokome/gifted-testimonials
 * Description: Display a nice testimonial carousel
 * Version: 1.0
 * Author: Kofi Mokome
 * Author URI: https://kofimokome.stream
 */

namespace gifted_testimonial;

defined( 'ABSPATH' ) or die( 'Giving To Cesar What Belongs To Caesar' );

$error = false;

function kmgt_error_notice( $message = '' ) {
	if ( trim( $message ) != '' ):
		?>
        <div class="error notice is-dismissible">
            <p><b>Gifted Testimonials: </b><?php echo $message ?></p>
        </div>
	<?php
	endif;
}

add_action( 'admin_notices', 'gifted_testimonial\\kmgt_error_notice', 10, 1 );

// loads classes / files
function kmgt_loader() {
	global $error;
	$classes = array(
		'GiftedTestimonial.php', //
		'GiftedTestimonialPostType.php', //
		'GiftedTestimonialShortCode.php', //
	);

	foreach ( $classes as $file ) {
		if ( ! $filepath = file_exists( plugin_dir_path( __FILE__ ) . "includes/" . $file ) ) {
			kmgt_error_notice( sprintf( __( 'Error locating <b>%s</b> for inclusion', 'kmgt' ), $file ) );
			$error = true;
		} else {
			include_once plugin_dir_path( __FILE__ ) . "includes/" . $file;
		}
	}
}

function kmgt_start_gifted_testimonials() {
	$gifted_testimonial = new GiftedTestimonial();
	$gifted_testimonial->run();
}


kmgt_loader();
if ( ! $error ) {
	kmgt_start_gifted_testimonials();
}


// remove options upon deactivation

register_deactivation_hook( __FILE__, 'kmgt_deactivation' );

function kmgt_deactivation() {
	// set options to remove here
}

// todo: for future use
load_plugin_textdomain( 'kmgt', false, basename( dirname( __FILE__ ) ) . '/languages' );