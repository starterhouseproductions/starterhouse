<?php get_header();?>

<div id="topPanel">
	<div class="innerTopPanel">
		<h1><?php _e('Search Results','the-producer');?></h1>
		<h2><?php _e('Showing all search results for','the-producer');?> "<?php echo get_search_query();?>"</h2>
		<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
			<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search.png" id="searchsubmit" alt="GO!" />
			<input type="text" value="Search Site" onfocus="this.value=''; this.onfocus=null;" name="s" id="s" />
		</form>
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
			<p class="metaStuff"><?php _e('Posted by ','the-producer'); the_author(); _e(' on ','the-producer'); echo get_the_date(); ?>&nbsp; / &nbsp; <?php comments_number('Comments Open', '1 Comment', '% Comments' ); edit_post_link('Edit Post','&nbsp;&nbsp; / &nbsp;&nbsp;',''); ?></p>
			<?php } ?>
			<?php the_excerpt();?>
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

<?php get_footer(); ?>