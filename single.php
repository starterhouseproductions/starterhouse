<?php 
get_header();

//VAR SET
$themeSkin = get_theme_mod('themolitor_customizer_theme_skin');

if (have_posts()) : while (have_posts()) : the_post();
$data = get_post_meta( $post->ID, 'key', true );
if(!empty($data['custom-background'])){$customBg = $data['custom-background'];}
if(!empty($data['main-video'])){$video = $data['main-video'];}
if(!empty($data['credits'])){$credits = $data['credits'];}
if(!empty($data['videos'])){$videos = $data['videos'];}
$postID = $post->ID;
$category = get_the_category(); 
$relatedposts = get_posts('orderby=rand&numberposts=3&category='. $category[0]->term_id.'&exclude='.$postID);
$args = array('post_type' => 'attachment','post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args);
?>

<img src="<?php echo $customBg;?>" id="loadImg" />

<?php if (!empty($video)) { //IF VIDEO DETECTED, SHOW VIDEO?>

<div id="topPanel" class="videoContainer">
	<div id="video" class="innerTopPanel">
		 <?php echo $video; ?>
	</div><!--end video-->
	<a href="#" class="continueOn"><?php _e('Continue','the-producer');?></a>
	<div id="nextPrevLinks">
		<?php 
		next_post_link('%link', __('Next &rarr;', 'the-producer'), TRUE);
		previous_post_link('%link', __('&larr; Previous', 'the-producer'), TRUE); 
		?>
	</div>
</div><!--end videoContainer-->

<?php } else {  //IF NO VIDEO DETECTED, SHOW POST TITLE?>

<div id="topPanel">
	<div class="innerTopPanel">
		<h1><?php the_title(); ?></h1>
		<h2><?php _e('Posted by ','the-producer'); the_author_posts_link(); _e(' on ','the-producer'); echo get_the_date('M j, Y'); _e(' in ','the-producer'); the_category(', '); edit_post_link('Edit Post &rarr;','&nbsp;&nbsp;/&nbsp;&nbsp;','');?></h2>
	</div><!--end innerTopPanel-->
	<a href="#" class="continueOn"><?php _e('Continue','the-producer');?></a>
	<div id="nextPrevLinks">
		<?php 
		next_post_link('%link', __('Next &rarr;', 'the-producer'), TRUE);
		previous_post_link('%link', __('&larr; Previous', 'the-producer'), TRUE);
		?>
	</div>
</div><!--end topPanel-->

<?php } if (!empty($video)) { //IF VIDEO DETECTED, SHOW TABS?>

<div id="mainPanel">

<!--TAB BUTTONS-->
<div id="tabNavContainer">
<ul id="tabNav">
		<li class="activeNav" id="synopsisLink"><a href="#"><i class="fa fa-info-circle"></i><span><?php _e('Synopsis','the-producer');?></span></a></li>
	<?php if (!empty($videos)) { ?>
		<li id="videosLink"><a href="#"><i class="fa fa-play-circle"></i><span><?php _e('Videos','the-producer');?></span></a></li>
	<?php } if($attachments) { ?>
		<li id="galleryLink"><a href="#"><i class="fa fa-th"></i><span><?php _e('Gallery','the-producer');?></span></a></li>
	<?php } if (!empty($credits)) { ?>
		<li id="creditsLink"><a href="#"><i class="fa fa-align-center"></i><span><?php _e('Credits','the-producer');?></span></a></li>
	<?php } if ('open' == $post->comment_status) { ?>
		<li id="commentsLink"><a href="#"><i class="fa fa-comment"></i><span><?php _e('Comments','the-producer');?></span></a></li>
	<?php } if($category[0] && count($relatedposts) > 1) { ?>
		<li id="relatedLink"><a href="#"><i class="fa fa-sitemap"></i><span><?php _e('Related','the-producer');?></span></a></li>
	<?php } ?>
</ul><!--end tabNav-->
</div><!--end tabNavContainer-->

<div id="tabs">
	
	<!--TABS ARROW CONTROLS-->
	<a href="#" id="prevTab" class="tabControls">&larr;</a>
	<a href="#" id="nextTab" class="tabControls">&rarr;</a>
	
	<div <?php post_class(); ?>>
	
		<!--SYNOPSIS TAB-->
		<div class="tab activeTab">
			<?php 
			if ( has_post_thumbnail() ) { 
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
  			 	echo '<a target="_blankd" class="thumbLink" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
   				the_post_thumbnail('related',array('title' => get_the_title()));
   				echo '</a>';
			} if ($video) { ?>
				<h2 class="posttitle"><?php the_title(); edit_post_link('Edit Post &rarr;','&nbsp;&nbsp;/&nbsp;<small>','</small>');?></h2>
			<?php }
				the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); 
				wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
			?>
			<div class="clear"></div>			
		</div><!--end tab-->		
	
		
	<?php if (!empty($videos)) {?>
		
		<!--VIDEOS TAB-->
		<div class="tab" id="videoTab">
			<?php echo wpautop($videos); ?>
		</div><!--end tab-->

		
	<?php } if($attachments) {?>
		
		<!--GALLERY TAB-->
		<div class="tab">
			<ul class="attachmentGallery">
    			<?php attachment_postpage(); ?>
    		</ul>
    		<div class="clear"></div>
    	</div><!--end tab-->
    
    	
   	<?php } if (!empty($credits)) {?>
      	
      	<!--CREDIT ROLL TAB-->	
      	<div class="tab" id="creditsList"> 
			<div id="creditRoll">
				<?php echo wpautop($credits); ?>
			</div>
		</div><!--end tab-->
    
    		
   	<?php } if ('open' == $post->comment_status) {?>
		
		<!--COMMENTS TAB-->
		<div class="tab">        
      		<?php comments_template(); ?>
      	</div><!--end tab-->
		
	<?php } if($category[0] && count($relatedposts) > 1){?>
		
		<!--RELATED TAB-->	
		<div class="tab" id="relatedPost"> 
			<ul>
				<?php
				foreach($relatedposts as $post) :
				?>
				<li>
					<a class="thumbLink" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('related',array('title' => get_the_title())); ?>
					</a>
					<h3><?php the_title(); ?></h3>
				</li>
				<?php endforeach; ?>
			</ul>
		</div><!--end tab-->
		
	<?php } ?>
		
	</div><!--end post-->
        		
</div><!--end tabs-->
</div><!--end mainPanel-->

<?php } else {  //IF NO VIDEO DETECTED, SHOW POST CONTENT w/ COMMENTS?>

<div id="mainPanel">
	<div id="main" class="videoLess">

		<div class="entry">	
        	
		<?php 
		the_content('<p class="serif">Read the rest of this page &raquo;</p>');
		wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
		the_tags('<p class="tags">Tags: ',' ','</p>');
		?>
		<br />
		</div>
 		
		<div class="clear"></div>
		
    	<?php if ('open' == $post->comment_status) { comments_template(); } ?>

		<div class="clear"></div>
	</div><!--end main-->
</div><!--end mainPanel-->

<?php } //END VIDEO DETECTION?>

<script>
jQuery.noConflict(); jQuery(document).ready(function(){
	jQuery(window).load(function(){		
		<?php if($customBg){ $background = $customBg; } else { $background = get_theme_mod('themolitor_customizer_bg');}?>
		jQuery.backstretch("<?php echo $background;?>", {speed: 1000});
	});
});
</script>

<?php endwhile; endif; get_footer(); ?>