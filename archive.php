<?php 
get_header();
$catName = single_cat_title("", false);
$catBio = category_description();
$term_id = get_category_id($catName);
$customBg = get_tax_meta($term_id,'cat_bg');
?>

<img src="<?php echo $customBg;?>" id="loadImg" />

<div id="topPanel">
	<div class="innerTopPanel">
		<h1><?php if (is_category()) { single_cat_title(); } else if (is_tax()) { global $wp_query; $term = $wp_query->get_queried_object(); echo $term->name; } else if (is_tag()) { single_tag_title(); } else if (is_author()) { the_author(); } else if (is_day()) { echo get_the_date(); } else if (is_month()) { echo get_the_date('F Y'); } else if (is_year()) { echo get_the_date('Y'); } else { echo "Archives"; } ?></h1>
		<?php if($catBio){ echo '<h2>'. $catBio.'</h2>';} ?>
	</div><!--end innerTopPanel-->
	<a href="#" class="continueOn"><?php _e('Continue','the-producer');?></a>
</div><!--end topPanel-->

<div id="mainPanel">
<div id="main">

	<div class="listing">
	<?php 
	if (have_posts()) : while (have_posts()) : the_post(); 
	$data = get_post_meta( $post->ID, 'key', true );
	if(isset($data[ 'main-video' ])){$video = $data[ 'main-video' ];}
	?>
	
		<div <?php post_class(); ?>>
		
		<?php if ( has_post_thumbnail() && $video) { ?>
			<a class="thumbLink" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('post-thumbnail',array('title' => get_the_title())); ?></a>
		<?php } elseif ( has_post_thumbnail()) { ?>
			<a class="thumbLinkWide" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('wide',array('title' => get_the_title())); ?></a>
			<div class="clear"></div>
		<?php } ?>	
			
			<h2 class="posttitle"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<?php if(!$video) { ?>
			<p class="metaStuff"><?php _e('Posted by ','the-producer'); the_author(); _e(' on ','the-producer'); echo get_the_date(); ?>&nbsp; / &nbsp; <?php comments_number('No Comments', '1 Comment', '% Comments' ); edit_post_link('Edit Post','&nbsp;&nbsp; / &nbsp;&nbsp;',''); ?></p>
			<?php }	the_excerpt(); ?>
			<a class="viewDetails" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php _e('Continue','the-producer');?></a>        
			<div class="clear"></div>		
			
		</div><!--end post-->

		<?php 
		endwhile;
		get_template_part('navigation'); 
		else : 
		?>
		
		<h2 class="center"><?php _e('Not Found','the-producer');?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that is not here.','the-producer');?></p>
		
	<?php endif; ?>
	
	</div><!--end listing-->

<div class="clear"></div>
	
</div><!--end main-->
</div><!--end mainPanel-->

<script>
jQuery.noConflict(); jQuery(document).ready(function(){
	jQuery(window).load(function(){
		<?php if($customBg){ $background = $customBg; } else { $background = get_theme_mod('themolitor_customizer_bg');}?>
		jQuery.backstretch("<?php echo $background;?>", {speed: 1000});
	});
});
</script>
<?php get_footer(); ?>