<?php
/**
 * Hero section for general pages
 *
 * @package pbz
 */

$options    = get_field( 'hero' );
$image_id   = ! empty( $options['image']['ID'] ) ? $options['image']['ID'] : get_field( 'header', 'options' )['default_hero_image']['ID'];
$bg_html    = wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'hero__bg' ) );
$image_meta = wp_get_attachment_metadata( $image_id );
// Generate the upload directory uri base path for the images.
$base_path = wp_upload_dir()['baseurl'] . '/';

$hero_title = ! empty( $options['title'] ) ? $options['title'] : get_the_title();
?>

<section class="hero general">
	<div class="large-wrapper">
		<picture>
			<?php
			// Generate <source> elements for different image sizes.
			foreach ( $image_meta['sizes'] as $size ) {
				// Get the upload date of the image.
				$upload_date = get_the_time( 'Y/m', $image_id ) . '/';
				echo '<source media="(max-width: ' . esc_attr( $size['width'] ) . 'px)" srcset="' . esc_attr( $base_path . $upload_date . $size['file'] ) . '">';
			}
			echo wp_kses_post( $bg_html );
			?>
		</picture>
		<h1 class="hero__title"><?php echo esc_html( $hero_title ); ?></h1>
	</div>
</section>
