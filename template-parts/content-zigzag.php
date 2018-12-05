<?php
/**
 * The default template for displaying single post content (with sidebar).
 * This is a template part. It must be used within The Loop.
 *
 * @package Bimber_Theme 5.4
 */

$bimber_entry_data = bimber_get_template_part_data();
$bimber_elements   = $bimber_entry_data['elements'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-tpl-zigzag' ); ?>
         itemscope="" itemtype="<?php echo esc_attr( bimber_get_entry_microdata_itemtype() ); ?>">

	<?php
	if ( $bimber_elements['featured_media'] ) :
		bimber_render_entry_featured_media( array(
			'size'          => 'bimber-zigzag',
			'allow_video'   => true,
		) );
	endif;
	?>

	<?php bimber_render_entry_flags(); ?>

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
					'class'             => 'g1-meta g1-current-background',
				) );
				?>

				<?php
				if ( $bimber_elements['categories'] ) :
					bimber_render_entry_categories();
				endif;
				?>
			</div>

			<?php bimber_render_entry_title( '<h2 class="g1-alpha g1-alpha-1st entry-title" itemprop="headline"><a href="%1$s" rel="bookmark">', '</a></h2>' ); ?>
			<?php if ( $bimber_elements['author'] || $bimber_elements['date'] ) : ?>
				<p class="g1-meta entry-meta">
                    <span class="entry-byline <?php if ( $bimber_elements['avatar'] ) { echo sanitize_html_class( 'entry-byline-with-avatar' );}?>">
						<?php
						if ( $bimber_elements['author'] ) :
							bimber_render_entry_author( array(
								'avatar'        => $bimber_elements['avatar'],
								'avatar_size'   => 30,
							) );
						endif;
						?>

						<?php
						if ( $bimber_elements['date'] ) :
							bimber_render_entry_date();
						endif;
						?>
					</span>
				</p>
			<?php endif; ?>
		</header>

		<?php if ( $bimber_elements['summary'] ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>

		<?php do_action( 'bimber_after_zigzag_content' ); ?>

		<footer class="entry-footer">
			<p>
				<a class="g1-button g1-button-simple g1-button-s" href="<?php the_permalink(); ?>">
					<?php esc_html_e( 'Read more', 'bimber' ); ?>
				</a>
			</p>

			<?php bimber_render_mini_share_buttons(); ?>
		</footer>

		<?php if ( isset( $bimber_elements['voting_box'] ) && $bimber_elements['voting_box'] ) : ?>
			<div class="entry-voting snax">
				<?php do_action( 'bimber_entry_voting_box', 'mini' ); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
