<?php get_header(); ?>

<?= get_template_part('template-parts/hero/general'); ?>

<div id="content">

	<div id="inner-content" class="large-wrapper">

		<main id="main" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

						<section class="entry-content ">
							<?php the_content(); ?>
						</section>

					</article>

			<?php endwhile;
			endif; ?>

		</main>

	</div>

</div>


<?php get_footer(); ?>