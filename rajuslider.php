<?php
/*
Plugin Name: Raju Slider
Plugin URI: https://onlytarikul.com
Description: Raju Slider Plugin
Version: 1.0
Author: Tarikul Islam
Author URI: https://onlytarikul.com
License: GPLv2 or later
Text Domain: rajus
Domain Path: /languages/
*/

function rajus_plugins_loaded() {
    load_plugin_textdomain( 'rajus', false, dirname( __FILE__ ) . "/languages" );
}
add_action('plugins_loaded','rajus_plugins_loaded');
/*function wordcount_activation_hook(){}
register_activation_hook(__FILE__,"wordcount_activation_hook");

function wordcount_deactivation_hook(){}
register_deactivation_hook(__FILE__,"wordcount_deactivation_hook");*/

/**
 * Admin Enqueue Script Here 
 */
function rajus_assets() {
    wp_enqueue_style( 'rajuslider-css', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css" );
    wp_enqueue_script( 'raju-slider-js', "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", null, '1.0.0', true );
    wp_enqueue_script( 'main-js', plugin_dir_url( __FILE__ ) . "/assets/js/main.js", array( 'jquery' ), time(), true );

}
add_action( 'wp_enqueue_scripts', 'rajus_assets' );

/**
 * Add Image Size for slider
 */
function rajuslider_init(){
    add_image_size('rajuslider_img_size','1000','400',true);
}
add_action('init','rajuslider_init');



/**
 * Slider Container Shortcode Here
 */
function rajusliders_shortcode($attributes,$content=''){

    $defaults = array(
        'id'=>'',
        'width'=> '1000',
        'height'=>'400',
    );
    $params = shortcode_atts($defaults,$attributes);
    $content = do_shortcode($content);

    $slider_output = <<<EOD
    <div style="width:{$params['width']}; height:{$params['height']}">
        <div class="my-slider">
            $content
        </div>
    </div>
EOD;
    return $slider_output;
}
add_shortcode('rslider','rajusliders_shortcode');


function rajuslide_shortcode($attributes){
    $defaults = array(
        'id'=>'',
        'size'=> 'rajuslider_img_size',
        'caption'=>'',
    );
    $params = shortcode_atts($defaults,$attributes);
    $slide_img = wp_get_attachment_image_src( $params['id'], $params['size']);

    $slider_output = <<<EOD
        <div class="slide"> 
            <p><img src ="{$slide_img[0]}"></p>
            <p>{$params['caption']}</p>
        </div>
    
EOD;
    return $slider_output;

}
add_shortcode('slide','rajuslide_shortcode');