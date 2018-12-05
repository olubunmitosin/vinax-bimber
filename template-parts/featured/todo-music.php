<?php
/**
 * The template part for displaying the featured content.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 4.10
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bimber_template_data                      = bimber_get_template_part_data();
$bimber_featured_entries                   = $bimber_template_data['featured_entries'];


$bimber_featured_ids = bimber_get_featured_posts_ids( $bimber_featured_entries );

$bimber_query_args = array();

if ( ! empty( $bimber_featured_ids ) ) {
	$bimber_query_args['post__in']            = $bimber_featured_ids;
	$bimber_query_args['orderby']             = 'post__in';
	$bimber_query_args['ignore_sticky_posts'] = true;
}

$bimber_query = new WP_Query( $bimber_query_args );

$bimber_featured_class = array(
	'archive-featured',
	'archive-featured-stretched',
	'todo-music',
);

if ( ! $bimber_template_data['featured_entries_title_hide'] ) {
	$bimber_featured_class[] = 'archive-featured-with-title';
}

if ( $bimber_template_data['featured_entries_gutter'] ) {
	$bimber_featured_class[] = 'archive-featured-with-gutter';
}
?>

<?php if ( $bimber_query->have_posts() ) : ?>
	<?php $bimber_index = 0; ?>
	<section class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $bimber_featured_class ) ); ?>">
				<?php bimber_render_section_title( wp_kses_post( '<strong>' . $bimber_template_data['featured_entries_title'] . '</strong>' ), $bimber_template_data['featured_entries_title_hide'], array( 'archive-featured-title' ) ); ?>


					<?php if ( $bimber_query->have_posts() ) : $bimber_query->the_post(); ?>
						<div class="todo-music-tile">
							<?php
								bimber_set_template_part_data( $bimber_featured_entries );
								get_template_part( 'template-parts/content-tile-xxl', get_post_format() );
							?>
						</div>
					<?php endif; ?>

					<div class="g1-row">
						<div class="g1-row-inner">

							<div class="g1-column">

								<div class="g1-collection g1-collection-columns-3">
									<div class="g1-collection-viewport">
										<ul class="g1-collection-items">
											<?php while ( $bimber_query->have_posts() ) : $bimber_query->the_post(); ?>
												<li class="g1-collection-item">

													<?php
														$bimber_featured_entries['elements']['summary'] = false;
														$bimber_featured_entries['elements']['author'] = false;
														$bimber_featured_entries['elements']['date'] = false;
														bimber_set_template_part_data( $bimber_featured_entries );

														get_template_part( 'template-parts/content-grid-standard', get_post_format() );
													?>
													
												</li>
											<?php endwhile; ?>
										</ul>
									</div>
								</div><!-- .g1-collection -->

							</div>

						</div>
					</div><!-- .g1-row -->


	</section>

	<?php
	bimber_reset_template_part_data();
	wp_reset_postdata();
endif;