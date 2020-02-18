<?php
/**
 * Plugin Name:       Gated Content/ Infusionsoft Sign Up Form
 * Description:       This plugin creates a signup form that adds new users in Infusionsoft and creates accounts for them, enabling access to gated content. It requires the plugins Simple WordPress Membership and Simple Membership API to be installed and activated.
 * Version:           1.0.0
 * Author:            Daniel Ellis
 * Author URI:        https://danielellisdevelopment.com/
 */


/*
  Basic Security
*/
if ( ! defined( 'ABSPATH' ) ) {
  die;
}

/*
  Plugin Container Class
*/
if ( !class_exists( 'Ammonite_Gated_Content_Infusionsoft_Signup' ) ) {
  class Ammonite_Gated_Content_Infusionsoft_Signup
  {
    // Add shortcode to pull in the form template and its associated scripts and styles
    public static function add_shortcode_to_include_form_template_and_associated_scripts_and_styles() {
      add_shortcode( 'gated_content_infusionsoft_signup_form', array( 'Ammonite_Gated_Content_Infusionsoft_Signup', 'include_form_template_and_associated_scripts_and_styles' ) );
    }

    // Function called whenever the shortcode [gated_content_infusionsoft_signup_form] is used
    public static function include_form_template_and_associated_scripts_and_styles() {
      // Include form template wherever shortcode is used
      include( 'templates/signup-form.php' );

      // Enqueue associated script
      wp_enqueue_script( 'ammonite_gated_content_infusionsoft_signup_form_script' );

      // Enqueue associated stylesheet
      wp_enqueue_style( 'ammonite_gated_content_infusionsoft_signup_form_styles' );
    }

    // Register styles and scripts
    public static function register_scripts_and_styles() {
      add_action( 'wp_enqueue_scripts', function() {
        wp_register_script( 'ammonite_gated_content_infusionsoft_signup_form_script', plugins_url('assets/js/ammonite-gated-content-infusionsoft-signup-form.js', __FILE__ ), array('jquery'), '1.0.0', true );
        wp_register_style( 'ammonite_gated_content_infusionsoft_signup_form_styles', plugins_url('assets/css/ammonite-gated-content-infusionsoft-signup-form.css', __FILE__ ), array(), '1.0.0', 'all' );
      } );
    }
  }

  Ammonite_Gated_Content_Infusionsoft_Signup::register_scripts_and_styles();
  Ammonite_Gated_Content_Infusionsoft_Signup::add_shortcode_to_include_form_template_and_associated_scripts_and_styles();
}
