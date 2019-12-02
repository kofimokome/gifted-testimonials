<?php
/**
 * Created by PhpStorm.
 * User: kofi
 * Date: 12/2/19
 * Time: 2:54 PM
 */

namespace gifted_testimonial;

class GiftedTestimonialPostType {
	public function __construct() {
		// silence is golden
		$this->run();
	}

	private function run() {
		$this->add_actions();
	}

	private function add_actions() {
		add_action( 'init', [ $this, 'post_type' ] );
		add_action( 'init', [ $this, 'testimonial_taxonomy' ] );
		add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );
	}

	public function post_type() {
		$labels = array(
			'name'               => 'Gifted Testimonials',
			'singular_name'      => 'Gifted Testimonial',
			'add_new'            => 'Add New Testimonial',
			'add_new_item'       => 'Add New Testimonial',
			'edit_item'          => 'Edit Testimonial',
			'new_item'           => 'New Testimonial',
			'all_items'          => 'All Testimonials',
			'view_item'          => 'View Testimonial',
			'search_items'       => 'Search Testimonials',
			'not_found'          => 'No testimonial found',
			'not_found_in_trash' => 'No restimonial found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Gifted Testimonials'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'          => 'dashicons-format-chat',
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'rewrite'            => array( 'slug' => 'gifted_testimonials' ),
			'supports'           => array( 'title', 'author', 'editor', 'thumbnail' )
		);

		register_post_type( 'gifted_testimonials', $args );
	}

	public function testimonial_taxonomy() {
		register_taxonomy(
			'gifted_testimonials_location',
			'gifted_testimonials',
			array(
				'labels'        => array(
					'name'          => 'Locations',
					'add_new_item'  => 'Add New Location',
					'new_item_name' => "New Location"
				),
				'show_ui'       => true,
				'show_tagcloud' => true,
				'hierarchical'  => false
			)
		);
	}

	public function register_meta_boxes() {
		add_meta_box( 'shortcode-meta-box', 'Short Code', [
			$this,
			'shortcode_callback'
		], 'gifted_testimonials', 'side' );
	}

	public function shortcode_callback() {
		echo "Shorcode: <code><b>[gifted_testimonials]</b></code>";
	}
}