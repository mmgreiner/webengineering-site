<?php
// custom_post_type.php

// information sources: 
// http://php.net/manual/de/function.include.php
// http://blog.teamtreehouse.com/create-your-first-wordpress-custom-post-type

add_action('init', 'portfolio_posttype');

function portfolio_posttype() {
    $labels = array(
		'name' => 'My Portfolio',
		'singular_name' => 'Portfolio Item',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Portfolio Item',
		'edit_item' => 'Edit Portfolio Item',
		'new_item' => 'New Portfolio Item',
		'view_item' => 'View Portfolio Item',
		'search_items' => 'Search Portfolio',
		'not_found' => 'Nothing found',
		'not_found_in_trash' => 'Nothing found in Trash',
		'parent_item_colon' => '',
        'menu_name' => 'My Portfolio'
	);
 
	$args = array(
        'label' => 'portfolio',
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		//'menu_icon' => get_stylesheet_directory_uri() . '/article16.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => ['title','editor','thumbnail']
	  ); 
 
	register_post_type( 'portfolio' , $args );
    
    register_taxonomy("Skills", array("portfolio"), array("hierarchical" => true, "label" => "Skills", "singular_label" => "Skill", "rewrite" => true));

}

add_action('pre_get_posts', 'add_portfolio_posttypes');

function add_portfolio_posttypes() {
    if ( is_home() && $query->is_main_query() )
        $query->set('post_type', array('post', 'portfolio'));
    return $query;
}

?>