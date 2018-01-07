<?php
///////////////////////
// TITLE TAG SUPPORT
///////////////////////
add_theme_support( 'title-tag' );

///////////////////////
// Localization Support
///////////////////////
load_theme_textdomain( 'the-producer', get_template_directory().'/languages' );
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);

///////////////////////
//configure category custom field
///////////////////////
require_once("Tax-meta-class/Tax-meta-class.php");
$config = array(
   'id' => 'custom_meta_box',                         // meta box id, unique per meta box
   'title' => 'Theme Meta Box',                      // meta box title
   'pages' => array('category'),                    // taxonomy name, accept categories, post_tag and custom taxonomies
   'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
   'fields' => array(),                             // list of meta fields (can be added by field arrays)
   'local_images' => false,                         // Use local or hosted images (meta box images for add/remove)
   'use_with_theme' => true                        //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);
$my_meta = new Tax_Meta_Class($config);
$my_meta->addText('cat_bg',array('name'=> 'Background Image URL'));
$my_meta->Finish();

///////////////////////
//IMAGE ATTACHMENTS FOR POST PAGE
///////////////////////
function attachment_postpage($size = 'thumbnail') {
	$thumb_ID = get_post_thumbnail_id();
	if($images = get_children(array(
		'order'   => 'ASC',
		'orderby' => 'menu_order',
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		//'exclude' => $thumb_ID,
		'post_mime_type' => 'image'
	))) {
		foreach($images as $image) {
			$attimg   = wp_get_attachment_image($image->ID,$size);
			$atturl   = wp_get_attachment_url($image->ID);
			$atttitle = apply_filters('the_title',$image->post_title);
			echo'<li><a title="'.$atttitle.'" class="attachmentGallery" rel="zoomBox[gallery-'.get_the_ID().']" href="'.$atturl.'">'.$attimg.'</a></li>';
		}
	}
}

///////////////////////
//CONTENT WIDTH
///////////////////////
if ( ! isset( $content_width ) ) $content_width = 500;

///////////////////////
//EXCERPT STUFF
///////////////////////
function new_excerpt_length($length) {
	return 35;
}
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_more($more) {
       global $post;
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

///////////////////////
//FEED LINKS
///////////////////////
add_theme_support('automatic-feed-links' );

///////////////////////
//EXCLUDE PAGES FROM SEARCH
///////////////////////
function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
add_filter('pre_get_posts','SearchFilter');

///////////////////////
//FEATURED IMAGE SUPPORT
///////////////////////
add_theme_support( 'post-thumbnails', array( 'post' ) );
set_post_thumbnail_size( 230, 340, true );
add_image_size( 'related',185 ,273,true );
add_image_size( 'wide',500 ,9999);

///////////////////////
//CATEGORY ID FROM NAME FOR PAGE TEMPLATES
///////////////////////
function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

///////////////////////
//ADD MENU SUPPORT
///////////////////////
add_theme_support( 'menus' );
register_nav_menu('main', 'Main Navigation Menu');

///////////////////////
//SIDEBAR GENERATOR (FOR SIDEBAR AND FOOTER)
///////////////////////
function producer_widgets_init() {
    register_sidebar( array(
		'name'=>'Live Widgets',
		'id' => 'sidebar-1',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
		'description' => 'Place up to 4 widgets in this space.'
	) );
}
add_action( 'widgets_init', 'producer_widgets_init' );

///////////////////////
//BREADCRUMBS
///////////////////////
include(TEMPLATEPATH . '/include/breadcrumbs.php');

////////////////////////
//POST OPTIONS
////////////////////////
include(TEMPLATEPATH . '/include/post-options.php');

////////////////////////
//THEME OPTIONS
////////////////////////
include(TEMPLATEPATH . '/include/theme-options.php');


////////////////////////////
//ALLOW IFRAME FOR SANTIZING
////////////////////////////
add_filter( 'wp_kses_allowed_html', 'esw_author_cap_filter',1,1 );

function esw_author_cap_filter( $allowedposttags ) {

	//Here put your conditions, depending your context
	if ( !current_user_can( 'publish_posts' ) )
	return $allowedposttags;
	
	// Here add tags and attributes you want to allow
	$allowedposttags['iframe']=array(
		'align' => true,
		'width' => true,
		'height' => true,
		'frameborder' => true,
		'name' => true,
		'src' => true,
		'id' => true,
		'class' => true,
		'style' => true,
		'scrolling' => true,
		'marginwidth' => true,
		'marginheight' => true,	
	);
	return $allowedposttags;
}