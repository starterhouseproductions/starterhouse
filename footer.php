<?php
//VAR SETUP
$rss = get_theme_mod('themolitor_customizer_rss_onoff',TRUE);
$skype = get_theme_mod('themolitor_customizer_skype');
$imdb = get_theme_mod('themolitor_customizer_imdb');
$flickr = get_theme_mod('themolitor_customizer_flikr');
$instagram = get_theme_mod('themolitor_customizer_instagram');
$linkedin = get_theme_mod('themolitor_customizer_linkedin');
$youtube = get_theme_mod('themolitor_customizer_youtube');
$vimeo = get_theme_mod('themolitor_customizer_vimeo');
$facebook = get_theme_mod('themolitor_customizer_facebook');
$twitter = get_theme_mod('themolitor_customizer_twitter');
$footerText = get_theme_mod('themolitor_customizer_footer','Site by <a href="http://themolitor.com/portfolio" title="Site by THE MOLITOR">THE MOLITOR</a>');
$background = get_theme_mod('themolitor_customizer_bg');
$continueOn = get_theme_mod('themolitor_customizer_continue_onoff',TRUE);
?>

<div id="bottomPanel">

	<?php get_sidebar(); ?>

	<div id="footer">  
		<?php if ($rss != '' || $skype != '' || $myspace != '' || $flickr != '' || $linkedin != '' || $youtube != '' || $vimeo != '' || $facebook != '' || $twitter != '') { ?>
		<div id="socialStuff">
			<?php if ($rss != '') { ?>
				<a class="socialicon" id="rssIcon" href="<?php bloginfo('rss2_url'); ?>"  title="Subscribe via RSS" rel="nofollow"><i class="fa fa-rss"></i></a>
			<?php } if ($skype != '') { ?>
				<a class="socialicon" id="skypeIcon" href="<?php echo $skype; ?>"  title="Skype" rel="nofollow"><i class="fa fa-skype"></i></a>
			<?php } if ($imdb != '') { ?>
				<a class="socialicon" id="imdbIcon" href="<?php echo $imdb; ?>"  title="IMDB" rel="nofollow"><i class="fa fa-imdb"></i></a>
			<?php } if ($instagram != '') { ?>
				<a class="socialicon" id="instagramIcon" href="<?php echo $instagram; ?>"  title="Instagram" rel="nofollow"><i class="fa fa-instagram"></i></a>
			<?php } if ($flickr != '') { ?>
				<a class="socialicon" id="flickrIcon" href="<?php echo $flickr; ?>"  title="Flickr" rel="nofollow"><i class="fa fa-flickr"></i></a>
			<?php } if ($linkedin != '') { ?>
				<a class="socialicon" id="linkedinIcon" href="<?php echo $linkedin; ?>"  title="LinkedIn" rel="nofollow"><i class="fa fa-linkedin"></i></a>
			<?php } if ($youtube != '') { ?> 
				<a class="socialicon" id="youtubeIcon" href="<?php echo $youtube; ?>" title="YouTube Channel"  rel="nofollow"><i class="fa fa-youtube"></i></a>
			<?php } if ($vimeo != '') { ?> 
				<a class="socialicon" id="vimeoIcon" href="<?php echo $vimeo; ?>"  title="Vimeo Profile" rel="nofollow"><i class="fa fa-vimeo"></i></a>
			<?php } if ($facebook != '') { ?>
				<a class="socialicon" id="facebookIcon" href="<?php echo $facebook; ?>"  title="Facebook Profile" rel="nofollow"><i class="fa fa-facebook"></i></a>
			<?php } if ($twitter != '') { ?> 
				<a class="socialicon" id="twitterIcon" href="<?php echo $twitter; ?>" title="Follow on Twitter"  rel="nofollow"><i class="fa fa-twitter"></i></a>
			<?php } ?>
		</div>
		<?php } ?>
	
		<div id="copyright">
			<?php dimox_breadcrumbs(); ?>
			&copy; <?php echo date('Y '); bloginfo('name'); echo ". ".$footerText; echo " ";?>	
		</div>
	</div><!--end footer-->
</div><!--end bottomPanel-->

</div><!--end wrapper-->

<?php if(!is_single() && !is_page() && !is_category()){ ?>
<img src="<?php echo $background;?>" id="loadImg" alt="" />
<?php } ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/pace.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/backstretch.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/custom.js"></script>
<script>
jQuery.noConflict(); jQuery(document).ready(function(){

	var view = jQuery(window);
		
	<?php if(is_front_page()){ ?>
		view.load(function(){
			var customBg = jQuery('.activeTab').children('span').text();
			jQuery('#sliderContainer').backstretch(customBg,{speed:1000});
			jQuery.backstretch("<?php echo $background;?>", {speed:1000});
		})
	<?php } elseif(!is_single() && !is_page() && !is_category()){ ?>
		view.load(function(){
			jQuery.backstretch("<?php echo $background;?>", {speed: 1000});
		})
	<?php }
	
	if($continueOn == 1){ ?>
		var continueOn = jQuery('.continueOn');
		continueOn.hover(function(){
			jQuery(this).stop(true,true).animate({paddingBottom:"15px",marginTop:"-15px"},300);
		},function(){
			jQuery(this).stop(true,true).animate({paddingBottom:"0px",marginTop:"0px"},300);
		});
	<?php } ?>
});
</script>

<!--[if IE 8]>
<script>
jQuery.noConflict(); jQuery(document).ready(function(){
	jQuery('img').removeAttr('width').removeAttr('height');
});
</script>
<![endif]-->

<?php wp_footer(); ?>

</body>
</html>