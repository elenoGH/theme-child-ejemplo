<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function child_scripst(){
    wp_enqueue_script('exta js', get_stylesheet_directory_uri().'/js/extra.js');
}
add_action('wp_enqueue_scripts', 'child_scripst');