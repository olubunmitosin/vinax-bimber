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

<article <?php post_class( 'entry-tpl-txtlist' ); ?>>
	<div class="entry-body">
		<header class="entry-header">
			<?php bimber_render_entry_title( '<h3 class="g1-epsilon g1-epsilon-1st entry-title"><a href="%1$s" rel="bookmark">', '</a></h3>' ); ?>
		</header>

		<?php if ( isset( $bimber_elements['voting_box'] ) && $bimber_elements['voting_box'] ) : ?>
			<div class="entry-voting snax">
				<?php do_action( 'bimber_entry_voting_box', 'mini' ); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
