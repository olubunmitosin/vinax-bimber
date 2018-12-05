<?php
/**
 * Latest Reactions BuddyPress
 *
 * @package whats-your-reaction
 * @subpackage Widgets
 */
if ( isset( $_GET['wyr_page'] ) ) {
	$page = $_GET['wyr_page'];
} else {
	$page = 1;
}
$per_page = apply_filters( 'wyr_bp_page_reactions_per_page', 10 );
$offset = ( $page - 1 ) * $per_page;
$wyr_latest_reactions = wyr_get_user_latest_votes( bp_displayed_user_id(), $per_page, $offset );
?>
<div id="wyr-memeber-reactions" class="wyr-memeber-reactions">
	<?php if ( ! empty( $wyr_latest_reactions ) ) : ?>

		<ul class="wyr-links">
			<?php foreach ( $wyr_latest_reactions as $wyr_reaction ) : 
				$post_id = $wyr_reaction->post_id;
				?>
				<li class="wyr-link">
					<?php $wyr_reaction = wyr_get_reaction( $wyr_reaction->vote );
					?>

					<?php wyr_render_reaction_icon( $wyr_reaction->term_id ); ?>

					<div class="wyr-link-header"><p class="entry-title g1-epsilon g1-epsilon-1st"><a href="<?php echo esc_url( get_the_permalink( $post_id ) ); ?>"><?php echo get_the_title( $post_id ); ?></a></p></div>
				</li>
			<?php endforeach; ?>
		</ul>

		<a href="<?php echo esc_url( add_query_arg( 'wyr_page', rawurlencode( $page+1 ) ) );?>" class="wyr-load-more"><?php esc_html_e( 'Load more.', 'wyr' ); ?></a>

	<?php else : ?>
		<p class="wyr-no-results">
			<?php esc_html_e( 'Sorry. No data so far.', 'wyr' ); ?>
		</p>
	<?php endif; ?>
</div>
