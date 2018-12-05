<?php
/**
 * The template part for displaying content
 *
 * @package Bimber_Theme 5.4
 */

?>
<?php

$bimber_entry_data = bimber_get_template_part_data();
$bimber_elements   = $bimber_entry_data['elements'];
?>
<article <?php post_class( 'entry-tpl-grid-fancy' ); ?>>
	<?php
	if ( $bimber_elements['featured_media'] ) :
		bimber_render_entry_featured_media( array(
			'size' => 'bimber-grid-fancy',
		) );
	endif;
	?>

	<div class="entry-counter"></div>

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

			<?php bimber_render_entry_title( '<h3 class="g1-delta g1-delta-1st entry-title"><a href="%1$s" rel="bookmark">', '</a></h3>' ); ?>
		</header>

		<?php
		if ( $bimber_elements['summary'] ) :
			the_excerpt();
		endif;
		?>

		<?php if ( $bimber_elements['author'] || $bimber_elements['date'] ) : ?>
			<footer>
				<p class="g1-meta entry-meta entry-byline <?php if ( $bimber_elements['avatar'] ) { echo sanitize_html_class( 'entry-byline-with-avatar' );}?>">
					<?php
					if ( $bimber_elements['author'] ) :
						bimber_render_entry_author( array( 'avatar' => $bimber_elements['avatar'] ) );
					endif;
					?>

					<?php
					if ( $bimber_elements['date'] ) :
						bimber_render_entry_date();
					endif;
					?>
				</p>
			</footer>
		<?php endif; ?>

		<?php if ( isset( $bimber_elements['voting_box'] ) && $bimber_elements['voting_box'] ) : ?>
			<div class="entry-voting snax">
				<?php do_action( 'bimber_entry_voting_box', 'mini' ); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
