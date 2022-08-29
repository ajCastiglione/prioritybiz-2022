<?php

/**
 * Services Block Template.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'services-block';

// Create class attribute allowing for custom "className" and "align" values.
$className = 'services';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$services = get_field('services');

?>
<section id="<?php echo esc_attr($id); ?>">
    <div class="<?php echo esc_attr($className); ?>">

        <div class="services__cards">
            <div class="row">

                <?php foreach ($services as $service) :
                    $img = $service['image'];
                    $title = $service['title'];
                    $desc = $service['description'];
                ?>
                    <div class="col-sm-6 col-lg-4 col-xxl-3 gy-3">
                        <div class="card">
                            <img src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" class="card-img-top">
                            <h3 class="card-title"><?= $title ?></h3>
                            <div class="card-text"><?= $desc ?></div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

        </div>

    </div>
</section>