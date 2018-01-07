<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 
$data = get_post_meta( $post->ID, 'key', true );
if(!empty($data['custom-background'])){$customBg = $data['custom-background'];}
if(!empty($data['sub-text'])){$tagline = $data['sub-text'];}
?>

<img src="<?php echo $customBg;?>" id="loadImg" />

<div id="topPanel">
	<div class="innerTopPanel">
		<h1><?php the_title(); ?></h1>
		<?php if(isset($tagline)){?><h2><?php echo $tagline;?></h2><?php } ?>
	</div><!--end innerTopPanel-->
	<a href="#" class="continueOn"><?php _e('Continue','the-producer');?></a>
</div><!--end topPanel-->

<div id="mainPanel">
	<div id="main">
		<div class="entry">
		<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>				
		<br />
		<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		<div class="clear"></div>
    	<?php if ('open' == $post->comment_status) { comments_template(); } ?>
		<div class="clear"></div>
	</div><!--end main-->
</div><!--end mainPanel-->

<script>
jQuery.noConflict(); jQuery(document).ready(function(){
	jQuery(window).load(function(){		
		<?php if(isset($customBg)){ $background = $customBg; } else { $background = get_theme_mod('themolitor_customizer_bg');}?>
		jQuery.backstretch("<?php echo $background;?>", {speed: 1000});
	});
});
</script>

<?php endwhile; endif; get_footer(); ?>