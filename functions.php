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

function child_scripst_jquery(){
//    wp_enqueue_script('jquery js', get_stylesheet_directory_uri().'/js/jquery-git.js');
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'child_scripst_jquery');

function child_scripst(){
    wp_enqueue_script('exta js', get_stylesheet_directory_uri().'/js/extra.js');
}
add_action('wp_enqueue_scripts', 'child_scripst');


function elh_insert_into_db() {
 
    global $wpdb;
    // creates my_table in database if not exists
    $table = $wpdb->prefix . "my_table"; 
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `name` text NOT NULL,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    // starts output buffering
    ob_start();
    ?>
    <form action="#v_form" method="post" id="v_form">
        <label for="visitor_name"><h3>Hello there! What is your name?</h3></label>
        <input type="text" name="visitor_name" id="visitor_name" />
        <input type="submit" name="submit_form" value="submit" />
    </form>
    <?php
    $html = ob_get_clean();
    // does the inserting, in case the form is filled and submitted
    if ( isset( $_POST["submit_form"] ) && $_POST["visitor_name"] != "" ) {
        $table = $wpdb->prefix."my_table";
        $name = strip_tags($_POST["visitor_name"], "");
        $wpdb->insert( 
            $table, 
            array( 
                'name' => $name
            )
        );
//        var_dump($wpdb);
        $html = "<p>Your name <strong>$name</strong> was successfully recorded. Thanks!!</p>";
    }
    // if the form is submitted but the name is empty
    if ( isset( $_POST["submit_form"] ) && $_POST["visitor_name"] == "" )
        $html .= "<p>You need to fill the required fields.</p>";
    // outputs everything
    return $html;
     
}
// adds a shortcode you can use: [insert-into-db]
add_shortcode('elh-db-insert', 'elh_insert_into_db');