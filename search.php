<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap">

		<main id="main" class="" role="main">
			<h1 class="archive-title"><span><?php _e('Search Results for:', 'pbltheme'); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">

						<header class="entry-header article-header">

							<h3 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

							<p class="byline entry-meta vcard">
								<?php printf(
									__('Posted %1$s by %2$s', 'pbltheme'),
									/* the time the post was published */
									'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
									/* the author of the post */
									'<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link(get_the_author_meta('ID')) . '</span>'
								); ?>
							</p>

						</header>

						<section class="entry-content">
							<?php the_excerpt('<span class="read-more">' . __('Read more &raquo;', 'pbltheme') . '</span>'); ?>

						</section>

						<footer class="article-footer">

							<?php if (get_the_category_list(', ') != '') : ?>
								<?php printf(__('Filed under: %1$s', 'pbltheme'), get_the_category_list(', ')); ?>
							<?php endif; ?>

							<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags:', 'pbltheme') . '</span> ', ', ', '</p>'); ?>

						</footer> <!-- end article footer -->

					</article>

				<?php endwhile; ?>

				<?php pbl_page_navi(); ?>

			<?php else : ?>

				<article id="post-not-found" class="hentry">
					<header class="article-header">
						<h1><?php _e('Sorry, No Results.', 'pbltheme'); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e('Try your search again.', 'pbltheme'); ?></p>
					</section>
					<footer class="article-footer">
						<p><?php _e('This is the error message in the search.php template.', 'pbltheme'); ?></p>
					</footer>
				</article>

			<?php endif; ?>

		</main>

		<?php get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>