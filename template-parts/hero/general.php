<?php

$options = get_field('hero');
$bg = !empty($options['image']) ? $options['image']['url'] : site_url() . '/wp-content/uploads/2021/04/freight-truck1.jpg';
$title = !empty($options['title']) ? $options['title'] : get_the_title();
?>

<section class="hero general">
    <div class="large-wrapper">
        <img src="<?= $bg ?>" class="hero__bg">
        <h1 class="hero__title"><?= $title ?></h1>
    </div>
</section>