<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="initial-scale=1.0,width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}
?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" /> 

<?php
//VAR SETUP
$logo = get_theme_mod('themolitor_customizer_logo');
$customCSS = get_theme_mod('themolitor_customizer_css');
$themeSkin = get_theme_mod('themolitor_customizer_theme_skin','dark');
$mainPatternDark = get_theme_mod('themolitor_customizer_main_dark_bg');
$footerPatternDark = get_theme_mod('themolitor_customizer_footer_dark_bg');
$mainPatternLight = get_theme_mod('themolitor_customizer_main_light_bg');
$footerPatternLight = get_theme_mod('themolitor_customizer_footer_light_bg');
$searchOnOff = get_theme_mod('themolitor_customizer_search_onoff',TRUE);
$bgOpacity = get_theme_mod('themolitor_customizer_bg_opacity','.80');
$continueOn = get_theme_mod('themolitor_customizer_continue_onoff',TRUE);
?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php if($themeSkin == "light"){?><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style_light.css" type="text/css" media="screen" /><?php } ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/responsive.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.min.css">

<?php
//WordPress VAR setup
$templateUrl = get_template_directory_uri();
$siteUrl = home_url();
$siteName = get_bloginfo('name');
?>

<style>
	<?php if(($themeSkin == 'dark') && $mainPatternDark){?>
		#mainPanel {background-image: url(<?php echo $mainPatternDark;?>);}
	<?php } if(($themeSkin == 'dark') && $footerPatternDark){?>
		#bottomPanel {background-image: url(<?php echo $footerPatternDark;?>);}
	<?php } if(($themeSkin == 'light') && $mainPatternLight){?>
		#mainPanel {background-image: url(<?php echo $mainPatternLight;?>);}
	<?php } if(($themeSkin == 'light') && $footerPatternLight){?>
		#bottomPanel {background-image: url(<?php echo $footerPatternLight;?>);}
	<?php } if($searchOnOff == 0){?>
		#navigation {margin-right: 0;}
	<?php } if($continueOn == 0){?>
		.continueOn {text-indent:0px; color:#fff; padding-bottom: 15px; margin-top:-15px;}
	<?php }
	
	//BACKGROUND OPACITY
	echo '#topPanel {background: rgba(0,0,0,'.$bgOpacity.');}';
	
	echo '@media screen and (max-width:900px) { #headerContainer {background: rgba(0,0,0,'.$bgOpacity.');}}';
	
	//CUSTOM CSS
	echo $customCSS; 
	?>
</style>

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->

<?php 
wp_enqueue_script('jquery');
wp_head(); 
if ( is_singular() ) wp_enqueue_script('comment-reply');
?>

</head>

<body <?php body_class();?>>

<div id="wrapper">

<div id="headerContainer">
	<div id="header">
		<a id="logo" href="<?php echo home_url(); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a><!--end logo-->   
		<?php if($searchOnOff == 1){ ?>
		<form method="get" id="headerSearch" action="<?php echo $siteUrl; ?>/">
			<input type="image" src="<?php echo $templateUrl; ?>/images/magglass.png" id="searchBtn" alt="Go" />
			<input type="text" value="Search Site" onfocus="this.value=''; this.onfocus=null;" name="s" id="s" />
		</form> 		
		<?php }
		if (has_nav_menu( 'main' ) ) { wp_nav_menu(array('theme_location' => 'main', 'container_id' => 'navigation', 'menu_id' => 'dropmenu')); }
    	?>	
	</div><!--end header-->
</div><!--end headerContainer-->	

<div id="loadingContainer"></div>