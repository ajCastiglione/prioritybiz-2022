<?php
add_action('acf/init', 'my_acf_init');
function my_acf_init()
{
    // Check if function exists and hook into setup.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'services',
            'title'             => __('Services Block'),
            'description'       => __('Displays a row of cards of the services offered.'),
            'render_callback'   => 'render_callback',
            'category'          => 'layout',
            'icon'              => 'admin-post',
            'mode'              => 'edit',
            'align'             => 'wide',
            'keywords'          => array('services'),
            'enqueue_style'     => get_stylesheet_directory_uri() . '/library/dist/services/services.css',
        ));
    }
}

function render_callback($block)
{
    // Name has to be equal to the file name after content
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/blocks" folder
    $path = get_template_directory() . "/blocks/{$slug}/{$slug}.php";
    if (file_exists($path)) {
        include($path);
    }
}
