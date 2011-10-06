<?php
/*
Template Name: Torrents
*/
?>
<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<table>
<?php
$args = array( 'post_type' => 'torrent', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>
	<tr>
		<td><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></td>
		<td><a href="<?php bloginfo('url'); ?>/author/<?php the_author_meta('nickname'); ?>"><?php the_author(); ?></a></td>
		<td><?php the_date(); ?></td>
		<td><?php the_time(); ?></td>
	</tr>
<?php
endwhile;
?>
						</table>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

			</div><!-- #content -->
		</div><!-- #primary -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>
