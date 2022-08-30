<?php

/**
 * CTA Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cta-block';

// Create class attribute allowing for custom "className" and "align" values.
$className = 'cta btn';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$link = get_field( 'link' );

?>

<a id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo $link['target']; ?>">
	<?php echo esc_html( $link['title'] ); ?>
</a>
