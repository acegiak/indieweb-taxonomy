<?php
/**
 * Plugin Name: IndieWeb Custom Taxonomy
 * Plugin URI: http://tiny.n9n.us
 * Description: Adds Semantic Functionality to Posts
 * Version: 0.01
 * Author: David Shanske
 * Author URI: http://david.shanske.com
 * License: CC0
 */

// Register Kind to Distinguish the Types of Posts

require_once( plugin_dir_path( __FILE__ ) . '/WDS_Taxonomy_Radio.class.php');
require_once( plugin_dir_path( __FILE__ ) . '/WDS_Taxonomy_Radio_Walker.php');
// Add Kind Post Metadata
require_once( plugin_dir_path( __FILE__ ) . '/kind-postmeta.php');


add_action( 'init', 'register_taxonomy_kind' );

function register_taxonomy_kind() {

    $labels = array( 
        'name' => _x( 'Kinds', 'kind' ),
        'singular_name' => _x( 'Kind', 'kind' ),
        'search_items' => _x( 'Search Kinds', 'kind' ),
        'popular_items' => _x( 'Popular Kinds', 'kind' ),
        'all_items' => _x( 'All Kinds', 'kind' ),
        'parent_item' => _x( 'Parent Kind', 'kind' ),
        'parent_item_colon' => _x( 'Parent Kind:', 'kind' ),
        'edit_item' => _x( 'Edit Kind', 'kind' ),
        'update_item' => _x( 'Update Kind', 'kind' ),
        'add_new_item' => _x( 'Add New Kind', 'kind' ),
        'new_item_name' => _x( 'New Kind', 'kind' ),
        'separate_items_with_commas' => _x( 'Separate kinds with commas', 'kind' ),
        'add_or_remove_items' => _x( 'Add or remove kinds', 'kind' ),
        'choose_from_most_used' => _x( 'Choose from the most used kinds', 'kind' ),
        'menu_name' => _x( 'Kinds', 'kind' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'kind', array('post'), $args );
}

// Comment this entry to revert to the standard category style picker
$kind_mb = new WDS_Taxonomy_Radio( 'kind' );

add_filter('post_link', 'kind_permalink', 10, 3);
add_filter('post_type_link', 'kind_permalink', 10, 3);
 
function kind_permalink($permalink, $post_id, $leavename) {
    if (strpos($permalink, '%kind%') === FALSE) return $permalink;
     
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;
 
        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'kind');   
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'standard';
 
    return str_replace('%kind%', $taxonomy_slug, $permalink);
}   


?>
