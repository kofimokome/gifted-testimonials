<?php
/**
 * Created by PhpStorm.
 * User: kofi
 * Date: 12/2/19
 * Time: 3:12 PM
 */

namespace gifted_testimonial;

class GiftedTestimonialShortCode {
	public function __construct() {
		// silence is golden
		$this->run();
	}

	private function run() {
		$this->add_actions();
	}

	private function add_actions() {
		add_shortcode( 'gifted_testimonials', [ $this, 'gifted_testimonial_shorcode_callback' ] );
	}

	public function gifted_testimonial_shorcode_callback( $atts ) {
		ob_start();
		$args  = [
			'post_type'     => 'gifted_testimonials',
			'post_status'   => 'published',
			'post_per_page' => - 1,
			'order'         => 'asc'
		];
		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) :
			?>
            <div class="owl-carousel owl-theme owl-loaded km-gifted-testimonials">
                <div class="owl-nav">
                    <div class="owl-prev">
                        <i class="fa fa-chevron-circle-left fa-3x km-gifted-control-prev"></i>
                    </div>
                </div>
                <div class="owl-stage-outer">
                    <div class="owl-stage">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							$id       = get_the_ID();
							$taxonomy = wp_get_post_terms( $id, 'gifted_testimonials_location', [ 'fields' => 'names' ] );
							?>
                            <div class="owl-item">
                                <div class="km-gifted-testimonial">
                                    <i class="fa fa-quote-left fa-4x" style="color:#019dd8"></i>
                                    <div class="km-gifted-testimonial-content">
										<?php the_content(); ?>
                                    </div>
                                    <div class="km-gifted-testimonial-user">
                                        <div class="km-gifted-testimonial-image">
                                            <img src="<?php echo get_the_post_thumbnail_url( $id ) ?>" alt="">
                                        </div>
                                        <div class="km-gifted-testimonial-location">
                                            <h6><b><?php echo get_the_title() ?></b></h6>
                                            <span id="km-location"><?php echo $taxonomy[0] ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
						<?php
						endwhile;
						?>
                    </div>
                </div>
                <div class="owl-nav">
                    <div class="owl-next">
                        <i class="fa fa-chevron-circle-right fa-3x km-gifted-control-next"></i>
                    </div>
                </div>
                <!--<div class="owl-dots">
                    <div class="owl-dot active"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                </div>-->
            </div>
		<?php
		endif;
		//
		wp_reset_postdata();
		$output_string = ob_get_contents();
		ob_end_clean();

		return $output_string;

	}
}