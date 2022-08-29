<?php
/*
 Template Name: Custom Page Example
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap ">

		<main id="main" class="" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header class="article-header">

							<h1 class="page-title"><?php the_title(); ?></h1>

							<p class="byline vcard">
								<?php printf(__('Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span>', 'pbltheme'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link(get_the_author_meta('ID'))); ?>
							</p>


						</header>

						<section class="entry-content " itemprop="articleBody">
							<?php the_content(); ?>

						</section>


						<footer class="article-footer">

							<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags:', 'pbltheme') . '</span> ', ', ', '</p>'); ?>

						</footer>

						<?php comments_template(); ?>

					</article>

				<?php endwhile;
			else : ?>

				<article id="post-not-found" class="hentry ">
					<header class="article-header">
						<h1><?php _e('Oops, Post Not Found!', 'pbltheme'); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'pbltheme'); ?></p>
					</section>
					<footer class="article-footer">
						<p><?php _e('This is the error message in the page-custom.php template.', 'pbltheme'); ?></p>
					</footer>
				</article>

			<?php endif; ?>

		</main>

		<?php get_sidebar(); ?>

	</div>

</div>


<?php get_footer(); ?>