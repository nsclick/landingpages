<?php
/**
 * The main template file
 * First NSClick responsive Wordpress theme
 * 
 */
get_header(); ?>

<?php //get_sidebar( 'content' ); ?>

<div id="main-content">
	<div class="content">

		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();

					get_template_part( 'content', get_post_format() );

				endwhile;

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>


	</div>
</div>
<?php get_sidebar(); ?>
<?php
get_footer();
