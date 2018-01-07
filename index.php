<?php 
get_header(); 

//VAR SETUP
$sliderCat = get_option('themolitor_slider_category');
$catBg = get_tax_meta($sliderCat,'cat_bg');
$sliderNum = get_theme_mod('themolitor_customizer_slider_number','4');
$video = get_theme_mod('themolitor_customizer_video');
if ($video != '') {
	$panelId = 'video'; 
	$panelClass = 'class="videoContainer"'; 
	$panelContent =  $video;
} else {
	$welcomeMsg = get_theme_mod('themolitor_customizer_welcome','The Producer is a unique <a target="_blank" href="http://themolitor.com/wordpress">WordPress theme</a> designed specifically for <a href="http://test.themolitor.com/producer/category/projects/">video projects</a> and built to be CRAZY easy to use.');
	if(!$welcomeMsg){$welcomeMsg = get_bloginfo('description');}
	$panelId = 'welcome'; 
	$panelClass = ''; 
	$panelContent =  '<h1>'.$welcomeMsg.'</h1>';
} 
?>

<div id="topPanel" <?php echo $panelClass;?>>
	<div id="<?php echo $panelId;?>" class="innerTopPanel">
		 <?php echo $panelContent; ?>
	</div><!--end video-->
	<a href="#" class="continueOn"><?php _e('Continue','the-producer');?></a>
</div><!--end topPanel-->

<div id="mainPanel">
<div id="sliderContainer">
<div id="innerSlider">
<div class="innerSection">

	<div id="homeSlider">
	<ul>
		<?php 
		$temp = $wp_query;
		$wp_query= null;
		$wp_query = new WP_Query();
		$wp_query->query('cat='.$sliderCat.'&posts_per_page='.$sliderNum);
		while ($wp_query->have_posts()) : $wp_query->the_post();
		$data = get_post_meta( $post->ID, 'key', true );
		if(!empty($data[ 'custom-background' ])){$backImage = $data[ 'custom-background' ];}
		?>
		<li class="homeSlide">
			<?php if ( has_post_thumbnail() ) { ?>
			<a class="thumbLink" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail',array('title' => get_the_title())); ?></a>
			<?php } ?>
			
			<div class="slideDetails">
				<h2 class="posttitle"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
				<?php the_excerpt();?>
				<a class="viewDetails" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php _e('Continue','the-producer');?></a>
			</div><!--end slideDetails-->
        
        	<?php if(isset($backImage)) {?><span><?php echo $backImage;?><img src="<?php echo $backImage;?>" alt="" /></span><?php } ?>
        	
			<div class="clear"></div>			
		</li><!--end homeSlide-->		
		<?php 
		endwhile;
		$wp_query = null; $wp_query = $temp;
		?>
		<!--VIEW ALL CATEGORY SLIDE-->
		<li class="homeSlide" id="catSlide">
			<div class="slideDetails">
				<h2 class="posttitle"><a href="<?php echo get_category_link($sliderCat); ?>"><?php echo get_cat_name($sliderCat);?></a></h2>
				<?php echo category_description($sliderCat); ?>
				<a class="viewDetails" href="<?php echo get_category_link($sliderCat); ?>"><?php _e('View All','the-producer');?></a>
			</div><!--end slideDetails-->
			<span><?php echo $catBg;?></span>
		</li><!--END VIEW ALL CATEGORY SLIDE-->
	</ul>

	<!--SLIDER ARROWS-->
	<a href="#" id="prevSlide" class="slideControls">&larr;</a>
	<a href="#" id="nextSlide" class="slideControls">&rarr;</a>

	</div><!--end homeSlider-->
	
	<!--SLIDE INDICATORS-->
	<ul id="homeSlideNav"></ul>

</div><!--end innerSection-->
</div><!--end innerSlider-->
</div><!--end sliderContainer-->
</div><!--end mainPanel-->

<?php get_footer(); ?>