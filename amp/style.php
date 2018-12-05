<?php
require_once trailingslashit( get_parent_theme_file_path() ) . 'includes/front/lib/class-bimber-color.php';

$bimber_skin = bimber_get_theme_option( 'global', 'skin' );
?>


<?php
$bimber_stack 	 = bimber_get_current_stack();
$icon_style		 = bimber_get_theme_option( 'global', 'icon_style' );
if ( 'default' === $icon_style && 'bunchy' === $bimber_stack ) {
	$icon_style = 'line';
} elseif ( 'default' === $icon_style ) {
	$icon_style = 'solid';
}
if ( 'line' === $icon_style ) {
	$bimber_font_dir_uri = trailingslashit( get_template_directory_uri() ) . 'css/' . bimber_get_css_theme_ver_directory() . '/bunchy/fonts/';
} else {
	$bimber_font_dir_uri = trailingslashit( get_template_directory_uri() ) . 'css/' . bimber_get_css_theme_ver_directory() . '/bimber/fonts/';
}
?>
@font-face {
	font-family: "bimber";
	src:url("<?php echo $bimber_font_dir_uri; ?>bimber.eot");
	src:url("<?php echo $bimber_font_dir_uri; ?>bimber.eot?#iefix") format("embedded-opentype"),
	url("<?php echo $bimber_font_dir_uri; ?>bimber.woff") format("woff"),
	url("<?php echo $bimber_font_dir_uri; ?>bimber.ttf") format("truetype"),
	url("<?php echo $bimber_font_dir_uri; ?>bimber.svg#bimber") format("svg");
	font-weight: normal;
	font-style: normal;
}

<?php
if ( 'fashion' === bimber_get_current_stack() || 'original-2018' === bimber_get_current_stack() ) :
	$bimber_font_dir_uri = trailingslashit( get_template_directory_uri() ) . 'css/';
?>
	@font-face {
		font-family: "SpartanMB";
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-regular.eot');
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-regular.eot?#iefix') format('embedded-opentype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-regular.woff') format('woff'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-regular.ttf') format('truetype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-regular.svg#SpartanMB-Regular') format('svg');
		font-weight: normal;
		font-style: normal;
	}

	@font-face {
		font-family: "SpartanMB";
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-light.eot');
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-light.eot?#iefix') format('embedded-opentype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-light.woff') format('woff'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-light.ttf') format('truetype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-light.svg#SpartanMB-Light') format('svg');
		font-weight: 300;
		font-style: normal;
	}

	@font-face {
		font-family: "SpartanMB";
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-semibold.eot');
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-semibold.eot?#iefix') format('embedded-opentype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-semibold.woff') format('woff'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-semibold.ttf') format('truetype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-semibold.svg#SpartanMB-Bold') format('svg');
		font-weight: 600;
		font-style: normal;
	}

	@font-face {
		font-family: "SpartanMB";
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-bold.eot');
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-bold.eot?#iefix') format('embedded-opentype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-bold.woff') format('woff'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-bold.ttf') format('truetype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-bold.svg#SpartanMB-Bold') format('svg');
		font-weight: 700;
		font-style: normal;
	}

	@font-face {
		font-family: "SpartanMB";
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-extrabold.eot');
		src: url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-extrabold.eot?#iefix') format('embedded-opentype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-extrabold.woff') format('woff'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-extrabold.ttf') format('truetype'),
			url('<?php echo $bimber_font_dir_uri; ?>spartanmb/spartanmb-extrabold.svg#SpartanMB-ExtraBold') format('svg');
		font-weight: 800;
		font-style: normal;
	}
	<?php endif; ?>
<?php
// @todo Maybe we shouldn't include it like this:
include trailingslashit( get_template_directory() ) . '/css/' . bimber_get_css_theme_ver_directory() . '/styles' . '/' . bimber_get_current_stack() . '/amp-'. $bimber_skin .'.min.css';
?>


.amp-wp-iframe-placeholder {
	background-image: url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> );
}


<?php
$bimber_cs_1_accent1                = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_1_accent1' ) );
$bimber_cs_2_text1                  = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_2_text1' ) );
$bimber_cs_2_background             = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_2_background_color' ) );
?>
a {color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_1_accent1->get_hex() ); ?>;}

.g1-nav-single-prev > a > span:before,
.g1-nav-single-next > a > span:after,
.mashsb-count {
color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_1_accent1->get_hex() ); ?>;
}



.g1-button-solid,
.g1-arrow-solid {
border-color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_2_background->get_hex() ); ?>;
background-color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_2_background->get_hex() ); ?>;
color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_2_text1->get_hex() ); ?>;
}





<?php
$bimber_header_text       = new Bimber_Color( bimber_get_theme_option( 'header', 'text_color' ) );
$bimber_header_accent     = new Bimber_Color( bimber_get_theme_option( 'header', 'accent_color' ) );

$bimber_header_bg1        = new Bimber_Color( bimber_get_theme_option( 'header', 'background_color' ) );
$bimber_header_bg2 = bimber_get_theme_option( 'header', 'bg2_color' );
$bimber_header_bg2 = strlen( $bimber_header_bg2 ) ? new Bimber_Color( $bimber_header_bg2 ) : $bimber_header_bg1;

$bimber_logo = bimber_get_logo();
?>
.g1-header > .g1-row-background {
	background-color:#<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() )?>;
<?php if ( $bimber_header_bg1->get_hex() !== $bimber_header_bg2->get_hex() ) : ?>
	background-image: -webkit-linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
	background-image:    -moz-linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
	background-image:      -o-linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
	background-image:         linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
<?php endif; ?>
}
.g1-header .g1-hamburger {color: #<?php echo sanitize_hex_color_no_hash( $bimber_header_text->get_hex() ); ?>;}
<?php if ( isset( $bimber_logo['width'] ) ) :?>
.g1-header .g1-logo {max-width:<?php echo absint( $bimber_logo['width'] ); ?>px;}
<?php endif;?>





<?php
$bimber_bg1_color = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_1_background_color' ) );
?>

.g1-footer > .g1-row-background {
background-color: #<?php echo sanitize_hex_color_no_hash( $bimber_bg1_color->get_hex() ); ?>;
}

<?php

// we try to get the HB row with logo in it and use it's bg color.
$row_letter = bimber_hb_get_row_with_logo();
if ( $row_letter ) :
	$bimber_hb_backgound       	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_background_color' ) );
?>
.g1-header > .g1-row-background {
	background-color:#<?php echo sanitize_hex_color_no_hash( $bimber_hb_backgound->get_hex() )?>;
}
<?php endif;

$hamburger_size = bimber_get_theme_option( 'header_builder', 'element_size_mobile_menu' );
if ( 'g1-hamburger-m' == $hamburger_size ) : ?>
.g1-hamburger-icon{
	font-size: 24px;
}
<?php elseif ( 'g1-hamburger-s' == $hamburger_size ) : ?>
.g1-hamburger-icon{
	font-size: 16px;
}
<?php endif;
