<?php
 
function redsilverita_scripts() {
    wp_enqueue_style( 'redsilverita-style', get_stylesheet_uri() );
    wp_enqueue_style( 'redsilverita-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i&display=swap&subset=latin-ext' );
}    
 
add_action( 'wp_enqueue_scripts', 'redsilverita_scripts' );
function redsilverita_menus() {
  register_nav_menu( 'main-menu', 'Main Menu' );
}
add_action( 'after_setup_theme', 'redsilverita_menus' );

add_theme_support('post-thumbnails');
set_post_thumbnail_size(300,200);

add_image_size('special-thumbnail',800,200);

function redsilverita_widgets_init() {
register_sidebar( array (
    'name' => __( 'Primary Widget Area'),
    'id' => 'widget-sidebar',
    'description' => __( 'The primary widget area'),
    'before_widget' => '<div id=”%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );
 
}
  
add_action( 'widgets_init', 'redsilverita_widgets_init' );

function redsilverita_child_pages()  {
	global $post;
	if ( is_page () && $post->post_parent )
		  $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	  else
		  $childpages =wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . 'echo=0' );
	  if ($childpages) {
		  $string = '<ul>'. $childpages . '</ul>';
	  }
	  return $string;
} 


add_shortcode('redsilverita_childpages', 'redsilverita_list_child_pages');
