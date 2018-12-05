<?php
/**
 * The template part for displaying content
 *
 * @package Bimber_Theme 4.10
 */

?>
<?php
$bimber_entry_data = bimber_get_template_part_data();
$bimber_elements   = $bimber_entry_data['elements'];
?>

<article <?php post_class( 'entry-tpl-list' ); ?>>
	<?php
	if ( $bimber_elements['featured_media'] ) :
		bimber_render_entry_featured_media( array(
			'size' => 'bimber-list-standard',
		) );
	endif;
	?>

	<?php
	bimber_render_open_list_badge();
	bimber_render_entry_flags(); ?>

	<div class="entry-body">
		<header class="entry-header">
			<div class="entry-before-title">
				<?php
				bimber_render_entry_stats( array(
					'share_count'       => $bimber_elements['shares'],
					'view_count'        => $bimber_elements['views'],
					'comment_count'     => $bimber_elements['comments_link'],
					'download_count'    => $bimber_elements['downloads'],
					'vote_count'        => $bimber_elements['votes'],
					'class'             => 'g1-current-background',
				) );
				?>

				<?php
				if ( $bimber_elements['categories'] ) :
					bimber_render_entry_categories();
				endif;
				?>
			</div>

		<?php bimber_render_entry_title( '<h3 class="g1-gamma g1-gamma-1st entry-title"><a href="%1$s" rel="bookmark">', '</a></h3>' ); ?>
		</header>

		<?php if ( $bimber_elements['summary'] ) : ?>
			<div class="entry-summary">
				<?php the_excerpt();
				snax_render_meme_recaption();
				snax_render_meme_see_similar();
				?>
			</div>
		<?php endif; ?>

		<?php if ( $bimber_elements['author'] || $bimber_elements['date'] ) : ?>
			<footer>
				<p class="g1-meta entry-meta entry-meta-byline">

					<?php
					if ( $bimber_elements['date'] ) :
						bimber_render_entry_date();
					endif;
					?>
				</p>
			</footer>
		<?php endif; ?>
	</div>
</article>
