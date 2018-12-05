<?php
/**
 * The Template for displaying archive pages.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bimber_class = array(
	'g1-row',
	'g1-row-layout-page',
	'page-header',
	'page-header-01',
	'archive-header',
	'archive-header-modifiable',
);
$hide_elements = explode( ',', bimber_get_theme_option( 'archive', 'header_hide_elements' ) );

$bimber_class = apply_filters( 'bimber_page_header_class', $bimber_class );
?>

<header class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $bimber_class ) ); ?>">
	<div class="g1-row-inner">
		<div class="g1-column">
			<?php
			if ( ! in_array( 'taxonomy image', $hide_elements, true ) ) {
				bimber_render_archive_featured_image();
			}?>
			<div class="g1-archive-header-text">
				<?php
				if ( bimber_show_breadcrumbs() && ! in_array( 'breadcrumbs', $hide_elements, true ) ) :
					bimber_render_breadcrumbs();
				endif;
				if ( ! in_array( 'title', $hide_elements, true ) ) {
					the_archive_title( '<h1 class="g1-alpha g1-alpha-2nd page-title archive-title">', '</h1>' );
				} else {
					the_archive_title( '<h1 class="g1-alpha g1-alpha-2nd page-title archive-title screen-reader-text">', '</h1>' );
				}
				if ( ! in_array( 'description', $hide_elements, true ) ) {
					the_archive_description( '<h2 class="g1-delta g1-delta-3rd page-subtitle archive-subtitle">', '</h2>' );
				}
				?>
			</div>
			<?php
			if ( ! in_array( 'filters', $hide_elements, true ) ) {
				bimber_render_archive_filter();
			}
			?>
		</div>
	</div>
	<div class="g1-row-background">
	</div>
</header>
