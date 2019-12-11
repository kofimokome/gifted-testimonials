<?php
/**
 * Created by PhpStorm.
 * User: kofi
 * Date: 12/2/19
 * Time: 2:03 PM
 */

namespace gifted_testimonial;

class GiftedTestimonial {

	public function __construct() {
		// our constructor
	}

	public function run() {
		$this->add_actions();
		$this->add_functionality();
	}

	private function add_actions() {

		add_action( 'wp_enqueue_scripts', [ $this, 'add_scripts' ] );
		add_action( 'admin_notices', [ $this, 'error_notice' ], 10, 1 );
	}

	public function error_notice( $message = '' ) {
		if ( trim( $message ) != '' ):
			?>
            <div class="error notice">
                <p><b>Gifted Testimonial: </b><?php echo $message ?></p>
            </div>
		<?php
		endif;
	}

	public function add_scripts() {
		//wp_enqueue_style( 'style-name', get_stylesheet_uri() );
		wp_enqueue_style( 'font-awesome', plugins_url( '/css/all.min.css', dirname( __FILE__ ) ), '', '5.11.2', '' );
		wp_enqueue_style( 'owl-carousel', plugins_url( '/css/owl.carousel.min.css', dirname( __FILE__ ) ), '', '2.3.4', '' );
		wp_enqueue_style( 'owl-carousel-default', plugins_url( '/css/owl.theme.default.min.css', dirname( __FILE__ ) ), '', '2.3.4', '' );
		wp_enqueue_style( 'gifted-testimonial', plugins_url( '/css/main.css', dirname( __FILE__ ) ), '', '1.0.0', '' );

		wp_enqueue_script( 'owl-carousel', plugins_url( '/js/owl.carousel.min.js', dirname( __FILE__ ) ), [ 'jquery' ], '2.3.4', true );
		wp_enqueue_script( 'gifted-testimonial', plugins_url( '/js/main.js', dirname( __FILE__ ) ), array( 'jquery' ), '1.0.0', true );

	}

	private function add_functionality() {
		new GiftedTestimonialPostType();
		new GiftedTestimonialShortCode();
	}

}