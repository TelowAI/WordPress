<?php

/**
 * Load Styles Front-End
 */
function base_assets() {
    $manifest = json_decode(file_get_contents('build/assets.json', true));
    $main = $manifest->main;
    wp_enqueue_style('base-css', get_template_directory_uri() . "/build/" . $main->css,  false, null);
    wp_enqueue_script('base-js', get_template_directory_uri() . "/build/" . $main->js, ['jquery'], null, true);

    wp_localize_script('all', 'wpb_wp_obj', array(
            'ajaxurl'           => admin_url('admin-ajax.php'),
            'ajax_nonce'        => wp_create_nonce('nih-ajax'),
            'template_dir'      => get_template_directory_uri()
        )
    );
}
add_action( 'wp_enqueue_scripts', 'base_assets');

/**
 * Load Styles Front-End
 */
function admin_assets() {
    $manifest = json_decode(file_get_contents('build/admin.assets.json', true));
    $main = $manifest->main;
    wp_enqueue_style('admin-css', get_template_directory_uri() . "/build/" . $main->css,  false, null);
    wp_enqueue_script('admin-js', get_template_directory_uri() . "/build/" . $main->js, ['jquery'], null, true);

    wp_localize_script('all', 'wpb_wp_obj', array(
            'ajaxurl'           => admin_url('admin-ajax.php'),
            'ajax_nonce'        => wp_create_nonce('nih-ajax'),
            'template_dir'      => get_template_directory_uri()
        )
    );
}
add_action( 'admin_enqueue_scripts', 'admin_assets');

/**
 * Overwrite Admin CSS
 */
function admin_style() {
    wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/admin/admin-style.css', false, null );
}
add_action( 'admin_enqueue_scripts', 'admin_style' );

function register_my_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}

/**
 * Display Alert Message Odd week of the year on Tuesdays.
 */

function add_maintenance_alert($wp_admin_bar){
	if(date('W') % 2 != 0 && date('D') == 'Tue'){
	  // Add New Node
		$wp_admin_bar->add_node(array(
		  'id'    => 'maintenance_node',
		  'title' => 'Site updates today from 4PM - 5PM ET. Do not edit/save during this time.',
		  'meta'  => array( 'class' => 'maintenance_node' )
		));
	
		// Enter Node Bar Style
		echo '<style>
			  .maintenance_node{
				background: #d81c1c !important;
			  }
		  </style>';
	
	}
  }
  add_action('admin_bar_menu', 'add_maintenance_alert', 1);