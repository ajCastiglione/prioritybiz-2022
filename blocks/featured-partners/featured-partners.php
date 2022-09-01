<?php

/**
 * Featured Partners Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'partners-block';

// Create class attribute allowing for custom "className" and "align" values.
$className = 'partners';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$block_title = get_field( 'title' ) ?? 'Featured Partners';
$gallery     = get_field( 'gallery' );

// Add slick slider from cdnjs.
wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ), '1.9.0', true );
wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), '1.9.0' );
wp_enqueue_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css', array(), '1.9.0' );

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">

	<h3 class="partners__title"><?php echo esc_html( $block_title ); ?></h3>

	<div class="partners__gallery">
		<?php foreach ( $gallery as $image ) : ?>
			<img class="image" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
		<?php endforeach; ?> 
	</div>

</section>
